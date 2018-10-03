<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller {

	/*konstruktor*/
	public function __construct()
    {
        parent::__construct();
        // Your own constructor code
		$this->load->helper('url');
		$this->load->library('googlemaps');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('peta','',TRUE);
		$this->load->library('pagination');
		$this->load->helper('html');
		//$this->output->enable_profiler(TRUE);
		
    }

	public function index()
	{
		$this->session->unset_userdata('keyword');
		$this->session->unset_userdata('keyword2');
		$this->session->unset_userdata('keyword3');
		$this->session->unset_userdata('tanggal1');
		$this->session->unset_userdata('tanggal2');
		$this->session->unset_userdata('tanggal12');
		$this->session->unset_userdata('tanggal22');
		$data['title']='Pemetaan';
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['id_user'] = $session_data['id_user'];
			//setting url buat login/logout
			$data['link']='account/logout';
			$data['link2']='Keluar';
		}
		else
		{
			$data['username'] = 'pengunjung';
			$data['id_user'] = '0';
			//setting url buat login/logout
			$data['link']='account';
			$data['link2']='Masuk';
		}
		
		$a = $this->peta->GetJumlahBencana();
		$config['base_url'] = base_url().'index.php/map/index/'; //pointing to a controller called and a function
		$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
		$config['per_page'] = 5; //The number of items you intend to show per page
		$config['uri_segment'] = 3; //The pagination function automatically determines which segment of your URI contains the page number
		$config['num_links'] = 2; //The number of "digit" links you would like before and after the selected page number
		$config['use_page_numbers'] = TRUE; //By default, the URI segment will use the starting index for the items you are paginating. If you prefer to show the the actual page number, set this to TRUE
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		$this->pagination->initialize($config); //initialize pagination
		if($this->uri->segment(3) > 0)
		    $offset = ($this->uri->segment(3) + 0)*$config['per_page'] - $config['per_page'];
		else
		    $offset = $this->uri->segment(3);
		$data['detail'] = $this->peta->GetBencanaPaging($config['per_page'],$offset);
		$data['map']=$this->map1();
		$data['keyword'] = '';
		$data['tanggal1'] = '';
		$data['tanggal2'] = '';
		//$this->load->view('peta_v',$data);
		$data['main_content']='peta_v';
		$data['map_content1']='peta_v1';
		$data['map_content2'] = 'peta_v2';
		$this->load->view('includes/template_4',$data);
	}

	public function map1()
	{
		$config['zoom'] = 'auto';//zoom level to show all the marker
		$config['center'] = '-7.7828,110.3608';//uajy
		// Initialize our map. Here you can also pass in additional parameters for customising the map (see below)
		$this->googlemaps->initialize($config);

		// Get the co-ordinates from the database using our model
		//$coords = $this->peta->getKoordinatBencana();
		
		$id_bencana=0;
		$detail=$this->peta->getIdMaxTanggalBencana();

		if(count($detail) > 0) { 
          	foreach($detail as $rows) {
         	 	$id_bencana = $rows['id_bencana'];
      		}
  		}
		$coords = $this->peta->cariKoordinatBencana($id_bencana);
		$i=0;
		// Loop through the coordinates we obtained above and add them to the map
		foreach ($coords as $coordinate) {
			$marker = array();
			$marker['position'] = $coordinate->latitude.','.$coordinate->longitude;
			//$datestring = "Year: %Y Month: %m Day: %d - %h:%i %a";mdate($datestring, $time);
			$marker['title'] = $coordinate->nama_bencana.' ('. $coordinate->tanggal_format.')';
			$marker['zIndex'] = $i; //If two markers overlap, the marker with the higher $zIndex will appear on top
			$i=$i+1;//supaya bencana yang tanggalnya terkini yang muncul duluan 
			$marker['icon'] = base_url().'/images/marker1.png';//icon marker
			$korban=(int)$coordinate->meninggal+(int)$coordinate->luka_berat+(int)$coordinate->luka_ringan+(int)$coordinate->hilang;
			$marker['infowindow_content'] ="<div class='text-left'><h4>". 
						$coordinate->nama_bencana ."</h4><p>Koordinat: ".$coordinate->latitude.','.$coordinate->longitude.
						"</p><p>Laporan tanggal: ". $coordinate->tgl_lap_format .
						"</p><p>Total korban: ". $korban ." orang</p><p class='indent2'>Jumlah meninggal: ".
                        $coordinate->meninggal." orang</p><p  class='indent2'>Jumlah luka berat: ".
                        $coordinate->luka_berat." orang </p><p class='indent2'>Jumlah luka ringan: ".
                        $coordinate->luka_ringan." orang</p><p class='indent2'>Jumlah hilang/hanyut: ".
                        $coordinate->hilang." orang </p></div>";
			$this->googlemaps->add_marker($marker);
		}

		//$coords = $this->peta->getKoordinatPosko();
		$coords = $this->peta->cariKoordinatPosko($id_bencana);
		$i=0;
		// Loop through the coordinates we obtained above and add them to the map
		foreach ($coords as $coordinate) {
			$marker = array();
			$marker['position'] = $coordinate->platitude.','.$coordinate->plongitude;
			//$datestring = "Year: %Y Month: %m Day: %d - %h:%i %a";mdate($datestring, $time);
			$marker['title'] = $coordinate->nama_posko;
			$marker['zIndex'] = $i; //If two markers overlap, the marker with the higher $zIndex will appear on top
			$i=$i+1;//supaya bencana yang tanggalnya terkini yang muncul duluan 
			$marker['icon'] = base_url().'/images/marker2.png';//icon marker
			$pengungsi=$coordinate->jumlah_pria+$coordinate->jumlah_wanita;
			$marker['infowindow_content'] ="<div class='text-left'><h4>". $coordinate->nama_posko .
				"</h4><p>Koordinat: ".$coordinate->platitude.','.$coordinate->plongitude.
						"</p><p>Laporan tanggal: ". $coordinate->tanggal_format .
				"</p><p>Kapasitas: ". $coordinate->kapasitas.
				"</p><p>Pengungsi: ". $pengungsi.
				" orang<div class='indent2'><p>Jumlah kk: ". $coordinate->jumlah_kk.
				" kk</p><p>Jumlah pria: ". $coordinate->jumlah_pria .
				" orang</p><p>Jumlah wanita: ". $coordinate->jumlah_wanita.
				" orang</p><p>Jumlah balita: ". $coordinate->jumlah_balita.
				" orang</p></div></div>";
			$this->googlemaps->add_marker($marker);
		}

		// Create the map
		//$data['map'] = $this->googlemaps->create_map();
		return $this->googlemaps->create_map();
	}
	public function map2($id_bencana)
	{
		$config['zoom'] = 'auto';//zoom level to show all the marker
		$config['center'] = '-7.7828,110.3608';//uajy
		// Initialize our map. Here you can also pass in additional parameters for customising the map (see below)
		$this->googlemaps->initialize($config);

		// Get the co-ordinates from the database using our model
		$coords = $this->peta->cariKoordinatBencana($id_bencana);
		$i=0;
		// Loop through the coordinates we obtained above and add them to the map
		foreach ($coords as $coordinate) {
			$marker = array();
			$marker['position'] = $coordinate->latitude.','.$coordinate->longitude;
			//$datestring = "Year: %Y Month: %m Day: %d - %h:%i %a";mdate($datestring, $time);
			$marker['title'] = $coordinate->nama_bencana.' ('. $coordinate->tanggal_format.')';
			$marker['zIndex'] = $i; //If two markers overlap, the marker with the higher $zIndex will appear on top
			$marker['icon'] = base_url().'/images/marker1.png';//icon marker
			$i=$i+1;//supaya bencana yang tanggalnya terkini yang muncul duluan 
			$korban=(int)$coordinate->meninggal+(int)$coordinate->luka_berat+(int)$coordinate->luka_ringan+(int)$coordinate->hilang;
			$marker['infowindow_content'] ="<div class='text-left'><h4>". $coordinate->nama_bencana .
						"</h4><p>Koordinat: ".$coordinate->latitude.','.$coordinate->longitude.
						"</p><p>Laporan tanggal: ". $coordinate->tgl_lap_format .
						"</p><p>Total korban: ". $korban ." orang</p><p class='indent2'>Jumlah meninggal: ".
                        $coordinate->meninggal." orang</p><p  class='indent2'>Jumlah luka berat: ".
                        $coordinate->luka_berat." orang </p><p class='indent2'>Jumlah luka ringan: ".
                        $coordinate->luka_ringan." orang</p><p class='indent2'>Jumlah hilang/hanyut: ".
                        $coordinate->hilang." orang </p></div>";
			$this->googlemaps->add_marker($marker);
		}

		$coords = $this->peta->cariKoordinatPosko($id_bencana);
		$i=0;
		// Loop through the coordinates we obtained above and add them to the map
		foreach ($coords as $coordinate) {
			$marker = array();
			$marker['position'] = $coordinate->platitude.','.$coordinate->plongitude;
			//$datestring = "Year: %Y Month: %m Day: %d - %h:%i %a";mdate($datestring, $time);
			$marker['title'] = $coordinate->nama_posko;
			$marker['zIndex'] = $i; //If two markers overlap, the marker with the higher $zIndex will appear on top
			$i=$i+1;//supaya bencana yang tanggalnya terkini yang muncul duluan 
			$marker['icon'] = base_url().'/images/marker2.png';//icon marker
			$pengungsi=$coordinate->jumlah_pria+$coordinate->jumlah_wanita;
			$marker['infowindow_content'] ="<div class='text-left'><h4>". $coordinate->nama_posko .
				"</h4><p>Koordinat: ".$coordinate->platitude.','.$coordinate->plongitude.
						"</p><p>Laporan tanggal: ". $coordinate->tanggal_format .
				"</p><p>Kapasitas: ". $coordinate->kapasitas.
				"</p><p>Pengungsi: ". $pengungsi.
				" orang<div class='indent2'><p>Jumlah kk: ". $coordinate->jumlah_kk.
				" kk</p><p>Jumlah pria: ". $coordinate->jumlah_pria .
				" orang</p><p>Jumlah wanita: ". $coordinate->jumlah_wanita.
				" orang</p><p>Jumlah balita: ". $coordinate->jumlah_balita.
				" orang</p></div></div>";
			$this->googlemaps->add_marker($marker);
		}

		// Create the map
		//$data['map'] = $this->googlemaps->create_map();
		return $this->googlemaps->create_map();
	}
	public function find()
	{
		$data['map'] = $this->map1();
		$data['title']='Pemetaan - Cari Data Bencana';
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['id_user'] = $session_data['id_user'];
			//setting url buat login/logout
			$data['link']='account/logout';
			$data['link2']='Keluar';
		}
		else
		{
			$data['username'] = '';
			$data['id_user'] = '0';
			//setting url buat login/logout
			$data['link']='account';
			$data['link2']='Masuk';
		}
		$keyword = ''; // default when no term in session or POST
		if ($this->input->post('keyword'))
		{
			// use the term from POST and set it to session
			$keyword = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $keyword);
		}
		elseif ($this->session->userdata('keyword'))
		{
			// if term is not in POST use existing term from session
			$keyword = $this->session->userdata('keyword');
		}
		$data['keyword'] = $keyword;

		$tanggal1 = ''; // default when no term in session or POST
		if ($this->input->post('tanggal1'))
		{
			// use the term from POST and set it to session
			$tanggal1 = $this->input->post('tanggal1');
			$this->session->set_userdata('tanggal1', $tanggal1);
		}
		elseif ($this->session->userdata('tanggal1'))
		{
			// if term is not in POST use existing term from session
			$tanggal1 = $this->session->userdata('tanggal1');
		}
		$data['tanggal1'] = $tanggal1;
		$tanggal2 = ''; // default when no term in session or POST
		if ($this->input->post('tanggal2'))
		{
			// use the term from POST and set it to session
			$tanggal2 = $this->input->post('tanggal2');
			$this->session->set_userdata('tanggal2', $tanggal2);
		}
		elseif ($this->session->userdata('tanggal2'))
		{
			// if term is not in POST use existing term from session
			$tanggal2 = $this->session->userdata('tanggal2');
		}
		$data['tanggal2'] = $tanggal2;



		//$this->form_validation->set_rules('field', 'label', 'rules');
		$this->form_validation->set_rules('keyword', 'pencarian', 'xss_clean|max_length[50]|callback_alpha_dash_space|trim');
		$this->form_validation->set_rules('tanggal1', 'tanggal1', 'xss_clean|trim');
		$this->form_validation->set_rules('tanggal2', 'tanggal2', 'xss_clean|trim');
		//$this->form_validation->set_message('rule', 'Error Message');
		$this->form_validation->set_message('required', 'Field %s harus diisi');
		$this->form_validation->set_message('max_length', 'Field %s maksimal 50 karakter');
		$this->form_validation->set_message('alpha_dash_space', 'Field %s hanya dapat mengandung huruf, angka, spasi, tanda underscore, dan tanda dash');
			
			
		if($this->form_validation->run() ==FALSE && !$this->session->userdata('keyword'))
		{
			if($tanggal1=='' || $tanggal2=='')
			{
				//echo 'lol1';
				//kalau form validation gagal
				$a = $this->peta->GetJumlahBencana();
				$config['base_url'] = base_url().'index.php/map/find/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 5; //The number of items you intend to show per page
				$config['uri_segment'] = 3; //The pagination function automatically determines which segment of your URI contains the page number
				$config['num_links'] = 2; //The number of "digit" links you would like before and after the selected page number
				$config['use_page_numbers'] = TRUE; //By default, the URI segment will use the starting index for the items you are paginating. If you prefer to show the the actual page number, set this to TRUE
				$config['full_tag_open'] = "<ul class='pagination'>";
				$config['full_tag_close'] ="</ul>";
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$config['next_tag_open'] = "<li>";
				$config['next_tagl_close'] = "</li>";
				$config['prev_tag_open'] = "<li>";
				$config['prev_tagl_close'] = "</li>";
				$config['first_tag_open'] = "<li>";
				$config['first_tagl_close'] = "</li>";
				$config['last_tag_open'] = "<li>";
				$config['last_tagl_close'] = "</li>";
				$this->pagination->initialize($config); //initialize pagination
				if($this->uri->segment(3) > 0)
				    $offset = ($this->uri->segment(3) + 0)*$config['per_page'] - $config['per_page'];
				else
				    $offset = $this->uri->segment(3);
				$data['detail'] = $this->peta->GetBencanaPaging($config['per_page'],$offset);
				//$this->load->view('peta_v',$data);
			}
			else
			{
				$a = $this->peta->GetJumlahBencana3($keyword,$tanggal1,$tanggal2);
				$config['base_url'] = base_url().'index.php/map/find/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 5; //The number of items you intend to show per page
				$config['uri_segment'] = 3; //The pagination function automatically determines which segment of your URI contains the page number
				$config['num_links'] = 2; //The number of "digit" links you would like before and after the selected page number
				$config['use_page_numbers'] = TRUE; //By default, the URI segment will use the starting index for the items you are paginating. If you prefer to show the the actual page number, set this to TRUE
				$config['full_tag_open'] = "<ul class='pagination'>";
				$config['full_tag_close'] ="</ul>";
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$config['next_tag_open'] = "<li>";
				$config['next_tagl_close'] = "</li>";
				$config['prev_tag_open'] = "<li>";
				$config['prev_tagl_close'] = "</li>";
				$config['first_tag_open'] = "<li>";
				$config['first_tagl_close'] = "</li>";
				$config['last_tag_open'] = "<li>";
				$config['last_tagl_close'] = "</li>";
				$this->pagination->initialize($config); //initialize pagination
				if($this->uri->segment(3) > 0)
				{
				    $offset = ($this->uri->segment(3) + 0)*$config['per_page'] - $config['per_page'];
				    $urisegment=$this->uri->segment(3);
				}
				else
				{
				    $offset = $this->uri->segment(3);
				    $urisegment=1;
				}

				$data['detail'] = $this->peta->CariBencanaPaging2($config['per_page'],$offset,$keyword,$tanggal1,$tanggal2);
			}
		}
		else
		{
			if($tanggal1=='' || $tanggal2=='')
			{
				//$keyword=$this->session->userdata('keyword');
				//echo 'lol2'. $this->session->userdata('keyword');
				$a = $this->peta->GetJumlahBencana2($keyword);
				$config['base_url'] = base_url().'index.php/map/find/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 5; //The number of items you intend to show per page
				$config['uri_segment'] = 3; //The pagination function automatically determines which segment of your URI contains the page number
				$config['num_links'] = 2; //The number of "digit" links you would like before and after the selected page number
				$config['use_page_numbers'] = TRUE; //By default, the URI segment will use the starting index for the items you are paginating. If you prefer to show the the actual page number, set this to TRUE
				$config['full_tag_open'] = "<ul class='pagination'>";
				$config['full_tag_close'] ="</ul>";
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$config['next_tag_open'] = "<li>";
				$config['next_tagl_close'] = "</li>";
				$config['prev_tag_open'] = "<li>";
				$config['prev_tagl_close'] = "</li>";
				$config['first_tag_open'] = "<li>";
				$config['first_tagl_close'] = "</li>";
				$config['last_tag_open'] = "<li>";
				$config['last_tagl_close'] = "</li>";
				$this->pagination->initialize($config); //initialize pagination
				if($this->uri->segment(3) > 0)
				{
				    $offset = ($this->uri->segment(3) + 0)*$config['per_page'] - $config['per_page'];
				    $urisegment=$this->uri->segment(3);
				}
				else
				{
				    $offset = $this->uri->segment(3);
				    $urisegment=1;
				}

				$data['detail'] = $this->peta->CariBencanaPaging($config['per_page'],$offset,$keyword);
				//$this->load->view('peta_v',$data);
			}
			else
			{
				$a = $this->peta->GetJumlahBencana3($keyword,$tanggal1,$tanggal2);
				$config['base_url'] = base_url().'index.php/map/find/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 5; //The number of items you intend to show per page
				$config['uri_segment'] = 3; //The pagination function automatically determines which segment of your URI contains the page number
				$config['num_links'] = 2; //The number of "digit" links you would like before and after the selected page number
				$config['use_page_numbers'] = TRUE; //By default, the URI segment will use the starting index for the items you are paginating. If you prefer to show the the actual page number, set this to TRUE
				$config['full_tag_open'] = "<ul class='pagination'>";
				$config['full_tag_close'] ="</ul>";
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$config['next_tag_open'] = "<li>";
				$config['next_tagl_close'] = "</li>";
				$config['prev_tag_open'] = "<li>";
				$config['prev_tagl_close'] = "</li>";
				$config['first_tag_open'] = "<li>";
				$config['first_tagl_close'] = "</li>";
				$config['last_tag_open'] = "<li>";
				$config['last_tagl_close'] = "</li>";
				$this->pagination->initialize($config); //initialize pagination
				if($this->uri->segment(3) > 0)
				{
				    $offset = ($this->uri->segment(3) + 0)*$config['per_page'] - $config['per_page'];
				    $urisegment=$this->uri->segment(3);
				}
				else
				{
				    $offset = $this->uri->segment(3);
				    $urisegment=1;
				}

				$data['detail'] = $this->peta->CariBencanaPaging2($config['per_page'],$offset,$keyword,$tanggal1,$tanggal2);
			}
		}
		$data['main_content']='peta_v';
		$data['map_content1']='peta_v1';
		$data['map_content2'] = 'peta_v2';
		$this->load->view('includes/template_4',$data);
	}
	public function searching() {
		$this->session->unset_userdata('keyword');
		$this->session->unset_userdata('keyword2');
		$this->session->unset_userdata('keyword3');
		$this->session->unset_userdata('tanggal1');
		$this->session->unset_userdata('tanggal2');
		$this->session->unset_userdata('tanggal12');
		$this->session->unset_userdata('tanggal22');
		$this->find();
	
	}






















	public function show($id_bencana = null) {
		if ($id_bencana == null) {
			show_error('No identifier provided', 500);
		}
		else {
		//$this->session->set_userdata('id_bencana', $id_bencana);
		//$this->searching();
		$data['map'] = $this->map2($id_bencana);
		$data['title']='Pemetaan';
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['id_user'] = $session_data['id_user'];
			//setting url buat login/logout
			$data['link']='account/logout';
			$data['link2']='Keluar';
		}
		else
		{
			$data['username'] = '';
			$data['id_user'] = '0';
			//setting url buat login/logout
			$data['link']='account';
			$data['link2']='Masuk';
		}
		$keyword = ''; // default when no term in session or POST
		if ($this->input->post('keyword'))
		{
			// use the term from POST and set it to session
			$keyword = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $keyword);
		}
		elseif ($this->session->userdata('keyword'))
		{
			// if term is not in POST use existing term from session
			$keyword = $this->session->userdata('keyword');
		}
		$data['keyword'] = $keyword;

		$tanggal1 = ''; // default when no term in session or POST
		if ($this->input->post('tanggal1'))
		{
			// use the term from POST and set it to session
			$tanggal1 = $this->input->post('tanggal1');
			$this->session->set_userdata('tanggal1', $tanggal1);
		}
		elseif ($this->session->userdata('tanggal1'))
		{
			// if term is not in POST use existing term from session
			$tanggal1 = $this->session->userdata('tanggal1');
		}
		$data['tanggal1'] = $tanggal1;
		$tanggal2 = ''; // default when no term in session or POST
		if ($this->input->post('tanggal2'))
		{
			// use the term from POST and set it to session
			$tanggal2 = $this->input->post('tanggal2');
			$this->session->set_userdata('tanggal2', $tanggal2);
		}
		elseif ($this->session->userdata('tanggal2'))
		{
			// if term is not in POST use existing term from session
			$tanggal2 = $this->session->userdata('tanggal2');
		}
		$data['tanggal2'] = $tanggal2;


		if($tanggal1=='' || $tanggal2=='')
		{
			$a = $this->peta->GetJumlahBencana2($keyword);
			$config['base_url'] = base_url().'index.php/map/show/'.$id_bencana.'/'; //pointing to a controller called and a function
			$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
			$config['per_page'] = 5; //The number of items you intend to show per page
			$config['uri_segment'] = 4; //The pagination function automatically determines which segment of your URI contains the page number
			$config['num_links'] = 2; //The number of "digit" links you would like before and after the selected page number
			$config['use_page_numbers'] = TRUE; //By default, the URI segment will use the starting index for the items you are paginating. If you prefer to show the the actual page number, set this to TRUE
			$config['full_tag_open'] = "<ul class='pagination'>";
			$config['full_tag_close'] ="</ul>";
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
			$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] = "<li>";
			$config['next_tagl_close'] = "</li>";
			$config['prev_tag_open'] = "<li>";
			$config['prev_tagl_close'] = "</li>";
			$config['first_tag_open'] = "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open'] = "<li>";
			$config['last_tagl_close'] = "</li>";
			$this->pagination->initialize($config); //initialize pagination
			if($this->uri->segment(4) > 0)
			    $offset = ($this->uri->segment(4) + 0)*$config['per_page'] - $config['per_page'];
			else
			    $offset = $this->uri->segment(4);

			$data['detail'] = $this->peta->CariBencanaPaging($config['per_page'],$offset,$keyword);
		}
		else
		{
			$a = $this->peta->GetJumlahBencana3($keyword,$tanggal1,$tanggal2);
			$config['base_url'] = base_url().'index.php/map/show/'.$id_bencana.'/'; //pointing to a controller called and a function
			$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
			$config['per_page'] = 5; //The number of items you intend to show per page
			$config['uri_segment'] = 4; //The pagination function automatically determines which segment of your URI contains the page number
			$config['num_links'] = 2; //The number of "digit" links you would like before and after the selected page number
			$config['use_page_numbers'] = TRUE; //By default, the URI segment will use the starting index for the items you are paginating. If you prefer to show the the actual page number, set this to TRUE
			$config['full_tag_open'] = "<ul class='pagination'>";
			$config['full_tag_close'] ="</ul>";
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
			$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] = "<li>";
			$config['next_tagl_close'] = "</li>";
			$config['prev_tag_open'] = "<li>";
			$config['prev_tagl_close'] = "</li>";
			$config['first_tag_open'] = "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open'] = "<li>";
			$config['last_tagl_close'] = "</li>";
			$this->pagination->initialize($config); //initialize pagination
			if($this->uri->segment(4) > 0)
			    $offset = ($this->uri->segment(4) + 0)*$config['per_page'] - $config['per_page'];
			else
			    $offset = $this->uri->segment(4);

			$data['detail'] = $this->peta->CariBencanaPaging2($config['per_page'],$offset,$keyword,$tanggal1,$tanggal2);
			
		}
		//$data['hal']=ceil(($this->uri->segment(4)/$config['per_page']) + 1); ;
		$data['main_content']='peta_v';
		$data['map_content1']='peta_v1';
		$data['map_content2'] = 'peta_v2';
		$this->load->view('includes/template_4',$data);
		/*if($data['hal']!=1)
			redirect('map/show/'.$id_bencana.'/'.$data['hal']);
			*/
		}
	}
}

/* End of file welcome.php */
