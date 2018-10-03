<?php
Class Account_model extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->database();
	}
	function login($username, $password)
	{
	ini_set('display_errors', 1);
error_reporting(E_ALL);
		$this->db->select('id_user, username, password');
		$this->db->from('user');
		$this->db->where('username', $username);
		$this->db->where('password', MD5($password));
		$this->db->where('status', 1);
		$this->db->where('id_role', 1);
		$this->db->limit(1);
		$query=$this->db->get();

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
?>