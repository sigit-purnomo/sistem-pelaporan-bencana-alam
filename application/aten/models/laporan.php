<?php
Class Laporan extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->database();
	}

	function GetPengungsi($id_laporan)
	{
		//ambil jumlah pengungsi dari laporan posko, data terbaru tapi tanggal sebelum tanggal laporan bencana
		$this->db->select('sum(jumlah_pria)+sum(jumlah_wanita) as j_pengungsi',FALSE);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','lp.id_posko=p.id_posko');
		$this->db->join('bencana as b','b.id_bencana=p.id_bencana');
		$this->db->join('laporan as lb','lb.id_bencana=b.id_bencana');
		$where = "addtime(lp.tgl_lap_posko,lp.jam_lap_posko)= 
										(select max(addtime(ilp.tgl_lap_posko,ilp.jam_lap_posko))
                                        from laporan_posko ilp
                                        where ilp.id_posko=p.id_posko and 
                                        addtime(ilp.tgl_lap_posko,ilp.jam_lap_posko)< addtime(lb.tanggal_laporan,lb.jam_laporan) and
                                        ilp.status=1
                                        )";
		$this->db->where($where);
		$this->db->where('lb.id_laporan',$id_laporan);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$query = $this->db->get('');
		if($query->num_rows() > 0)
		{
			$detail=$query->result_array();
			foreach($detail as $rows) 
              	{
                 	$j_pengungsi= $rows['j_pengungsi'];
					return $j_pengungsi;
				}
		}
		else
			return null;
	}
	
	//report 1
	function GetLaporan1Paging($perPage,$uri) { //to get all data in tb_book
		// DATE_FORMAT(SYSDATE(), '%Y-%m-%d');
		$this->db->select('*');
		$this->db->from('laporan as l');
		$this->db->join('user as u','l.id_user=u.id_user');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$where = "addtime(l.tanggal_laporan,l.jam_laporan)= (select min(addtime(i.tanggal_laporan,i.jam_laporan))
                                        from laporan i
                                        where i.id_bencana=b.id_bencana and i.status=1)";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function GetJumlahLaporan1()
	{
		$this->db->select('*');
		$this->db->from('laporan as l');
		$this->db->join('user as u','l.id_user=u.id_user');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$where = "addtime(l.tanggal_laporan,l.jam_laporan)= (select min(addtime(i.tanggal_laporan,i.jam_laporan))
                                        from laporan i
                                        where i.id_bencana=b.id_bencana and i.status=1)";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$getData = $this->db->get('');
		
		return $getData->num_rows();
	}
	function GetJumlahLaporan12($keyword)
	{
		$keyword=$this->db->escape_str($keyword);
		$this->db->select();
		$this->db->from('laporan as l');
		$this->db->join('user as u','l.id_user=u.id_user');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%') or
					u.nama_lengkap LIKE lower('%$keyword%') or
					u.username LIKE lower('%$keyword%'))
					and 
					addtime(l.tanggal_laporan,l.jam_laporan)= (select min(addtime(i.tanggal_laporan,i.jam_laporan))
                                        from laporan i
                                        where i.id_bencana=b.id_bencana and i.status=1)";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$query = $this->db->get('');
		return $query->num_rows();
	}
	function CariLaporan1Paging($perPage,$uri,$keyword) { //to get all data in tb_book
		$keyword=$this->db->escape_str($keyword);
		$this->db->select('*');
		$this->db->from('laporan as l');
		$this->db->join('user as u','l.id_user=u.id_user');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%') or
					u.nama_lengkap LIKE lower('%$keyword%') or
					u.username LIKE lower('%$keyword%'))
					and 
					addtime(l.tanggal_laporan,l.jam_laporan)= (select min(addtime(i.tanggal_laporan,i.jam_laporan))
                                        from laporan i
                                        where i.id_bencana=b.id_bencana and i.status=1)";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function GetJumlahLaporan13($keyword,$tgl1,$tgl2)
	{
		$keyword=$this->db->escape_str($keyword);
		if($tgl1>$tgl2)
		{
			$temp=$tgl1;
			$tgl1=$tgl2;
			$tgl2=$temp;
		}
		$this->db->select();
		$this->db->from('laporan as l');
		$this->db->join('user as u','l.id_user=u.id_user');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%') or
					u.nama_lengkap LIKE lower('%$keyword%') or
					u.username LIKE lower('%$keyword%'))
					and 
					addtime(l.tanggal_laporan,l.jam_laporan)= (select min(addtime(i.tanggal_laporan,i.jam_laporan))
                                        from laporan i
                                        where i.id_bencana=b.id_bencana and i.status=1) and b.tanggal between '$tgl1' and '$tgl2'";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$query = $this->db->get('');
		return $query->num_rows();
	}
	function CariLaporan1Paging3($perPage,$uri,$keyword,$tgl1,$tgl2) { //to get all data in tb_book
		$keyword=$this->db->escape_str($keyword);
		if($tgl1>$tgl2)
		{
			$temp=$tgl1;
			$tgl1=$tgl2;
			$tgl2=$temp;
		}
		$this->db->select('*');
		$this->db->from('laporan as l');
		$this->db->join('user as u','l.id_user=u.id_user');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%') or
					u.nama_lengkap LIKE lower('%$keyword%') or
					u.username LIKE lower('%$keyword%'))
					and 
					addtime(l.tanggal_laporan,l.jam_laporan)= (select min(addtime(i.tanggal_laporan,i.jam_laporan))
                                        from laporan i
                                        where i.id_bencana=b.id_bencana and i.status=1) and b.tanggal between '$tgl1' and '$tgl2'";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}

	function GetDataLaporan1($id_laporan)
	{
		$this->db->select();
		$this->db->from('laporan');
		$where = "id_laporan = '$id_laporan'";
		$this->db->join('bencana','laporan.id_bencana=bencana.id_bencana');
		$this->db->where($where);
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}















	//report 2
	function GetLaporan2Paging($perPage,$uri) { //to get all data in tb_book
		// DATE_FORMAT(SYSDATE(), '%Y-%m-%d');
		$this->db->select('*');
		$this->db->from('laporan as l');
		$this->db->join('user as u','l.id_user=u.id_user');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$where = "addtime(l.tanggal_laporan,l.jam_laporan)<> (select min(addtime(i.tanggal_laporan,i.jam_laporan))
                                        from laporan i
                                        where i.id_bencana=b.id_bencana and i.status=1)";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function GetJumlahLaporan2()
	{
		$this->db->select('*');
		$this->db->from('laporan as l');
		$this->db->join('user as u','l.id_user=u.id_user');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$where = "addtime(l.tanggal_laporan,l.jam_laporan)<> (select min(addtime(i.tanggal_laporan,i.jam_laporan))
                                        from laporan i
                                        where i.id_bencana=b.id_bencana and i.status=1)";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$getData = $this->db->get('');
		
		return $getData->num_rows();
	}
	function GetJumlahLaporan22($keyword)
	{
		$keyword=$this->db->escape_str($keyword);
		$this->db->select();
		$this->db->from('laporan as l');
		$this->db->join('user as u','l.id_user=u.id_user');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%') or
					u.nama_lengkap LIKE lower('%$keyword%') or
					u.username LIKE lower('%$keyword%')) and 
					addtime(l.tanggal_laporan,l.jam_laporan)<> (select min(addtime(i.tanggal_laporan,i.jam_laporan))
                                        from laporan i
                                        where i.id_bencana=b.id_bencana and i.status=1)";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$query = $this->db->get('');
		return $query->num_rows();
	}
	function CariLaporan2Paging($perPage,$uri,$keyword) { //to get all data in tb_book
		$keyword=$this->db->escape_str($keyword);
		$this->db->select('*');
		$this->db->from('laporan as l');
		$this->db->join('user as u','l.id_user=u.id_user');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%') or
					u.nama_lengkap LIKE lower('%$keyword%') or
					u.username LIKE lower('%$keyword%')) and 
					addtime(l.tanggal_laporan,l.jam_laporan)<> (select min(addtime(i.tanggal_laporan,i.jam_laporan))
                                        from laporan i
                                        where i.id_bencana=b.id_bencana and i.status=1)";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function GetJumlahLaporan23($keyword,$tgl1,$tgl2)
	{
		$keyword=$this->db->escape_str($keyword);
		if($tgl1>$tgl2)
		{
			$temp=$tgl1;
			$tgl1=$tgl2;
			$tgl2=$temp;
		}
		$this->db->select();
		$this->db->from('laporan as l');
		$this->db->join('user as u','l.id_user=u.id_user');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%') or
					u.nama_lengkap LIKE lower('%$keyword%') or
					u.username LIKE lower('%$keyword%')) and 
					addtime(l.tanggal_laporan,l.jam_laporan)<> (select min(addtime(i.tanggal_laporan,i.jam_laporan))
                                        from laporan i
                                        where i.id_bencana=b.id_bencana and i.status=1)
										 and tanggal between '$tgl1' and '$tgl2'";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$query = $this->db->get('');
		return $query->num_rows();
	}
	function CariLaporan2Paging3($perPage,$uri,$keyword,$tgl1,$tgl2) { //to get all data in tb_book
		$keyword=$this->db->escape_str($keyword);
		if($tgl1>$tgl2)
		{
			$temp=$tgl1;
			$tgl1=$tgl2;
			$tgl2=$temp;
		}
		$this->db->select('*');
		$this->db->from('laporan as l');
		$this->db->join('user as u','l.id_user=u.id_user');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%') or
					u.nama_lengkap LIKE lower('%$keyword%') or
					u.username LIKE lower('%$keyword%')) and 
					addtime(l.tanggal_laporan,l.jam_laporan)<> (select min(addtime(i.tanggal_laporan,i.jam_laporan))
                                        from laporan i
                                        where i.id_bencana=b.id_bencana and i.status=1)
										 and tanggal between '$tgl1' and '$tgl2'";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function GetDataLaporan2($id_laporan)
	{
		$this->db->select();
		$this->db->from('laporan');
		$where = "id_laporan = '$id_laporan'";
		$this->db->join('bencana','laporan.id_bencana=bencana.id_bencana');
		$this->db->where($where);
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}














	
	//report 3
	function GetLaporan3Paging($perPage,$uri) { //to get all data in tb_book
		// DATE_FORMAT(SYSDATE(), '%Y-%m-%d');
		$this->db->select('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$this->db->select('count(distinct p.id_posko) AS jumlah_posko',FALSE);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','lp.id_posko=p.id_posko');
		$this->db->join('user as u','lp.id_user=u.id_user');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		$this->db->group_by('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		/*
		$where = "addtime(l.tanggal_laporan,l.jam_laporan)<> (select min(addtime(i.tanggal_laporan,i.jam_laporan))
                                        from laporan i
                                        where i.id_bencana=b.id_bencana)";
		$this->db->where($where);
		*/
		$this->db->where('b.status', 1);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function GetJumlahLaporan3()
	{
		//$this->db->select('*');
		//$this->db->select('(SELECT SUM(payments.amount) FROM payments WHERE payments.invoice_id=4') AS amount_paid', FALSE); 
		//$this->db->select('nama_bencana,tanggal,jam,b.id_bencana as id_bencana');
		$this->db->select('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$this->db->select('count(distinct p.id_posko) AS jumlah_posko',FALSE);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','lp.id_posko=p.id_posko');
		$this->db->join('user as u','lp.id_user=u.id_user');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		$this->db->group_by('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		/*
		$where = "addtime(l.tanggal_laporan,l.jam_laporan)<> (select min(addtime(i.tanggal_laporan,i.jam_laporan))
                                        from laporan i
                                        where i.id_bencana=b.id_bencana)";
		$this->db->where($where);
		*/
		$this->db->where('b.status', 1);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$getData = $this->db->get('');
		
		return $getData->num_rows();
	}
	function GetJumlahLaporan32($keyword)
	{
		$keyword=$this->db->escape_str($keyword);
		$this->db->select('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$this->db->select('count(distinct p.id_posko) AS jumlah_posko',FALSE);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','lp.id_posko=p.id_posko');
		$this->db->join('user as u','lp.id_user=u.id_user');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		$this->db->group_by('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%'))";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$query = $this->db->get('');
		return $query->num_rows();
	}
	function CariLaporan3Paging($perPage,$uri,$keyword) { //to get all data in tb_book
		$keyword=$this->db->escape_str($keyword);
		$this->db->select('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$this->db->select('count(distinct p.id_posko) AS jumlah_posko',FALSE);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','lp.id_posko=p.id_posko');
		$this->db->join('user as u','lp.id_user=u.id_user');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		$this->db->group_by('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%'))";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function GetJumlahLaporan33($keyword,$tgl1,$tgl2)
	{
		$keyword=$this->db->escape_str($keyword);
		if($tgl1>$tgl2)
		{
			$temp=$tgl1;
			$tgl1=$tgl2;
			$tgl2=$temp;
		}
		$this->db->select('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$this->db->select('count(distinct p.id_posko) AS jumlah_posko',FALSE);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','lp.id_posko=p.id_posko');
		$this->db->join('user as u','lp.id_user=u.id_user');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		$this->db->group_by('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%')) and tanggal between '$tgl1' and '$tgl2'";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$query = $this->db->get('');
		return $query->num_rows();
	}
	function CariLaporan3Paging3($perPage,$uri,$keyword,$tgl1,$tgl2) { //to get all data in tb_book
		$keyword=$this->db->escape_str($keyword);
		if($tgl1>$tgl2)
		{
			$temp=$tgl1;
			$tgl1=$tgl2;
			$tgl2=$temp;
		}
		$this->db->select('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$this->db->select('count(distinct p.id_posko) AS jumlah_posko',FALSE);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','lp.id_posko=p.id_posko');
		$this->db->join('user as u','lp.id_user=u.id_user');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		$this->db->group_by('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%')) and tanggal between '$tgl1' and '$tgl2'";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function GetDataLaporan3($id_bencana)
	{
		$this->db->select();
		$this->db->select('p.latitude AS plat,p.longitude as plon');
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','lp.id_posko=p.id_posko');
		$this->db->join('user as u','lp.id_user=u.id_user');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		$where = "p.id_bencana = '$id_bencana' and 
					addtime(lp.tgl_lap_posko,lp.jam_lap_posko)= (select min(addtime(i.tgl_lap_posko,i.jam_lap_posko))
                                        from laporan_posko i
                                        where i.id_posko=p.id_posko and i.status=1)";
		$this->db->where($where);
		$this->db->where('lp.status', 1);
		$this->db->where('p.status', 1);
		$this->db->order_by('nama_posko');
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}
	function getDetailDataLaporan($id_laporan)
	{
		$this->db->select();
		$this->db->from('laporan_posko as lp');
		$this->db->join('user as u','lp.id_user=u.id_user');
		$this->db->join('posko as p','lp.id_posko=p.id_posko');
		$this->db->where('lp.id_laporan', $id_laporan);
		$this->db->where('lp.status', 1);
		$this->db->where('p.status', 1);
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}













	
	//report 4
	function GetLaporan4Paging($perPage,$uri) { //to get all data in tb_book
		// DATE_FORMAT(SYSDATE(), '%Y-%m-%d');
		$this->db->select('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$this->db->select('count(distinct p.id_posko) AS jumlah_posko',FALSE);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','lp.id_posko=p.id_posko');
		$this->db->join('user as u','lp.id_user=u.id_user');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		$this->db->group_by('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		/*
		$where = "addtime(l.tanggal_laporan,l.jam_laporan)<> (select min(addtime(i.tanggal_laporan,i.jam_laporan))
                                        from laporan i
                                        where i.id_bencana=b.id_bencana)";
		$this->db->where($where);
		*/
		$this->db->where('b.status', 1);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function GetJumlahLaporan4()
	{
		//$this->db->select('*');
		//$this->db->select('(SELECT SUM(payments.amount) FROM payments WHERE payments.invoice_id=4') AS amount_paid', FALSE); 
		//$this->db->select('nama_bencana,tanggal,jam,b.id_bencana as id_bencana');
		$this->db->select('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$this->db->select('count(distinct p.id_posko) AS jumlah_posko',FALSE);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','lp.id_posko=p.id_posko');
		$this->db->join('user as u','lp.id_user=u.id_user');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		$this->db->group_by('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		/*
		$where = "addtime(l.tanggal_laporan,l.jam_laporan)<> (select min(addtime(i.tanggal_laporan,i.jam_laporan))
                                        from laporan i
                                        where i.id_bencana=b.id_bencana)";
		$this->db->where($where);
		*/
		$this->db->where('b.status', 1);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$getData = $this->db->get('');
		
		return $getData->num_rows();
	}
	function GetJumlahLaporan42($keyword)
	{
		$keyword=$this->db->escape_str($keyword);
		$this->db->select('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$this->db->select('count(distinct p.id_posko) AS jumlah_posko',FALSE);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','lp.id_posko=p.id_posko');
		$this->db->join('user as u','lp.id_user=u.id_user');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		$this->db->group_by('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%'))";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$query = $this->db->get('');
		return $query->num_rows();
	}
	function CariLaporan4Paging($perPage,$uri,$keyword) { //to get all data in tb_book
		$keyword=$this->db->escape_str($keyword);
		$this->db->select('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$this->db->select('count(distinct p.id_posko) AS jumlah_posko',FALSE);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','lp.id_posko=p.id_posko');
		$this->db->join('user as u','lp.id_user=u.id_user');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		$this->db->group_by('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%'))";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function GetJumlahLaporan43($keyword,$tgl1,$tgl2)
	{
		$keyword=$this->db->escape_str($keyword);
		if($tgl1>$tgl2)
		{
			$temp=$tgl1;
			$tgl1=$tgl2;
			$tgl2=$temp;
		}
		$this->db->select('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$this->db->select('count(distinct p.id_posko) AS jumlah_posko',FALSE);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','lp.id_posko=p.id_posko');
		$this->db->join('user as u','lp.id_user=u.id_user');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		$this->db->group_by('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%')) and tanggal between '$tgl1' and '$tgl2'";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$query = $this->db->get('');
		return $query->num_rows();
	}
	function CariLaporan4Paging3($perPage,$uri,$keyword,$tgl1,$tgl2) { //to get all data in tb_book
		$keyword=$this->db->escape_str($keyword);
		if($tgl1>$tgl2)
		{
			$temp=$tgl1;
			$tgl1=$tgl2;
			$tgl2=$temp;
		}
		$this->db->select('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$this->db->select('count(distinct p.id_posko) AS jumlah_posko',FALSE);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','lp.id_posko=p.id_posko');
		$this->db->join('user as u','lp.id_user=u.id_user');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		$this->db->group_by('b.id_bencana,b.nama_bencana,b.lokasi,b.jenis_bencana,b.tanggal,b.jam');
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%')) and tanggal between '$tgl1' and '$tgl2'";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function GetDataLaporan4($id_bencana)
	{
		$this->db->select();
		$this->db->select('p.latitude AS plat,p.longitude as plon');
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','lp.id_posko=p.id_posko');
		$this->db->join('user as u','lp.id_user=u.id_user');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		$where = "p.id_bencana = '$id_bencana' and 
					addtime(lp.tgl_lap_posko,lp.jam_lap_posko)= (select max(addtime(i.tgl_lap_posko,i.jam_lap_posko))
                                        from laporan_posko i
                                        where i.id_posko=p.id_posko and i.status=1)";
		$this->db->where($where);
		$this->db->where('lp.status', 1);
		$this->db->where('p.status', 1);
		$this->db->order_by('nama_posko');
		$this->db->order_by('tgl_lap_posko','DESC');
		$this->db->order_by('jam_lap_posko','DESC');
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}













	
	//report 5
	function GetLaporan5Paging($perPage,$uri) { //to get all data in tb_book
		// DATE_FORMAT(SYSDATE(), '%Y-%m-%d');
		$this->db->select('b.id_bencana,b.nama_bencana,b.tanggal,b.jam,b.latitude,b.longitude,b.lokasi,b.jenis_bencana');
		$this->db->select('count(distinct l.id_laporan) AS jumlah_laporan',FALSE);
		$this->db->from('laporan as l');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$this->db->group_by('b.id_bencana,b.nama_bencana,b.tanggal,b.jam,b.latitude,b.longitude,b.lokasi,b.jenis_bencana');
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function GetJumlahLaporan5()
	{
		$this->db->select('b.id_bencana,b.nama_bencana,b.tanggal,b.jam,b.latitude,b.longitude,b.lokasi,b.jenis_bencana');
		$this->db->select('count(distinct l.id_laporan) AS jumlah_laporan',FALSE);
		$this->db->from('laporan as l');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$this->db->group_by('b.id_bencana,b.nama_bencana,b.tanggal,b.jam,b.latitude,b.longitude,b.lokasi,b.jenis_bencana');
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$getData = $this->db->get('');
		
		return $getData->num_rows();
	}
	function GetJumlahLaporan52($keyword)
	{
		$keyword=$this->db->escape_str($keyword);
		$this->db->select('b.id_bencana,b.nama_bencana,b.tanggal,b.jam,b.latitude,b.longitude,b.lokasi,b.jenis_bencana');
		$this->db->select('count(distinct l.id_laporan) AS jumlah_laporan',FALSE);
		$this->db->from('laporan as l');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$this->db->group_by('b.id_bencana,b.nama_bencana,b.tanggal,b.jam,b.latitude,b.longitude,b.lokasi,b.jenis_bencana');
		
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%'))";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$query = $this->db->get('');
		return $query->num_rows();
	}
	function CariLaporan5Paging($perPage,$uri,$keyword) { //to get all data in tb_book
		$keyword=$this->db->escape_str($keyword);
		$this->db->select('b.id_bencana,b.nama_bencana,b.tanggal,b.jam,b.latitude,b.longitude,b.lokasi,b.jenis_bencana');
		$this->db->select('count(distinct l.id_laporan) AS jumlah_laporan',FALSE);
		$this->db->from('laporan as l');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$this->db->group_by('b.id_bencana,b.nama_bencana,b.tanggal,b.jam,b.latitude,b.longitude,b.lokasi,b.jenis_bencana');
		
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%'))";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function GetJumlahLaporan53($keyword,$tgl1,$tgl2)
	{
		$keyword=$this->db->escape_str($keyword);
		if($tgl1>$tgl2)
		{
			$temp=$tgl1;
			$tgl1=$tgl2;
			$tgl2=$temp;
		}
		$this->db->select('b.id_bencana,b.nama_bencana,b.tanggal,b.jam,b.latitude,b.longitude,b.lokasi,b.jenis_bencana');
		$this->db->select('count(distinct l.id_laporan) AS jumlah_laporan',FALSE);
		$this->db->from('laporan as l');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$this->db->group_by('b.id_bencana,b.nama_bencana,b.tanggal,b.jam,b.latitude,b.longitude,b.lokasi,b.jenis_bencana');
		
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%')) and tanggal between '$tgl1' and '$tgl2'";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$query = $this->db->get('');
		return $query->num_rows();
	}
	function CariLaporan5Paging3($perPage,$uri,$keyword,$tgl1,$tgl2) { //to get all data in tb_book
		$keyword=$this->db->escape_str($keyword);
		if($tgl1>$tgl2)
		{
			$temp=$tgl1;
			$tgl1=$tgl2;
			$tgl2=$temp;
		}
		$this->db->select('b.id_bencana,b.nama_bencana,b.tanggal,b.jam,b.latitude,b.longitude,b.lokasi,b.jenis_bencana');
		$this->db->select('count(distinct l.id_laporan) AS jumlah_laporan',FALSE);
		$this->db->from('laporan as l');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$this->db->group_by('b.id_bencana,b.nama_bencana,b.tanggal,b.jam,b.latitude,b.longitude,b.lokasi,b.jenis_bencana');
		
		$where = "(b.nama_bencana LIKE lower('%$keyword%') or
					b.lokasi LIKE lower('%$keyword%') or
					b.jenis_bencana LIKE lower('%$keyword%')) and tanggal between '$tgl1' and '$tgl2'";
		$this->db->where($where);
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$this->db->order_by('tanggal','DESC');
		$this->db->order_by('jam','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	function GetDataLaporan5($id_bencana)
	{
		$this->db->select('l.id_bencana,tanggal_laporan,meninggal as ameninggal,
			luka_berat as aluka_berat,luka_ringan as aluka_ringan,hilang as ahilang,
			mengungsi_jiwa as amengungsi_jiwa,mengungsi_kk as amengungsi_kk,
			rumah as arumah,kantor as akantor,
			fasilitas_kesehatan as afasilitas_kesehatan,fasilitas_pendidikan as afasilitas_pendidikan,fasilitas_umum as afasilitas_umum,
			sarana_ibadah as asarana_ibadah,jembatan as ajembatan,jalan as ajalan,tanggul as atanggul,sawah as asawah,
			lahan_pertanian as alahan_pertanian,lain_lain as alain_lain,
			tim_bpbd as atim_bpbd,tim_dinsos as atim_dinsos,tim_dinkes as atim_dinkes,tim_pu as atim_pu,
			sub_tim as atim_pu');
		$this->db->from('laporan as l');
		$this->db->join('bencana as b','l.id_bencana=b.id_bencana');
		$where = "addtime(l.tanggal_laporan,l.jam_laporan)= 
										(select max(addtime(il.tanggal_laporan,il.jam_laporan))
                                        from laporan il
                                        where il.id_bencana=b.id_bencana and
                                        il.status=1 and il.tanggal_laporan=l.tanggal_laporan
                                        )";
		//jika dalam satu tanggal ada lebih dari 1 lap, maka ambil yang jamnya paling besar tapi kalau jamnya sama akan muncul semua >.~
		$this->db->where($where);
		$this->db->where('l.id_bencana', $id_bencana);
		$this->db->where('b.status', 1);
		$this->db->where('l.status', 1);
		$this->db->order_by('tanggal_laporan');
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}
	
//jangan pakai $this->db->distinct, soalnya dia jadi select distinct * ga peduli uda dikasi nama kolom T.T
	function GetDataLaporanTanggal5($id_bencana)
	{
		$this->db->select('distinct tgl_lap_posko',false);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','p.id_posko=lp.id_posko');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		$this->db->where('b.id_bencana', $id_bencana);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$this->db->order_by('tgl_lap_posko');
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}
	function GetDataPosko5($id_bencana)
	{
		$this->db->select('distinct p.id_posko,p.nama_posko',false);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','p.id_posko=lp.id_posko');
		$this->db->where('p.id_bencana', $id_bencana);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$this->db->order_by('p.nama_posko');
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}

	function GetDataLaporanPosko51($id_bencana,$id_posko)
	{
		$this->db->select('distinct lp.tgl_lap_posko, 
(select avg(ilp.jumlah_pria) from laporan_posko ilp where 
 addtime(ilp.tgl_lap_posko, ilp.jam_lap_posko)=
 	(select max(addtime(iilp.tgl_lap_posko, iilp.jam_lap_posko)) 
    from laporan_posko iilp 
    where iilp.id_posko=ilp.id_posko and 
    iilp.status=1 and 
     iilp.tgl_lap_posko=ilp.tgl_lap_posko and
     iilp.tgl_lap_posko=lp.tgl_lap_posko
			) and ilp.id_posko='.$id_posko.') as jp',FALSE);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','p.id_posko=lp.id_posko');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		//jika dalam satu tanggal ada lebih dari 1 lap, maka ambil yang jamnya paling besar tapi kalau jamnya sama akan muncul semua >.~
		
		$this->db->where('p.id_bencana', $id_bencana);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$this->db->order_by('lp.tgl_lap_posko');
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}
	function GetDataLaporanPosko52($id_bencana,$id_posko)
	{
		$this->db->select('distinct lp.tgl_lap_posko, 
(select avg(ilp.jumlah_wanita) from laporan_posko ilp where 
 addtime(ilp.tgl_lap_posko, ilp.jam_lap_posko)=
 	(select max(addtime(iilp.tgl_lap_posko, iilp.jam_lap_posko)) 
    from laporan_posko iilp 
    where iilp.id_posko=ilp.id_posko and 
    iilp.status=1 and 
     iilp.tgl_lap_posko=ilp.tgl_lap_posko and
     iilp.tgl_lap_posko=lp.tgl_lap_posko
			) and ilp.id_posko='.$id_posko.') as jp',FALSE);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','p.id_posko=lp.id_posko');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		$this->db->where('p.id_bencana', $id_bencana);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$this->db->order_by('lp.tgl_lap_posko');
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}
	function GetDataLaporanPosko53($id_bencana,$id_posko)
	{
		$this->db->select('distinct lp.tgl_lap_posko, 
(select avg(ilp.jumlah_balita) from laporan_posko ilp where 
 addtime(ilp.tgl_lap_posko, ilp.jam_lap_posko)=
 	(select max(addtime(iilp.tgl_lap_posko, iilp.jam_lap_posko)) 
    from laporan_posko iilp 
    where iilp.id_posko=ilp.id_posko and 
    iilp.status=1 and 
     iilp.tgl_lap_posko=ilp.tgl_lap_posko and
     iilp.tgl_lap_posko=lp.tgl_lap_posko
			) and ilp.id_posko='.$id_posko.') as jp',FALSE);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','p.id_posko=lp.id_posko');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		$this->db->where('p.id_bencana', $id_bencana);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$this->db->order_by('lp.tgl_lap_posko');
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}
	function GetDataLaporanPosko54($id_bencana,$id_posko)
	{
		$this->db->select('distinct lp.tgl_lap_posko, 
(select avg(ilp.jumlah_kk) from laporan_posko ilp where 
 addtime(ilp.tgl_lap_posko, ilp.jam_lap_posko)=
 	(select max(addtime(iilp.tgl_lap_posko, iilp.jam_lap_posko)) 
    from laporan_posko iilp 
    where iilp.id_posko=ilp.id_posko and 
    iilp.status=1 and 
     iilp.tgl_lap_posko=ilp.tgl_lap_posko and
     iilp.tgl_lap_posko=lp.tgl_lap_posko
			) and ilp.id_posko='.$id_posko.') as jp',FALSE);
		$this->db->from('laporan_posko as lp');
		$this->db->join('posko as p','p.id_posko=lp.id_posko');
		$this->db->join('bencana as b','p.id_bencana=b.id_bencana');
		$this->db->where('p.id_bencana', $id_bencana);
		$this->db->where('p.status', 1);
		$this->db->where('lp.status', 1);
		$this->db->order_by('lp.tgl_lap_posko');
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}












	
	//report 6
	
	function GetDataLaporan61()
	{
		$this->db->select('
			SUM(IF(jenis_bencana="Gempa Bumi",1,0)) as j1,
			SUM(IF(jenis_bencana="Gunung Berapi",1,0)) as j2,
			SUM(IF(jenis_bencana="Tsunami",1,0)) as j3,
			SUM(IF(jenis_bencana="Tanah Longsor",1,0)) as j4,
			SUM(IF(jenis_bencana="Banjir",1,0)) as j5,
			SUM(IF(jenis_bencana="Kekeringan",1,0)) as j6,
			SUM(IF(jenis_bencana="Kebakaran",1,0)) as j7,
			SUM(IF(jenis_bencana="Kebakaran Hutan",1,0)) as j8,
			SUM(IF(jenis_bencana="Angin Puting Beliung",1,0)) as j9,
			SUM(IF(jenis_bencana="Gelombang Laut Pasang",1,0)) as j10,
			SUM(IF(jenis_bencana="Abrasi",1,0)) as j11',FALSE);
		$this->db->from('bencana as b');
		$this->db->where('b.status', 1);
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}
	function GetDataLaporan62($tahun)
	{
		$this->db->select('date_format(tanggal, "%Y") as tahun, SUM(IF(jenis_bencana="Gempa Bumi", 1, 0)) as j1,
			SUM(IF(jenis_bencana="Gunung Berapi", 1, 0)) as j2, SUM(IF(jenis_bencana="Tsunami", 1, 0)) as j3,
			SUM(IF(jenis_bencana="Tanah Longsor", 1, 0)) as j4, SUM(IF(jenis_bencana="Banjir", 1, 0)) as j5,
			SUM(IF(jenis_bencana="Kekeringan", 1, 0)) as j6, SUM(IF(jenis_bencana="Kebakaran", 1, 0)) as j7,
			SUM(IF(jenis_bencana="Kebakaran Hutan", 1, 0)) as j8, SUM(IF(jenis_bencana="Angin Puting Beliung", 1, 0)) as j9,
			SUM(IF(jenis_bencana="Gelombang Laut Pasang", 1, 0)) as j10, SUM(IF(jenis_bencana="Abrasi", 1, 0)) as j11 
			FROM bencana where status=1
			GROUP BY date_format(tanggal, "%Y")',FALSE);
		
		$this->db->having('tahun',$tahun);
		$query = $this->db->get('');
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}
	function GetDataTahun()
	{
		$return['0'] = 'Semua Tahun';
		$this->db->select('distinct date_format(tanggal,"%Y") as tahun',FALSE);
		$this->db->from('bencana as b');
		$this->db->where('b.status', 1);
		$this->db->order_by('tahun');
	    $query  = $this->db->get('');
	    foreach($query->result_array() as $row){
	        $return[$row['tahun']] = $row['tahun'];
	    }
	    return $return;
	}
}
?>