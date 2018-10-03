<?php
class M_login extends CI_Model {

  	function __construct()
  	{
		parent::__construct();
		$this->_table='user';
  	}
  
  	function login($username, $password) {
	
		$username = $this->db->escape($username);
		$password = $this->db->escape($password);
		
		$result = $this->db->query("select * from user
		where username = $username AND password = $password AND id_role != '3' AND status!=1");
		
		if($result->num_rows()== 0){
			return false;
		}
		else{
			$result = $result->row();
			$this->session->set_userdata('logged_in', $result);
			return true;
		}
  	}	
  	  function updateUser($where, $data)
	  {
	    $this->db->where($where);
	    $this->db->update($this->_table, $data);
	    return $this->db->affected_rows();
	  }
	  function login_api($data)	{
		$this->db->select('id_user,username,no_hp,nama_lengkap,status,id_role');
		$this->db->where('username', $data['username']);
		$this->db->where('password', md5($data['password']));
		$this->db->where('status', 0);
		$this->db->where('id_role', 3);
		$this->db->from('user');
		$this->db->limit(1);

		$query = $this->db->get();
		if($query!=NULL){
			return $query->result();
		}else{
			return FALSE;
		}
	}
	 public function update_password($update){
	 	$this->db->select('password');
	 	 $this->db->where('id_user',$update['id_user']);
	 	 $this->db->from('user');
	 	 $this->db->limit(1);
	 	 $query = $this->db->get();
	 	 $passlama= $query->result_array()[0]["password"];
	 	
		if($passlama==md5($update['passlama'])){
			$this->db->set('password',md5($update['passbaru']));
		    $this->db->limit(1);
		    $this->db->where('id_user',$update['id_user']);
		    if($this->db->update($this->_table)){
		      return 1;
		    }else{
		      return 0;
		  }
		}
		else
		return 0;
   
    }	
	public function update_regis($update){
	 	$this->db->select('reg_id');
	 	 $this->db->where('id_user',$update['id_user']);
	 	 $this->db->from('user');
	 	 $this->db->limit(1);
	 	 $query = $this->db->get();
 	
		
		$this->db->set('reg_id',$update['reg_id']);
		    $this->db->limit(1);
		    $this->db->where('id_user',$update['id_user']);
		    if($this->db->update($this->_table)){
		      return 1;
		    }else{
		      return 0;
		  }
   
    }
}
?>