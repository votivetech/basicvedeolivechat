<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller { 
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
		$this->load->model('functions');
		$this->load->model('search');
		$this->load->library('paypal_Lib');
		$this->load->database();
	}

	//function for login user home page....................//
	public function index()
	{
		//check user login.........//
		$this->functions->checkSession();
		$this->profile();
	}
	//function for user profile....................//
	public function profile()
	{
		//check login user is amaeur or admin profile not for user...//
		$this->functions->checkSession(array('Amateur','Admin'));
		$userid='';
		
		//only admin can edit all the users profile..............//
		if($this->session->userdata('sessusertype')=='Admin')
		{
			if($this->uri->segment(3)=='Edit' && $this->uri->segment(4)!='')
			{
				$userid=$this->uri->segment(4);	
			}
			else{
				$userid=$this->session->userdata('sessuserid');
			}
		}
		else{
			//user can edit its own profile details......................// 
			$userid=$this->session->userdata('sessuserid');
		}
		//post profile video............// 
		if($this->input->post('provideoupload')){
			$data['viderror']=$this->create->profileVideoUpload($userid);
			}
		//post profile photo...............//
		if($this->input->post('prophotoupload')){
			$data['photoerror']=$this->create->profilephotoUpload($userid);
			}
		//post profile details.............//
		if($this->input->post('profileupdate')){
			$this->create->profileUpdate($userid);
			}
		//posed change login details..........//
		if($this->input->post('changelogin')){
			$data['changeLoginError']=$this->create->changeLogin($userid);
			}
		
		//get users profile data to edit..........//
		$data['details']=$this->functions->getUserData($userid);
		
		//set page title...................//
		$data['title']='My Profile';
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
				//unset login user session data...........//
		$this->session->unset_userdata($session_array);
		redirect(base_url());
	}
	//function to manage users by admin
	function manageusers()
	{
		$data='';
		//check login session for admin.................//
		$this->functions->checkSession(array('Admin'));
		
		//get last segmant for page offset............//
		$ts=$this->uri->total_segments();
		$offset= $this->uri->segment($ts);
		
		//call to delete user from database......................//
		if($this->uri->segment(3)=='delete' && $this->uri->segment(4))
		{
			$data['deleteMsg']=$this->functions->deleteUser($this->uri->segment(4));
			redirect(base_url().'user/manageusers/');
		}
		//call to change user status (acive/inactive).........//
		if($this->uri->segment(3)=='statuschange' && $this->uri->segment(4))
		{
			$data['statusMsg']=$this->functions->changeUserStatus($this->uri->segment(4));
			redirect(base_url().'user/manageusers/');
		}
		
		//get all the users for management with paging links.................//
		$data['countusers']=$this->search->searchUsers();
		$pagelimit=$this->functions->getPagelimit();
		$data['pagelinks']=$this->functions->getPageLinks('user/manageusers/'.implode('/',$data['countusers']['inputs']),$pagelimit,count($data['countusers']['result']));
		$users=$this->search->searchUsers($pagelimit,$offset);
		$data['users']=$users['result'];
		$data['inputs']=$users['inputs'];
		
		//set page title.........................//
		$data['title']='Manage Users';
		$this->load->view('manageusers',$data);
	}
	//function to manage video category by admin
	function managecategory()
	{
	//check admin login.......//
		$this->functions->checkSession(array('Admin'));
		$data='';
		//call to add posted category..............//
		if($this->input->post('addcategory'))
		{
			$data['addsuccess']=$this->create->addCategory();
		}
		//call to update posted category.............// 
		if($this->input->post('updatecat'))
		{
			$data['addsuccess']=$this->create->updateCategory();
		}
		
		//call to change category status (active/inactive)..............//
		if($this->uri->segment(3)=='changestatus' && $this->uri->segment(4))
		{
			$data['addsuccess']=$this->functions->changeCatStatus($this->uri->segment(4));
			redirect(base_url().'user/managecategory');
		}
		//call to delete seleced caegory from database...................//
		if($this->uri->segment(3)=='delete' && $this->uri->segment(4))
		{
			$data['addsuccess']=$this->functions->deleteCat($this->uri->segment(4));
			redirect(base_url().'user/managecategory');
		}
		
		//get all the categories for management.................//
		$data['categories']=$this->functions->getCategories();
		//set page title.....................//
		$data['title']='Manage Category';
		$this->load->view('managecategory',$data);
	}
	
	//add and manage its own videos by ameteurs............//
	function myvideos()
	{
		//check amateur login or not.........................//
		$this->functions->checkSession(array('Amateur'));
		$data='';
		$userid=$this->session->userdata('sessuserid');
		
		//call to check and add/edit posted video...........//
		if($this->input->post('addvideo')){
		$data['addmsg']=$this->check->checkAddvideo();
		}
		//call to get edited video details...................//
		if($this->uri->segment(3)=='Edit' && $this->uri->segment(4)){
				$data['editvideo']=$this->functions->getVideoById($this->uri->segment(4),$userid);
				
			}
		//call to delete selected video by amateur.................//
		if($this->uri->segment(3)=='delete' && $this->uri->segment(4)){
				$data['addmsg']=$this->functions->deleteVideo($this->uri->segment(4),$userid);
				redirect(base_url().'user/myvideos/');
				
			}
		//call to change video status 
		if($this->uri->segment(3)=='changestatus' && $this->uri->segment(4)){
				$data['addmsg']=$this->functions->changeVideoStatus($this->uri->segment(4),$userid);
				redirect(base_url().'user/myvideos/');
			}
			
		//get page offset for paging .................//
		if(!in_array($this->uri->segment(3),array('Edit','delete','changestatus'))){
		$ts=$this->uri->total_segments();
		$offset= $this->uri->segment($ts);
		}else{$offset=0;}
		
		//get all the login amateur videos for management with paging details.........................// 
		$data['countmyvideos']=$this->search->searchMyvideos($userid);
		$pagelimit=$this->functions->getPagelimit();
		$data['pagelinks']=$this->functions->getPageLinks('user/myvideos/'.implode('/',$data['countmyvideos']['inputs']),$pagelimit,count($data['countmyvideos']['result']));
		$videos=$this->search->searchMyvideos($userid,$pagelimit,$offset);
		$data['myvideos']=$videos['result'];
		$data['inputs']=$videos['inputs'];
		$data['title']='My Video';
		//get categories for select box.........//
		$data['categories']=$this->functions->getSelCategories();
		$this->load->view('myvideos',$data);
	}
	//function to manage all videos by admin
	function managevideos()
	{
		$data='';
		//check admin login..............................//
		$this->functions->checkSession(array('Admin'));
		$offset=0;
		
		//call to add posed video.....................// 
		if($this->input->post('addvideo')){
			$data['addmsg']=$this->check->checkAddvideo();
		}
		
		//call o get video details of selected video for edit............//
		 if($this->uri->segment(3)=='Edit' && $this->uri->segment(4)){
				$data['editvideo']=$this->functions->getVideoById($this->uri->segment(4));
			}
		else if($this->uri->segment(3)=='delete' && $this->uri->segment(4)){
				//call to delete selected video......................//
				$data['addmsg']=$this->functions->deleteVideo($this->uri->segment(4));
				redirect(base_url().'user/managevideos/');
			}
		else if($this->uri->segment(3)=='changestatus' && $this->uri->segment(4)){
				//call o change staus of selected video...................// 
				$data['addmsg']=$this->functions->changeVideoStatus($this->uri->segment(4));
				redirect(base_url().'user/managevideos/');
			}
			else{
				//get last segment for page offset....................// 
				$ts=$this->uri->total_segments();
				$offset= $this->uri->segment($ts);
			}
			
		//search all videos wih paging............................// 	
		$data['countvideos']=$this->search->searchVideos();
		$pagelimit=$this->functions->getPagelimit();
		$data['pagelinks']=$this->functions->getPageLinks('user/managevideos/'.implode('/',$data['countvideos']['inputs']),$pagelimit,count($data['countvideos']['result']));
		$videos=$this->search->searchVideos($pagelimit,$offset);
		$data['videos']=$videos['result'];
		$data['inputs']=$videos['inputs'];
		
		//get all categories for search.............//
		$data['categories']=$this->functions->getSelCategories();
		
		//get all the amateurs for search................//
		$data['uploadedby']=$this->functions->getAllUsers('Amateur');
		
		//set page title..............................//
		$data['title']='Manage Videos';
		$this->load->view('managevideos',$data);
	}
	
	//function to set credits by admin..........//
	function setcredit()
	{
		//check admin logi or not..............//
		$this->functions->checkSession(array('Admin'));
		$data='';
		
		//call to add posted credits..............//
		if($this->input->post('addcredits'))
		{
			$data['addsuccess']=$this->create->addCredit();
		}
		
		//call to delete selected set credits 
		if($this->uri->segment(3)=='delete' && $this->uri->segment(4))
		{
			$data['addsuccess']=$this->functions->deleteCredit($this->uri->segment(4));
			redirect(base_url().'user/setcredit');
		}
		
		//get all the credits...................//
		$data['credits']=$this->functions->getCredits();
		
		//se page title..............//
		$data['title']='Set Credits';
		$this->load->view('setcredits',$data);
	}
	//function to buy credits.........//
	function buycredits()
	{
		//check user session..............//
		$this->functions->checkSession(array('User'));
		$data='';
		
		//get all the set credits
		
		$data['credits']=$this->functions->getCredits();
		$data['title']='Buy Credits';
		$this->load->view('buycredits',$data);
	}
	
	//function to show  my income for login amateur..................//
	function myincome()
	{
		//check amateur login session..................//
		$this->functions->checkSession(array('Amateur'));
		
		//get page offset for paging................//
		$ts=$this->uri->total_segments();
		$offset= $this->uri->segment($ts);
		
		///call to add payouts by amateur for posted payout details.......//
		if($this->input->post('addpayout')){
			$data['addmsg']=$this->check->checkAddpayout();
		}
		
		//get all the income of login amateur with paging..........// 
		$data['countmyincome']=$this->search->searchMyincome();
		$pagelimit=$this->functions->getPagelimit();
		$data['pagelinks']=$this->functions->getPageLinks('user/myincome/'.implode('/',$data['countmyincome']['inputs']),$pagelimit,count($data['countmyincome']['result']));
		$incomes=$this->search->searchMyincome($pagelimit,$offset);
		$data['incomes']=$incomes['result'];
		$data['inputs']=$incomes['inputs'];
		$data['offset']=$offset;
		
		//se page title...............................//
		$data['title']='My Income';
		$this->load->view('myincome',$data);
	}
	//function to view incomes of all the amateurs by admin
	function incomes()
	{
		//check admin session..............................//
		$this->functions->checkSession(array('Admin'));
		
		//get page offset.......................//
		$ts=$this->uri->total_segments();
		$offset= $this->uri->segment($ts);
		
		//get all the income of all the amateur for management by admin.................//
		$data['countincome']=$this->search->searchIncomes();
		$pagelimit=$this->functions->getPagelimit();
		$data['pagelinks']=$this->functions->getPageLinks('user/incomes/'.implode('/',$data['countincome']['inputs']),$pagelimit,count($data['countincome']['result']));
		$incomes=$this->search->searchIncomes($pagelimit,$offset);
		$data['incomes']=$incomes['result'];
		$data['inputs']=$incomes['inputs'];
		$data['offset']=$offset;
		
		//se page title........................//
		$data['title']='Incomes';
		
		//get all the amaeur for searching.............//
		$data['amateurs']=$this->functions->getAllUsers('Amateur');
		
		//get all the users for searching...................//
		$data['users']=$this->functions->getAllUsers('User');
		
		$this->load->view('incomes',$data);
	} 
	//function to manage payouts by admin
	function managepayouts()
	{
		//check session for admin logi............//
		$this->functions->checkSession(array('Admin'));
		
		//get page offe for pagination.............................//
		$ts=$this->uri->total_segments();
		$offset= $this->uri->segment($ts);
		
		//call to change payout status.............................// 
		if($this->uri->segment(3)=='changestatus' && $this->uri->segment(4)!='')
		{
			$this->functions->changePayoutStatus($this->uri->segment(4));
			redirect(base_url().'user/managepayouts/');
		}
		
		//get all the payout request for managemet by admin..........//
		$data['countpayouts']=$this->search->searchPayouts();
		$pagelimit=$this->functions->getPagelimit();
		$data['pagelinks']=$this->functions->getPageLinks('user/managepayouts/'.implode('/',$data['countpayouts']['inputs']),$pagelimit,count($data['countpayouts']['result']));
		$incomes=$this->search->searchPayouts($pagelimit,$offset);
		$data['payouts']=$incomes['result'];
		$data['inputs']=$incomes['inputs'];
		$data['offset']=$offset;
		
		//et page title.......//
		$data['title']='Payouts';
		
		//get all amateur for search inputs........//
		$data['amateurs']=$this->functions->getAllUsers('Amateur');
		$this->load->view('managepayouts',$data);
	}
	//fuction for paypal 
	function paypal()
	{
		//check user session 
		$this->functions->checkSession(array('User'));
		
		//if pypal retur success....//
		if($this->uri->segment(3)=='success')
		{
			if($this->input->post()){
				//add uy credit for that user...........//
				$this->create->addBuyCredit();
			}
			//unset buy credit data in session..............//
			$this->session->unset_userdata(array('buyamount'=>'','buycredits'=>'', 'buyuser'=>''));
			redirect(base_url('user/paypalreturn/success'));
		}
		else if($this->uri->segment(3)=='cancel')
		{
			///if user cancel the payment process than return back into this....//
			$this->session->unset_userdata(array('buyamount'=>'','buycredits'=>'', 'buyuser'=>''));
			redirect(base_url('user/paypalreturn/cancel'));
		}
		else if($this->input->post('buycredits'))
		{
		
		//set paypal credential if user posted a buy credit payment request to paypal...//
		$amount=0;
		$credits=0;
		
		//handel buy credit inputs for payment process.........//
		$buycredit=explode('-',$this->input->post('buycredit'));
		if(isset($buycredit[1])){$amount=$buycredit[1];}
		if(isset($buycredit[0])){$credits=$buycredit[0];}
		
		//set buy credit details into session.........//
			$data=array(
						'buyamount'=>$amount,
						'buycredits'=>$credits,
						'buyuser'=>$this->session->userdata('sessuserid'),
						);
			$this->session->set_userdata($data);
			
			//add form field to post payment details on paypal server......//			
			$this->paypal_lib->add_field('business', 'vikas__1293717953_biz@ymail.com');
			$this->paypal_lib->add_field('return', site_url('user/paypal/success'));
			$this->paypal_lib->add_field('cancel_return', site_url('user/paypal/cancel'));
			$this->paypal_lib->add_field('custom', '1234567890'); // <-- Verify return
			$this->paypal_lib->add_field('item_name','Credits');
			$this->paypal_lib->add_field('amount', $amount);
			$this->paypal_lib->add_field('rm', '2');
			
			//load paypal form....//
			$data['paypal_form'] = $this->paypal_lib->paypal_form();
			
			//a loading view to show process loading....//
			$this->load->view('form', $data);
		}
	}
	
	//function from paypal return
	function paypalreturn()
	{
		//check session for user.......//
		$this->functions->checkSession(array('User'));
		if($this->uri->segment(3)=='success')
		{
			//set success message...//
			$data['message']='<span class="error">Thank you !!!!<br><br></span>  Your payment has been successfully recieved using paypal. Now buy credit successfully added in your credit balance.';
		}
		else if($this->uri->segment(3)=='cancel')
		{
			//set cancel message....................//
			$data['message']='Your payment order has been canceled successfully.';
		}
		$this->load->view('paypalreturn',$data);
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
