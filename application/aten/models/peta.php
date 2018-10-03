<?php
Class Peta extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->database();
	}
	function getKoordinatPosko()
	{
		$return = array();
		$this->db->select('nama_posko,posko.latitude as platitude,posko.longitude as plongitude,
			kapasitas,jumlah_kk,jumlah_pria,jumlah_wanita,jumlah_balita');
		$this->db->select("DATE_FORMAT(tgl_lap_posko, '%d-%m-%Y') AS tanggal_format", FALSE);
		$this->db->from("posko");
		$this->db->join('laporan_posko','laporan_posko.id_posko=posko.id_posko');
		$this->db->join('bencana','posko.id_bencana=bencana.id_bencana');
		$this->db->where('bencana.status', 1);
		$this->db->where('posko.status', 1);
		$this->db->where('laporan_posko.status', 1);
		$this->db->order_by('tgl_lap_posko','DESC');
		$this->db->order_by('jam_lap_posko','DESC');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			foreach ($query->result() as $row) {
				array_push($return, $row);
			}
		}
		return $return;
	}
	function getKoordinatBencana()
	{
		$return = array();
		$this->db->select("nama_bencana,latitude,longitude");
		$this->db->select("DATE_FORMAT(tanggal, '%d-%m-%Y') AS tanggal_format", FALSE);
		$this->db->select("meninggal,luka_berat,luka_ringan,hilang,mengungsi_jiwa,mengungsi_kk");
		$this->db->from("bencana");
		$this->db->join('laporan','laporan.id_bencana=bencana.id_bencana');
		$this->db->where('laporan.status', 1);
		$this->db->where('bencana.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			foreach ($query->result() as $row) {
				array_push($return, $row);
			}
		}
		return $return;
	}

	function cariKoordinatPosko($id_bencana)
	{
		$return = array();
		$this->db->select('nama_posko,posko.latitude as platitude,posko.longitude as plongitude,
			kapasitas,jumlah_kk,jumlah_pria,jumlah_wanita,jumlah_balita');
		$this->db->select("DATE_FORMAT(tgl_lap_posko, '%d-%m-%Y') AS tanggal_format", FALSE);
		$this->db->from("posko");
		$this->db->join('laporan_posko','laporan_posko.id_posko=posko.id_posko');
		$this->db->join('bencana','posko.id_bencana=bencana.id_bencana');
		$where = "posko.id_bencana = '$id_bencana'";
		$this->db->where($where);
		$this->db->where('bencana.status', 1);
		$this->db->where('posko.status', 1);
		$this->db->where('laporan_posko.status', 1);
		$this->db->order_by('tgl_lap_posko','DESC');
		$this->db->order_by('jam_lap_posko','DESC');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			foreach ($query->result() as $row) {
				array_push($return, $row);
			}
		}
		return $return;
	}
	function cariKoordinatBencana($id_bencana)
	{
		$return = array();
		$this->db->select("nama_bencana,latitude,longitude");
		$this->db->select("DATE_FORMAT(tanggal, '%d-%m-%Y') AS tanggal_format", FALSE);
		$this->db->select("DATE_FORMAT(tanggal_laporan, '%d-%m-%Y') AS tgl_lap_format", FALSE);
		$this->db->select("meninggal,luka_berat,luka_ringan,hilang,mengungsi_jiwa,mengungsi_kk");
		$this->db->from("bencana");
		$this->db->join('laporan','laporan.id_bencana=bencana.id_bencana');
		$where = "bencana.id_bencana = '$id_bencana'";
		$this->db->where($where);
		$this->db->where('laporan.status', 1);
		$this->db->where('bencana.status', 1);
		$this->db->order_by('tanggal_laporan','DESC');
		$this->db->order_by('jam_laporan','DESC');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			foreach ($query->result() as $row) {
				array_push($return, $row);
			}
		}
		return $return;
	}

	function GetBencanaPaging($perPage,$uri) { //to get all data in tb_book
		// DATE_FORMAT(SYSDATE(), '%Y-%m-%d');
		$this->db->select('distinct bencana.id_bencana,nama_bencana,tanggal,jam,jenis_bencana,lokasi,penyebab,latitude,longitude',FALSE);
		$this->db->from('bencana');
		$this->db->join('laporan','laporan.id_bencana=bencana.id_bencana');
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$this->db->order_by('nama_bencana');
		$this->db->where('bencana.status', 1);
		$this->db->where('laporan.status', 1);
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function GetJumlahBencana()
	{
		$this->db->select('distinct bencana.id_bencana,nama_bencana,tanggal,jam,jenis_bencana,lokasi,penyebab,latitude,longitude',FALSE);
		$this->db->from('bencana');
		$this->db->join('laporan','laporan.id_bencana=bencana.id_bencana');
		$this->db->where('bencana.status', 1);
		$this->db->where('laporan.status', 1);
		$getData = $this->db->get('');
		
		return $getData->num_rows();
	}

	function CariBencanaPaging($perPage,$uri,$keyword) { //to get all data in tb_book
		$keyword=$this->db->escape_str($keyword);
		$this->db->select('distinct bencana.id_bencana,nama_bencana,tanggal,jam,jenis_bencana,lokasi,penyebab,latitude,longitude',FALSE);
		$this->db->from('bencana');
		$this->db->join('laporan','laporan.id_bencana=bencana.id_bencana');
		$where = "(nama_bencana LIKE lower('%$keyword%') or 
			jenis_bencana LIKE lower('%$keyword%') or
			lokasi LIKE lower('%$keyword%') or
			penyebab LIKE lower('%$keyword%') or
			jam LIKE lower('%$keyword%') or
			DATE_FORMAT(tanggal,'%d-%m-%Y') LIKE lower('%$keyword%') or
			latitude LIKE lower('%$keyword%') or
			longitude LIKE lower('%$keyword%'))";
		$this->db->where($where);
		$this->db->where('bencana.status', 1);
		$this->db->where('laporan.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$this->db->order_by('nama_bencana');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function GetJumlahBencana2($keyword)
	{
		$keyword=$this->db->escape_str($keyword);
		$this->db->select('distinct bencana.id_bencana,nama_bencana,tanggal,jam,jenis_bencana,lokasi,penyebab,latitude,longitude',FALSE);
		$this->db->from('bencana');
		$this->db->join('laporan','laporan.id_bencana=bencana.id_bencana');
		$where = "(nama_bencana LIKE lower('%$keyword%') or 
			jenis_bencana LIKE lower('%$keyword%') or
			lokasi LIKE lower('%$keyword%') or
			penyebab LIKE lower('%$keyword%') or
			jam LIKE lower('%$keyword%') or
			DATE_FORMAT(tanggal,'%d-%m-%Y') LIKE lower('%$keyword%') or
			latitude LIKE lower('%$keyword%') or
			longitude LIKE lower('%$keyword%'))";
		$this->db->where($where);
		$this->db->where('bencana.status', 1);
		$this->db->where('laporan.status', 1);
		$query = $this->db->get('');
		return $query->num_rows();
	}
	function CariBencanaPaging2($perPage,$uri,$keyword,$tgl1,$tgl2) { //to get all data in tb_book
		$keyword=$this->db->escape_str($keyword);
		if($tgl1>$tgl2)
		{
			$temp=$tgl1;
			$tgl1=$tgl2;
			$tgl2=$temp;
		}
		$this->db->select('distinct bencana.id_bencana,nama_bencana,tanggal,jam,jenis_bencana,lokasi,penyebab,latitude,longitude',FALSE);
		$this->db->from('bencana');
		$this->db->join('laporan','laporan.id_bencana=bencana.id_bencana');
		$where = "(nama_bencana LIKE lower('%$keyword%') or 
			jenis_bencana LIKE lower('%$keyword%') or
			lokasi LIKE lower('%$keyword%') or
			penyebab LIKE lower('%$keyword%') or
			jam LIKE lower('%$keyword%') or
			DATE_FORMAT(tanggal,'%d-%m-%Y') LIKE lower('%$keyword%') or
			latitude LIKE lower('%$keyword%') or
			longitude LIKE lower('%$keyword%')) and tanggal between '$tgl1' and '$tgl2'";
		$this->db->where($where);
		$this->db->where('bencana.status', 1);
		$this->db->where('laporan.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$this->db->order_by('nama_bencana');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function GetJumlahBencana3($keyword,$tgl1,$tgl2)
	{
		$keyword=$this->db->escape_str($keyword);
		if($tgl1>$tgl2)
		{
			$temp=$tgl1;
			$tgl1=$tgl2;
			$tgl2=$temp;
		}
		$this->db->select('distinct bencana.id_bencana,nama_bencana,tanggal,jam,jenis_bencana,lokasi,penyebab,latitude,longitude',FALSE);
		$this->db->from('bencana');
		$this->db->join('laporan','laporan.id_bencana=bencana.id_bencana');
		$where = "(nama_bencana LIKE lower('%$keyword%') or 
			jenis_bencana LIKE lower('%$keyword%') or
			lokasi LIKE lower('%$keyword%') or
			penyebab LIKE lower('%$keyword%') or
			jam LIKE lower('%$keyword%') or
			DATE_FORMAT(tanggal,'%d-%m-%Y') LIKE lower('%$keyword%') or
			latitude LIKE lower('%$keyword%') or
			longitude LIKE lower('%$keyword%')) and tanggal between '$tgl1' and '$tgl2'";
		$this->db->where($where);
		$this->db->where('bencana.status', 1);
		$this->db->where('laporan.status', 1);
		$query = $this->db->get('');
		return $query->num_rows();
	}
	function getIdMaxTanggalBencana()
	{
		$this->db->select_max('b.id_bencana');
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','lp.id_posko=p.id_posko');
		$this->db->join('bencana as b','b.id_bencana=p.id_bencana');
		$this->db->join('laporan as lb','lb.id_bencana=b.id_bencana');
		$where = "addtime(b.tanggal,b.jam)=(select max(addtime(bi.tanggal,bi.jam)) from bencana bi
						join laporan lbi on lbi.id_bencana=bi.id_bencana
						join posko pi on bi.id_bencana=pi.id_bencana
						join laporan_posko lpi on lpi.id_posko=pi.id_posko
						where bi.status=1 and lbi.status=1 and pi.status=1 and lpi.status=1) and 
				b.status=1 and lb.status=1 and p.status=1 and lp.status=1";
		$this->db->where($where);
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}
	
}
?>