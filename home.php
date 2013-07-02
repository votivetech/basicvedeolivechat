<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller { 
  function __construct()
	{
		parent::__construct(); 
		//load related libraries, helpers and model 
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->model('check');
		$this->load->model('search');
		$this->load->model('functions');
		$this->load->database();
	}
	
	//function to show home page view......//
	public function index()
	{
		$data='';
		//check login details are posted or not...//
		if($this->input->post('autologin'))
		{
			//check  login credetials.............// 
			$data['checkLogin']=$this->check->checkLogin();
		}
		//to get offset for paging through url segment.......//
		$ts=$this->uri->total_segments();
		$offset= $this->uri->segment($ts);
		
		//get all the active videos with paging.........//
		$data['countvideos']=$this->search->getVideos();
		$pagelimit=$this->functions->getPagelimit();
		$data['pagelinks']=$this->functions->getPageLinks('home/index/'.implode('/',$data['countvideos']['inputs']),$pagelimit,count($data['countvideos']['result']));
		$videos=$this->search->getVideos($pagelimit,$offset);
		$data['videos']=$videos['result'];
		$data['inputs']=$videos['inputs'];
		
		//se title for pages............// 
		$data['title']='Home';
		
		//get all the category insered......................//
		$data['categories']=$this->functions->getCategories();
		
		//load html  view 
		$this->load->view('index',$data);
	}
	//function to register................//
	public function registration()
	{
		$data='';
		//check regisration submitted or not....//
		if($this->input->post('registration')){
			//check registration details correct or not and save it in database..........//
			$data['checkRegistration']=$this->check->checkRegistration();
		}
		//set page title.......//
		$data['title']='Registration';
		
		//load html view......//
		$this->load->view('registration',$data);
	}
	
	//function to show individual video details...............//
	function video()
	{
			//check user logedin or not....................// 
			$this->functions->checkSession();
			
			//get encrepted video file name through url segment.........//
			$vdfilename=base64_decode($this->uri->segment(3));
			
			//get selected video details ............//
			$data['videodata']=$this->functions->getVideoByfileName($vdfilename);
			
			//check confirmation from user to view video and deduction of credits from its account...//
			if(($this->uri->segment(4)=='confirm' && !$this->session->userdata('vconfirm')) || $this->session->userdata('sessusertype')=='Amateur'){
				//check video authority for user and amateur...........................// 
				$data['message']=$this->functions->viewAuthority($data['videodata']);
			}
			else{
				//unset session to check page visited once or not.................//
				$this->session->unset_userdata('vconfirm',false);
				
				//set confirmation method display for user.......................//
				if(isset($data['videodata']->price) && $this->session->userdata('sessusertype')=='User'){
				$data['message']['noauthority']='<span class="error">This video will deduct '.$data['videodata']->price.' credits from your account. Are you sure to view this video...<br><br><a style="float:none;" class="buylink" href="'.base_url().'home/video/'.$this->uri->segment(3).'/confirm">Yes</a><br>OR<br><br><a style="float:none;" class="buylink2" href="'.base_url().'">No</a></span>';
				}
			}
			
			//get category for the selected video to show similar videos................/// 
			$catid='';
			if(isset($data['videodata']->catid)){$catid=$data['videodata']->catid;}
			$data['similarvideos']=$this->functions->getSimilarVideos($catid);
			
			//get videos for left side videos..........................//
			$videos=$this->search->getVideos(4);
			$data['videos']=$videos['result'];
			
			//se page title............................//
			$data['title']='Watch Video';
			
			//load html view...............................//
			$this->load->view('video',$data);
	}
	
	//function for about us page....................//
	public function aboutus()
	{
		$this->load->view('aboutus');
	}
	//function for contact us page....................//
	public function contactus()
	{
		$this->load->view('contactus');
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
