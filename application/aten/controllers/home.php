<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$data['title']='Aplikasi Web untuk Pelaporan Data Bencana Alam';
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
		//$this->load->view('tes_v',$data);
		$data['main_content']='home_v';
		$this->load->view('includes/template_1',$data);
	}
}