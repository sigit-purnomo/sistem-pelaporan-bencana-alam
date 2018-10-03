<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dlp extends CI_Controller {

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
		$this->load->model('posko','',TRUE);
		$this->load->model('laporan_posko','',TRUE);
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
		redirect('dlp/listing');
	}
	public function listing() {
		$data['title']='Pengelolaan Data Laporan Posko - Data Bencana';
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
		$config['base_url'] = base_url().'index.php/dlp/listing/'; //pointing to a controller called and a function
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
		//$this->load->view('dlp_v1',$data);
		$data['main_content']='dlp_v1';
		$this->load->view('includes/template_2',$data);
	}
	function alpha_dash_space($str)
	{
		return ( ! preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
	}

	
	public function shelter($idbencana=NULL) {
		$data['title']='Pengelolaan Data Laporan Posko - Data Posko';
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
			$a = $this->posko->GetJumlahPosko($idbencana);
			$config['base_url'] = base_url().'index.php/dlp/shelter/'.$idbencana; //pointing to a controller called and a function
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

			$data['detail'] = $this->posko->GetPoskoPaging($config['per_page'],$offset,$idbencana);

			$data['keyword2'] = '';
		    //$this->load->view('dlp_v2', $data);
		    $data['main_content']='dlp_v2';
			$this->load->view('includes/template_2',$data);
		}
	}
	
	public function searching()
	{
		if(isset($_POST["caridata"]))
		{
			$this->session->unset_userdata('keyword');
			$this->session->unset_userdata('keyword2');
			$this->session->unset_userdata('keyword3');
			$this->session->unset_userdata('tanggal1');
			$this->session->unset_userdata('tanggal2');
			$this->session->unset_userdata('tanggal12');
			$this->session->unset_userdata('tanggal22');
			$this->find1();
		}
		else if(isset($_POST["caridatapos"]))
		{
			$this->session->unset_userdata('keyword2');
			$this->session->unset_userdata('keyword3');
			$this->session->unset_userdata('tanggal12');
			$this->session->unset_userdata('tanggal22');
			$this->find2();
		}
		else if(isset($_POST["caridatalappos"]))
		{
			$this->session->unset_userdata('keyword3');
			$this->session->unset_userdata('tanggal12');
			$this->session->unset_userdata('tanggal22');
			$this->find3();
		}
		else if(isset($_POST["tambahdata"]))
			$this->add();
	}
	public function find1()
	{
		$data['title']='Pengelolaan Data Laporan Posko - Cari Data Bencana';
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
		$this->form_validation->set_rules('idbencana', 'id bencana', 'required|trim');
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
				$a = $this->bencana->GetJumlahBencana();
				$config['base_url'] = base_url().'index.php/dlp/find1/'; //pointing to a controller called and a function
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
				$a = $this->bencana->GetJumlahBencana3($keyword,$tanggal1,$tanggal2);
				$config['base_url'] = base_url().'index.php/dlp/find1/'; //pointing to a controller called and a function
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
			//$this->load->view('dlp_v1',$data);
		}
		else
		{
			if($tanggal1=='' || $tanggal2=='')
			{
				//$keyword=$this->session->userdata('keyword');
				//echo 'lol2'. $this->session->userdata('keyword');
				$a = $this->bencana->GetJumlahBencana2($keyword);
				$config['base_url'] = base_url().'index.php/dlp/find1/'; //pointing to a controller called and a function
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
				$config['base_url'] = base_url().'index.php/dlp/find1/'; //pointing to a controller called and a function
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
			
			//$this->load->view('dlp_v1',$data);
		}
		$data['keyword'] = $keyword;
		$data['tanggal1'] = $tanggal1;
		$data['tanggal2'] = $tanggal2;
		$data['main_content']='dlp_v1';
		$this->load->view('includes/template_2',$data);
	}
	
	public function add()
	{
		$data['title']='Pengelolaan Data Laporan Posko - Tambah Data Posko';
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
	    //$this->load->view('dlp_add', $data);
	    $data['main_content']='dlp_add';
		$this->load->view('includes/template_2',$data);
	}
	
	public function find2()
	{
		$data['title']='Pengelolaan Data Laporan Posko - Cari Data Posko';
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
		
		//$this->form_validation->set_rules('field', 'label', 'rules');
		$this->form_validation->set_rules('keyword2', 'pencarian', 'xss_clean|max_length[50]|trim');
		$this->form_validation->set_rules('idbencana', 'id bencana', 'required|trim');
		//$this->form_validation->set_message('rule', 'Error Message');
		$this->form_validation->set_message('required', 'Field %s harus diisi');
		$this->form_validation->set_message('max_length', 'Field %s maksimal 50 karakter');
		$this->form_validation->set_message('alpha_dash_space', 'Field %s hanya dapat mengandung huruf, angka, spasi, tanda underscore, dan tanda dash');
			
			
		if($this->form_validation->run() ==FALSE && !$this->session->userdata('keyword2'))
		{
			//echo 'lol1';
			//kalau form validation gagal
			//hups ntar $idbencana = $this->session->userdata('idbencana'); 
			$a = $this->posko->GetJumlahPosko($idbencana);
			$config['base_url'] = base_url().'index.php/dlp/find2/'; //pointing to a controller called and a function
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
			$data['detail'] = $this->posko->GetPoskoPaging($config['per_page'],$offset,$idbencana);
			//$this->load->view('dlp_v2',$data);
		}
		else
		{
			//$keyword=$this->session->userdata('keyword');
			//echo 'lol2'. $this->session->userdata('keyword');
			$a = $this->posko->GetJumlahPosko2($keyword2,$idbencana);
			$config['base_url'] = base_url().'index.php/dlp/find2/'; //pointing to a controller called and a function
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
			$data['detail'] = $this->posko->CariPoskoPaging($config['per_page'],$offset,$keyword2,$idbencana);
			
			//$this->load->view('dlp_v2',$data);
		}
		$data['keyword2'] = $keyword2;
		$data['main_content']='dlp_v2';
		$this->load->view('includes/template_2',$data);
	}

































	public function report($id_posko=NULL) {
		$data['title']='Pengelolaan Data Laporan Posko - Data Laporan Posko';
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
		if ($id_posko == null) {
			show_error('No identifier provided', 500);
		}
		else {
			$data['id_posko']=$id_posko;
			///////////////////////////////
			$this->session->set_userdata('id_posko', $id_posko);
			///////////////////////////////
			$a = $this->laporan_posko->GetJumlahLaporanPosko($id_posko);
			$config['base_url'] = base_url().'index.php/dlp/report/'.$id_posko; //pointing to a controller called and a function
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

			$data['detail'] = $this->laporan_posko->GetLaporanPoskoPaging($config['per_page'],$offset,$id_posko);

			$data['keyword3'] = '';
			$data['tanggal12'] = '';
			$data['tanggal22'] = '';
		    //$this->load->view('dlp_v3', $data);
		    $data['main_content']='dlp_v3';
			$this->load->view('includes/template_2',$data);
		}
	}
	public function find3()
	{
		$data['title']='Pengelolaan Data Laporan Posko - Cari Data Laporan Posko';
		//$idbencana = $this->input->post('idbencana');
		$id_posko = ''; // default when no term in session or POST
		if ($this->input->post('id_posko'))
		{
		    // use the term from POST and set it to session
		    $id_posko = $this->input->post('id_posko');
		    $this->session->set_userdata('id_posko', $id_posko);
		}
		elseif ($this->session->userdata('id_posko'))
		{
		    // if term is not in POST use existing term from session
		    $id_posko = $this->session->userdata('id_posko');
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
		$keyword3 = ''; // default when no term in session or POST
		if ($this->input->post('keyword3'))
		{
			// use the term from POST and set it to session
			$keyword3 = $this->input->post('keyword3');
			$this->session->set_userdata('keyword3', $keyword3);
		}
		elseif ($this->session->userdata('keyword3'))
		{
			// if term is not in POST use existing term from session
			$keyword3 = $this->session->userdata('keyword3');
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
		$this->form_validation->set_rules('keyword3', 'pencarian', 'xss_clean|max_length[50]|trim');
		$this->form_validation->set_rules('id_posko', 'id posko', 'required|trim');
		$this->form_validation->set_rules('tanggal12', 'tanggal12', 'xss_clean|trim');
		$this->form_validation->set_rules('tanggal22', 'tanggal22', 'xss_clean|trim');
		//$this->form_validation->set_message('rule', 'Error Message');
		$this->form_validation->set_message('required', 'Field %s harus diisi');
		$this->form_validation->set_message('max_length', 'Field %s maksimal 50 karakter');
		$this->form_validation->set_message('alpha_dash_space', 'Field %s hanya dapat mengandung huruf, angka, spasi, tanda underscore, dan tanda dash');
			
			
		if($this->form_validation->run() ==FALSE && !$this->session->userdata('keyword3'))
		{
			if($tanggal12=='' || $tanggal22=='')
			{
				//echo 'lol1';
				//kalau form validation gagal
				//hups ntar $idbencana = $this->session->userdata('idbencana'); 
				$a = $this->laporan_posko->GetJumlahLaporanPosko($id_posko);
				$config['base_url'] = base_url().'index.php/dlp/find3/'; //pointing to a controller called and a function
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
				$data['detail'] = $this->laporan_posko->GetLaporanPoskoPaging($config['per_page'],$offset,$id_posko);
			}
			else
			{
				$a = $this->laporan_posko->GetJumlahLaporanPosko3($keyword3,$id_posko,$tanggal12,$tanggal22);
				$config['base_url'] = base_url().'index.php/dlp/find3/'; //pointing to a controller called and a function
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
				$data['detail'] = $this->laporan_posko->CariLaporanPoskoPaging2($config['per_page'],$offset,$keyword3,$id_posko,$tanggal12,$tanggal22);
			
			}
			//$this->load->view('dlp_v3',$data);
		}
		else
		{
			if($tanggal12=='' || $tanggal22=='')
			{
				//$keyword=$this->session->userdata('keyword');
				//echo 'lol2'. $this->session->userdata('keyword');
				$a = $this->laporan_posko->GetJumlahLaporanPosko2($keyword3,$id_posko);
				$config['base_url'] = base_url().'index.php/dlp/find3/'; //pointing to a controller called and a function
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
				$data['detail'] = $this->laporan_posko->CariLaporanPoskoPaging($config['per_page'],$offset,$keyword3,$id_posko);
			}
			else
			{
				$a = $this->laporan_posko->GetJumlahLaporanPosko3($keyword3,$id_posko,$tanggal12,$tanggal22);
				$config['base_url'] = base_url().'index.php/dlp/find3/'; //pointing to a controller called and a function
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
				$data['detail'] = $this->laporan_posko->CariLaporanPoskoPaging2($config['per_page'],$offset,$keyword3,$id_posko,$tanggal12,$tanggal22);
			}
			//$this->load->view('dlp_v3',$data);
		}
		$data['keyword3'] = $keyword3;
		$data['tanggal12'] = $tanggal12;
		$data['tanggal22'] = $tanggal22;
		$data['main_content']='dlp_v3';
		$this->load->view('includes/template_2',$data);
	}
	
  	public function save() {
  	
  		$data['title']='Pengelolaan Data Laporan Posko - Tambah Data Laporan Posko';
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
	  	
	  	$this->form_validation->set_rules('tgl_lap_posko', 'tanggal laporan posko', 'trim|required');
	  	$this->form_validation->set_rules('jam_lap_posko', 'jam laporan posko', 'trim|required');
	  	$this->form_validation->set_rules('kapasitas', 'kapasitas', 'is_natural|trim|required');

	  	$this->form_validation->set_rules('fasilitas_dapur', 'jumlah fasilitas dapur', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('fasilitas_kesehatan', 'jumlah fasilitas kesehatan', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('fasilitas_mck', 'jumlah fasilitas mck', 'is_natural|trim|required');

	  	$this->form_validation->set_rules('jumlah_kk', 'jumlah kk', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('jumlah_pria', 'jumlah pria', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('jumlah_wanita', 'jumlah wanita', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('jumlah_balita', 'jumlah balita', 'is_natural|trim|required');
	  	
			//$this->form_validation->set_message('rule', 'Error Message');
	  	$this->form_validation->set_message('required', 'Field %s harus diisi');  	
	  	$this->form_validation->set_message('is_natural', 'Field %s hanya dapat mengandung angka');
	  	$this->form_validation->set_message('numeric', 'Field %s hanya dapat mengandung angka');
	  	$this->form_validation->set_message('max_length', 'Field %s maksimal 50 karakter');
	  	$this->form_validation->set_message('alpha_dash_space', 'Field %s hanya dapat mengandung huruf, angka, spasi, tanda underscore, dan tanda dash');

	  	if($this->form_validation->run() ==FALSE)
	  	{
			//kalau form validation gagal
			//$this->load->view('dlp_add',$data); //ga bisa rdirect, nanti form_validation nya ga muncul
	  		$data['main_content']='dlp_add';
			$this->load->view('includes/template_2',$data);
			
		}
		else
		{
			$id_posko=$this->session->userdata('id_posko');
			$session_data = $this->session->userdata('logged_in');
			$id_user=$session_data['id_user'];

			$tgl_lap_posko=$this->input->post('tgl_lap_posko');
			$jam_lap_posko=$this->input->post('jam_lap_posko');
			$kapasitas=$this->input->post('kapasitas');
			
			$fasilitas_dapur=$this->input->post('fasilitas_dapur');
			$fasilitas_kesehatan=$this->input->post('fasilitas_kesehatan');
			$fasilitas_mck=$this->input->post('fasilitas_mck');
			
			$jumlah_kk=$this->input->post('jumlah_kk');
			$jumlah_pria=$this->input->post('jumlah_pria');
			$jumlah_wanita=$this->input->post('jumlah_wanita');
			$jumlah_balita=$this->input->post('jumlah_balita');
			
			$this->laporan_posko->InsertLaporanPosko($id_posko,$id_user,$tgl_lap_posko,$jam_lap_posko,$kapasitas,
				$fasilitas_dapur,$fasilitas_kesehatan,$fasilitas_mck,
				$jumlah_kk,$jumlah_pria,$jumlah_wanita,$jumlah_balita);
			//reset set_value
			$this->form_validation->resetpostdata();
			$this->session->set_flashdata('message', 'Data laporan posko berhasil ditambahkan');
			
			//masuk ke success page, show all data bencana mungkin haha
			//jadi pesa dari flash cuman muncul kalau pakai redirect refresh, kalau pakai load->view tidak bisa muncul
			//redirect('dlp/add', 'refresh');
			redirect('dlp/report/'.$this->session->userdata('id_posko'), 'refresh');
			
		}
	}
	public function remove($id_laporan = null) {
		if ($id_laporan == null) {
			show_error('No identifier provided', 500);
		}
		else {
			$this->laporan_posko->HapusLaporanPosko($id_laporan);
			$this->session->set_flashdata('messagehapuslapposko', 'Data laporan posko berhasil dihapus');
			
			redirect('dlp/report/'.$this->session->userdata('id_posko') , 'refresh');
  		}
	}
























	public function modify($id_laporan = null) {
		$data['title']='Pengelolaan Data Laporan Posko - Ubah Data Laporan Posko';
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
			$data['detail'] = $this->laporan_posko->CariLaporanPoskoById($id_laporan);
			//$this->load->view('dlp_edit',$data);
			$data['main_content']='dlp_edit';
			$this->load->view('includes/template_2',$data);
	  }
	}
	public function update() {
		$data['title']='Pengelolaan Data Laporan Posko - Ubah Data Laporan Posko';
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
		$this->form_validation->set_rules('tgl_lap_posko', 'tanggal laporan posko', 'trim|required');
	  	$this->form_validation->set_rules('jam_lap_posko', 'jam laporan posko', 'trim|required');
	  	$this->form_validation->set_rules('kapasitas', 'kapasitas', 'is_natural|trim|required');

	  	$this->form_validation->set_rules('fasilitas_dapur', 'jumlah fasilitas dapur', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('fasilitas_kesehatan', 'jumlah fasilitas kesehatan', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('fasilitas_mck', 'jumlah fasilitas mck', 'is_natural|trim|required');

	  	$this->form_validation->set_rules('jumlah_kk', 'jumlah kk', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('jumlah_pria', 'jumlah pria', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('jumlah_wanita', 'jumlah wanita', 'is_natural|trim|required');
	  	$this->form_validation->set_rules('jumlah_balita', 'jumlah balita', 'is_natural|trim|required');
  	
			//$this->form_validation->set_message('rule', 'Error Message');
	  	$this->form_validation->set_message('required', 'Field %s harus diisi');
	  	$this->form_validation->set_message('is_natural', 'Field %s hanya dapat mengandung angka');
	  	$this->form_validation->set_message('numeric', 'Field %s hanya dapat mengandung angka');
	  	$this->form_validation->set_message('max_length', 'Field %s maksimal 500 karakter');
	  	$this->form_validation->set_message('alpha_dash_space', 'Field %s hanya dapat mengandung huruf, angka, spasi, tanda underscore, dan tanda dash');

		if($this->form_validation->run() ==FALSE)
		{
			$data['detail'] = '';
			//$this->load->view('dlp_edit',$data); //ga bisa rdirect, nanti form_validation nya ga muncul
			$data['main_content']='dlp_edit';
			$this->load->view('includes/template_2',$data);
			
		}
		else
		{
			//$id_posko=$this->session->userdata('id_posko');
			$session_data = $this->session->userdata('logged_in');
			$id_user=$session_data['id_user'];

			$id_laporan=$this->input->post('id_laporan');
			$tgl_lap_posko=$this->input->post('tgl_lap_posko');
			$jam_lap_posko=$this->input->post('jam_lap_posko');
			$kapasitas=$this->input->post('kapasitas');
			
			$fasilitas_dapur=$this->input->post('fasilitas_dapur');
			$fasilitas_kesehatan=$this->input->post('fasilitas_kesehatan');
			$fasilitas_mck=$this->input->post('fasilitas_mck');
			
			$jumlah_kk=$this->input->post('jumlah_kk');
			$jumlah_pria=$this->input->post('jumlah_pria');
			$jumlah_wanita=$this->input->post('jumlah_wanita');
			$jumlah_balita=$this->input->post('jumlah_balita');

			$this->laporan_posko->EditLaporanPosko($id_user,$id_laporan,$tgl_lap_posko,$jam_lap_posko,$kapasitas,
				$fasilitas_dapur,$fasilitas_kesehatan,$fasilitas_mck,
				$jumlah_kk,$jumlah_pria,$jumlah_wanita,$jumlah_balita);
			
			$this->session->set_flashdata('message', 'Data laporan posko berhasil diubah');
		
			//jadi pesa dari flash cuman muncul kalau pakai redirect refresh, kalau pakai load->view tidak bisa muncul
			redirect('dlp/report/'.$this->session->userdata('id_posko'), 'refresh');

		}
	}
	
}
/* End of file welcome.php */