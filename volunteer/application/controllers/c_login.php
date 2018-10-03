<?php if (! defined('BASEPATH'))exit('No direct script access allowed');
	class C_login extends CI_Controller{
		function __construct() 
		{
			parent::__construct();
			$this->load->helper('form');
			$this->load->model('m_login');
			$this->load->helper('url');
		}
		
		function index(){
			if($this->session->userdata('logged_in')){
				redirect('admin/c_admin','refresh');
			}else{
				$data['cek'] = '1';
				$this->load->view('v_login','refresh');
			}
		}
		
		function check_login(){
			$username = $this->input->post('username');
			$password = $this->input->post('password', TRUE);
			
			$password = MD5($password);
			
			$this->form_validation->set_rules('username', 'username', 'required');
			$this->form_validation->set_rules('password', 'password', 'required');
			
			
			if ($this->form_validation->run() == TRUE)
			{	
				$result['hasil'] = $this->m_login->login($username,$password);
				if($result['hasil']==NULL){
					
					$data['cek'] = '0';
					$this->load->view('v_login',$data);
				}else{
					redirect('c_login','refresh');
				}
			}else{
				$this->load->view('v_login',TRUE);
			}
			
		}
		
		function logout()
		{
			$this->session->unset_userdata('logged_in');
			session_start();
			session_destroy();
			redirect('c_login', 'refresh');
		}
	}
?>