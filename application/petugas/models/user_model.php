<?php
 
class User_model extends CI_Model {
 	function __construct() {
 		parent::__construct();
	 
	}
	 
	public function show()
	{
		$id_user_login = $this->session->userdata('id_user'); 

	 	$this->db->select('*');
	    $this ->db-> from('user');
	    $this->db->order_by('id_user');

	    $this->db->where("(status = '1' AND id_user != '$id_user_login')");

	    $query = $this ->db-> get();

	    return $query->result();
	}

	public function show2()
	{
		// $id_user_login = $this->session->userdata('id_user'); 

	 	$this->db->select('id_user, id_role, username, no_hp, nama_lengkap');
	    $this ->db-> from('user');
	    $this->db->order_by('id_user');

	    $this->db->where("(status = '1' AND id_role!='3')");

	    $query = $this ->db-> get();

	    return $query->result();
	}

	public function show3()
	{
		// $id_user_login = $this->session->userdata('id_user'); 

	 	$this->db->select('id_user, id_role, username, no_hp, nama_lengkap');
	    $this ->db-> from('user');
	    $this->db->order_by('id_user');

	    $this->db->where("(status = '1' AND id_role!='3' AND id_role!='1')");

	    $query = $this ->db-> get();

	    return $query->result();
	}
	
	public function show_by($id_user)
	{
		$id_user_login = $this->session->userdata('id_user'); 

	 	$this->db->select('*');
	    $this ->db-> from('user');
	    $this ->db->where('id_user',$id_user);

	    $this->db->where("(status = '1' AND id_user != '$id_user_login')");

	    $query = $this ->db-> get();
	    return $query->result();
	}


	public function search_by($cari)
	{
		$id_user_login = $this->session->userdata('id_user'); 

		$role = "";
		if($cari=='Petugas')
		{
			$role = 1;
		}
		else if($cari=='Relawan')
		{
			$role = 2;
		}

	 	$this->db->select('*');
	    $this ->db->from('user');

	    $this->db->where("(status = '1' AND id_user != '$id_user_login')");

	    $this->db->where("(id_user = '$cari' OR nama_lengkap = '$cari' 
                   OR username = '$cari' OR no_hp = '$cari'
                   OR id_role = '$role')");
	   
	    $this->db->order_by('id_user');
	    $query = $this ->db-> get();

	    return $query->result();
	}

	public function search_by2($cari)
	{
		// $id_user_login = $this->session->userdata('id_user'); 

		$role = "";
		if($cari=='Petugas')
		{
			$role = 1;
		}
		else if($cari=='Relawan')
		{
			$role = 2;
		}

	 	$this->db->select('id_user, id_role, username, no_hp, nama_lengkap');
	    $this ->db->from('user');

	    $this->db->where("(status = '1')");

	    $this->db->where("(id_user = '$cari' OR nama_lengkap = '$cari' 
                   OR username = '$cari' OR no_hp = '$cari'
                   OR id_role = '$role')");
	   
	    $this->db->order_by('id_user');
	    $query = $this ->db-> get();

	    return $query->result();
	}

	public function search_iduser_by($cari)
	{
		$id_user_login = $this->session->userdata('id_user'); 

	 	$this->db->select('*');
	    $this ->db->from('user');
	    $this ->db->where('id_user',$cari);
	    $this ->db->or_where('nama_lengkap',$cari);
	    $this ->db->or_where('username',$cari);

	    // $this->db->where('status','tidak_terhapus')

	    // $this->db->where_not_in('id_user',$id_user_login);
	    $this->db->where('id_user !=',$id_user_login);

	    $this->db->order_by('id_user');
	    $query = $this ->db-> get();

	    return $query->row()->id_user;
	}


	public function search_no_hp_by_id_user($id_user)
	{
	 	$this->db->select('*');
	    $this ->db->from('user');
	    $this ->db->where('id_user',$id_user);

	    $query = $this ->db-> get();

	    return $query->row()->no_hp;
	}

	public function search_username_by_id_user($id_user)
	{
	 	$this->db->select('*');
	    $this ->db->from('user');
	    $this ->db->where('id_user',$id_user);

	    $query = $this ->db-> get();

	    return $query->row()->username;
	}

	public function check_no_telepon($nomor_telepon)//Tambah
	{
		$this -> db -> select('*');
	    $this -> db -> from('user');
	    $this -> db -> where('no_hp', $nomor_telepon);
	    $this -> db -> where('status','1');

	    $query = $this -> db -> get();

	    if($query -> num_rows() == 0) //Tidak menemukan nomor kembar
	    {
	      return true;
	    }
	    else
	    {
	      return false;
	    }
	}

	public function check_username($username)//Tambah
	{
		$this -> db -> select('*');
	    $this -> db -> from('user');
	    $this -> db -> where('username', $username);
	    $this -> db -> where('status','1');

	    $query = $this -> db -> get();

	    if($query -> num_rows() == 0) //Tidak menemukan username kembar
	    {
	      return true;
	    }
	    else
	    {
	      return false;
	    }
	}

	public function insert($data)
	{
	 	$this->db->insert('user', $data);
	}

	public function update($data, $id_user)
	{
	 	$this -> db -> where('id_user', $id_user);
	 	$this->db->update('user', $data);
	}

	public function delete($id_user)
	{
	 	$this->db->where('id_user', $id_user);
		$hasil = $this->db->delete('user'); 
		return $hasil;
	}

	function login($username,$password)
  	{

    	$this->db->where("username",$username);
    	$this->db->where("password",$password);

    	$query=$this->db->get("user");
    
    	if($query->num_rows()>0)
    	{
      		foreach($query->result() as $rows)
        	{
          //add all data to session
            	$newdata = array(
              	'id_user'    => $rows->id_user,
              	'username'   => $rows->username,
              	'role'    => $rows->id_role,
              	'logged_in'   => TRUE
           	);
        	}
      		$this->session->set_userdata($newdata);
            return true;            
        }
        return false;
    }

    function login2($username, $password)
   {
   		$this->db->select('*');
   		$this->db->from('user');
       	$this->db->where('username', $username);
       	$this->db->where('password', $password);
   		$this->db->where('id_role', '3'); //cuma SUPER ADMIN yang bisa login
   		$this->db->where('status', '1'); //cuma PETUGAS tidak terhapus yang bisa login
       	$this->db->limit(1);

       	$query = $this->db->get();

       	if($query->num_rows() == 1)
       	{
         	return $query->result();
       	}
       	else
  	 	{
			return false;
       	}
   }

   function login3($username,$password)
  	{

    	$this->db->where("username",$username);
    	$this->db->where("password",$password);

    	$query=$this->db->get("user");
    
    	if($query->num_rows()>0)
    	{
      		foreach($query->result() as $rows)
        	{
          	//add all data to session
            	$newdata = array(
              	'id_user'    => $rows->id_user,
              	'username'   => $rows->username,
              	'role'    => $rows->id_role,
              	'logged_in'   => TRUE
           		);
        	}
      		// $this->session->set_userdata($newdata);
            return $newdata;            
        }
        return false;
    }

    function login4($username, $password)
   {
   		$this->db->select('*');
   		$this->db->from('user');
       	$this->db->where('username', $username);
       	$this->db->where('password', $password);
   		$this->db->where('id_role', '1'); //cuma PETUGAS yang bisa login
   		$this->db->where('status', '1'); //cuma PETUGAS tidak terhapus yang bisa login
       	$this->db->limit(1);

       	$query = $this->db->get();

       	if($query->num_rows() == 1)
       	{
         	return $query->result();
       	}
       	else
  	 	{
			return false;
       	}
   }
}