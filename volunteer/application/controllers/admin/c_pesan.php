 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_pesan extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');        
	$this->load->model('admin/m_pesan');

        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
    }

     function index(){
		if($this->session->userdata('logged_in'))
		{
                       
                      $json_url   = "http://alert.id/disaster/volunteer/api/user/showreg_relawan";
                      $json         = file_get_contents($json_url);
                      $result       = json_decode($json, true);
                      $data['Hasil']        = $result['result'];
		      $data['page_title']        = 'Pemberitahuan';
		      $data['notice_class'] = 'none';
		      $data['notice']       = '';
		            if ($this->session->userdata('notice') != '') {
		                $data['notice_class'] = '';
		                $data['notice']       = $this->session->userdata('notice');
		            }
			$this->session->unset_userdata('notice');
		      $data['content'] = $this->load->view('petugas/v_pesan', $data, TRUE);
                      $this->load->view('v_utama', $data);
		}else
			redirect('c_login', 'refresh');   
        	
    }

     public function form()
    {
        
        $action   = $this->input->post('action');
        $pilihan  = 1;
        $massal   = $this->input->post('massal');

        $tujuan= $this->input->post('penerima');

     
	$pushMessage   = $this->input->post('pesan');
    	$messageSender = $this->input->post('pesan');

	$reg_id = [];
	$result = [];

		 $ids = explode(",", $this->input->post('data_reg'));
		
		for($i=0; $i<count($ids);$i++)
		{
			// added by Vincent
			if($ids[$i] !== '') 
                     		array_push($reg_id, $ids[$i]);
		}
		
		$reg_id = implode(",", $reg_id);

		$reg_id = explode(",", $reg_id);
	
        if ($action == 'Kirim Pesan') {
            $notice                  = '';
	    $jum                     = 0;
            $data['class']           = '1';
           
            $data['delivery_report'] = 'yes';
            $data['coding']          = 'default';
            
            $data['url']             = '';
            
	  // added by Vincent

		if ($reg_id != '') {		

			$message = array(
					"message" => $pushMessage,
					"sender"=>$messageSender);
				
				foreach($reg_id as $things=> $value)
				{
					if($value != '')	
					{
						$hasil = $this->m_pesan->sendMessageThroughGCM($value, $message); 
						//$result = explode("/", $hasil);
						$jum++; 
					}
				}
	
			   $notice = '<div class="nNote nSuccess hideit">
	                        <p><i class="fa-check-circle" style=""></i>
	                        <strong>Berhasil : </strong> Pesan telah berhasil dikirim.</p>
	                        </div>';
	                $this->session->set_userdata('notice',  $notice); 
	                 redirect('admin/c_pesan');     
		}
		else 
		{       
			$notice .= '<div class="nNote nWarning hideit">
                        <p><i class="fa-exclamation-triangle" style=""></i>
                        <strong>Kesalahan : </strong> Data tidak valid. Silakan periksa kembali.</p>
                        </div>';
			$this->session->set_userdata('notice', $notice);
            		redirect('admin/c_pesan');
		}
        }
        
        
    }
	
     
     
}
?>