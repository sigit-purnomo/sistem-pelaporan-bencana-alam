<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
	/*konstruktor*/
	public function __construct()
	{
		parent::__construct();
        // Your own constructor code
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('account_model','',TRUE);//tell the model loading function to auto-connect to database
		
		//$this->output->enable_profiler(TRUE);
		
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			redirect('home');
		}
		$this->session->unset_userdata('keyword');
		$this->session->unset_userdata('keyword2');
		$this->session->unset_userdata('keyword3');
		$this->session->unset_userdata('tanggal1');
		$this->session->unset_userdata('tanggal2');
		$this->session->unset_userdata('tanggal12');
		$this->session->unset_userdata('tanggal22');

		$data['title']='Login';
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
		//$this->load->view('login_v',$data);
		$data['main_content']='login_v';
		$this->load->view('includes/template_5',$data);
	}
	public function login()
	{
		if($this->session->userdata('logged_in'))
		{
			redirect('home');
		}
		$data['title']='Login';
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
		$this->form_validation->set_rules('username', 'nama pengguna', 'alpha_dash|trim|max_length[50]|required');
		$this->form_validation->set_rules('password', 'kata sandi', 'alpha_dash|trim|max_length[50]|required');
		
		//$this->form_validation->set_message('rule', 'Error Message');
		$this->form_validation->set_message('required', 'Field %s harus diisi');
		$this->form_validation->set_message('max_length', 'Field %s maksimal 50 karakter');
		$this->form_validation->set_message('alpha_dash', 'Field %s hanya dapat mengandung huruf, angka, tanda underscore, dan tanda dash');

		if($this->form_validation->run() ==FALSE)
		{
			//kalau form validation gagal
			$this->session->set_flashdata('message', 'Nama pengguna atau kata sandi salah.');
			//$this->load->view('login_v',$data); //ga bisa rdirect, nanti form_validation nya ga muncul
			
		}
		else
		{

			//cek data login dr database
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			//query the database
  			$result = $this->account_model->login($username, $password);
  			if($result)//soalnya di database kalau data tidak sesuai return false
  			{
  				$sess_array = array();
  				foreach($result as $row)
  				{
  					$sess_array = array(
  						'id_user' => $row->id_user,
  						'username' => $row->username,
  						'status'=>'ok',
  						);
  					$this->session->set_userdata('logged_in', $sess_array);
  				}
  				redirect('home','refresh'); 
  			}
  			else
  			{
  				$this->session->set_flashdata('message', 'Nama pengguna atau kata sandi salah');  				
  			}
		}
		$data['main_content']='login_v';
		$this->load->view('includes/template_5',$data);
	}
	public function logout()
	{
		$this->session->sess_destroy();
		$data['title']='Aplikasi Web untuk Pelaporan Data Bencana Alam';
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['id_user'] = $session_data['id_user'];
			$data['link']='account/logout';
			$data['link2']='Keluar';
		}
		else
		{
			$data['username'] = '';
			$data['id_user'] = '0';
			$data['link']='account';
			$data['link2']='Masuk';
		}
		$data['main_content']='home_v';
		$this->load->view('includes/template_1',$data);
	}
	function alpha_dash_space($str)
	{
		return ( ! preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
	}
	
}
/* End of file welcome.php */