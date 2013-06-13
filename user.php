<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller { 
  function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->model('check');
		$this->load->model('functions');
		$this->load->model('search');
		$this->load->database();
	}

	//function for user dashboard....................//
	public function index()
	{
		$this->functions->checkSession();
		redirect(base_url());
		//$this->profile();
	}
	//function for user profile....................//
	public function profile()
	{
		$this->functions->checkSession(array('Amateur','Admin'));
		$userid='';
		if($this->session->userdata('sessusertype')=='Admin')
		{
			if($this->uri->segment(3)=='Edit' && $this->uri->segment(4)!='')
			{
				$userid=$this->uri->segment(4);	
			}
		}
		else{
			$userid=$this->session->userdata('sessuserid');
		}
		if($this->input->post('provideoupload')){
			$data['viderror']=$this->create->profileVideoUpload($userid);
			}
		if($this->input->post('prophotoupload')){
			$data['photoerror']=$this->create->profilephotoUpload($userid);
			}
		if($this->input->post('profileupdate')){
			$this->create->profileUpdate($userid);
			}
		if($this->input->post('changelogin')){
			$data['changeLoginError']=$this->create->changeLogin($userid);
			}
		$data['details']=$this->functions->getUserData($userid);
		$this->load->view('profile',$data);
	}
	//function for user logout....................//
	public function logout()
	{
		$session_array=array(
					'sessuserid'=>'',
					'sesemail'=>'',
					'sessname'=>'',
					'sessusertype'=>'',
				);
		$this->session->unset_userdata($session_array);
		redirect(base_url());
	}
	//function to manage users by admin
	function manageusers()
	{
		$data='';
		$this->functions->checkSession(array('Admin'));
		$ts=$this->uri->total_segments();
		$offset= $this->uri->segment($ts);
		if($this->uri->segment(3)=='delete' && $this->uri->segment(4))
		{
			$data['deleteMsg']=$this->functions->deleteUser($this->uri->segment(4));
			redirect(base_url().'user/manageusers/');
		}
		if($this->uri->segment(3)=='statuschange' && $this->uri->segment(4))
		{
			$data['statusMsg']=$this->functions->changeUserStatus($this->uri->segment(4));
			redirect(base_url().'user/manageusers/');
		}
		$data['countusers']=$this->search->searchUsers();
		$pagelimit=$this->functions->getPagelimit();
		$data['pagelinks']=$this->functions->getPageLinks('user/manageusers/'.implode('/',$data['countusers']['inputs']),$pagelimit,count($data['countusers']['result']));
		$users=$this->search->searchUsers($pagelimit,$offset);
		$data['users']=$users['result'];
		$data['inputs']=$users['inputs'];
		$data['title']='Manage Users';
		$this->load->view('manageusers',$data);
	}
	//function to manage video category
	function managecategory()
	{
		$this->functions->checkSession(array('Admin'));
		$data='';
		if($this->input->post('addcategory'))
		{
			$data['addsuccess']=$this->create->addCategory();
		}
		if($this->input->post('updatecat'))
		{
			$data['addsuccess']=$this->create->updateCategory();
		}
		if($this->uri->segment(3)=='changestatus' && $this->uri->segment(4))
		{
			$data['addsuccess']=$this->functions->changeCatStatus($this->uri->segment(4));
			redirect(base_url().'user/managecategory');
		}
		if($this->uri->segment(3)=='delete' && $this->uri->segment(4))
		{
			$data['addsuccess']=$this->functions->deleteCat($this->uri->segment(4));
			redirect(base_url().'user/managecategory');
		}
		$data['categories']=$this->functions->getCategories();
		$this->load->view('managecategory',$data);
	}
	//add videos by ameteurs
	function myvideos()
	{
		$this->functions->checkSession(array('Amateur'));
		$data='';
		$userid=$this->session->userdata('sessuserid');
		if($this->input->post('addvideo')){
		$data['addmsg']=$this->check->checkAddvideo();
		}
		if($this->uri->segment(3)=='Edit' && $this->uri->segment(4)){
				$data['editvideo']=$this->functions->getVideoById($this->uri->segment(4),$userid);
				
			}
		if($this->uri->segment(3)=='delete' && $this->uri->segment(4)){
				$data['addmsg']=$this->functions->deleteVideo($this->uri->segment(4),$userid);
				redirect(base_url().'user/myvideos/');
				
			}
		if($this->uri->segment(3)=='changestatus' && $this->uri->segment(4)){
				$data['addmsg']=$this->functions->changeVideoStatus($this->uri->segment(4),$userid);
				redirect(base_url().'user/myvideos/');
			}
		if(!in_array($this->uri->segment(3),array('Edit','delete','changestatus'))){
		$ts=$this->uri->total_segments();
		$offset= $this->uri->segment($ts);
		}else{$offset=0;}
		$data['categories']=$this->functions->getSelCategories();
		$data['countmyvideos']=$this->search->searchMyvideos($userid);
		$pagelimit=$this->functions->getPagelimit();
		$data['pagelinks']=$this->functions->getPageLinks('user/myvideos/'.implode('/',$data['countmyvideos']['inputs']),$pagelimit,count($data['countmyvideos']['result']));
		$videos=$this->search->searchMyvideos($userid,$pagelimit,$offset);
		$data['myvideos']=$videos['result'];
		$data['inputs']=$videos['inputs'];
		$this->load->view('myvideos',$data);
	}
	//function to manage videos by admin
	function managevideos()
	{
		$data='';
		$this->functions->checkSession(array('Admin'));
		$ts=$this->uri->total_segments();
		$offset= $this->uri->segment($ts);
		if($this->input->post('addvideo')){
			$data['addmsg']=$this->check->checkAddvideo();
		}
		if($this->uri->segment(3)=='Edit' && $this->uri->segment(4)){
				$data['editvideo']=$this->functions->getVideoById($this->uri->segment(4));
				
			}
		if($this->uri->segment(3)=='delete' && $this->uri->segment(4)){
				$data['addmsg']=$this->functions->deleteVideo($this->uri->segment(4));
				redirect(base_url().'user/managevideos/');
				
			}
		if($this->uri->segment(3)=='changestatus' && $this->uri->segment(4)){
				$data['addmsg']=$this->functions->changeVideoStatus($this->uri->segment(4));
				redirect(base_url().'user/managevideos/');
			}
		$data['countvideos']=$this->search->searchVideos();
		$pagelimit=$this->functions->getPagelimit();
		$data['pagelinks']=$this->functions->getPageLinks('user/managevideos/'.implode('/',$data['countvideos']['inputs']),$pagelimit,count($data['countvideos']['result']));
		$videos=$this->search->searchVideos($pagelimit,$offset);
		$data['videos']=$videos['result'];
		$data['inputs']=$videos['inputs'];
		$data['categories']=$this->functions->getSelCategories();
		$data['uploadedby']=$this->functions->getAllUsers('Amateur');
		
		$data['title']='Manage Videos';
		$this->load->view('managevideos',$data);
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
