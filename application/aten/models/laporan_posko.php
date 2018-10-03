<?php
Class Laporan_posko extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->database();
	}
	function InsertLaporanPosko($id_posko,$id_user,$tgl_lap_posko,$jam_lap_posko,$kapasitas,
		$fasilitas_dapur,$fasilitas_kesehatan,$fasilitas_mck,
		$jumlah_kk,$jumlah_pria,$jumlah_wanita,$jumlah_balita)
	{
		$data = array(
			'id_posko' => $id_posko,
			'id_user' => $id_user,
			'tgl_lap_posko' => $tgl_lap_posko,
			'jam_lap_posko' => $jam_lap_posko,
			'kapasitas' => $kapasitas,

			'fasilitas_dapur' => $fasilitas_dapur,
			'fasilitas_kesehatan' => $fasilitas_kesehatan,
			'fasilitas_mck' => $fasilitas_mck,

			'jumlah_kk' => $jumlah_kk,
			'jumlah_pria' => $jumlah_pria,
			'jumlah_wanita' => $jumlah_wanita,
			'jumlah_balita' => $jumlah_balita,
			'status' => 1
		);
		$this->db->insert('laporan_posko', $data);
	}
	
	function GetLaporanPoskoPaging($perPage,$uri,$id_posko) { //to get all data in tb_book
		// DATE_FORMAT(SYSDATE(), '%Y-%m-%d');
		$this->db->select('*');
		$this->db->from('laporan_posko');
		$this->db->join('user','laporan_posko.id_user=user.id_user');
		$this->db->join('posko','laporan_posko.id_posko=posko.id_posko');
		$this->db->where('laporan_posko.id_posko', $id_posko);
		$this->db->where('laporan_posko.status', 1);
		$this->db->where('posko.status', 1);
		$this->db->order_by('nama_posko');
		$this->db->order_by('tgl_lap_posko','DESC');
		$this->db->order_by('jam_lap_posko','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function GetJumlahLaporanPosko($id_posko)
	{
		$this->db->select('*');
		$this->db->from('laporan_posko');
		$this->db->join('posko','laporan_posko.id_posko=posko.id_posko');
		$this->db->where('laporan_posko.id_posko', $id_posko);
		$this->db->where('posko.status', 1);
		$this->db->where('laporan_posko.status', 1);
		$getData = $this->db->get('');
		
		return $getData->num_rows();
	}
	
	function HapusLaporanPosko($idlaporanposko)
	{
		$data = array(
			'status' => 0
		);
		$this->db->where('id_laporan', $idlaporanposko);
		//$this->db->delete('laporan'); 
		$this->db->update('laporan_posko', $data);
	}
	
	function GetJumlahLaporanPosko2($keyword,$id_posko)
	{
		$keyword=$this->db->escape_str($keyword);
		$this->db->select();
		$this->db->from('laporan_posko');
		$this->db->join('posko','laporan_posko.id_posko=posko.id_posko');
		$this->db->join('user','laporan_posko.id_user=user.id_user');
		$where = "((DATE_FORMAT(tgl_lap_posko,'%d-%m-%Y') like '$keyword' or
			username like '$keyword') and
			laporan_posko.id_posko = '$id_posko' and laporan_posko.status=1 and posko.status=1)";
		$this->db->where($where);
		$query = $this->db->get('');
		return $query->num_rows();
	}
	function CariLaporanPoskoPaging($perPage,$uri,$keyword,$id_posko) { //to get all data in tb_book
		$keyword=$this->db->escape_str($keyword);
		$this->db->select('*');
		$this->db->from('laporan_posko');
		$this->db->join('posko','laporan_posko.id_posko=posko.id_posko');
		$this->db->join('user','laporan_posko.id_user=user.id_user');
		$where = "((DATE_FORMAT(tgl_lap_posko,'%d-%m-%Y') like '$keyword' or
			username like '$keyword') and
			laporan_posko.id_posko = '$id_posko' and laporan_posko.status=1 and posko.status=1)";
		$this->db->where($where);
		$this->db->order_by('nama_posko');
		$this->db->order_by('tgl_lap_posko','DESC');
		$this->db->order_by('jam_lap_posko','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}






	function GetJumlahLaporanPosko3($keyword,$id_posko,$tgl1,$tgl2)
	{
		$keyword=$this->db->escape_str($keyword);
		if($tgl1>$tgl2)
		{
			$temp=$tgl1;
			$tgl1=$tgl2;
			$tgl2=$temp;
		}
		$this->db->select();
		$this->db->from('laporan_posko');
		$this->db->join('posko','laporan_posko.id_posko=posko.id_posko');
		$this->db->join('user','laporan_posko.id_user=user.id_user');
		$where = "((DATE_FORMAT(tgl_lap_posko,'%d-%m-%Y') like '$keyword' or
			username like lower('%$keyword%')) and
			laporan_posko.id_posko = '$id_posko' and laporan_posko.status=1 and posko.status=1 and tgl_lap_posko between '$tgl1' and '$tgl2')";
		$this->db->where($where);
		$query = $this->db->get('');
		return $query->num_rows();
	}
	function CariLaporanPoskoPaging2($perPage,$uri,$keyword,$id_posko,$tgl1,$tgl2) { //to get all data in tb_book
		$keyword=$this->db->escape_str($keyword);
		if($tgl1>$tgl2)
		{
			$temp=$tgl1;
			$tgl1=$tgl2;
			$tgl2=$temp;
		}
		$this->db->select('*');
		$this->db->from('laporan_posko');
		$this->db->join('posko','laporan_posko.id_posko=posko.id_posko');
		$this->db->join('user','laporan_posko.id_user=user.id_user');
		$where = "((DATE_FORMAT(tgl_lap_posko,'%d-%m-%Y') like '$keyword' or
			username like lower('%$keyword%')) and
			laporan_posko.id_posko = '$id_posko' and laporan_posko.status=1 and posko.status=1 and tgl_lap_posko between '$tgl1' and '$tgl2')";
		$this->db->where($where);
		$this->db->order_by('nama_posko');
		$this->db->order_by('tgl_lap_posko','DESC');
		$this->db->order_by('jam_lap_posko','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}





	
	function CariLaporanPoskoById($keyword)
	{
		$keyword=$this->db->escape_str($keyword);
		$this->db->select();
		$this->db->from('laporan_posko');
		$where = "id_laporan = '$keyword' and status=1";
		$this->db->where($where);
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}
	function EditLaporanPosko($id_user,$id_laporan,$tgl_lap_posko,$jam_lap_posko,$kapasitas,
		$fasilitas_dapur,$fasilitas_kesehatan,$fasilitas_mck,
		$jumlah_kk,$jumlah_pria,$jumlah_wanita,$jumlah_balita)
	{
		$data = array(
			'id_user' => $id_user,
			'tgl_lap_posko' => $tgl_lap_posko,
			'jam_lap_posko' => $jam_lap_posko,
			'kapasitas' => $kapasitas,

			'fasilitas_dapur' => $fasilitas_dapur,
			'fasilitas_kesehatan' => $fasilitas_kesehatan,
			'fasilitas_mck' => $fasilitas_mck,

			'jumlah_kk' => $jumlah_kk,
			'jumlah_pria' => $jumlah_pria,
			'jumlah_wanita' => $jumlah_wanita,
			'jumlah_balita' => $jumlah_balita
		);
		$this->db->where('id_laporan', $id_laporan);
		$this->db->update('laporan_posko', $data);
	}
	
}
?>