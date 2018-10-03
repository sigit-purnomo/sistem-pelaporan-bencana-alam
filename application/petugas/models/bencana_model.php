<?php
 
class Bencana_model extends CI_Model {
 	function __construct() {
 		parent::__construct();
	 
	}
	 
	public function show(){
	 	$this->db->select('*');
	    $this ->db-> from('bencana');

	    $query = $this ->db-> get();
	    return $query->result();
	}

	public function search_bencana_by_id_bencana($id_bencana)
	{
	 	$this->db->select('*');
	    $this ->db->from('bencana');
	    $this ->db->where('id_bencana',$id_bencana);
	    // $this->db->order_by('id_bencana');
	    $query = $this ->db-> get();

	    // $query = "SELECT * FROM USER WHERE ID_USER = ".$cari.";"
	    return $query->result();
	}
}