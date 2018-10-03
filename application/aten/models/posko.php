<?php
Class Posko extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->database();
	}
	function InsertPosko($id_bencana,$nama_posko,$latitude,$longitude,
		$lokasi_posko_dusun,$lokasi_posko_kecamatan,$lokasi_posko_kota,$lokasi_posko_provinsi)
	{
		$data = array(
			'id_bencana' => $id_bencana,
			'nama_posko' => $nama_posko,
			'latitude' => $latitude,
			'longitude' => $longitude,

			'lokasi_posko_dusun' => $lokasi_posko_dusun,
			'lokasi_posko_kecamatan' => $lokasi_posko_kecamatan,
			'lokasi_posko_kota' => $lokasi_posko_kota,
			'lokasi_posko_provinsi' => $lokasi_posko_provinsi,
			'status' => 1
		);
		$this->db->insert('posko', $data);
	}
	
	function GetPoskoPaging($perPage,$uri,$idbencana) { //to get all data in tb_book
		// DATE_FORMAT(SYSDATE(), '%Y-%m-%d');
		$this->db->select('*');
		$this->db->from('posko');
		$this->db->where('posko.id_bencana', $idbencana);
		$this->db->where('posko.status', 1);
		$this->db->order_by('nama_posko');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function GetJumlahPosko($idbencana)
	{
		$this->db->select('*');
		$this->db->from('posko');
		$this->db->where('id_bencana', $idbencana);
		$this->db->where('posko.status', 1);
		$getData = $this->db->get('');
		
		return $getData->num_rows();
	}
	
	function HapusPosko($id_posko)
	{
		$data = array(
			'status' => 0
		);
		$this->db->where('id_posko', $id_posko);
		//$this->db->delete('laporan'); 
		$this->db->update('posko', $data);
	}
	function CekDependencyPosko($id_posko)
	{
		$this->db->where('id_posko', $id_posko);
		$this->db->where('status', 1);
		$this->db->from('laporan_posko');
		$getData = $this->db->get('');
		$a=$getData->num_rows();
		
		return $a;
	}
	function GetJumlahPosko2($keyword,$idbencana)
	{
		$keyword=$this->db->escape_str($keyword);
		$this->db->select();
		$this->db->from('posko');
		$where = "((nama_posko LIKE lower('%$keyword%') or 
			latitude LIKE lower('%$keyword%') or 
			longitude LIKE lower('%$keyword%') or 
			lokasi_posko_dusun LIKE lower('%$keyword%') or 
			lokasi_posko_kecamatan LIKE lower('%$keyword%') or 
			lokasi_posko_kota LIKE lower('%$keyword%') or 
			lokasi_posko_provinsi LIKE lower('%$keyword%')) and
			id_bencana = '$idbencana' and status=1)";
		$this->db->where($where);
		$query = $this->db->get('');
		return $query->num_rows();
	}
	function CariPoskoPaging($perPage,$uri,$keyword,$idbencana) { //to get all data in tb_book
		$keyword=$this->db->escape_str($keyword);
		$this->db->select('*');
		$this->db->from('posko');
		$where = "((nama_posko LIKE lower('%$keyword%') or 
			latitude LIKE lower('%$keyword%') or 
			longitude LIKE lower('%$keyword%') or 
			lokasi_posko_dusun LIKE lower('%$keyword%') or 
			lokasi_posko_kecamatan LIKE lower('%$keyword%') or 
			lokasi_posko_kota LIKE lower('%$keyword%') or 
			lokasi_posko_provinsi LIKE lower('%$keyword%')) and
			id_bencana = '$idbencana' and status=1)";
		$this->db->where($where);
		$this->db->order_by('nama_posko');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function CariPoskoById($keyword)
	{
		$keyword=$this->db->escape_str($keyword);
		$this->db->select();
		$this->db->from('posko');
		$where = "id_posko = '$keyword' and status=1";
		$this->db->where($where);
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}
	function EditPosko($id_posko,$nama_posko,$latitude,$longitude,
		$lokasi_posko_dusun,$lokasi_posko_kecamatan,$lokasi_posko_kota,$lokasi_posko_provinsi)
	{
		$data = array(
			'nama_posko' => $nama_posko,
			'latitude' => $latitude,
			'longitude' => $longitude,

			'lokasi_posko_dusun' => $lokasi_posko_dusun,
			'lokasi_posko_kecamatan' => $lokasi_posko_kecamatan,
			'lokasi_posko_kota' => $lokasi_posko_kota,
			'lokasi_posko_provinsi' => $lokasi_posko_provinsi,
			'status' => 1
		);
		$this->db->where('id_posko', $id_posko);
		$this->db->update('posko', $data);
	}

}
?>