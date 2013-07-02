<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Model {

  function __construct()
	{
		parent::__construct();

	}
	
	//function to search users......//
	function searchUsers($limit=NULL,$offset=NUll)
	{
		//make a input array for searching input fields..........//
		$input_array=array('searchusername','searchuseremail','searchusertype','searchuserstatus');
		
		//result array return search result and inputs.........//
		$result=array('result'=>array(),'inputs'=>array());
		
		//query to search data for differet input fields..................//
		$this->db->select('userid,name,email,usertype,status,from')->from('users');
		
		if($this->input->post('searchusername')){
			$this->db->where('name like "%'.$this->input->post('searchusername').'%"');
			$result['inputs']['searchusername']='searchusername+'.$this->input->post('searchusername');
		}
		if($this->input->post('searchuseremail')){
			$this->db->where('email = "'.$this->input->post('searchuseremail').'"');
			$result['inputs']['searchuseremail']='searchuseremail+'.$this->input->post('searchuseremail');
		}
		if($this->input->post('searchusertype')!=''){
			$this->db->where('usertype = "'.$this->input->post('searchusertype').'"');
			$result['inputs']['searchusertype']='searchusertype+'.$this->input->post('searchusertype');
		}
		if($this->input->post('searchuserstatus')!=''){
			$this->db->where('status = "'.$this->input->post('searchuserstatus').'"');
			$result['inputs']['searchuserstatus']='searchuserstatus+'.$this->input->post('searchuserstatus');
		}
		
		///for pagiaion on searching inputs .........//
		for($i=3;$i<=6;$i++)
		{
			if($this->uri->segment($i)!='')
			{
			$input=$this->uri->segment($i);
				if(strpos($input,'+'))
				{
					$explodeinput=explode('+',$input);
					$inputvar=$explodeinput[0];
					$inputvalue=$explodeinput[1];
					if(in_array($inputvar,$input_array)){
					if($inputvar=='searchusername'){	$this->db->where('name like "%'.$inputvalue.'%"');	}
					if($inputvar=='searchuseremail'){$this->db->where('email = "'.$inputvalue.'"');}
					if($inputvar=='searchusertype'){	$this->db->where('usertype = "'.$inputvalue.'"');	}
					if($inputvar=='searchuserstatus'){	$this->db->where('status <= "'.$inputvalue.'"');	}
					}
					$result['inputs'][$inputvar]=$inputvar.'+'.$inputvalue;
				}
			}
		}
		//set limit and offset for pagination...............//
		if($limit!=NULL || $offset!=NULL)
		{$this->db->limit($limit,$offset);}
		
		//execute query.................//
		$query=$this->db->get();
		
		if($query->num_rows()!=0)
		{
			$result['result']=$query->result();
		}
		
		return $result;
	}
	
	//function to search my videos
	function searchMyvideos($userid=NULL,$limit=NULL,$offset=NULL)
	{
		//make a input array for searching input fields..........//
		$input_array=array('searchvname','searchvcategory','searchvstatus');
		
		//result array return search result and inputs.........//
		$result=array('result'=>array(),'inputs'=>array());
		
		//query to search data for differet input fields..................//
		$query=$this->db->select('a.video,a.videoid,a.status,a.catid,a.name,a.price,a.vimage,b.category')->from('videos a left join categories b on a.catid = b.catid');
		$this->db->where('userid',$userid);
		if($this->input->post('searchvname')){
			$this->db->where('a.name like "%'.$this->input->post('searchvname').'%"');
			$result['inputs']['searchvname']='searchvname+'.$this->input->post('searchvname');
		}
		if($this->input->post('searchvcategory')){
			$this->db->where('a.catid = "'.$this->input->post('searchvcategory').'"');
			$result['inputs']['searchvcategory']='searchvcategory+'.$this->input->post('searchvcategory');
		}
		if($this->input->post('searchvstatus')!=''){
			$this->db->where('a.status = "'.$this->input->post('searchvstatus').'"');
			$result['inputs']['searchvstatus']='searchvstatus+'.$this->input->post('searchvstatus');
		}
		
		///for pagiaion on searching inputs .........//
		for($i=3;$i<=6;$i++)
		{
			if($this->uri->segment($i)!='')
			{
			$input=$this->uri->segment($i);
				if(strpos($input,'+'))
				{
					$explodeinput=explode('+',$input);
					$inputvar=$explodeinput[0];
					$inputvalue=$explodeinput[1];
					if(in_array($inputvar,$input_array)){
					if($inputvar=='searchvname'){	$this->db->where('a.name like "%'.$inputvalue.'%"');	}
					if($inputvar=='searchvcategory'){$this->db->where('a.catid = "'.$inputvalue.'"');}
					if($inputvar=='searchvstatus'){	$this->db->where('a.status = "'.$inputvalue.'"');	}
					}
					$result['inputs'][$inputvar]=$inputvar.'+'.$inputvalue;
				}
			}
		}
		//apply limit ad offset for pagination..................//
		if($limit!=NULL || $offset!=NULL)
		{$this->db->limit($limit,$offset);}
		
		
		$query=$this->db->get();
		if($query->num_rows()!=0)
		{
			$result['result']=$query->result();
		}
		return $result;
	}
	
	//function to show all the videos .................//
	function getVideos($limit=NULL,$offset=NULL)
	{
		//make a input array for searching input fields..........//
		$input_array=array('category');
		
		//result array return search result and inputs.........//
		$result=array('result'=>array(),'inputs'=>array());
		
		//query to search data for differet input fields..................//
		$query=$this->db->select('a.video,a.videoid,a.status,a.catid,a.name,a.price,a.vimage,b.category,c.name as profilename')->from('videos a left join categories b on a.catid = b.catid left join users c on a.userid=c.userid')->where('a.status',1);
		if($this->input->get('category')){
			$this->db->where('a.catid = "'.$this->input->get('category').'"');
			$result['inputs']['category']='category+'.$this->input->get('category');
		}
	
	///for pagiaion on searching inputs .........//
			if($this->uri->segment(3)!='')
			{
				$input=$this->uri->segment(3);
				if(strpos($input,'+'))
				{
					$explodeinput=explode('+',$input);
					$inputvar=$explodeinput[0];
					$inputvalue=$explodeinput[1];
					if(in_array($inputvar,$input_array)){
					if($inputvar=='category'){	$this->db->where('a.catid = "'.$inputvalue.'"');}
					}
					$result['inputs'][$inputvar]=$inputvar.'+'.$inputvalue;
				}
			}
		
		//set limit and offset for pagination...............//
		if($limit!=NULL || $offset!=NULL)
		{$this->db->limit($limit,$offset);}
		
		$query=$this->db->get();
		if($query->num_rows()!=0)
		{
			$result['result']=$query->result();
		}
		return $result;
	}
	//function to search al videos by admin
	function searchVideos($limit=NULL,$offset=NULL)
	{
		//make a input array for searching input fields..........//
		$input_array=array('searchvname','searchvcategory','searchvstatus');
		
		//result array return search result and inputs.........//
		$result=array('result'=>array(),'inputs'=>array());
		
		//query to search data for differet input fields..................//
		$query=$this->db->select('a.video,a.videoid,a.status,a.catid,a.name,a.price,a.vimage,b.category,c.name as profilename')->from('videos a left join categories b on a.catid = b.catid left join users c on a.userid=c.userid');
		if($this->input->post('searchvname')){
			$this->db->where('a.name like "%'.$this->input->post('searchvname').'%"');
			$result['inputs']['searchvname']='searchvname+'.$this->input->post('searchvname');
		}
		if($this->input->post('searchvcategory')){
			$this->db->where('a.catid = "'.$this->input->post('searchvcategory').'"');
			$result['inputs']['searchvcategory']='searchvcategory+'.$this->input->post('searchvcategory');
		}
		if($this->input->post('searchuser')!=''){
			$this->db->where('a.userid = "'.$this->input->post('searchuser').'"');
			$result['inputs']['searchuser']='searchuser+'.$this->input->post('searchuser');
		}
		if($this->input->post('searchvstatus')!=''){
			$this->db->where('a.status = "'.$this->input->post('searchvstatus').'"');
			$result['inputs']['searchvstatus']='searchvstatus+'.$this->input->post('searchvstatus');
		}
		
		///for pagiaion on searching inputs .........//
		for($i=3;$i<=6;$i++)
		{
			if($this->uri->segment($i)!='')
			{
			$input=$this->uri->segment($i);
				if(strpos($input,'+'))
				{
					$explodeinput=explode('+',$input);
					$inputvar=$explodeinput[0];
					$inputvalue=$explodeinput[1];
					if(in_array($inputvar,$input_array)){
					if($inputvar=='searchvname'){	$this->db->where('a.name like "%'.$inputvalue.'%"');	}
					if($inputvar=='searchvcategory'){$this->db->where('a.catid = "'.$inputvalue.'"');}
					if($inputvar=='searchuser'){	$this->db->where('a.userid = "'.$inputvalue.'"');	}
					if($inputvar=='searchvstatus'){	$this->db->where('a.status = "'.$inputvalue.'"');	}
					}
					$result['inputs'][$inputvar]=$inputvar.'+'.$inputvalue;
				}
			}
		}
		
		//set limit and offset for pagination...............//
		if($limit!=NULL || $offset!=NULL)
		{$this->db->limit($limit,$offset);}
		
		
		$query=$this->db->get();
		if($query->num_rows()!=0)
		{
			$result['result']=$query->result();
		}
		return $result;
	}
	
	//function to search my incomes
	function searchMyincome($limit=NULL,$offset=NULL)
	{
		//make a input array for searching input fields..........//
		$input_array=array();
		
		//result array return search result and inputs.........//
		$result=array('result'=>array(),'inputs'=>array());
		
		//query to search data for differet input fields..................//
		$query=$this->db->select('a.userid,a.incomeid,a.videoid,a.income,a.date,a.time,b.name')->from('income a left join videos b on a.videoid = b.videoid')->where('b.userid',$this->session->userdata('sessuserid'));
		
		//set limit and offset for pagination...............//
		if($limit!=NULL || $offset!=NULL)
		{$this->db->limit($limit,$offset);}
		$query=$this->db->get();
		if($query->num_rows()!=0)
		{
			$result['result']=$query->result();
		}
		return $result;
	}
	//function to search my incomes
	function searchIncomes($limit=NULL,$offset=NULL)
	{
		//make a input array for searching input fields..........//
		$input_array=array('searchvideoincome','searchamateurincome','searchuserincome','searchfromincome','searchtoincome');
		
		//result array return search result and inputs.........//
		$result=array('result'=>array(),'inputs'=>array());
		
		//query to search data for differet input fields..................//
		$query=$this->db->select('a.userid,a.incomeid,a.videoid,a.income,a.date,a.time,b.name,c.name as amateur, d.name as paid_by')->from('income a left join videos b on a.videoid = b.videoid left join users c on b.userid=c.userid left join users d on a.userid=d.userid');
		
		if($this->input->post('searchvideoincome')){
			$this->db->where('b.name like "%'.$this->input->post('searchvideoincome').'%"');
			$result['inputs']['searchvideoincome']='searchvideoincome+'.$this->input->post('searchvideoincome');
		}
		if($this->input->post('searchamateurincome')){
			$this->db->where('b.userid = "'.$this->input->post('searchamateurincome').'"');
			$result['inputs']['searchamateurincome']='searchamateurincome+'.$this->input->post('searchamateurincome');
		}
		if($this->input->post('searchuserincome')!=''){
			$this->db->where('a.userid = "'.$this->input->post('searchuserincome').'"');
			$result['inputs']['searchuserincome']='searchuserincome+'.$this->input->post('searchuserincome');
		}
		if($this->input->post('searchfromincome')!=''){
			$this->db->where('a.date >= "'.$this->input->post('searchfromincome').'"');
			$result['inputs']['searchfromincome']='searchfromincome+'.$this->input->post('searchfromincome');
		}
		
		if($this->input->post('searchtoincome')!=''){
			$this->db->where('a.date <= "'.$this->input->post('searchtoincome').'"');
			$result['inputs']['searchtoincome']='searchtoincome+'.$this->input->post('searchtoincome');
		}
		 
		///for pagiaion on searching inputs .........//
		for($i=3;$i<=6;$i++)
		{
			if($this->uri->segment($i)!='')
			{
			$input=$this->uri->segment($i);
				if(strpos($input,'+'))
				{
					$explodeinput=explode('+',$input);
					$inputvar=$explodeinput[0];
					$inputvalue=$explodeinput[1];
					if(in_array($inputvar,$input_array)){
					if($inputvar=='searchvideoincome'){	$this->db->where('b.name like "%'.$inputvalue.'%"');	}
					if($inputvar=='searchamateurincome'){$this->db->where('b.userid = "'.$inputvalue.'"');}
					if($inputvar=='searchuserincome'){	$this->db->where('a.userid = "'.$inputvalue.'"');	}
					if($inputvar=='searchfromincome'){	$this->db->where('a.date >= "'.$inputvalue.'"');	}
					if($inputvar=='searchtoincome'){	$this->db->where('a.date <= "'.$inputvalue.'"');	}
					}
					$result['inputs'][$inputvar]=$inputvar.'+'.$inputvalue;
				}
			}
		}
		
		//set limit and offset for pagination...............//
		if($limit!=NULL || $offset!=NULL)
		{$this->db->limit($limit,$offset);}
		
		
		$query=$this->db->get();
		if($query->num_rows()!=0)
		{
			$result['result']=$query->result();
		}
		return $result;
	}
	
	//function to search payouts y admin
	function searchPayouts($limit=NULL,$offset=NULL)
	{
		//make a input array for searching input fields..........//
		$input_array=array('searchamateur','searchstatus');
		
		//result array return search result and inputs.........//
		$result=array('result'=>array(),'inputs'=>array());
		
		//query to search data for differet input fields..................//
		$query=$this->db->select('a.payoutid,a.amateurid,a.amount,a.accountno,a.bankcode,a.variable,a.date,a.time,a.status,b.name')->from('payouts a left join users b on a.amateurid = b.userid');
		
		if($this->input->post('searchamateur')){
			$this->db->where('a.amateurid = "'.$this->input->post('searchamateur').'"');
			$result['inputs']['searchamateur']='searchamateur+'.$this->input->post('searchamateur');
		}
		if($this->input->post('searchstatus')!=''){
			$this->db->where('a.status = "'.$this->input->post('searchstatus').'"');
			$result['inputs']['searchstatus']='searchstatus+'.$this->input->post('searchstatus');
		}
		 
		///for pagiaion on searching inputs .........//
		for($i=3;$i<=6;$i++)
		{
			if($this->uri->segment($i)!='')
			{
			$input=$this->uri->segment($i);
				if(strpos($input,'+'))
				{
					$explodeinput=explode('+',$input);
					$inputvar=$explodeinput[0];
					$inputvalue=$explodeinput[1];
					if(in_array($inputvar,$input_array)){
					if($inputvar=='searchamateur'){$this->db->where('a.amateurid = "'.$inputvalue.'"');}
					if($inputvar=='searchstatus'){	$this->db->where('a.status = "'.$inputvalue.'"');	}
					}
					$result['inputs'][$inputvar]=$inputvar.'+'.$inputvalue;
				}
			}
		}
		
		//set limit and offset for pagination...............//
		if($limit!=NULL || $offset!=NULL)
		{$this->db->limit($limit,$offset);}
		
		
		$query=$this->db->get();
		if($query->num_rows()!=0)
		{
			$result['result']=$query->result();
		}
		return $result;
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
