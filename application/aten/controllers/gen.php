<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gen extends CI_Controller {
	/*konstruktor*/
	public function __construct()
	{
		parent::__construct();
        // Your own constructor code
		$this->load->helper('url');
		$this->load->model('gen_model','',TRUE);//tell the model loading function to auto-connect to database
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->library('form_validation');
		//$this->output->enable_profiler(TRUE);
		
	}

	public function index()
	{
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
		$data['idbencana']='';
		$data['idposko']='';
		$this->load->view('gen_v',$data);
	}
	public function genBencana()
	{
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
		$this->gen_model->InsertBencana();
		$data['idbencana']=$this->db->insert_id();
		$data['idposko']='';
		$this->load->view('gen_v',$data);
	}
	public function genPosko()
	{
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

		$this->form_validation->set_rules('id_bencana', 'id bencana', 'trim|numeric|required|is_natural');

		$this->form_validation->set_message('required', 'Field %s harus diisi');
	  	$this->form_validation->set_message('numeric', 'Field %s hanya dapat mengandung angka');
	  	$this->form_validation->set_message('is_natural', 'Field %s hanya dapat mengandung angka');
	  	if($this->form_validation->run() ==FALSE)
	  	{
	  		$data['idposko']='';
	  	}
	  	else
	  	{
	  		$id_bencana = $this->input->post('id_bencana');
			$this->gen_model->InsertPosko($id_bencana);
			$data['idposko']=$this->db->insert_id();
		}
		$data['idbencana']='';
		$this->load->view('gen_v',$data);
	}
	
}
/* End of file welcome.php */