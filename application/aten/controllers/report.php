<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	/*konstruktor*/
	public function __construct()
	{
		parent::__construct();
        // Your own constructor code
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('laporan','',TRUE);//tell the model loading function to auto-connect to database
		$this->load->model('bencana','',TRUE);
		$this->load->model('laporan_bencana','',TRUE);
		$this->load->library('pagination'); //call pagination library
		$this->load->helper('html');
		$this->load->helper(array('dompdf', 'file'));
		//$this->output->enable_profiler(TRUE);
	}
	private function no_cache(){
       //fungsi buat tombol back ga bisa lihat data
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        
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
		$data['title']='Laporan';
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
		//$this->load->view('lap_v',$data);
		$data['main_content']='lap_v';
		$this->load->view('includes/template_3',$data);
	}
	public function form()
	{
		$jenislap = $this->input->post('jenislap');
		if($jenislap=='r1')
			$this->r1();
		else if ($jenislap=='r2')
			$this->r2();
		else if ($jenislap=='r3')
			$this->r3();
		else if ($jenislap=='r4')
			$this->r4();
		else if ($jenislap=='r5')
			$this->r5();
		else if ($jenislap=='r6')
			$this->r6();
	}
	public function search()
	{
		if(isset($_POST["caridatar1"]))
		{
			$this->session->unset_userdata('keyword');
			$this->session->unset_userdata('tanggal1');
			$this->session->unset_userdata('tanggal2');
			$this->find1();
		}
		else if(isset($_POST["caridatar2"]))
		{
			$this->session->unset_userdata('keyword');
			$this->session->unset_userdata('tanggal1');
			$this->session->unset_userdata('tanggal2');
			$this->find2();
		}
		else if(isset($_POST["caridatar3"]))
		{
			$this->session->unset_userdata('keyword');
			$this->session->unset_userdata('tanggal1');
			$this->session->unset_userdata('tanggal2');
			$this->find3();
		}
		else if(isset($_POST["caridatar4"]))
		{
			$this->session->unset_userdata('keyword');
			$this->session->unset_userdata('tanggal1');
			$this->session->unset_userdata('tanggal2');
			$this->find4();
		}
		else if(isset($_POST["caridatar5"]))
		{
			$this->session->unset_userdata('keyword');
			$this->session->unset_userdata('tanggal1');
			$this->session->unset_userdata('tanggal2');
			$this->find5();
		}
		else if(isset($_POST["caridatar6"]))
		{
			$this->session->unset_userdata('keyword');
			$this->session->unset_userdata('tanggal1');
			$this->session->unset_userdata('tanggal2');
			$this->find6();
		}
	}
	function alpha_dash_space($str)
	{
		return ( ! preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
	}

	//report 1
	public function r1() {
		$data['title']='Laporan Awal TRC BPBD';
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
		$a = $this->laporan->GetJumlahLaporan1();
		$config['base_url'] = base_url().'index.php/report/r1/'; //pointing to a controller called and a function
		$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
		$config['per_page'] = 10; //The number of items you intend to show per page
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
		$data['detail'] = $this->laporan->GetLaporan1Paging($config['per_page'],$offset);

		$data['keyword'] = '';
		$data['tanggal1'] = '';
		$data['tanggal2'] = '';

		//$this->load->view('lap_v1',$data);
		$data['main_content']='lap_v1';
		$this->load->view('includes/template_3',$data);
	}
	
	public function find1()
	{
		$data['title']='Laporan Awal TRC BPBD - Cari Data';
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
				$a = $this->laporan->GetJumlahLaporan1();
				$config['base_url'] = base_url().'index.php/report/find1/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->GetLaporan1Paging($config['per_page'],$offset);
				//$this->load->view('lap_v1',$data);
			}
			else
			{
				$a = $this->laporan->GetJumlahLaporan13($keyword,$tanggal1,$tanggal2);
				$config['base_url'] = base_url().'index.php/report/find1/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->CariLaporan1Paging3($config['per_page'],$offset,$keyword,$tanggal1,$tanggal2);
			}
		}
		else
		{
			if($tanggal1=='' || $tanggal2=='')
			{
				//$keyword=$this->session->userdata('keyword');
				//echo 'lol2'. $this->session->userdata('keyword');
				$a = $this->laporan->GetJumlahLaporan12($keyword);
				$config['base_url'] = base_url().'index.php/report/find1/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->CariLaporan1Paging($config['per_page'],$offset,$keyword);
			}
			else
			{
				$a = $this->laporan->GetJumlahLaporan13($keyword,$tanggal1,$tanggal2);
				$config['base_url'] = base_url().'index.php/report/find1/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->CariLaporan1Paging3($config['per_page'],$offset,$keyword,$tanggal1,$tanggal2);
			}
			
			//$this->load->view('lap_v1',$data);
		}
		$data['main_content']='lap_v1';
		$this->load->view('includes/template_3',$data);
	}
	public function form1($id_laporan=NULL) {
		$data['title']='Laporan Awal TRC BPBD';
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
		if ($id_laporan == null) {
			show_error('No identifier provided', 500);
		}
		else {
			$data['id_laporan']=$id_laporan;
			$data['detail'] = $this->laporan->GetDataLaporan1($id_laporan);
			$data['pengungsi'] = $this->laporan->GetPengungsi($id_laporan);

		    //$this->load->view('lap_v1_2', $data);
		    $data['main_content']='lap_v1_2';
			$this->load->view('includes/template_3',$data);
		    
		}
	}
	public function pdf1($id_laporan=NULL) {
		$this->no_cache();
		if(!$this->session->userdata('logged_in'))
		{
			$this->session->set_flashdata('message', 'Silahkan verifikasi terlebih dahulu');
			redirect('account');
		}
		$data['title']='Laporan Awal TRC BPBD';
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
		if ($id_laporan == null) {
			show_error('No identifier provided', 500);
		}
		else {
			$data['id_laporan']=$id_laporan;
			$data['detail'] = $this->laporan->GetDataLaporan1($id_laporan);
			$data['pengungsi'] = $this->laporan->GetPengungsi($id_laporan);

			$this->form_validation->set_rules('rencana_aksi', 'rencana aksi TIM', 'trim|max_length[500]|required');
		  	$this->form_validation->set_rules('kesimpulan', 'kesimpulan dan rekomendasi', 'trim|max_length[500]|required');
	  		$this->form_validation->set_rules('penutup', 'penutup', 'trim|max_length[500]|required');

	  		$this->form_validation->set_message('required', 'Field %s harus diisi');
		  	$this->form_validation->set_message('max_length', 'Field %s maksimal 500 karakter');
		  	$this->form_validation->set_message('alpha_dash_space', 'Field %s hanya dapat mengandung huruf, angka, spasi, tanda underscore, dan tanda dash');

		  	if($this->form_validation->run() ==FALSE)
			{
				//kalau form validation gagal
				//$this->session->set_flashdata('message', 'Data bencana tidak berhasil ditambahkan');
				$data['id_laporan']=$id_laporan;
				$data['detail'] = $this->laporan->GetDataLaporan1($id_laporan);
				$data['pengungsi'] = $this->laporan->GetPengungsi($id_laporan);

		    	//$this->load->view('lap_v1_2', $data); //ga bisa rdirect, nanti form_validation nya ga muncul
				$data['main_content']='lap_v1_2';
				$this->load->view('includes/template_3',$data);
				
			}
			else
			{
				$rencana_aksi=$this->input->post('rencana_aksi');
				$kesimpulan=$this->input->post('kesimpulan');
				$penutup=$this->input->post('penutup');

				$this->laporan_bencana->EditLaporanBencana2($id_laporan,$rencana_aksi,$kesimpulan,$penutup);

				$data['id_laporan']=$id_laporan;
				$data['detail'] = $this->laporan->GetDataLaporan1($id_laporan);
				$data['pengungsi'] = $this->laporan->GetPengungsi($id_laporan);
				//$data['test_questions']= "hello";
		        $html = $this->load->view('lap_v1_3', $data, true);
				$filename="Laporan Awal Bencana";
		        pdf_create($html, $filename);
		       // write_file('name', $data);
			    //$this->load->view('lap_v1_2', $data);
			    
			}
			
		}
	}














	//report 2
	public function r2() {
		$data['title']='Laporan Perkembangan TRC BPBD';
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
		$a = $this->laporan->GetJumlahLaporan2();
		$config['base_url'] = base_url().'index.php/report/r2/'; //pointing to a controller called and a function
		$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
		$config['per_page'] = 10; //The number of items you intend to show per page
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
		$data['detail'] = $this->laporan->GetLaporan2Paging($config['per_page'],$offset);

		$data['keyword'] = '';
		$data['tanggal1'] = '';
		$data['tanggal2'] = '';
		//$this->load->view('lap_v2',$data);
		$data['main_content']='lap_v2';
		$this->load->view('includes/template_3',$data);
	}
	
	public function find2()
	{
		$data['title']='Laporan Perkembangan TRC BPBD - Cari Data';
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
				$a = $this->laporan->GetJumlahLaporan2();
				$config['base_url'] = base_url().'index.php/report/find2/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->GetLaporan2Paging($config['per_page'],$offset);
				//$this->load->view('lap_v2',$data);
			}
			else
			{
				$a = $this->laporan->GetJumlahLaporan23($keyword,$tanggal1,$tanggal2);
				$config['base_url'] = base_url().'index.php/report/find2/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->CariLaporan2Paging3($config['per_page'],$offset,$keyword,$tanggal1,$tanggal2);
			}
		}
		else
		{
			if($tanggal1=='' || $tanggal2=='')
			{
				//$keyword=$this->session->userdata('keyword');
				//echo 'lol2'. $this->session->userdata('keyword');
				$a = $this->laporan->GetJumlahLaporan22($keyword);
				$config['base_url'] = base_url().'index.php/report/find2/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->CariLaporan2Paging($config['per_page'],$offset,$keyword);
				
				//$this->load->view('lap_v2',$data);
			}
			else
			{
				$a = $this->laporan->GetJumlahLaporan23($keyword,$tanggal1,$tanggal2);
				$config['base_url'] = base_url().'index.php/report/find2/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->CariLaporan2Paging3($config['per_page'],$offset,$keyword,$tanggal1,$tanggal2);
			}
		}
		$data['main_content']='lap_v2';
		$this->load->view('includes/template_3',$data);
	}
	public function form2($id_laporan=NULL) {
		$data['title']='Laporan Perkembangan TRC BPBD';
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
		if ($id_laporan == null) {
			show_error('No identifier provided', 500);
		}
		else {
			$data['id_laporan']=$id_laporan;
			$data['detail'] = $this->laporan->GetDataLaporan2($id_laporan);
			$data['pengungsi'] = $this->laporan->GetPengungsi($id_laporan);

		    //$this->load->view('lap_v2_2', $data);
		    $data['main_content']='lap_v2_2';
			$this->load->view('includes/template_3',$data);
		}
	}
	public function pdf2($id_laporan=NULL) {
		$this->no_cache();
		if(!$this->session->userdata('logged_in'))
		{
			$this->session->set_flashdata('message', 'Silahkan verifikasi terlebih dahulu');
			redirect('account');
		}
		$data['title']='Laporan Perkembangan TRC BPBD';
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
		if ($id_laporan == null) {
			show_error('No identifier provided', 500);
		}
		else {
			$data['id_laporan']=$id_laporan;
			$data['detail'] = $this->laporan->GetDataLaporan2($id_laporan);
			$data['pengungsi'] = $this->laporan->GetPengungsi($id_laporan);

			$this->form_validation->set_rules('rencana_aksi', 'rencana aksi TIM', 'trim|max_length[500]|required');
		  	$this->form_validation->set_rules('kesimpulan', 'kesimpulan dan rekomendasi', 'trim|max_length[500]|required');
	  		$this->form_validation->set_rules('penutup', 'penutup', 'trim|max_length[500]|required');

	  		$this->form_validation->set_message('required', 'Field %s harus diisi');
		  	$this->form_validation->set_message('max_length', 'Field %s maksimal 500 karakter');
		  	$this->form_validation->set_message('alpha_dash_space', 'Field %s hanya dapat mengandung huruf, angka, spasi, tanda underscore, dan tanda dash');

		  	if($this->form_validation->run() ==FALSE)
			{
				//kalau form validation gagal
				//$this->session->set_flashdata('message', 'Data bencana tidak berhasil ditambahkan');
				$data['id_laporan']=$id_laporan;
				$data['detail'] = $this->laporan->GetDataLaporan2($id_laporan);
				$data['pengungsi'] = $this->laporan->GetPengungsi($id_laporan);

		    	//$this->load->view('lap_v2_2', $data); //ga bisa rdirect, nanti form_validation nya ga muncul
				$data['main_content']='lap_v2_2';
				$this->load->view('includes/template_3',$data);
				
			}
			else
			{
				$rencana_aksi=$this->input->post('rencana_aksi');
				$kesimpulan=$this->input->post('kesimpulan');
				$penutup=$this->input->post('penutup');

				$this->laporan_bencana->EditLaporanBencana2($id_laporan,$rencana_aksi,$kesimpulan,$penutup);

				$data['id_laporan']=$id_laporan;
				$data['detail'] = $this->laporan->GetDataLaporan2($id_laporan);
				$data['pengungsi'] = $this->laporan->GetPengungsi($id_laporan);
				//$data['test_questions']= "hello";
		        $html = $this->load->view('lap_v2_3', $data, true);
		         //$filename="Test".$data['test_questions'];
				$filename="Laporan Perkembangan Bencana";
		        pdf_create($html, $filename);
		       // write_file('name', $data);
			    //$this->load->view('lap_v1_2', $data);
			    
			}
			
		}
	}














	//report 3
	public function r3() {
		$data['title']='Laporan Awal Posko';
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
		$a = $this->laporan->GetJumlahLaporan3();
		$config['base_url'] = base_url().'index.php/report/r3/'; //pointing to a controller called and a function
		$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
		$config['per_page'] = 10; //The number of items you intend to show per page
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
		$data['detail'] = $this->laporan->GetLaporan3Paging($config['per_page'],$offset);

		$data['keyword'] = '';
		$data['tanggal1'] = '';
		$data['tanggal2'] = '';
		//$this->load->view('lap_v3',$data);
		$data['main_content']='lap_v3';
		$this->load->view('includes/template_3',$data);
	}
	
	public function find3()
	{
		$data['title']='Laporan Awal Posko - Cari Data';
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
				$a = $this->laporan->GetJumlahLaporan3();
				$config['base_url'] = base_url().'index.php/report/find3/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->GetLaporan3Paging($config['per_page'],$offset);
				//$this->load->view('lap_v3',$data);
			}
			else
			{
				$a = $this->laporan->GetJumlahLaporan33($keyword,$tanggal1,$tanggal2);
				$config['base_url'] = base_url().'index.php/report/find3/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->CariLaporan3Paging3($config['per_page'],$offset,$keyword,$tanggal1,$tanggal2);
			}
		}
		else
		{
			if($tanggal1=='' || $tanggal2=='')
			{
				//$keyword=$this->session->userdata('keyword');
				//echo 'lol2'. $this->session->userdata('keyword');
				$a = $this->laporan->GetJumlahLaporan32($keyword);
				$config['base_url'] = base_url().'index.php/report/find3/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->CariLaporan3Paging($config['per_page'],$offset,$keyword);
			}
			else
			{
				$a = $this->laporan->GetJumlahLaporan33($keyword,$tanggal1,$tanggal2);
				$config['base_url'] = base_url().'index.php/report/find3/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->CariLaporan3Paging3($config['per_page'],$offset,$keyword,$tanggal1,$tanggal2);
			}
			
			//$this->load->view('lap_v3',$data);
		}
		$data['main_content']='lap_v3';
		$this->load->view('includes/template_3',$data);
	}
	public function form3($id_laporan=NULL) {
		$data['title']='Laporan Awal Posko';
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
		if ($id_laporan == null) {
			show_error('No identifier provided', 500);
		}
		else {
			$data['id_laporan']=$id_laporan;
			$data['detail'] = $this->laporan->GetDataLaporan3($id_laporan);

		    $data['main_content']='lap_v3_1';
			$this->load->view('includes/template_3',$data);
		}
	}
	public function pdf3($id_laporan=NULL) {
		$this->no_cache();
		if(!$this->session->userdata('logged_in'))
		{
			$this->session->set_flashdata('message', 'Silahkan verifikasi terlebih dahulu');
			redirect('account');
		}
		$data['title']='Laporan Awal Posko';
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
		if ($id_laporan == null) {
			show_error('No identifier provided', 500);
		}
		else {
			$data['id_laporan']=$id_laporan;
			$data['detail'] = $this->laporan->GetDataLaporan3($id_laporan);
			
	        $html = $this->load->view('lap_v3_2', $data, true);
			$filename="Laporan Awal Posko";
	        pdf_create($html, $filename);
		}
	}
	public function detail($id_laporan=NULL)
	{
		$this->load->library('googlemaps');
		$data['title']='Laporan - Detil Posko';
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
		if ($id_laporan == null) {
			show_error('No identifier provided', 500);
		}
		else {
			
			$coords =  $this->laporan->getDetailDataLaporan($id_laporan);
		
			// Loop through the coordinates we obtained above and add them to the map
			foreach ($coords as $coordinate) {
				
				$lat=$coordinate['latitude'];
				$lon=$coordinate['longitude'];
				$nama=$coordinate['nama_posko'];
				$marker = array();
				$marker['icon'] = base_url().'/images/marker2.png';//icon marker
				$marker['position'] = $lat.','.$lon;
				$this->googlemaps->add_marker($marker);			
			}
			$config['zoom'] = '13';
			$config['center'] = $lat.",".$lon;//ga perlu dikasih tanda petik di samping kiri kanan, malah bikin centernya jadi di koor 0,0 
			
			$this->googlemaps->initialize($config);
			
		
			$data['map'] = $this->googlemaps->create_map();

			$data['detail'] = $coords;
			$this->load->view('lap_v3_3',$data);
			
		}
	}
	












	//report 4
	public function r4() {
		$data['title']='Laporan Perkembangan Posko';
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
		$a = $this->laporan->GetJumlahLaporan4();
		$config['base_url'] = base_url().'index.php/report/r4/'; //pointing to a controller called and a function
		$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
		$config['per_page'] = 10; //The number of items you intend to show per page
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
		$data['detail'] = $this->laporan->GetLaporan4Paging($config['per_page'],$offset);

		$data['keyword'] = '';
		$data['tanggal1'] = '';
		$data['tanggal2'] = '';
		//$this->load->view('lap_v4',$data);
		$data['main_content']='lap_v4';
		$this->load->view('includes/template_3',$data);
	}
	
	public function find4()
	{
		$data['title']='Laporan Perkembangan Posko - Cari Data';
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
				$a = $this->laporan->GetJumlahLaporan4();
				$config['base_url'] = base_url().'index.php/report/find4/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->GetLaporan4Paging($config['per_page'],$offset);
				//$this->load->view('lap_v4',$data);
			}
			else
			{
				$a = $this->laporan->GetJumlahLaporan43($keyword,$tanggal1,$tanggal2);
				$config['base_url'] = base_url().'index.php/report/find4/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->CariLaporan4Paging3($config['per_page'],$offset,$keyword,$tanggal1,$tanggal2);
			}
		}
		else
		{
			if($tanggal1=='' || $tanggal2=='')
			{
				//$keyword=$this->session->userdata('keyword');
				//echo 'lol2'. $this->session->userdata('keyword');
				$a = $this->laporan->GetJumlahLaporan42($keyword);
				$config['base_url'] = base_url().'index.php/report/find4/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->CariLaporan4Paging($config['per_page'],$offset,$keyword);
			
				//$this->load->view('lap_v4',$data);
			}
			else
			{
				$a = $this->laporan->GetJumlahLaporan43($keyword,$tanggal1,$tanggal2);
				$config['base_url'] = base_url().'index.php/report/find4/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->CariLaporan4Paging3($config['per_page'],$offset,$keyword,$tanggal1,$tanggal2);
			}
		}
		$data['main_content']='lap_v4';
		$this->load->view('includes/template_3',$data);
	}
	public function form4($id_laporan=NULL) {
		$data['title']='Laporan Perkembangan Posko';
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
		if ($id_laporan == null) {
			show_error('No identifier provided', 500);
		}
		else {
			$data['id_laporan']=$id_laporan;
			$data['detail'] = $this->laporan->GetDataLaporan4($id_laporan);

		    $data['main_content']='lap_v4_1';
			$this->load->view('includes/template_3',$data);
		}
	}
	/*
	public function form4($id_laporan=NULL) {
		$data['title']='Aplikasi Web untuk Pemetaan Pengungsi Bencana Alam';
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
		if ($id_laporan == null) {
			show_error('No identifier provided', 500);
		}
		else {
			$data['id_laporan']=$id_laporan;
			$data['detail'] = $this->laporan->GetDataLaporan2($id_laporan);
			$data['pengungsi'] = $this->laporan->GetPengungsi($id_laporan);

		    $data['main_content']='lap_v4_1';
			$this->load->view('includes/template_3',$data);
		}
	}
	*/
	public function pdf4($id_laporan=NULL) {
		$this->no_cache();
		if(!$this->session->userdata('logged_in'))
		{
			$this->session->set_flashdata('message', 'Silahkan verifikasi terlebih dahulu');
			redirect('account');
		}
		$data['title']='Laporan Perkembangan Posko';
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
		if ($id_laporan == null) {
			show_error('No identifier provided', 500);
		}
		else {
			$data['id_laporan']=$id_laporan;
			$data['detail'] = $this->laporan->GetDataLaporan4($id_laporan);
			
	        $html = $this->load->view('lap_v4_2', $data, true);
			$filename="Laporan Perkembangan Posko";
	        pdf_create($html, $filename);
	        
		    //$this->load->view('lap_v4_2', $data);
		}
	}



























	//report 5
	public function r5() {
		$data['title']='Grafik Perkembangan Bencana';
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
		
		$a = $this->laporan->GetJumlahLaporan5();
		$config['base_url'] = base_url().'index.php/report/r5/'; //pointing to a controller called and a function
		$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
		$config['per_page'] = 10; //The number of items you intend to show per page
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
		$data['detail'] = $this->laporan->GetLaporan5Paging($config['per_page'],$offset);

		$data['keyword'] = '';
		$data['tanggal1'] = '';
		$data['tanggal2'] = '';
		//$this->load->view('lap_v5',$data);
		$data['main_content']='lap_v5';
		$this->load->view('includes/template_3',$data);
	}
	
	public function find5()
	{
		$data['title']='Grafik Perkembangan Bencana -  Cari Data';
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
				$a = $this->laporan->GetJumlahLaporan5();
				$config['base_url'] = base_url().'index.php/report/find5/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->GetLaporan5Paging($config['per_page'],$offset);
				//$this->load->view('lap_v5',$data);
			}
			else
			{
				$a = $this->laporan->GetJumlahLaporan53($keyword,$tanggal1,$tanggal2);
				$config['base_url'] = base_url().'index.php/report/find5/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->CariLaporan5Paging3($config['per_page'],$offset,$keyword,$tanggal1,$tanggal2);
			}
		}
		else
		{
			if($tanggal1=='' || $tanggal2=='')
			{
				//$keyword=$this->session->userdata('keyword');
				//echo 'lol2'. $this->session->userdata('keyword');
				$a = $this->laporan->GetJumlahLaporan52($keyword);
				$config['base_url'] = base_url().'index.php/report/find5/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->CariLaporan5Paging($config['per_page'],$offset,$keyword);
				
				//$this->load->view('lap_v5',$data);
			}
			else
			{
				$a = $this->laporan->GetJumlahLaporan53($keyword,$tanggal1,$tanggal2);
				$config['base_url'] = base_url().'index.php/report/find5/'; //pointing to a controller called and a function
				$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
				$config['per_page'] = 10; //The number of items you intend to show per page
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
				$data['detail'] = $this->laporan->CariLaporan5Paging3($config['per_page'],$offset,$keyword,$tanggal1,$tanggal2);
			}
		}
		$data['main_content']='lap_v5';
		$this->load->view('includes/template_3',$data);
	}
	public function form5($id_bencana=NULL) {
		$data['title']='Grafik Perkembangan Bencana';
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
		if ($id_bencana == null) {
			show_error('No identifier provided', 500);
		}
		else {
			$data['detail'] = $this->laporan->GetDataLaporan5($id_bencana);
			$data['detail_bencana']=$this->bencana->CariBencanaById($id_bencana);
			
		    $x=$this->laporan->GetDataLaporanTanggal5($id_bencana);
		    $y='';
		    if(count($x) > 0) {
                  foreach($x as $rows) {
                  	$date = new DateTime($rows['tgl_lap_posko']);
                    $y.= "'".$date->format('d-m-Y')."',";
                }}
                //$xaxis.=']';
            $data['xaxis']= $y;
			
			
            $x=$this->laporan->GetDataPosko5($id_bencana);
		    $y='';
		    if(count($x) > 0) {
                  foreach($x as $rows) {
                  	$id_posko=$rows['id_posko'];
                    $y.= "{name:'".$rows['nama_posko']."',data:[";
                    $x2=$this->laporan->GetDataLaporanPosko51($id_bencana,$id_posko);
                    if(count($x2) > 0) {
	                  foreach($x2 as $rows2) {
	                  	$jp=$rows2['jp'];
	                  	if($jp==NULL)
	                  		$y.= "null,";
	                  	else
	                    	$y.= "".$jp.",";
	                }}
	                $y.="]},";

                }}
                
            $data['series1']= $y;





            $x=$this->laporan->GetDataPosko5($id_bencana);
		    $y='';
		    if(count($x) > 0) {
                  foreach($x as $rows) {
                  	$id_posko=$rows['id_posko'];
                    $y.= "{name:'".$rows['nama_posko']."',data:[";
                    $x2=$this->laporan->GetDataLaporanPosko52($id_bencana,$id_posko);
                    if(count($x2) > 0) {
	                  foreach($x2 as $rows2) {
	                  	$jp=$rows2['jp'];
	                  	if($jp==NULL)
	                  		$y.= "null,";
	                  	else
	                    	$y.= "".$jp.",";
	                }}
	                $y.="]},";

                }}
                
            $data['series2']= $y;





            $x=$this->laporan->GetDataPosko5($id_bencana);
		    $y='';
		    if(count($x) > 0) {
                  foreach($x as $rows) {
                  	$id_posko=$rows['id_posko'];
                    $y.= "{name:'".$rows['nama_posko']."',data:[";
                    $x2=$this->laporan->GetDataLaporanPosko53($id_bencana,$id_posko);
                    if(count($x2) > 0) {
	                  foreach($x2 as $rows2) {
	                  	$jp=$rows2['jp'];
	                  	if($jp==NULL)
	                  		$y.= "null,";
	                  	else
	                    	$y.= "".$jp.",";
	                }}
	                $y.="]},";

                }}
                
            $data['series3']= $y;





            $x=$this->laporan->GetDataPosko5($id_bencana);
		    $y='';
		    if(count($x) > 0) {
                  foreach($x as $rows) {
                  	$id_posko=$rows['id_posko'];
                    $y.= "{name:'".$rows['nama_posko']."',data:[";
                    $x2=$this->laporan->GetDataLaporanPosko54($id_bencana,$id_posko);
                    if(count($x2) > 0) {
	                  foreach($x2 as $rows2) {
	                  	$jp=$rows2['jp'];
	                  	if($jp==NULL)
	                  		$y.= "null,";
	                  	else
	                    	$y.= "".$jp.",";
	                }}
	                $y.="]},";

                }}
                
            $data['series4']= $y;


		    $this->load->view('lap_v5_2', $data);
		    
		}
	}


























	//report 6
	public function r6() {
		$data['title']='Grafik Ringkasan Bencana';
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
		
		
		$data['detail'] = $this->laporan->GetDataLaporan61();
		$data['detail_tahun'] = $this->laporan->GetDataTahun();
		$data['tahun'] = 0;
		//$this->load->view('lap_v6',$data);
		$data['main_content']='lap_v6';
		$this->load->view('includes/template_3',$data);
	}
	
	public function find6()
	{
		$data['title']='Grafik Ringkasan Bencana';
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
		$this->form_validation->set_rules('tahun', 'tahun', 'xss_clean|trim');
		if($this->form_validation->run() ==FALSE)
  		{
  			$data['detail'] = $this->laporan->GetDataLaporan61();
			$data['tahun'] = $tahun;
			$data['detail_tahun'] = $this->laporan->GetDataTahun();
			$this->load->view('lap_v6',$data);
  		}
  		else
  		{
			$tahun = $this->input->post('tahun');
			if($tahun>0)
				$data['detail'] = $this->laporan->GetDataLaporan62($tahun);
			else
				$data['detail'] = $this->laporan->GetDataLaporan61();
			$data['tahun'] = $tahun;
			$data['detail_tahun'] = $this->laporan->GetDataTahun();
			$this->load->view('lap_v6',$data);
			
		}
	
	}
	
}
/* End of file welcome.php */