<?php
Class Laporan_bencana extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->database();
	}
	function InsertLaporanBencana($id_bencana,$id_user,$tanggal_laporan,$jam_laporan,$meninggal,
		$luka_berat,$luka_ringan,$hilang,$mengungsi_jiwa,$mengungsi_kk,
		$rumah,$kantor,$fasilitas_kesehatan,$fasilitas_pendidikan,$fasilitas_umum,
		$sarana_ibadah,$jembatan,$jalan,$tanggul,$sawah,
		$lahan_pertanian,$lain_lain,$bupati_tgl,$bupati_jam,$posko,
		$koordinasi,$evakuasi,$kesehatan,$dapur,$distribusi,
		$pengerahan,$sumber_daya,$kendala,$kebutuhan_mendesak,$rencana_tindaklanjut,
		$tim_bpbd,$tim_dinsos,$tim_dinkes,$tim_pu,$sub_tim)
	{
		$data = array(
			'id_bencana' => $id_bencana,
			'id_user' => $id_user,
			'tanggal_laporan' => $tanggal_laporan,
			'jam_laporan' => $jam_laporan,
			'meninggal' => $meninggal,

			'luka_berat' => $luka_berat,
			'luka_ringan' => $luka_ringan,
			'hilang' => $hilang,
			'mengungsi_jiwa' => $mengungsi_jiwa,
			'mengungsi_kk' => $mengungsi_kk,

			'rumah' => $rumah,
			'kantor' => $kantor,
			'fasilitas_kesehatan' => $fasilitas_kesehatan,
			'fasilitas_pendidikan' => $fasilitas_pendidikan,
			'fasilitas_umum' => $fasilitas_umum,

			'sarana_ibadah' => $sarana_ibadah,
			'jembatan' => $jembatan,
			'jalan' => $jalan,
			'tanggul' => $tanggul,
			'sawah' => $sawah,
			
			'lahan_pertanian' => $lahan_pertanian,
			'lain_lain' => $lain_lain,
			'bupati_tgl' => $bupati_tgl,
			'bupati_jam' => $bupati_jam,
			'posko' => $posko,

			'koordinasi' => $koordinasi,
			'evakuasi' => $evakuasi,
			'kesehatan' => $kesehatan,
			'dapur' => $dapur,
			'distribusi' => $distribusi,

			'pengerahan' => $pengerahan,
			'sumber_daya' => $sumber_daya,
			'kendala' => $kendala,
			'kebutuhan_mendesak' => $kebutuhan_mendesak,
			'rencana_tindaklanjut' => $rencana_tindaklanjut,

			'tim_bpbd' => $tim_bpbd,
			'tim_dinsos' => $tim_dinsos,
			'tim_dinkes' => $tim_dinkes,
			'tim_pu' => $tim_pu,
			'sub_tim' => $sub_tim,
			'status' => 1,

			'rencana_aksi' => '',
			'kesimpulan' => '',
			'penutup' => ''
		);
		$this->db->insert('laporan', $data);
	}
	
	function GetLaporanBencanaPaging($perPage,$uri,$idbencana) { //to get all data in tb_book
		// DATE_FORMAT(SYSDATE(), '%Y-%m-%d');
		$this->db->select('*');
		$this->db->from('laporan');
		$this->db->join('user','laporan.id_user=user.id_user');
		$this->db->where('laporan.id_bencana', $idbencana);
		$this->db->where('laporan.status', 1);
		$this->db->order_by('tanggal_laporan','DESC');
		$this->db->order_by('jam_laporan','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function GetJumlahLaporanBencana($idbencana)
	{
		$this->db->select('*');
		$this->db->from('laporan');
		$this->db->where('id_bencana', $idbencana);
		$this->db->where('laporan.status', 1);
		$getData = $this->db->get('');
		
		return $getData->num_rows();
	}
	
	function HapusLaporanBencana($idlaporanbencana)
	{
		$data = array(
			'status' => 0
		);
		$this->db->where('id_laporan', $idlaporanbencana);
		//$this->db->delete('laporan'); 
		$this->db->update('laporan', $data);
	}
	
	function GetJumlahLaporanBencana2($keyword,$idbencana)
	{
		$keyword=$this->db->escape_str($keyword);
		$this->db->select();
		$this->db->from('laporan');
		$this->db->join('user','laporan.id_user=user.id_user');
		$where = "((DATE_FORMAT(tanggal_laporan,'%d-%m-%Y') like '$keyword' or
			nama_lengkap LIKE lower('%$keyword%') or
			username like lower('%$keyword%')) and
			id_bencana = '$idbencana' and laporan.status=1)";
		$this->db->where($where);
		$query = $this->db->get('');
		return $query->num_rows();
	}
	function CariLaporanBencanaPaging($perPage,$uri,$keyword,$idbencana) { //to get all data in tb_book
		$keyword=$this->db->escape_str($keyword);
		$this->db->select('*');
		$this->db->from('laporan');
		$this->db->join('user','laporan.id_user=user.id_user');
		$where = "((DATE_FORMAT(tanggal_laporan,'%d-%m-%Y') like '$keyword' or
			nama_lengkap LIKE lower('%$keyword%') or
			username like lower('%$keyword%')) and
			id_bencana = '$idbencana' and laporan.status=1)";
		$this->db->where($where);
		$this->db->order_by('tanggal_laporan','DESC');
		$this->db->order_by('jam_laporan','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}






	function GetJumlahLaporanBencana3($keyword,$idbencana,$tgl1,$tgl2)
	{
		$keyword=$this->db->escape_str($keyword);
		if($tgl1>$tgl2)
		{
			$temp=$tgl1;
			$tgl1=$tgl2;
			$tgl2=$temp;
		}
		$this->db->select();
		$this->db->from('laporan');
		$this->db->join('user','laporan.id_user=user.id_user');
		$where = "((DATE_FORMAT(tanggal_laporan,'%d-%m-%Y') like '$keyword' or
			nama_lengkap LIKE lower('%$keyword%') or
			username like lower('%$keyword%')) and
			id_bencana = '$idbencana' and laporan.status=1 and tanggal_laporan between '$tgl1' and '$tgl2')";
		$this->db->where($where);
		$query = $this->db->get('');
		return $query->num_rows();
	}
	function CariLaporanBencanaPaging2($perPage,$uri,$keyword,$idbencana,$tgl1,$tgl2) { //to get all data in tb_book
		$keyword=$this->db->escape_str($keyword);
		if($tgl1>$tgl2)
		{
			$temp=$tgl1;
			$tgl1=$tgl2;
			$tgl2=$temp;
		}
		$this->db->select('*');
		$this->db->from('laporan');
		$this->db->join('user','laporan.id_user=user.id_user');
		$where = "((DATE_FORMAT(tanggal_laporan,'%d-%m-%Y') like '$keyword' or
			nama_lengkap LIKE lower('%$keyword%') or
			username like lower('%$keyword%')) and
			id_bencana = '$idbencana' and laporan.status=1 and tanggal_laporan between '$tgl1' and '$tgl2')";
		$this->db->where($where);
		$this->db->order_by('tanggal_laporan','DESC');
		$this->db->order_by('jam_laporan','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}







	
	function CariLaporanBencanaById($keyword)
	{
		$keyword=$this->db->escape_str($keyword);
		$this->db->select();
		$this->db->from('laporan');
		$where = "id_laporan = '$keyword' and status=1";
		$this->db->where($where);
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}
	function EditLaporanBencana($id_laporan,$id_bencana,$id_user,$tanggal_laporan,$jam_laporan,$meninggal,
		$luka_berat,$luka_ringan,$hilang,$mengungsi_jiwa,$mengungsi_kk,
		$rumah,$kantor,$fasilitas_kesehatan,$fasilitas_pendidikan,$fasilitas_umum,
		$sarana_ibadah,$jembatan,$jalan,$tanggul,$sawah,
		$lahan_pertanian,$lain_lain,$bupati_tgl,$bupati_jam,$posko,
		$koordinasi,$evakuasi,$kesehatan,$dapur,$distribusi,
		$pengerahan,$sumber_daya,$kendala,$kebutuhan_mendesak,$rencana_tindaklanjut,
		$tim_bpbd,$tim_dinsos,$tim_dinkes,$tim_pu,$sub_tim)
	{
		$data = array(
			'id_bencana' => $id_bencana,
			'id_user' => $id_user,
			'tanggal_laporan' => $tanggal_laporan,
			'jam_laporan' => $jam_laporan,
			'meninggal' => $meninggal,

			'luka_berat' => $luka_berat,
			'luka_ringan' => $luka_ringan,
			'hilang' => $hilang,
			'mengungsi_jiwa' => $mengungsi_jiwa,
			'mengungsi_kk' => $mengungsi_kk,

			'rumah' => $rumah,
			'kantor' => $kantor,
			'fasilitas_kesehatan' => $fasilitas_kesehatan,
			'fasilitas_pendidikan' => $fasilitas_pendidikan,
			'fasilitas_umum' => $fasilitas_umum,

			'sarana_ibadah' => $sarana_ibadah,
			'jembatan' => $jembatan,
			'jalan' => $jalan,
			'tanggul' => $tanggul,
			'sawah' => $sawah,
			
			'lahan_pertanian' => $lahan_pertanian,
			'lain_lain' => $lain_lain,
			'bupati_tgl' => $bupati_tgl,
			'bupati_jam' => $bupati_jam,
			'posko' => $posko,

			'koordinasi' => $koordinasi,
			'evakuasi' => $evakuasi,
			'kesehatan' => $kesehatan,
			'dapur' => $dapur,
			'distribusi' => $distribusi,

			'pengerahan' => $pengerahan,
			'sumber_daya' => $sumber_daya,
			'kendala' => $kendala,
			'kebutuhan_mendesak' => $kebutuhan_mendesak,
			'rencana_tindaklanjut' => $rencana_tindaklanjut,

			'tim_bpbd' => $tim_bpbd,
			'tim_dinsos' => $tim_dinsos,
			'tim_dinkes' => $tim_dinkes,
			'tim_pu' => $tim_pu,
			'sub_tim' => $sub_tim
		);
		$this->db->where('id_laporan', $id_laporan);
		$this->db->update('laporan', $data);
	}

	function EditLaporanBencana2($id_laporan,$rencana_aksi,$kesimpulan,$penutup)
	{
		$data = array(
			'rencana_aksi' => $rencana_aksi,
			'kesimpulan' => $kesimpulan,
			'penutup' => $penutup
		);
		$this->db->where('id_laporan', $id_laporan);
		$this->db->update('laporan', $data);
	}
}	
?>