<?php
Class Gen_model extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->database();
	}
	function InsertBencana()
	{
		$data = array(
			'nama_bencana' => '',
			'jenis_bencana' => '',
			'lokasi' => '',
			'penyebab' => '',
			'tanggal'=> '',
			'jam' => '',
			'latitude' => '',
			'longitude' => '',
			'status' => ''
		);
		$this->db->insert('bencana', $data);
	}
	
	function InsertPosko($id_bencana)
	{
		$data = array(
			'id_bencana' => $id_bencana,
			'nama_posko' => '',
			'latitude' => '',
			'longitude' => '',

			'lokasi_posko_dusun' => '',
			'lokasi_posko_kecamatan' => '',
			'lokasi_posko_kota' => '',
			'lokasi_posko_provinsi' => '',
			'status' => ''
		);
		$this->db->insert('posko', $data);
	}

}
?>