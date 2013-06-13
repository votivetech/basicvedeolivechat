<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Functions extends CI_Model {

  function __construct()
	{
		parent::__construct();
		
	}
	//function to get page limits
	function getPagelimit()
	{
		return 2;	
	}
	//function to get page links
	function getPageLinks($url,$perpage,$rows)
	{
		$config['base_url'] = base_url().$url;
		$config['total_rows'] = $rows;
		$config['per_page'] = $perpage; 
		$ts=$this->uri->total_segments();
		if(!in_array($this->uri->segment($ts-1),array('Edit','delete','changestatus'))){
		$config['uri_segment']= $ts;
		}
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['anchor_class']='class="p_page"';
		$config['cur_tag_open'] = '<a class="p_page active">';
		$config['cur_tag_close'] = '</a>';
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}
	//function to get users by email
	function getUserByEmail($email=NULL)
	{
		if($email!=NULL)
		{
		  $query=$this->db->select('userid,name,email,usertype')->from('users')->where('email',$email)->get();
			if($query->num_rows()!=0)
			{
				return $query->result();
			}
		}
	}
	
	//function to get users by email
	function getUserData($userid=NULL)
	{
		if($userid!=NULL)
		{
			$query=$this->db->select('userid,name,email,usertype,password,age,from,aboutme,photo,video')->from('users')->where('userid',$userid)->get();
			if($query->num_rows()!=0)
			{
				return $query->result();
			}
		}
	}
	//check session for admin,user,amateurs
	function checkTypeSession($usertype=NULL)
	{
		if($this->session->userdata('sessusertype')==$usertype)
		{
			redirect(base_url());
		}	
	}
	
	//check session 
	function checkSession($users=array())
	{
		if($this->session->userdata('sessuserid'))
		{
			if(count($users)!=0 && in_array($this->session->userdata('sessusertype'),$users)==false)
			{
				redirect(base_url());	
			}
		}	
		else{
			redirect(base_url());
			}
	}
	//function to get all users
	function getAllUsers($type=NULL)
	{
		$this->db->select('userid,name,email,usertype,age,from,aboutme,photo,video,status')->from('users');
		if($type!=NULL){
				$this->db->where('usertype = "'.$type.'"');
			}
		$query=$this->db->get();
			if($query->num_rows()!=0)
			{
				return $query->result();
			}
	}
	//function to delete users
	function deleteUser($userid=NULL)
	{
		if($userid!=NULL)
		{
			$this->db->where('userid',$userid);	
			$this->db->delete('users');
		}
	}
	//function to change user active status
	function changeUserStatus($userid)
	{
		if($userid!=NULL && is_numeric($userid))
		{
			$query=$this->db->select('status')->from('users')->where('userid',$userid)->get();
			if($query->num_rows()!=0)
			{
				$result=$query->row();
				$status=$result->status;
				
				if($status==0){$updatedata=array('status'=>'1');}
				else if($status==1){$updatedata=array('status'=>'0');}
				$this->db->where('userid',$userid);
				$this->db->update('users',$updatedata);
			}
		}
	}
	
	//function to get all categories
	function getCategories()
	{
			$query=$this->db->select('category,status,catid')->from('categories')->get();
			if($query->num_rows()!=0)
			{
				return $query->result();
			}
	}
	//function to get all categories
	function getSelCategories()
	{
			$query=$this->db->select('category,status,catid')->from('categories')->where('status',1)->get();
			if($query->num_rows()!=0)
			{
				return $query->result();
			}
	}
	//function to change cat status
	function changeCatStatus($catid=NULL)
	{
		if($catid!=NULL && is_numeric($catid))
		{
			$query=$this->db->select('status')->from('categories')->where('catid',$catid)->get();
			if($query->num_rows()!=0)
			{
				$result=$query->row();
				$status=$result->status;
				
				if($status==0){$updatedata=array('status'=>'1');}
				else if($status==1){$updatedata=array('status'=>'0');}
				$this->db->where('catid',$catid);
				$this->db->update('categories',$updatedata);
			}
		}
	}
	//function to delete categories
	function deleteCat($catid=NULL)
	{
		if($catid!=NULL && is_numeric($catid))
		{
			$this->db->where('catid',$catid);	
			$this->db->delete('categories');
			return 'Category Deleted Successfully';
		}
	}
	
	//function to get video by id
	function getVideoById($vid=NULL,$uid=NULL)
	{
			if($vid!=NULL && is_numeric($vid))
			{
					$this->db->select('video,videoid,catid,name,price,userid,status')->from('videos');
					$this->db->where('videoid',$vid);
					if($uid!=NULL){
					$this->db->where('userid',$uid);
					}
					$query=$this->db->get();
				if($query->num_rows()!=0)
				{
					return $query->row();
				}
			}
	}
	//function to delete video
	function deleteVideo($vid=NULL,$uid=NULL)
	{
		$result=array();
			if($vid!=NULL && is_numeric($vid))
			{
				$this->db->where('videoid',$vid);	
				if($uid!=NULL && is_numeric($uid))
				{
					$this->db->where('userid',$uid);	
				}
				$this->db->delete('videos');
				 $result['success']='Video Deleted Successfully.';
				 return $result;
			}
	}
	//function to change video status
	function changeVideoStatus($vid=NULL,$uid=NULL)
	{
		$result=array();
			if($vid!=NULL && is_numeric($vid))
			{
				$vdata=$this->functions->getVideoById($vid);
				if(isset($vdata))
				{
					if($vdata->status==1){$newstatus=array('status'=>0);}
					if($vdata->status==0){$newstatus=array('status'=>1);}
					
					$this->db->where('videoid',$vid);	
					if($uid!=NULL && is_numeric($uid))
					{
						$this->db->where('userid',$uid);	
					}
					$this->db->update('videos',$newstatus);
				 	$result['success']='Status Changed Successfully.';
				 	return $result;
				}
			}
	}
	//function to get video by its video file name
	function getVideoByfileName($filename=NULL)
	{
		if($filename!=NULL)
		{
			$this->db->select('a.video,a.videoid,a.status,a.catid,a.name,a.price,b.category,c.name profilename,c.age')->from('videos a left join categories b on a.catid = b.catid left join users c on c.userid = a.userid');
			$this->db->where('a.video = "'.$filename.'"');
			$query=$this->db->get();
			if($query->num_rows()!=0)
			{
				return $query->row();
			}	
		}
	}
	//function to get sim ilar videos 
	function getSimilarVideos($catid)
	{
			$this->db->select('a.video,a.videoid,a.status,a.catid,a.name,a.price,b.category,c.name profilename,c.age')->from('videos a left join categories b on a.catid = b.catid left join users c on c.userid = a.userid');
			if($catid!=NULL)	{
				$this->db->where('a.catid like "'.$catid.'"');
			}
			$this->db->order_by('a.videoid','random');
			$query=$this->db->get();
			if($query->num_rows()!=0)
			{
				return $query->result();
			}	
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
