<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Create extends CI_Model {
  function __construct()
	{
		parent::__construct();
		
	}
	
	//function to check registration 
	function createRegistration()
	{
		//set data for storage.....//
		$data=array(
		'name'=>$this->input->post('name'),
		'usertype'=>$this->input->post('usertype'),
		'email'=>$this->input->post('email'),
		'password'=>$this->input->post('password'),
		'dateofbirth'=>$this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day'),
		'terms'=>$this->input->post('agree'),
		'status'=>1,
		'date'=>date('Y-m-d'),
		'time'=>date('h:i:s'),
		);
		
		//insert user details.......................//
		$this->db->insert('users',$data);
		return 'Regisration Successfully Completed.';
	}
	//function to upload profile video...//
	function profileVideoUpload($userid=NULL)
	{
		if($userid!=NULL)
		{
			if($_FILES['profilevideo']['error']==0)
			{
			$ext=preg_replace("/.*\.([^.]+)$/","\\1", $_FILES['profilevideo']['name']);
			$filename='provid'.$userid.'_'.date('ymdhis').'.'.$ext;
			$config['file_name'] =$filename;
			$config['upload_path'] = './uploads/profilevideos/';
			$config['allowed_types'] = 'mp4|3gp|3gpp|mpeg|wmv|gif|avi|flv|webm|ogg|swf';
			$this->load->library('upload');
			$this->upload->initialize($config);
			if($this->upload->do_upload('profilevideo'))
				{
					$fileinsertdata=array(
					'video'=>$filename,
					);
					$this->db->where('userid',$userid);
					$this->db->update('users',$fileinsertdata);
					
				}	
				else{
					return strip_tags($this->upload->display_errors());
				}
			}
		}
	}
	
	//function to upload profile photo...//
	function profilephotoUpload($userid=NULL)
	{
		if($userid!=NULL)
		{
			if($_FILES['profilephoto']['error']==0)
			{
			$ext=preg_replace("/.*\.([^.]+)$/","\\1", $_FILES['profilephoto']['name']);
			$filename='prophoto'.$userid.'_'.date('ymdhis').'.'.$ext;
			$config['file_name'] =$filename;
			$config['upload_path'] = './uploads/profilephotos/';
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$this->load->library('upload');
			$this->upload->initialize($config);
			if($this->upload->do_upload('profilephoto'))
				{
				$fileinsertdata=array(
				'photo'=>$filename,
				);
				$this->db->where('userid',$userid);
				$this->db->update('users',$fileinsertdata);
			
				}	
				else{
					return strip_tags($this->upload->display_errors());
				}
			}
		}
	}
	
	//function to update profile
	function profileUpdate($userid=NULL)
	{
		if($userid!=NULL){
			$dataUpdate=array(
			'age'=>$this->input->post('profileage'),
			'from'=>$this->input->post('profilfrom'),
			'aboutme'=>$this->input->post('aboutme'),
			);	
			if($this->input->post('profilename')!=''){
				$dataUPdate['name']=$this->input->post('profilename');
			}
			$this->db->where('userid',$userid);
			$this->db->update('users',$dataUpdate);
		}
	}
	
	//function to change login
	function changeLogin($userid=NULL)
	{
		if($userid!=NULL){
			$this->form_validation->set_rules('email','Email','required|valid_email');
			$this->form_validation->set_rules('password','Password','required|min_length[6]');
			$this->form_validation->set_rules('re_password','Re-Password','required|matches[password]');
			if($this->form_validation->run())
			{
				$dataUpdate=array(
				'email'=>$this->input->post('email'),
				'password'=>$this->input->post('password'),
				);
				//check email exist or not
			$query=$this->db->select('userid')->from('users')->where('email = "'.$dataUpdate['email'].'"')->where('userid != '.$userid)->get();
				if($query->num_rows()!=0)
				{
					return 'Email Alredy Exist Choose Another Emailid';
				
				}else
				{
					$this->db->where('userid',$userid);
					$this->db->update('users',$dataUpdate);
				}
			}
		}
	}
	//function to create category
	function addCategory()
	{
		$this->form_validation->set_rules('category','Category','required');
		if($this->form_validation->run())
		{
			$catData=array(
				'category'=>$this->input->post('category'),
				'status'=>1,
				);
				$this->db->insert('categories',$catData);
				return 'Category Added Successfully';
		}
	}
	//function to update category
	function updateCategory()
	{
		$catid=$this->input->post('updateId');	
		$updatecat=$this->input->post('catupdate');	
		if($updatecat!='')
		{
			$this->db->where('catid = '.$catid);
			$this->db->update('categories',array('category'=>$updatecat));
			return 'Category Updated Successfully';
		}
	}
	//function to add new video
	function addVideo($userid=NULL)
	{
		$result=array();
		$error=0;
		//upload video file
			if($_FILES['videofile']['error']==0 && $userid!=NULL)
			{
			$ext=preg_replace("/.*\.([^.]+)$/","\\1", $_FILES['videofile']['name']);
			$filename='myvid'.$userid.'_'.date('ymdhis').'.'.$ext;
			$config['file_name'] =$filename;
			$config['upload_path'] = './uploads/myvideos/';
			$config['allowed_types'] = 'mp4|3gp|3gpp|mpeg|wmv|gif|avi|flv|webm|ogg|swf';
			$this->load->library('upload');
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('videofile'))
				{
					$result['verror']=strip_tags($this->upload->display_errors());
					$error=1;
				}	
			}
			else{
				$error=1;
				 $result['verror']='Please Select a Video File first';	
			}
			$imagefilename='';
			
			//upload video image 
			if($_FILES['vimage']['error']==0 && $userid!=NULL)
			{
			$ext=preg_replace("/.*\.([^.]+)$/","\\1", $_FILES['vimage']['name']);
			$imagefilename='myvidimage'.$userid.'_'.date('ymdhis').'.'.$ext;
			$config['file_name'] =$imagefilename;
			$config['upload_path'] = './uploads/myvideoimages/';
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$this->load->library('upload');
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('vimage'))
				{
					$result['imgerror']=strip_tags($this->upload->display_errors());
					
					$error=1;
				}	
			}
			else{
				 $error=1;
				 $result['imgerror']='Please Select a video image First.';
			}
			
			//enter video details in database
			if($error==0)
			{
				$fileinsertdata=array(
				'userid'=>$userid,
				'video'=>$filename,
				'vimage'=>$imagefilename,
				'name'=>$this->input->post('videoname'),
				'price'=>$this->input->post('videoprice'),
				'catid'=>$this->input->post('videocategory'),
				'date'=>date('Y-m-d'),
				'time'=>date('h:i:s'),
				'status'=>1,				
				);
				
				$this->db->insert('videos',$fileinsertdata);
				$result['success']='Video Uploaded Successfully.';
			}
			
			return $result;
	}
	
	//function to update video
	function updateVideo($vid=NULL)
	{
		if($vid!=NULL){
			$result=array();
				$fileinsertdata=array(
				'name'=>$this->input->post('videoname'),
				'price'=>$this->input->post('videoprice'),
				'catid'=>$this->input->post('videocategory'),
				);
				//upload video image 
					if($_FILES['vimage']['error']==0)
					{
					$ext=preg_replace("/.*\.([^.]+)$/","\\1", $_FILES['vimage']['name']);
					$imagefilename='myvidimage'.'_'.date('ymdhis').'.'.$ext;
					$config['file_name'] =$imagefilename;
					$config['upload_path'] = './uploads/myvideoimages/';
					$config['allowed_types'] = 'jpg|jpeg|gif|png';
					$this->load->library('upload');
					$this->upload->initialize($config);
					if($this->upload->do_upload('vimage'))
						{
							$fileinsertdata['vimage']=$imagefilename;
						}
						else{
							$result['imgerror']=strip_tags($this->upload->display_errors());
						}	
					}
				//update deatails....//
				$this->db->where('videoid',$vid);
				$this->db->update('videos',$fileinsertdata);
				$result['success']='Video Updated Successfully.';
				return $result;
		}
	}
	//function to save credit setting
	function addCredit()
	{
		//check sumited details are correc or not..........................//
		$this->form_validation->set_rules('credits','Credit','required|numeric');
		$this->form_validation->set_rules('amount','Amount','required|numeric');
		if($this->form_validation->run())
		{
			$creditData=array(
				'credits'=>$this->input->post('credits'),
				'amount'=>$this->input->post('amount'),
				'date'=>date('Y-m-d'),
				'time'=>date('h:i:s'),
				);
				
				//insert into database................//
				$this->db->insert('setcredits',$creditData);
				return 'Credit Added Successfully';
		}
	}
	
	//function to add buy credits
	function addBuyCredit()
	{
		//get input details from session........// 
			$amount=$this->session->userdata('buyamount');
			$credit=$this->session->userdata('buycredits');
			$user=$this->session->userdata('buyuser');
			if(isset($amount) && isset($credit) && isset($user)){
			$creditData=array(
				'userid'=>$user,
				'credits'=>$credit,
				'amount'=>$amount,
				'date'=>date('Y-m-d'),
				'time'=>date('h:i:s'),
				);
				//insert buy credit entry for history or management ..........// 
				$this->db->insert('buycredits',$creditData);
				$userdata=$this->functions->getUserData($user);
				if(isset($userdata)){
				
				//update users credits ..........//
					$updateCredits=array(
						'credits'=>$userdata->credits + $credit,
						'amounts'=>$userdata->credits + $amount,
					);
					$this->db->where('userid',$user);
					$this->db->update('users',$updateCredits);
				}
			}
	}
	//fuction to create payout for amateur
	function createPayouts()
	{
		$payoutData=array(
			'amateurid'=>$this->session->userdata('sessuserid'),
			'amount'=>$this->input->post('amount'),
			'accountno'=>$this->input->post('acc_no'),
			'bankcode'=>$this->input->post('bank_code'),
			'variable'=>$this->input->post('variable'),
			'date'=>date('Y-m-d'),
			'time'=>date('h:i:s'),
		);
		$this->db->insert('payouts',$payoutData);
		return '<span class="success"><b>Payout Details Send Successfully.</b></span>';
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
