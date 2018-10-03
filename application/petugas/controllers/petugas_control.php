<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Petugas_control extends CI_Controller {


	function __construct()
	{
		parent::__construct();
	   	$this->load->model('user_model');
	}
	   
	public function index() //TAMPIL DATA
	{
		if($this->session->userdata('logged_in'))
   		{	
			if($this->session->userdata('id_bencana_broadcast_bencana')) 
			{
			 	$this->session->unset_userdata('id_bencana_broadcast_bencana');
			}
			if($this->session->userdata('id_petugas_broadcast_bencana')) 
			{
				$this->session->unset_userdata('id_petugas_broadcast_bencana');
			}
			if($this->session->userdata('id_bencana_broadcast_posko')) 
			{
				$this->session->unset_userdata('id_bencana_broadcast_posko');
			}
			if($this->session->userdata('id_petugas_broadcast_posko')) 
			{
				$this->session->unset_userdata('id_petugas_broadcast_posko');	
			}
				
			$data['daftar_petugas'] = $this->user_model->show();
			$data['username'] = $this->session->userdata('username');

			$this->load->view('petugas',$data);
		}
		else 
		{
			redirect('login_control/index','refresh');
		}
	}

	public function view_tambah_petugas()
	{
		if($this->session->userdata('logged_in'))
   		{	
			if($this->session->userdata('id_bencana_broadcast_bencana')) 
			{
			 	$this->session->unset_userdata('id_bencana_broadcast_bencana');
			}
			if($this->session->userdata('id_petugas_broadcast_bencana')) 
			{
				$this->session->unset_userdata('id_petugas_broadcast_bencana');
			}
			if($this->session->userdata('id_bencana_broadcast_posko')) 
			{
				$this->session->unset_userdata('id_bencana_broadcast_posko');

			}
			if($this->session->userdata('id_petugas_broadcast_posko')) 
			{
				$this->session->unset_userdata('id_petugas_broadcast_posko');	
			}

			$data['username'] = $this->session->userdata('username');

			$this->load->view('petugas_tambah',$data);
		}
		else 
		{
			redirect('login_control/index','refresh');
		}
	}

	public function tambah_petugas()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|xss_clean|callback_check_username');
		// $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'trim|required|xss_clean|integer|callback_check_panjang_no_telepon|callback_check_no_telepon');
		$this->form_validation->set_rules('role', 'Role', 'required|xss_clean'); 

		$data['username'] = $this->session->userdata('username');

		if($this->form_validation->run() == FALSE) // FORM REGISTRASI MASIH ERROR
		{
			echo "<script>
				alert('Terjadi Kesalahan!');
				</script>";

			if($this->input->post('role') == 'Petugas')
			{
				$role = 1;
			}
			else if($this->input->post('role') == 'Relawan')
			{
				$role = 2;
			}
			$data = array(
				'nama_lengkap' 	=> $this->input->post('nama'),
	            'username'    	=> $this->input->post('username'),  
				'no_hp'       	=> "+62".$this->input->post('nomor_telepon'),   
	            'id_role' => $role
	        );

			$this->load->view('petugas_tambah_error', $data);
		}
		else
		{
			echo "<script>
				alert('Petugas baru berhasil ditambahkan! Password default petugas adalah 12345');
				</script>";

			if($this->input->post('role') == 'Petugas')
			{
				$role = 1;
			}
			else if($this->input->post('role') == 'Relawan')
			{
				$role = 2;
			}
			$data = array(
				'nama_lengkap' 	=> $this->input->post('nama'),
	            'username'    	=> $this->input->post('username'),  
	            'password'    	=> md5('12345'),       
				'no_hp'       	=> "+62".$this->input->post('nomor_telepon'),   
	            'id_role' =>$role,
	            'status' => '1'
	        );

			$this->user_model->insert($data);

			redirect('petugas_control/index','refresh');
		}
	}

	public function check_username()
	{
		$username = $this->input->post('username');

		$result = $this->user_model->check_username($username);

		if($result)
   		{
	     	return TRUE;
	   	}
	   	else
	   	{
	     	$this->form_validation->set_message('check_username', 'Username sudah terdaftar');
	     	return false;
	   	}
	}

	public function check_no_telepon()
 	{
	   //Field validation succeeded.  Validate against database
   		$nomor_telepon = "+62".$this->input->post('nomor_telepon');

	   //query the database
		$result = $this->user_model->check_no_telepon($nomor_telepon);

		if($result)
   		{
	     	return TRUE;
	   	}
	   	else
	   	{
	     	$this->form_validation->set_message('check_no_telepon', 'Nomor telepon sudah terdaftar');
	     	return false;
	   	}
 	}

 	public function check_panjang_no_telepon()
 	{
	   //Field validation succeeded.  Validate against database
   		$nomor_telepon = "+62".$this->input->post('nomor_telepon');
   		if(strlen($nomor_telepon) < 16 && strlen($nomor_telepon) > 11)
   		{
   			$result = true;
   		}
   		else
   		{
   			$result = false;
   		}
	   
		if($result)
   		{
	     	return TRUE;
	   	}
	   	else
	   	{
	     	$this->form_validation->set_message('check_panjang_no_telepon', 'Panjang nomor telepon tidak valid');
	     	return false;
	   	}
 	}

 	public function view_ubah_petugas()
	{
		if($this->session->userdata('logged_in'))
   		{	
			if($this->session->userdata('id_bencana_broadcast_bencana')) 
			{
			 	$this->session->unset_userdata('id_bencana_broadcast_bencana');
			}
			if($this->session->userdata('id_petugas_broadcast_bencana')) 
			{
				$this->session->unset_userdata('id_petugas_broadcast_bencana');
			}
			if($this->session->userdata('id_bencana_broadcast_posko')) 
			{
				$this->session->unset_userdata('id_bencana_broadcast_posko');

			}
			if($this->session->userdata('id_petugas_broadcast_posko')) 
			{
				$this->session->unset_userdata('id_petugas_broadcast_posko');	
			}

			$data['username'] = $this->session->userdata('username');

			$this->load->view('petugas_ubah2',$data);
		}
		else 
		{
			redirect('login_control/index','refresh');
		}
	}

	public function view_ubah_petugas2($id_user)
	{
		if($this->session->userdata('logged_in'))
   		{	
			if($this->session->userdata('id_bencana_broadcast_bencana')) 
			{
			 	$this->session->unset_userdata('id_bencana_broadcast_bencana');
			}
			if($this->session->userdata('id_petugas_broadcast_bencana')) 
			{
				$this->session->unset_userdata('id_petugas_broadcast_bencana');
			}
			if($this->session->userdata('id_bencana_broadcast_posko')) 
			{
				$this->session->unset_userdata('id_bencana_broadcast_posko');

			}
			if($this->session->userdata('id_petugas_broadcast_posko')) 
			{
				$this->session->unset_userdata('id_petugas_broadcast_posko');	
			}

			$data['info_petugas'] = $this->user_model->show_by($id_user);
			$data['id_user'] = $id_user;
			$data['username'] = $this->session->userdata('username');
			
			$this->load->view('petugas_ubah', $data);
		}	
		else 
		{
			redirect('login_control/index','refresh');
		}
	}

	public function edit_petugas($id_user)
	{
		$data['username'] = $this->session->userdata('username');
		$current_username = $this->user_model->search_username_by_id_user($id_user);
		$current_nomor_telepon = $this->user_model->search_no_hp_by_id_user($id_user);

		$username = $this->input->post('username');
   		$nomor_telepon = "+62".$this->input->post('nomor_telepon');

		$this->load->library('form_validation');
		// field name, error message, validation rules
		if($username != $current_username)
		{
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|xss_clean|callback_check_username');
		}
		else if($username == $current_username)
		{
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|xss_clean');
		}

		if($nomor_telepon != $current_nomor_telepon)
		{
			$this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'trim|required|xss_clean|integer|callback_check_panjang_no_telepon|callback_check_no_telepon');
		}
		else if($nomor_telepon == $current_nomor_telepon)
		{
			$this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'trim|required|xss_clean|integer|callback_check_panjang_no_telepon');
		}
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('role', 'Role', 'required|xss_clean'); 

		if($this->form_validation->run() == FALSE) // FORM REGISTRASI MASIH ERROR
		{
			echo "<script>
				alert('Terjadi Kesalahan!');
				</script>";

			if($this->input->post('role') == 'Petugas')
			{
				$role = 1;
			}
			else if($this->input->post('role') == 'Relawan')
			{
				$role = 2;
			}
			$data = array(
				'id_user' => $id_user,
				'nama_lengkap' 	=> $this->input->post('nama'),
	            'username'    	=> $this->input->post('username'),  
	            'password'    	=> $this->input->post('password'),
				'no_hp'       	=> "+62".$this->input->post('nomor_telepon'),   
	            'id_role' => $role
	        );

			$this->load->view('petugas_ubah_error', $data);
		}
		else
		{
			if($this->input->post('role') == 'Petugas')
			{
				$role = 1;
			}
			else if($this->input->post('role') == 'Relawan')
			{
				$role = 2;
			}
			$data = array(
				'nama_lengkap' 	=> $this->input->post('nama'),
	            'username'    	=> $this->input->post('username'),                                       
	            'password'    	=> md5($this->input->post('password')),
				'no_hp'       	=> "+62".$this->input->post('nomor_telepon'),   
	            'id_role' =>$role
	        );

			$this->user_model->update($data,$id_user);
			
			redirect('petugas_control/index','refresh');
		}
	}

	public function check_current_username()//Cek  
	{	
		$username = $this->input->post('username');

		$result = $this->user_model->check_username2($username, $id_user);

		if($result)//Nama berubah
   		{
	     	return TRUE;
	   	}
	   	else
	   	{
	     	return false;
	   	}
	}

 	public function check_current_no_telepon()//Cek
 	{
   		$nomor_telepon = "+62".$this->input->post('nomor_telepon');

	   //query the database
		$result = $this->user_model->check_no_telepon2($nomor_telepon, $id_user);

		if($result)//No telp berubah
   		{
	     	return TRUE;
	   	}
	   	else
	   	{
	     	return false;
	   	}
 	}

	public function cari_petugas()
	{
		if($this->session->userdata('id_bencana_broadcast_bencana')) 
		{
		 	$this->session->unset_userdata('id_bencana_broadcast_bencana');
		}
		if($this->session->userdata('id_petugas_broadcast_bencana')) 
		{
			$this->session->unset_userdata('id_petugas_broadcast_bencana');
		}
		if($this->session->userdata('id_bencana_broadcast_posko')) 
		{
			$this->session->unset_userdata('id_bencana_broadcast_posko');
		}
		if($this->session->userdata('id_petugas_broadcast_posko')) 
		{
			$this->session->unset_userdata('id_petugas_broadcast_posko');	
		}

		$cari = $this->input->post('cari');
		
		$data['username'] = $this->session->userdata('username');

		if(empty($this->user_model->search_by($cari)))//Ga da hasil
		{
			echo "<script>
				alert('Maaf, tidak dapat menemukan data petugas!');
				</script>";

			redirect('petugas_control/index','refresh');
		}
		else//Ada hasil
		{
			$data['cari_petugas'] = $this->user_model->search_by($cari);
			
			$this->load->view('petugas_cari',$data);
		}
	}

	public function view_hapus_petugas()
	{
		if($this->session->userdata('logged_in'))
   		{	
			if($this->session->userdata('id_bencana_broadcast_bencana')) 
			{
			 	$this->session->unset_userdata('id_bencana_broadcast_bencana');
			}
			if($this->session->userdata('id_petugas_broadcast_bencana')) 
			{
				$this->session->unset_userdata('id_petugas_broadcast_bencana');
			}
			if($this->session->userdata('id_bencana_broadcast_posko')) 
			{
				$this->session->unset_userdata('id_bencana_broadcast_posko');
			}
			if($this->session->userdata('id_petugas_broadcast_posko')) 
			{
				$this->session->unset_userdata('id_petugas_broadcast_posko');	
			}
			
			$data['username'] = $this->session->userdata('username');

			$this->load->view('petugas_hapus',$data);
		}	
		else 
		{
			redirect('login_control/index','refresh');
		}
	}

	public function delete_petugas($id_user)
	{
		$data = array(
			'status' => '0'
        );

		$this->user_model->update($data,$id_user);
		
		redirect('petugas_control/index','refresh');

		// $hasil = $this->user_model->delete($id_user);
		// if($hasil)
		// {

		// }
		// else
		// {

		// }
		// redirect('petugas_control/index','refresh');
	}

	public function reset_password($id_user)
	{
		$data = array(
			'password'	=> md5('12345')
        );

		$this->user_model->update($data,$id_user);

		echo "<script>
				alert('Reset password petugas berhasil dilakukan. Password default petugas 12345');
				</script>";
		
		redirect('petugas_control/index','refresh');
	}
}