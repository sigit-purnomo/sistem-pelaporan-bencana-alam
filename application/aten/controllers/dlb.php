<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dlb extends CI_Controller {

	/*konstruktor*/
	public function __construct()
	{
		parent::__construct();
        // Your own constructor code
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('bencana','',TRUE);//tell the model loading function to auto-connect to database
		$this->load->model('laporan_bencana','',TRUE);
		$this->load->library('pagination'); //call pagination library
		$this->load->helper('html');
		//$this->output->enable_profiler(TRUE);
		$this->no_cache();
		if(!$this->session->userdata('logged_in'))
		{
			$this->session->set_flashdata('message', 'Silahkan verifikasi terlebih dahulu');
			redirect('account');
		}
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

		redirect('dlb/listing');
	}
	public function listing() {
		$data['title']='Pengelolaan Data Laporan Bencana - Data Bencana';
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

		$a = $this->bencana->GetJumlahBencana();
		$config['base_url'] = base_url().'index.php/dlb/listing/'; //pointing to a controller called and a function
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
		$data['detail'] = $this->bencana->GetBencanaPaging($config['per_page'],$offset);

		$data['keyword'] = '';
		$data['tanggal1'] = '';
		$data['tanggal2'] = '';
		//$this->load->view('dlb_v1',$data);
		$data['main_content']='dlb_v1';
		$this->load->view('includes/template_2',$data);
	}
	function alpha_dash_space($str)
	{
		return ( ! preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
	}

	
	public function report($idbencana=NULL) {
		$data['title']='Pengelolaan Data Laporan Bencana - Data Laporan Bencana';
		$this->session->unset_userdata('keyword2');
		$this->session->unset_userdata('tanggal12');
		$this->session->unset_userdata('tanggal22');
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
		if ($idbencana == null) {
			show_error('No identifier provided', 500);
		}
		else {
			$data['id_bencana']=$idbencana;
			///////////////////////////////
			$this->session->set_userdata('idbencana', $idbencana);
			///////////////////////////////
			$a = $this->laporan_bencana->GetJumlahLaporanBencana($idbencana);
			$config['base_url'] = base_url().'index.php/dlb/report/'.$idbencana; //pointing to a controller called and a function
			$config['total_rows'] = $a; //This number represents the total rows in the result set you are creating pagination for
			$config['per_page'] = 10; //The number of items you intend to show per page
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

			$data['detail'] = $this->laporan_bencana->GetLaporanBencanaPaging($config['per_page'],$offset,$idbencana);

			$data['keyword2'] = '';
			$data['tanggal12'] = '';
			$data['tanggal22'] = '';
		    //$this->load->view('dlb_v2', $data);
		    $data['main_content']='dlb_v2';
			$this->load->view('includes/template_2',$data);
		}
	}
	public function searching()
	{
		if(isset($_POST["caridata"]))
		{
			$this->session->unset_userdata('keyword');
			$this->session->unset_userdata('keyword2');
			$this->session->unset_userdata('tanggal1');
			$this->session->unset_userdata('tanggal2');
			$this->session->unset_userdata('tanggal12');
			$this->session->unset_userdata('tanggal22');
			$this->find1();
		}
		else if(isset($_POST["caridatalap"]))
			{
				$this->session->unset_userdata('keyword2');
				$this->session->unset_userdata('tanggal12');
				$this->session->unset_userdata('tanggal22');
				$this->find2();
			}
		else if(isset($_POST["tambahdata1"]))
			$this->add1();
		else if(isset($_POST["tambahdata2"]))
			$this->add2();
	}































	public function find1()
	{
		$data['title']='Pengelolaan Data Laporan Bencana - Cari Data Bencana';
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
		$this->form_validation->set_rules('keyword', 'pencarian', 'xss_clean|max_length[50]|trim');
		$this->form_validation->set_rules('tanggal1', 'tanggal1', 'xss_clean|trim');
		$this->form_validation->set_rules('tanggal2', 'tanggal2', 'xss_clean|trim');
		$this->form_validation->set_rules('idbencana', 'id bencana', 'required|trim');
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
				$a = $this->bencana->GetJumlahBencana();
				$config['base_url'] = base_url().'index.php/dlb/find1/'; //pointing to a controller called and a function
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
				$data['detail'] = $this->bencana->GetBencanaPaging($config['per_page'],$offset);
				
			}
			else
			{
				//echo 'lol2';
				$a = $this->bencana->GetJumlahBencana3($keyword,$tanggal1,$tanggal2);
				$config['base_url'] = base_url().'index.php/dlb/find1/'; //pointing to a controller called and a function
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
				$data['detail'] = $this->bencana->CariBencanaPaging2($config['per_page'],$offset,$keyword,$tanggal1,$tanggal2);
			}
			//$this->load->view('dlb_v1',$data);
		}
		else
		{
			if($tanggal1=='' || $tanggal2=='')
			{
				//$keyword=$this->session->userdata('keyword');
				//echo 'lol2'. $this->session->userdata('keyword');
				$a = $this->bencana->GetJumlahBencana2($keyword);
				$config['base_url'] = base_url().'index.php/dlb/find1/'; //pointing to a controller called and a function
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
				$data['detail'] = $this->bencana->CariBencanaPaging($config['per_page'],$offset,$keyword);
			}
			else
			{
				$a = $this->bencana->GetJumlahBencana3($keyword,$tanggal1,$tanggal2);
				$config['base_url'] = base_url().'index.php/dlb/find1/'; //pointing to a controller called and a function
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
				$data['detail'] = $this->bencana->CariBencanaPaging2($config['per_page'],$offset,$keyword,$tanggal1,$tanggal2);
			}
			//$this->load->view('dlb_v1',$data);
		}
		$data['keyword'] = $keyword;
		$data['tanggal1'] = $tanggal1;
		$data['tanggal2'] = $tanggal2;
		$data['main_content']='dlb_v1';
		$this->load->view('includes/template_2',$data);
	}
	
	public function add1()
	{
		$data['title']='Pengelolaan Data Laporan Bencana - Tambah Data Laporan Awal';
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
	    //$this->load->view('dlb_add1', $data);
	    $data['main_content']='dlb_add1';
		$this->load->view('includes/template_2',$data);
	}
	public function add2()
	{
		$data['title']='Pengelolaan Data Laporan Bencana - Tambah Data Laporan Perkembangan';
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
	    //$this->load->view('dlb_add2', $data);
	    $data['main_content']='dlb_add2';
		$this->load->view('includes/template_2',$data);
	}





















	public function find2()
	{
		$data['title']='Pengelolaan Data Laporan Bencana - Cari Data Laporan Bencana';
		//$idbencana = $this->input->post('idbencana');
		$idbencana = ''; // default when no term in session or POST
		if ($this->input->post('idbencana'))
		{
		    // use the term from POST and set it to session
		    $idbencana = $this->input->post('idbencana');
		    $this->session->set_userdata('idbencana', $idbencana);
		}
		elseif ($this->session->userdata('idbencana'))
		{
		    // if term is not in POST use existing term from session
		    $idbencana = $this->session->userdata('idbencana');
		}
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
		$keyword2 = ''; // default when no term in session or POST
		if ($this->input->post('keyword2'))
		{
			// use the term from POST and set it to session
			$keyword2 = $this->input->post('keyword2');
			$this->session->set_userdata('keyword2', $keyword2);
		}
		elseif ($this->session->userdata('keyword2'))
		{
			// if term is not in POST use existing term from session
			$keyword2 = $this->session->userdata('keyword2');
		}

		$tanggal12 = ''; // default when no term in session or POST
		if ($this->input->post('tanggal12'))
		{
			// use the term from POST and set it to session
			$tanggal12 = $this->input->post('tanggal12');
			$this->session->set_userdata('tanggal12', $tanggal12);
		}
		elseif ($this->session->userdata('tanggal12'))
		{
			// if term is not in POST use existing term from session
			$tanggal12 = $this->session->userdata('tanggal12');
		}
		$data['tanggal12'] = $tanggal12;
		$tanggal22 = ''; // default when no term in session or POST
		if ($this->input->post('tanggal22'))
		{
			// use the term from POST and set it to session
			$tanggal22 = $this->input->post('tanggal22');
			$this->session->set_userdata('tanggal22', $tanggal22);
		}
		elseif ($this->session->userdata('tanggal22'))
		{
			// if term is not in POST use existing term from session
			$tanggal22 = $this->session->userdata('tanggal22');
		}
		$data['tanggal22'] = $tanggal22;


		
		//$this->form_validation->set_rules('field', 'label', 'rules');
		$this->form_validation->set_rules('keyword2', 'pencarian', 'xss_clean|max_length[50]|trim');
		$this->form_validation->set_rules('idbencana', 'id bencana', 'required|trim');
		$this->form_validation->set_rules('tanggal12', 'tanggal12', 'xss_clean|trim');
		$this->form_validation->set_rules('tanggal22', 'tanggal22', 'xss_clean|trim');
		//$this->form_validation->set_message('rule', 'Error Message');
		$this->form_validation->set_message('required', 'Field %s harus diisi');
		$this->form_validation->set_message('max_length', 'Field %s maksimal 50 karakter');
		$this->form_validation->set_message('alpha_dash_space', 'Field %s hanya dapat mengandung huruf, angka, spasi, tanda underscore, dan tanda dash');
			
			
		if($this->form_validation->run() ==FALSE && !$this->session->userdata('keyword2'))
		{
			if($tanggal12=='' || $tanggal22=='')
			{
				//echo 'lol1';
				//kalau form validation gagal
				//hups ntar $idbencana = $this->session->userdata('idbencana'); 
				$a = $this->laporan_bencana->GetJumlahLaporanBencana($idbencana);
				$config['base_url'] = base_url().'index.php/dlb/find2/'; //pointing to a controller called and a function
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
				$data['detail'] = $this->laporan_bencana->GetLaporanBencanaPaging($config['per_page'],$offset,$idbencana);
			}
			else
			{
				//echo 'lol2';
				$a = $this->laporan_bencana->GetJumlahLaporanBencana3($keyword2,$idbencana,$tanggal12,$tanggal22);
				$config['base_url'] = base_url().'index.php/dlb/find2/'; //pointing to a controller called and a function
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
				$data['detail'] = $this->laporan_bencana->CariLaporanBencanaPaging2($config['per_page'],$offset,$keyword2,$idbencana,$tanggal12,$tanggal22);
			}
			//$this->load->view('dlb_v2',$data);
		}
		else
		{
			if($tanggal12=='' || $tanggal22=='')
			{
				//echo 'lol3';
				//$keyword=$this->session->userdata('keyword');
				//echo 'lol2'. $this->session->userdata('keyword');
				$a = $this->laporan_bencana->GetJumlahLaporanBencana2($keyword2,$idbencana);
				$config['base_url'] = base_url().'index.php/dlb/find2/'; //pointing to a controller called and a function
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
				$data['detail'] = $this->laporan_bencana->CariLaporanBencanaPaging($config['per_page'],$offset,$keyword2,$idbencana);
			}
			else
			{
				//echo 'lol4';
				$a = $this->laporan_bencana->GetJumlahLaporanBencana3($keyword2,$idbencana,$tanggal12,$tanggal22);
				$config['base_url'] = base_url().'index.php/dlb/find2/'; //pointing to a controller called and a function
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
				$data['detail'] = $this->laporan_bencana->CariLaporanBencanaPaging2($config['per_page'],$offset,$keyword2,$idbencana,$tanggal12,$tanggal22);
			}
			
			//$this->load->view('dlb_v2',$data);
		}
		$data['keyword2'] =  $keyword2;
		$data['tanggal12'] = $tanggal12;
		$data['tanggal22'] = $tanggal22;
		$data['main_content']='dlb_v2';
		$this->load->view('includes/template_2',$data);
	}
	
  public function save() {
  	
  	$data['title']='Pengelolaan Data Laporan Bencana - Simpan Data Laporan Bencana';
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
  	//$this->form_validation->set_rules('field', 'label', 'rules');
  	//$this->form_validation->set_rules('nama', 'nama bencana', 'callback_alpha_dash_space|trim|max_length[50]|required');
  	$this->form_validation->set_rules('tanggal_laporan', 'tanggal laporan', 'trim|required');
  	$this->form_validation->set_rules('jam_laporan', 'jam laporan', 'trim|required');
  	$this->form_validation->set_rules('meninggal', 'jumlah meninggal', 'is_natural|trim|required');
  	$this->form_validation->set_rules('luka_berat', 'jumlah luka berat', 'is_natural|trim|required');
  	$this->form_validation->set_rules('luka_ringan', 'jumlah luka ringan', 'is_natural|trim|required');
  	$this->form_validation->set_rules('hilang', 'jumlah hilang', 'is_natural|trim|required');
  	$this->form_validation->set_rules('mengungsi_kk', 'jumlah mengungsi (kk)', 'is_natural|trim|required');
  	$this->form_validation->set_rules('mengungsi_jiwa', 'jumlah mengungsi (jiwa)', 'is_natural|trim|required');

  	$this->form_validation->set_rules('rumah', 'jumlah kerusakan rumah', 'is_natural|trim|required');
  	$this->form_validation->set_rules('kantor', 'jumlah kerusakan kantor', 'is_natural|trim|required');
  	$this->form_validation->set_rules('fasilitas_kesehatan', 'jumlah kerusakan fasilitas kesehatan', 'is_natural|trim|required');
  	$this->form_validation->set_rules('fasilitas_pendidikan', 'jumlah kerusakan fasilitas pendidikan', 'is_natural|trim|required');
  	$this->form_validation->set_rules('fasilitas_umum', 'jumlah kerusakan fasilitas umum', 'is_natural|trim|required');
  	$this->form_validation->set_rules('sarana_ibadah', 'jumlah kerusakan sarana ibadah', 'is_natural|trim|required');
  	$this->form_validation->set_rules('jembatan', 'jumlah kerusakan jembatan', 'is_natural|trim|required');
  	$this->form_validation->set_rules('jalan', 'jumlah kerusakan jalan', 'is_natural|trim|required');
  	$this->form_validation->set_rules('tanggul', 'jumlah kerusakan tanggul', 'is_natural|trim|required');
  	$this->form_validation->set_rules('sawah', 'jumlah kerusakan sawah', 'is_natural|trim|required');
  	$this->form_validation->set_rules('lahan_pertanian', 'jumlah kerusakan lahan pertanian', 'is_natural|trim|required');
  	$this->form_validation->set_rules('lain_lain', 'jumlah kerusakan lainnya', 'is_natural|trim|required');

  	$this->form_validation->set_rules('bupati_tgl', 'tanggal kunjungan bupati', 'trim|required');
  	$this->form_validation->set_rules('bupati_jam', 'jam kunjungan bupati', 'trim|required');

  	$this->form_validation->set_rules('posko', 'posko', 'trim|required');
  	$this->form_validation->set_rules('koordinasi', 'koordinasi', 'trim|required');
  	$this->form_validation->set_rules('evakuasi', 'evakuasi', 'trim|required');
  	$this->form_validation->set_rules('kesehatan', 'kesehatan', 'trim|required');
  	$this->form_validation->set_rules('dapur', 'dapur', 'trim|required');
  	$this->form_validation->set_rules('distribusi', 'distribusi', 'trim|required');
  	$this->form_validation->set_rules('pengerahan', 'pengerahan', 'trim|required');

  	$this->form_validation->set_rules('sumber_daya', 'sumber daya', 'trim|max_length[500]|required');
  	$this->form_validation->set_rules('kendala', 'kendala', 'trim|max_length[500]|required');
  	$this->form_validation->set_rules('kebutuhan_mendesak', 'kebutuhan mendesak', 'trim|max_length[500]|required');
  	$this->form_validation->set_rules('rencana_tindaklanjut', 'rencana tindak lanjut', 'trim|max_length[500]|required');

  	if(isset($_POST["insert2"]))
  	{
  		$this->form_validation->set_rules('sub_tim', 'jumlah sub tim', 'is_natural|trim|required');
  	}
  	else if(isset($_POST["insert1"]))
  	{
	  	$this->form_validation->set_rules('tim_bpbd', 'jumlah tim BPBD', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('tim_dinsos', 'jumlah tim dinsos', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('tim_dinkes', 'jumlah tim dinkes', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('tim_pu', 'jumlah tim PU', 'is_natural|trim|required');
	}

		//$this->form_validation->set_message('rule', 'Error Message');
  	$this->form_validation->set_message('required', 'Field %s harus diisi');  	$this->form_validation->set_message('is_natural', 'Field %s hanya dapat mengandung angka');
  	$this->form_validation->set_message('max_length', 'Field %s maksimal 500 karakter');
  	$this->form_validation->set_message('alpha_dash_space', 'Field %s hanya dapat mengandung huruf, angka, spasi, tanda underscore, dan tanda dash');

  	if($this->form_validation->run() ==FALSE)
  	{
			//kalau form validation gagal
			//$this->session->set_flashdata('message', 'Data bencana tidak berhasil ditambahkan');
  			if(isset($_POST["insert1"]))
				//$this->load->view('dlb_add1',$data); //ga bisa rdirect, nanti form_validation nya ga muncul
				$data['main_content']='dlb_add1';
			else if(isset($_POST["insert2"]))
				//$this->load->view('dlb_add2',$data);
				$data['main_content']='dlb_add2';
			//redirect('db_tambah', 'refresh');
			
			$this->load->view('includes/template_2',$data);
		}
		else
		{
			$id_bencana=$this->session->userdata('idbencana');
			$session_data = $this->session->userdata('logged_in');
			$id_user=$session_data['id_user'];

			$tanggal_laporan=$this->input->post('tanggal_laporan');
			$jam_laporan=$this->input->post('jam_laporan');
			$meninggal=$this->input->post('meninggal');
			
			$luka_berat=$this->input->post('luka_berat');
			$luka_ringan=$this->input->post('luka_ringan');
			$hilang=$this->input->post('hilang');
			$mengungsi_jiwa=$this->input->post('mengungsi_jiwa');
			$mengungsi_kk=$this->input->post('mengungsi_kk');
			
			$rumah=$this->input->post('rumah');
			$kantor=$this->input->post('kantor');
			$fasilitas_kesehatan=$this->input->post('fasilitas_kesehatan');
			$fasilitas_pendidikan=$this->input->post('fasilitas_pendidikan');
			$fasilitas_umum=$this->input->post('fasilitas_umum');
			
			$sarana_ibadah=$this->input->post('sarana_ibadah');
			$jembatan=$this->input->post('jembatan');
			$jalan=$this->input->post('jalan');
			$tanggul=$this->input->post('tanggul');
			$sawah=$this->input->post('sawah');
			
			$lahan_pertanian=$this->input->post('lahan_pertanian');
			$lain_lain=$this->input->post('lain_lain');
			$bupati_tgl=$this->input->post('bupati_tgl');
			$bupati_jam=$this->input->post('bupati_jam');
			$posko=$this->input->post('posko');
			
			$koordinasi=$this->input->post('koordinasi');
			$evakuasi=$this->input->post('evakuasi');
			$kesehatan=$this->input->post('kesehatan');
			$dapur=$this->input->post('dapur');
			$distribusi=$this->input->post('distribusi');
			
			$pengerahan=$this->input->post('pengerahan');
			$sumber_daya=$this->input->post('sumber_daya');
			$kendala=$this->input->post('kendala');
			$kebutuhan_mendesak=$this->input->post('kebutuhan_mendesak');
			$rencana_tindaklanjut=$this->input->post('rencana_tindaklanjut');
			
			if(isset($_POST["insert1"]))
			{
				$sub_tim=0;
				$tim_bpbd=$this->input->post('tim_bpbd');
				$tim_dinsos=$this->input->post('tim_dinsos');
				$tim_dinkes=$this->input->post('tim_dinkes');
				$tim_pu=$this->input->post('tim_pu');
			}
			else if(isset($_POST["insert2"]))
			{
				$sub_tim=$this->input->post('sub_tim');
				$tim_bpbd=0;
				$tim_dinsos=0;
				$tim_dinkes=0;
				$tim_pu=0;
			}
			
			$this->laporan_bencana->InsertLaporanBencana($id_bencana,$id_user,$tanggal_laporan,$jam_laporan,$meninggal,
				$luka_berat,$luka_ringan,$hilang,$mengungsi_jiwa,$mengungsi_kk,
				$rumah,$kantor,$fasilitas_kesehatan,$fasilitas_pendidikan,$fasilitas_umum,
				$sarana_ibadah,$jembatan,$jalan,$tanggul,$sawah,
				$lahan_pertanian,$lain_lain,$bupati_tgl,$bupati_jam,$posko,
				$koordinasi,$evakuasi,$kesehatan,$dapur,$distribusi,
				$pengerahan,$sumber_daya,$kendala,$kebutuhan_mendesak,$rencana_tindaklanjut,
				$tim_bpbd,$tim_dinsos,$tim_dinkes,$tim_pu,$sub_tim);
			//reset set_value
			$this->form_validation->resetpostdata();
			$this->session->set_flashdata('message', 'Data laporan berhasil ditambahkan');
			/*
			if(isset($_POST["insert1"]))
			{
				redirect('dlb/add1', 'refresh');
			}
			else if(isset($_POST["insert2"]))
			{
				//masuk ke success page, show all data bencana mungkin haha
				//$this->load->view('dlb_add');
				//jadi pesa dari flash cuman muncul kalau pakai redirect refresh, kalau pakai load->view tidak bisa muncul
				redirect('dlb/add2', 'refresh');
			}
			*/
			redirect('dlb/report/'.$this->session->userdata('idbencana'), 'refresh');
			
		}
	}
	public function remove($id_laporan = null) {
		if ($id_laporan == null) {
			show_error('No identifier provided', 500);
		}
		else {

			$this->laporan_bencana->HapusLaporanBencana($id_laporan);
			$this->session->set_flashdata('messagehapusbencana', 'Data laporan bencana berhasil dihapus');
			
			redirect('dlb/report/'.$this->session->userdata('idbencana') , 'refresh');
  		}
	}

	public function modify($id_laporan = null) {
		$data['title']='Pengelolaan Data Laporan Bencana - Ubah Data Laporan Bencana';
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
			$data['detail'] = $this->laporan_bencana->CariLaporanBencanaById($id_laporan);
			//$this->load->view('dlb_edit',$data);
			$data['main_content']='dlb_edit';
			$this->load->view('includes/template_2',$data);
	  }
	}
	public function update() {
		$data['title']='Pengelolaan Data Laporan Bencana - Ubah Data Laporan Bencana';
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
		$this->form_validation->set_rules('id_laporan', 'id laporan', 'trim|required');
		$this->form_validation->set_rules('tanggal_laporan', 'tanggal laporan', 'trim|required');
	  	$this->form_validation->set_rules('jam_laporan', 'jam laporan', 'trim|required');
	  	$this->form_validation->set_rules('meninggal', 'jumlah meninggal', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('luka_berat', 'jumlah luka berat', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('luka_ringan', 'jumlah luka ringan', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('hilang', 'jumlah hilang', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('mengungsi_kk', 'jumlah mengungsi (kk)', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('mengungsi_jiwa', 'jumlah mengungsi (jiwa)', 'is_natural|trim|required');

	  	$this->form_validation->set_rules('rumah', 'jumlah kerusakan rumah', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('kantor', 'jumlah kerusakan kantor', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('fasilitas_kesehatan', 'jumlah kerusakan fasilitas kesehatan', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('fasilitas_pendidikan', 'jumlah kerusakan fasilitas pendidikan', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('fasilitas_umum', 'jumlah kerusakan fasilitas umum', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('sarana_ibadah', 'jumlah kerusakan sarana ibadah', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('jembatan', 'jumlah kerusakan jembatan', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('jalan', 'jumlah kerusakan jalan', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('tanggul', 'jumlah kerusakan tanggul', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('sawah', 'jumlah kerusakan sawah', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('lahan_pertanian', 'jumlah kerusakan lahan pertanian', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('lain_lain', 'jumlah kerusakan lainnya', 'is_natural|trim|required');

	  	$this->form_validation->set_rules('bupati_tgl', 'tanggal kunjungan bupati', 'trim|required');
	  	$this->form_validation->set_rules('bupati_jam', 'jam kunjungan bupati', 'trim|required');

	  	$this->form_validation->set_rules('posko', 'posko', 'trim|required');
	  	$this->form_validation->set_rules('koordinasi', 'koordinasi', 'trim|required');
	  	$this->form_validation->set_rules('evakuasi', 'evakuasi', 'trim|required');
	  	$this->form_validation->set_rules('kesehatan', 'kesehatan', 'trim|required');
	  	$this->form_validation->set_rules('dapur', 'dapur', 'trim|required');
	  	$this->form_validation->set_rules('distribusi', 'distribusi', 'trim|required');
	  	$this->form_validation->set_rules('pengerahan', 'pengerahan', 'trim|required');

	  	$this->form_validation->set_rules('sumber_daya', 'sumber daya', 'trim|max_length[500]|required');
	  	$this->form_validation->set_rules('kendala', 'kendala', 'trim|max_length[500]|required');
	  	$this->form_validation->set_rules('kebutuhan_mendesak', 'kebutuhan mendesak', 'trim|max_length[500]|required');
	  	$this->form_validation->set_rules('rencana_tindaklanjut', 'rencana tindak lanjut', 'trim|max_length[500]|required');

	  	$this->form_validation->set_rules('tim_bpbd', 'jumlah tim BPBD', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('tim_dinsos', 'jumlah tim dinsos', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('tim_dinkes', 'jumlah tim dinkes', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('tim_pu', 'jumlah tim PU', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('sub_tim', 'jumlah sub tim', 'is_natural|trim|required');

			//$this->form_validation->set_message('rule', 'Error Message');
	  	$this->form_validation->set_message('required', 'Field %s harus diisi');
	  	$this->form_validation->set_message('is_natural', 'Field %s hanya dapat mengandung angka');
	  	$this->form_validation->set_message('max_length', 'Field %s maksimal 500 karakter');
	  	$this->form_validation->set_message('alpha_dash_space', 'Field %s hanya dapat mengandung huruf, angka, spasi, tanda underscore, dan tanda dash');

		if($this->form_validation->run() ==FALSE)
		{
			//kalau form validation gagal
			$data['detail'] = '';
			//$this->load->view('dlb_edit',$data); //ga bisa rdirect, nanti form_validation nya ga muncul
			$data['main_content']='dlb_edit';
			$this->load->view('includes/template_2',$data);
			
			
		}
		else
		{
			$id_bencana=$this->session->userdata('idbencana');
			$session_data = $this->session->userdata('logged_in');
			$id_user=$session_data['id_user'];

			$id_laporan=$this->input->post('id_laporan');
			$tanggal_laporan=$this->input->post('tanggal_laporan');
			$jam_laporan=$this->input->post('jam_laporan');
			$meninggal=$this->input->post('meninggal');
			
			$luka_berat=$this->input->post('luka_berat');
			$luka_ringan=$this->input->post('luka_ringan');
			$hilang=$this->input->post('hilang');
			$mengungsi_jiwa=$this->input->post('mengungsi_jiwa');
			$mengungsi_kk=$this->input->post('mengungsi_kk');
			
			$rumah=$this->input->post('rumah');
			$kantor=$this->input->post('kantor');
			$fasilitas_kesehatan=$this->input->post('fasilitas_kesehatan');
			$fasilitas_pendidikan=$this->input->post('fasilitas_pendidikan');
			$fasilitas_umum=$this->input->post('fasilitas_umum');
			
			$sarana_ibadah=$this->input->post('sarana_ibadah');
			$jembatan=$this->input->post('jembatan');
			$jalan=$this->input->post('jalan');
			$tanggul=$this->input->post('tanggul');
			$sawah=$this->input->post('sawah');
			
			$lahan_pertanian=$this->input->post('lahan_pertanian');
			$lain_lain=$this->input->post('lain_lain');
			$bupati_tgl=$this->input->post('bupati_tgl');
			$bupati_jam=$this->input->post('bupati_jam');
			$posko=$this->input->post('posko');
			
			$koordinasi=$this->input->post('koordinasi');
			$evakuasi=$this->input->post('evakuasi');
			$kesehatan=$this->input->post('kesehatan');
			$dapur=$this->input->post('dapur');
			$distribusi=$this->input->post('distribusi');
			
			$pengerahan=$this->input->post('pengerahan');
			$sumber_daya=$this->input->post('sumber_daya');
			$kendala=$this->input->post('kendala');
			$kebutuhan_mendesak=$this->input->post('kebutuhan_mendesak');
			$rencana_tindaklanjut=$this->input->post('rencana_tindaklanjut');

			$tim_bpbd=$this->input->post('tim_bpbd');
			$tim_dinsos=$this->input->post('tim_dinsos');
			$tim_dinkes=$this->input->post('tim_dinkes');
			$tim_pu=$this->input->post('tim_pu');
			$sub_tim=$this->input->post('sub_tim');

			$this->laporan_bencana->EditLaporanBencana($id_laporan,$id_bencana,$id_user,$tanggal_laporan,$jam_laporan,$meninggal,
				$luka_berat,$luka_ringan,$hilang,$mengungsi_jiwa,$mengungsi_kk,
				$rumah,$kantor,$fasilitas_kesehatan,$fasilitas_pendidikan,$fasilitas_umum,
				$sarana_ibadah,$jembatan,$jalan,$tanggul,$sawah,
				$lahan_pertanian,$lain_lain,$bupati_tgl,$bupati_jam,$posko,
				$koordinasi,$evakuasi,$kesehatan,$dapur,$distribusi,
				$pengerahan,$sumber_daya,$kendala,$kebutuhan_mendesak,$rencana_tindaklanjut,
				$tim_bpbd,$tim_dinsos,$tim_dinkes,$tim_pu,$sub_tim);
			//khusus edit, 5 kolom tambahan -$tim_bpbd,$tim_dinsos,$tim_dinkes,$tim_pu,$sub_tim- diikutin semua
			$this->session->set_flashdata('message', 'Data laporan berhasil diubah');
		
			//jadi pesa dari flash cuman muncul kalau pakai redirect refresh, kalau pakai load->view tidak bisa muncul
			//redirect('dlb/modify/'.$id_laporan, 'refresh');
			redirect('dlb/report/'.$this->session->userdata('idbencana'), 'refresh');
		}
	}
}
/* End of file welcome.php */