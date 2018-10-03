<?php
Class Cjob_model extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
		//$this->load->database();
	}
	/*
	function InsertBencana($inama, $ijenis, $ilokasi, $ipenyebab, $ijam, $itanggal, $ilatitude, $ilongitude)
	{
		$data = array(
			'nama_bencana' => $inama,
			'jenis_bencana' => $ijenis,
			'lokasi' => $ilokasi,
			'penyebab' => $ipenyebab,
			'tanggal'=> $itanggal,
			'jam' => $ijam,
			'latitude' => $ilatitude,
			'longitude' => $ilongitude,
			'status' => 1
		);
		$this->db->insert('bencana', $data);
	}
	function GetBencanaPaging($perPage,$uri) { //to get all data in tb_book
		// DATE_FORMAT(SYSDATE(), '%Y-%m-%d');
		$this->db->select('*');
		$this->db->from('bencana');
		$this->db->order_by('id_bencana','DESC');
		$this->db->where('status', 1);
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function GetJumlahBencana()
	{
		$this->db->select('*');
		$this->db->from('bencana');
		$this->db->where('status', 1);
		$getData = $this->db->get('');
		
		return $getData->num_rows();
	}
	
	function HapusBencana($idbencana)
	{
		$data = array(
			'status' => 0
		);
		$this->db->where('id_bencana', $idbencana);
		$this->db->update('bencana', $data);
		//$this->db->delete('bencana'); 
	}
	
	function CekDependencyBencana($idbencana)
	{
		$this->db->where('id_bencana', $idbencana);
		$this->db->where('status', 1);
		$this->db->from('posko');
		$getData = $this->db->get('');
		$a=$getData->num_rows();
		
		$this->db->where('id_bencana', $idbencana);
		$this->db->where('status', 1);
		$this->db->from('laporan');
		$getData = $this->db->get('');
		$b=$getData->num_rows();
		
		return $a+$b;
	}
	
	function GetJumlahBencana2($keyword)
	{
		$this->db->select();
		$this->db->from('bencana');
		$where = "(nama_bencana LIKE lower('%$keyword%') or 
			jenis_bencana LIKE lower('%$keyword%') or
			lokasi LIKE lower('%$keyword%') or
			penyebab LIKE lower('%$keyword%') or
			jam LIKE lower('%$keyword%') or
			DATE_FORMAT(tanggal,'%d-%m-%Y') LIKE lower('%$keyword%') or
			latitude LIKE lower('%$keyword%') or
			longitude LIKE lower('%$keyword%')) and status=1";
		$this->db->where($where);
		$query = $this->db->get('');
		return $query->num_rows();
	}
	function CariBencanaPaging($perPage,$uri,$keyword) { //to get all data in tb_book
		$this->db->select('*');
		$this->db->from('bencana');
		$where = "(nama_bencana LIKE lower('%$keyword%') or 
			jenis_bencana LIKE lower('%$keyword%') or
			lokasi LIKE lower('%$keyword%') or
			penyebab LIKE lower('%$keyword%') or
			jam LIKE lower('%$keyword%') or
			DATE_FORMAT(tanggal,'%d-%m-%Y') LIKE lower('%$keyword%') or
			latitude LIKE lower('%$keyword%') or
			longitude LIKE lower('%$keyword%')) and status=1";
		$this->db->where($where);
		$this->db->order_by('id_bencana','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}

	function GetJumlahBencana3($keyword,$tgl1,$tgl2)
	{
		if($tgl1>$tgl2)
		{
			$temp=$tgl1;
			$tgl1=$tgl2;
			$tgl2=$temp;
		}
		$this->db->select();
		$this->db->from('bencana');
		$where = "(nama_bencana LIKE lower('%$keyword%') or 
			jenis_bencana LIKE lower('%$keyword%') or
			lokasi LIKE lower('%$keyword%') or
			penyebab LIKE lower('%$keyword%') or
			jam LIKE lower('%$keyword%') or
			DATE_FORMAT(tanggal,'%d-%m-%Y') LIKE lower('%$keyword%') or
			latitude LIKE lower('%$keyword%') or
			longitude LIKE lower('%$keyword%')) and status=1 and tanggal between '$tgl1' and '$tgl2'";
		$this->db->where($where);
		$query = $this->db->get('');
		return $query->num_rows();
	}

	function CariBencanaPaging2($perPage,$uri,$keyword,$tgl1,$tgl2) { //to get all data in tb_book
		if($tgl1>$tgl2)
		{
			$temp=$tgl1;
			$tgl1=$tgl2;
			$tgl2=$temp;
		}
		$this->db->select('*');
		$this->db->from('bencana');
		$where = "(nama_bencana LIKE lower('%$keyword%') or 
			jenis_bencana LIKE lower('%$keyword%') or
			lokasi LIKE lower('%$keyword%') or
			penyebab LIKE lower('%$keyword%') or
			jam LIKE lower('%$keyword%') or
			DATE_FORMAT(tanggal,'%d-%m-%Y') LIKE lower('%$keyword%') or
			latitude LIKE lower('%$keyword%') or
			longitude LIKE lower('%$keyword%')) and status=1 and tanggal between '$tgl1' and '$tgl2'";
		$this->db->where($where);
		$this->db->order_by('id_bencana','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function CariBencanaById($keyword)
	{
		$this->db->select();
		$this->db->from('bencana');
		$where = "id_bencana = '$keyword'  and status=1";
		$this->db->where($where);
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}
	
	function EditBencana($idbencana, $inama, $ijenis, $ilokasi, $ipenyebab, $ijam, $itanggal, $ilatitude, $ilongitude)
	{
		$data = array(
			'nama_bencana' => $inama,
			'jenis_bencana' => $ijenis,
			'lokasi' => $ilokasi,
			'penyebab' => $ipenyebab,
			'jam' => $ijam,
			'latitude' => $ilatitude,
			'longitude' => $ilongitude
		);
		//STR_TO_DATE('2013-02-11', '%Y-%m-%d');
		$this->db->set('tanggal', 'STR_TO_DATE("'.$itanggal.'","%Y-%m-%d")', FALSE);
		//false untuk escape diset false, supaya str_to_date dianggap sebagai fungsi
		$this->db->where('id_bencana', $idbencana);
		$this->db->update('bencana', $data);
	}
	
}*/
?>