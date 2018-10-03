<?php if (! defined('BASEPATH'))exit('No direct script access allowed');
	class C_admin extends CI_Controller{
		function __construct()
		{
			parent::__construct();
			$this->load->helper('form');
			$this->load->helper('url');
			$this->load->model('admin/m_relawan');
			$this->load->model('admin/m_petugas');
		}
		
		function index(){
			if($this->session->userdata('logged_in')){
				//$data['username'] = $this->session->userdata('username');
				$this->admin();
				
			}else{
				redirect('c_login','refresh');
			}
			
		}

		function admin(){
			if($this->session->userdata('logged_in'))
			{
				
				$data['nama']=$this->input->post('penerima');
				$data['tgl']=$this->input->post('tgl');
				$data['id_user']=$this->input->post('idnya');
				$data['gawat'] = json_encode($this->m_petugas->markerAll());
				if ($data['nama']!=null&&$data['tgl']!=null) {
					$data['pet'] = json_encode($this->m_petugas->getsearchby2($data['id_user'],$data['tgl']));
				
				}elseif ($data['nama']==null&&$data['tgl']!=null) {
				
				$data['pet'] = json_encode($this->m_petugas->getsearchbytgl($data['tgl']));

				}elseif ($data['nama']!=null&&$data['tgl']==null) {
					$data['pet'] = json_encode($this->m_petugas->getsearchbyid($data['id_user']));
				}else{
					$data['pet'] = json_encode($this->m_petugas->getAll());
				}
				// $json_url             = "http://localhost/monitoring/index.php/api/user/show_relawanpos";
                                $json_url             = "http://alert.id/disaster/volunteer/index.php/api/user/show_relawanpos";
            	 $json                 = file_get_contents($json_url);
            	 $result               = json_decode($json, true);
            	$data['Hasil']        = $result['result'];
				$data['page_title'] = 'Sistem Monitoring dan Pencarian Relawan';
	            $data['content'] = $this->load->view('v_beranda', $data, TRUE);
	            //echo json_encode($datax);
	            $this->load->view('v_utama', $data);
	        }else{
	        	redirect('c_login','refresh');
	        }
		}
		
		function jamgawat($id_user)
		{
			echo $this->m_relawan->jamgawat($id_user);
		}
}
?>