<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tes extends CI_Controller {

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
		$this->output->enable_profiler(TRUE);
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
		
$data = array("id"=>"disabledIsdfsdfsnput", 2, 4);
$hidden = array("id"=>"disabledInput");
$data = array_merge($data, $hidden);

if(!$this->session->userdata('logged_in'))
          {
            $hidden = array("disabled"=>"");
			$data = array_merge($data, $hidden);
          }


if(!$this->session->userdata('logged_in'))
          {
            $hidden = array("class"=>"button btn btn-primary btn-block disabled");
            $data = array_merge($data, $hidden);
          }



print_r($data);

	}
	public function cek()
	{
		echo 'lol';
	}
}
/*end*/