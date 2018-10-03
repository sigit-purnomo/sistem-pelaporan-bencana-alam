<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dp extends CI_Controller {

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
		redirect('dp/listing');
	}
	public function listing() {
		$data['title']='Pengelolaan Data Posko - Data Bencana';
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
		$config['base_url'] = base_url().'index.php/dp/listing/'; //pointing to a controller called and a function
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
		//$this->load->view('dp_v1',$data);
		$data['main_content']='dp_v1';
		$this->load->view('includes/template_2',$data);
	}
	function alpha_dash_space($str)
	{
		return ( ! preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
	}

	
	public function shelter($idbencana=NULL) {
		$data['title']='Pengelolaan Data Posko - Data Posko';
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
			$config['base_url'] = base_url().'index.php/dp/shelter/'.$idbencana; //pointing to a controller called and a function
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
		    //$this->load->view('dp_v2', $data);
		    $data['main_content']='dp_v2';
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
		else if(isset($_POST["caridatapos"]))
		{
			$this->session->unset_userdata('keyword2');
			$this->find2();
		}
		else if(isset($_POST["tambahdata"]))
			$this->add();
	}
	public function find1()
	{
		$data['title']='Pengelolaan Data Posko - Cari Data Bencana';
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
		$this->form_validation->set_rules('keyword', 'pencarian', 'xss_clean|max_length[50]|required|trim');
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
				//kalau form validation gagal
				$a = $this->bencana->GetJumlahBencana();
				$config['base_url'] = base_url().'index.php/dp/find1/'; //pointing to a controller called and a function
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
				//$this->load->view('dp_v1',$data);
			}
			else
			{
				$a = $this->bencana->GetJumlahBencana3($keyword,$tanggal1,$tanggal2);
				$config['base_url'] = base_url().'index.php/dp/find1/'; //pointing to a controller called and a function
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
				//$this->load->view('dp_v1',$data);
			}
		}
		else
		{
			//$keyword=$this->session->userdata('keyword');
			//echo 'lol2'. $this->session->userdata('keyword');
			if($tanggal1=='' || $tanggal2=='')
			{
				$a = $this->bencana->GetJumlahBencana2($keyword);
				$config['base_url'] = base_url().'index.php/dp/find1/'; //pointing to a controller called and a function
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
				
				//$this->load->view('dp_v1',$data);
			}
			else
			{
				$a = $this->bencana->GetJumlahBencana3($keyword,$tanggal1,$tanggal2);
				$config['base_url'] = base_url().'index.php/dp/find1/'; //pointing to a controller called and a function
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
				$data['detail'] = $this->bencana->CariBencanaPaging($config['per_page'],$offset,$keyword,$tanggal1,$tanggal2);
			}
		}
		$data['keyword'] = $keyword;
		$data['tanggal1'] = $tanggal1;
		$data['tanggal2'] = $tanggal2;
		$data['main_content']='dp_v1';
		$this->load->view('includes/template_2',$data);
	}
	
	public function add()
	{
		$data['title']='Pengelolaan Data Posko - Tambah Data Posko';
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
	    //$this->load->view('dp_add', $data);
	    $data['main_content']='dp_add';
		$this->load->view('includes/template_2',$data);
	}
	
	public function find2()
	{
		$data['title']='Pengelolaan Data Posko - Cari Data Posko';
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
		$this->form_validation->set_rules('keyword2', 'pencarian', 'xss_clean|max_length[50]|required|trim');
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
			$config['base_url'] = base_url().'index.php/dp/find2/'; //pointing to a controller called and a function
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
			//$this->load->view('dp_v2',$data);
		}
		else
		{
			//$keyword=$this->session->userdata('keyword');
			//echo 'lol2'. $this->session->userdata('keyword');
			$a = $this->posko->GetJumlahPosko2($keyword2,$idbencana);
			$config['base_url'] = base_url().'index.php/dp/find2/'; //pointing to a controller called and a function
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
			
			//$this->load->view('dp_v2',$data);
		}
		$data['keyword2'] = $keyword2;
		$data['main_content']='dp_v2';
		$this->load->view('includes/template_2',$data);
	}
	
  	public function save() {
  	
  		$data['title']='Pengelolaan Data Posko - Tambah Data Posko';
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
	  	$this->form_validation->set_rules('nama_posko', 'nama posko', 'trim|max_length[50]|required');
	  	$this->form_validation->set_rules('latitude', 'latitude', 'numeric|trim|required');
	  	$this->form_validation->set_rules('longitude', 'longitude', 'numeric|trim|required');
	  	
	  	$this->form_validation->set_rules('lokasi_posko_dusun', 'nama dusun', 'trim|max_length[50]|required');
	  	$this->form_validation->set_rules('lokasi_posko_kecamatan', 'nama kecamatan', 'trim|max_length[50]|required');
	  	$this->form_validation->set_rules('lokasi_posko_kota', 'nama kota', 'trim|max_length[50]|required');
	  	$this->form_validation->set_rules('lokasi_posko_provinsi', 'nama provinsi', 'trim|max_length[50]|required');


			//$this->form_validation->set_message('rule', 'Error Message');
	  	$this->form_validation->set_message('required', 'Field %s harus diisi');  	
	  	$this->form_validation->set_message('is_natural', 'Field %s hanya dapat mengandung angka');
	  	$this->form_validation->set_message('numeric', 'Field %s hanya dapat mengandung angka');
	  	$this->form_validation->set_message('max_length', 'Field %s maksimal 50 karakter');
	  	$this->form_validation->set_message('alpha_dash_space', 'Field %s hanya dapat mengandung huruf, angka, spasi, tanda underscore, dan tanda dash');

	  	if($this->form_validation->run() ==FALSE)
	  	{
		//kalau form validation gagal
		//$this->load->view('dp_add',$data); //ga bisa rdirect, nanti form_validation nya ga muncul
  		$data['main_content']='dp_add';
		$this->load->view('includes/template_2',$data);
			
		}
		else
		{
			$id_bencana=$this->session->userdata('idbencana');
			$session_data = $this->session->userdata('logged_in');
			$id_user=$session_data['id_user'];

			$nama_posko=$this->input->post('nama_posko');
			$latitude=$this->input->post('latitude');
			$longitude=$this->input->post('longitude');
			
			$lokasi_posko_dusun=$this->input->post('lokasi_posko_dusun');
			$lokasi_posko_kecamatan=$this->input->post('lokasi_posko_kecamatan');
			$lokasi_posko_kota=$this->input->post('lokasi_posko_kota');
			$lokasi_posko_provinsi=$this->input->post('lokasi_posko_provinsi');
			

			$this->posko->InsertPosko($id_bencana,$nama_posko,$latitude,$longitude,
				$lokasi_posko_dusun,$lokasi_posko_kecamatan,$lokasi_posko_kota,$lokasi_posko_provinsi);

			
			//reset set_value
			$this->form_validation->resetpostdata();
			$this->session->set_flashdata('message', 'Data posko '.$nama_posko.' berhasil ditambahkan');
			
			//jadi pesa dari flash cuman muncul kalau pakai redirect refresh, kalau pakai load->view tidak bisa muncul$nama_posko.
			//redirect('dp/add', 'refresh');
			redirect('dp/shelter/'.$this->session->userdata('idbencana'), 'refresh');
			
		}
	}
	public function remove($id_posko = null) {
		if ($id_posko == null) {
			show_error('No identifier provided', 500);
		}
		else {
			if($this->posko->CekDependencyPosko($id_posko)==0)
			{
				//kalau tidak ada data di tabel posko dan tabel laporan yang dependency, maka akan dihapus data bencana
				$this->posko->HapusPosko($id_posko);
				$this->session->set_flashdata('messagehapusposko', 'Data posko berhasil dihapus');
			}
			else
			{
				$this->session->set_flashdata('messagehapusposko', 'Data posko tidak berhasil dihapus');
			}
			redirect('dp/shelter/'.$this->session->userdata('idbencana') , 'refresh');
  		}
	}

	public function modify($id_posko = null) {
		$data['title']='Pengelolaan Data Posko - Ubah Data Posko';
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
			$data['detail'] = $this->posko->CariPoskoById($id_posko);
			//$this->load->view('dp_edit',$data);
			$data['main_content']='dp_edit';
			$this->load->view('includes/template_2',$data);
	  }
	}
	public function update() {
		$data['title']='Pengelolaan Data Posko - Ubah Data Posko';
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
		$this->form_validation->set_rules('id_posko', 'id posko', 'trim|required');
		$this->form_validation->set_rules('nama_posko', 'nama posko', 'trim|max_length[50]|required');
	  	$this->form_validation->set_rules('latitude', 'latitude', 'numeric|trim|required');
	  	$this->form_validation->set_rules('longitude', 'longitude', 'numeric|trim|required');
	  	
	  	$this->form_validation->set_rules('lokasi_posko_dusun', 'nama dusun', 'trim|max_length[50]|required');
	  	$this->form_validation->set_rules('lokasi_posko_kecamatan', 'nama kecamatan', 'trim|max_length[50]|required');
	  	$this->form_validation->set_rules('lokasi_posko_kota', 'nama kota', 'trim|max_length[50]|required');
	  	$this->form_validation->set_rules('lokasi_posko_provinsi', 'nama provinsi', 'trim|max_length[50]|required');

			//$this->form_validation->set_message('rule', 'Error Message');
	  	$this->form_validation->set_message('required', 'Field %s harus diisi');
	  	$this->form_validation->set_message('is_natural', 'Field %s hanya dapat mengandung angka');
	  	$this->form_validation->set_message('numeric', 'Field %s hanya dapat mengandung angka');
	  	$this->form_validation->set_message('max_length', 'Field %s maksimal 500 karakter');
	  	$this->form_validation->set_message('alpha_dash_space', 'Field %s hanya dapat mengandung huruf, angka, spasi, tanda underscore, dan tanda dash');

		if($this->form_validation->run() ==FALSE)
		{
			//kalau form validation gagal
			$data['detail'] = '';
			//$this->load->view('dp_edit',$data); //ga bisa rdirect, nanti form_validation nya ga muncul
			$data['main_content']='dp_edit';
			$this->load->view('includes/template_2',$data);
			
		}
		else
		{
			$id_posko=$this->input->post('id_posko');
			$nama_posko=$this->input->post('nama_posko');
			$latitude=$this->input->post('latitude');
			$longitude=$this->input->post('longitude');
			
			$lokasi_posko_dusun=$this->input->post('lokasi_posko_dusun');
			$lokasi_posko_kecamatan=$this->input->post('lokasi_posko_kecamatan');
			$lokasi_posko_kota=$this->input->post('lokasi_posko_kota');
			$lokasi_posko_provinsi=$this->input->post('lokasi_posko_provinsi');
			
			$this->posko->EditPosko($id_posko,$nama_posko,$latitude,$longitude,
				$lokasi_posko_dusun,$lokasi_posko_kecamatan,$lokasi_posko_kota,$lokasi_posko_provinsi);
			
			$this->session->set_flashdata('message', 'Data posko '.$nama_posko.' berhasil diubah');
		
			//jadi pesa dari flash cuman muncul kalau pakai redirect refresh, kalau pakai load->view tidak bisa muncul
			//redirect('dp/modify/'.$id_posko, 'refresh');
			redirect('dp/shelter/'.$this->session->userdata('idbencana'), 'refresh');
		}
	}
}
/* End of file welcome.php */