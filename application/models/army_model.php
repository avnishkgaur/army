<?php
class Army_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function createuser($uname=NULL,$password=NULL,$email=NULL){
		if($uname&&$password){
			$data = array(
			   'username' => $uname ,
			   'email' => $email ,
			   'password' => md5($password)
			);
			$this->db->insert('users', $data); 
			return true;
		}
		return false;
	}

	public function login($uname=NULL,$password=NULL){
		if($uname&&$password){
			$query = $this->db->get_where('users',array('username' => $uname,'password'=>md5($password)));
			$ans = $query->row_array();
			if(count($ans)>0){
				return true;
			}
			return false;
		}
		return false;
	}
	
	public function getuserinfo($uname=NULL){
		if($uname){
			$query = $this->db->get_where('users',array('username' => $uname));
			$ans = $query->row_array();
			return $ans;
		}
		return false;
	}
	
	public function getcontacts($uname=NULL){
		if($uname){
			$query = $this->db->get_where('users',array('username' => $uname));
			$ans = $query->row_array();
			return $ans;
		}
		return false;
	}
	
	public function getcontent($type=NULL){
		if($type){
			$query = $this->db->get_where('content',array('topic_id' => $type));
			$ans = $query->result_array();
			return $ans;
		} else{
			$query = $this->db->limit(12);
			$query = $this->db->order_by('id',"desc");
			$query = $this->db->get('files');
			$ans = $query->result_array();
			return $ans;			
		}
		return false;
	}
	
	public function uploadfile($fname=NULL,$ftitle=NULL,$desc=NULL,$added_by=NULL,$vis=1){
		if($fname&&$ftitle&&$added_by){
			$data = array(
				   'filename' => $ftitle ,
				   'title' => $fname ,
				   'description' => $desc ,
 				   'added_on' => date("Y-m-d H:i:s") ,
				   'added_by' => $added_by ,
				   'visible' => $vis
				);
				$this->db->insert('files', $data); 
				return true;
		}
		return false;
	}

}