<?php if (! defined('BASEPATH'))exit('No direct script access allowed');
	class C_changepass extends CI_Controller{
		function __construct()
		{
			parent::__construct();
			$this->load->helper('form');
			$this->load->helper('url');
			$this->load->model('m_login');
		}
		
		function index(){
			if($this->session->userdata('logged_in')){
				$this->change();
				
			}else{
				redirect('c_login','refresh');
			}
			
		}

		function change(){
			if($this->session->userdata('logged_in'))
			{
	            $this->load->view('v_changepass');
	        }else{
	        	redirect('c_login','refresh');
	        }
		}

		function updatePass() {
		if($this->session->userdata('logged_in'))
			{
				$passLama	= $this->input->post('passlama', TRUE);
				$passLama 	= MD5($passLama);
				
				$passBaru 	= $this->input->post('passbaru', TRUE);
				$passBaru 	= MD5($passBaru);
				
				$konfirm 	= $this->input->post('password', TRUE);
				$konfirm 	= MD5($konfirm);
				
				$data['hasil'] = $this->session->userdata('logged_in');
				$id = $data['hasil']->id_user;				
				$temp = $data['hasil']->password;
				
            	$this->form_validation->set_rules('passbaru', 'Kata Sandi Baru', 'min_length[6]');
            	 if ($this->form_validation->run() == TRUE)
            {
				if($passLama==$temp)
				{
					if($passBaru==$konfirm)
					{							
						$data = array(
							'password' => $konfirm			
						);		
						$this->m_login->updateUser(array('id_user' => $id), $data);
						redirect('admin/c_changepass/back');	
					}
					else {
							$data['cek'] = '0';
							$this->load->view('v_changepass',$data);
					}
				}
				else {
							$data['cek'] = '2';
							$this->load->view('v_changepass',$data);
							//echo json_encode($temp);
				}
			}else{
				$data['cek'] = '4';
							$this->load->view('v_changepass',$data);
							//echo json_encode($temp);
			}
					
			}else
				redirect('c_login', 'refresh');   	       
    }

    function back()
	{
		$this->session->unset_userdata('logged_in');
			session_start();
			session_destroy();
			redirect('c_login', 'refresh');
	}
}
?>