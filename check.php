<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check extends CI_Model {
  function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('create');
		$this->load->model('functions');
		
	}
	//function to check registration details
	function checkRegistration()
	{
		$this->form_validation->set_rules('usertype','User Type','required');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password','Password','required|min_length[6]');
		$this->form_validation->set_rules('re_password','Re-Password','required|matches[password]');
		$this->form_validation->set_rules('agree','Terms and conditions','required');
		if($this->form_validation->run())
		{
			$create=$this->create->createRegistration();
			return $create;
		}
	}
	
	//function to check login details
	function checkLogin()
	{
		$this->form_validation->set_rules('login','Login Id','required');
		$this->form_validation->set_rules('password','Password','required');
		if($this->form_validation->run())
		{
		
			$email=$this->input->post('login');
			$userExist=$this->functions->getUserByEmail($email);
			if($userExist)
			{
				$session_array=array(
					'sessuserid'=>$userExist[0]->userid,
					'sesemail'=>$userExist[0]->email,
					'sessname'=>$userExist[0]->name,
					'sessusertype'=>$userExist[0]->usertype,
				);
				$this->session->set_userdata($session_array);
				redirect(base_url().'user/');		
			}
			else{
				return 'Your Login Details are incorrect.';
			}
		}
	}
	//function to check add video form data
	function checkAddvideo()
	{
		$check=array();
		
		if(!$this->input->post('editvidid')){
		if($_FILES['videofile']['error']!=0){
				$check['verror']='Please Select a Video File first';
			}
		if($_FILES['vimage']['error']!=0){
				$check['imgerror']='Please Select a Video Image File first';
			}
		}
		
		$this->form_validation->set_rules('videoname','Name','required');
		$this->form_validation->set_rules('videoprice','Price','required|numeric');
		$this->form_validation->set_rules('videocategory','Category','required');
		if($this->form_validation->run())
		{
			if($this->input->post('editvidid')){
					$check=$this->create->updateVideo($this->input->post('editvidid'));
				}
				else{
					$check=$this->create->addVideo($this->session->userdata('sessuserid'));
				}
		}
		
		return $check;
	}
	//fuction to check payout add details
	function checkAddpayout()
	{
		//check payout submitted details are correct or icorrect..........//
		$this->form_validation->set_rules('acc_no','Account No.','required');
		$this->form_validation->set_rules('bank_code','Bank Code','required');
		$this->form_validation->set_rules('variable','Variable','required');
		if($this->form_validation->run())
		{
			if($this->input->post('amount')<20){
				return '<span class="error">Error : Minimum to pay out is $20. </span>';
			}
			else
			{
				return $this->create->createPayouts();
			}
		}
	} 
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
