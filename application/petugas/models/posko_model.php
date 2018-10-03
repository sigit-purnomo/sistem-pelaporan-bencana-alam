<?php
 
class Posko_model extends CI_Model {
 	function __construct() {
 		parent::__construct();
	 
	}
	 
	public function show(){
	 	$this->db->select('*');
	    $this ->db-> from('posko');
	    $query = $this ->db-> get();
	    return $query->result();
	}

	public function search_posko_by_id_posko($id_posko)
	{
	 	$this->db->select('*');
	    $this ->db->from('posko');
	    $this ->db->where('id_posko',$id_posko);
	    // $this->db->order_by('id_bencana');
	    $query = $this ->db-> get();

	    // $query = "SELECT * FROM USER WHERE ID_USER = ".$cari.";"
	    return $query->result();
	}
	
}