<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class C_relawan extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');        
        $this->load->model('admin/m_relawan');
        $this->load->model('admin/m_petugas');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    function index(){
		if($this->session->userdata('logged_in'))
		{
			$this->lists();
		}else
			redirect('c_login', 'refresh');   
        	
    }
  

    function reset_relawan($id_user){
        if($this->session->userdata('logged_in'))
        {
           $this->m_petugas->resetpass($id_user);
            
        }else
            redirect('c_login', 'refresh');
    }
    function lists() {
        if($this->session->userdata('logged_in')){
            $colModel['id_user'] = array('ID',40,TRUE,'center',2);  
            $colModel['nama_lengkap'] = array('Nama',150,TRUE,'left',2);
            $colModel['username'] = array('Username',120,TRUE,'left',2);
            $colModel['no_hp'] = array('Nomor HP',120,TRUE,'left',2);
            $colModel['aksi'] = array('Aksi',150,FALSE,'center',0);
            
            //Populate flexigrid buttons..
            $buttons[] = array('Tandai Semua','check','btn');
            $buttons[] = array('separator');
            $buttons[] = array('Hapus Semua Tanda','uncheck','btn');
            $buttons[] = array('separator');
            $buttons[] = array('Tambah Relawan','add','btn');
            $buttons[] = array('separator');
            $buttons[] = array('Hapus Relawan','delete','btn');
            $buttons[] = array('separator');
                
            $gridParams = array(
                'height' => 350,
                'rp' => 10,
                'rpOptions' => '[10,20,30,40]',
                'pagestat' => 'Displaying: {from} to {to} of {total} items.',
                'blockOpacity' => 0.5,
                'title' => '',
                'showTableToggleBtn' => false,

           );

            $grid_js = build_grid_js('flex1',site_url('admin/c_relawan/load_data'),$colModel,'id_user','asc',$gridParams,$buttons);

            $data['js_grid'] = $grid_js;

            $data['page_title'] = 'Pengelolaan Data Relawan';

            $data['content'] = $this->load->view('relawan/v_list', $data, TRUE);
            $this->load->view('v_utama', $data);
        }else{
            redirect('c_login','refresh');
        }
    }

    function load_data() {	
        if($this->session->userdata('logged_in')){
            $this->load->library('flexigrid');
            $valid_fields = array('id_user','nama_lengkap','username','no_hp');

            $this->flexigrid->validate_post('id_user','ASC',$valid_fields);
            $records = $this->m_relawan->get_relawan_flexigrid();
            $this->output->set_header($this->config->item('json_header'));
        
            $record_items = array();
            
            foreach ($records['records']->result() as $row)
            {
                $record_items[] = array(
                    $row->id_user,
                    $row->id_user,
                    $row->nama_lengkap,
                    $row->username,
                    $row->no_hp,
                    '<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="editrelawan(\''.$row->id_user.'\')"/><i class="fa fa-pencil"></i></button>
                     <button type="submit" class="btn btn-default btn-xs" title="Reset Password Relawan" onclick="reset_relawan(\''.$row->id_user.'\')"/>Reset Password</i></button>'
                );  
            }
            //Print please
            $this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
        }else{
            redirect('c_login','refresh');
        }
		
    }
    function add(){
       if($this->session->userdata('logged_in'))
       {           
            $data['page_title'] = 'Tambah Relawan';
            $data['content'] = $this->load->view('relawan/v_tambah', $data, TRUE);
        
            $this->load->view('v_utama', $data);
        }else
            redirect('c_login', 'refresh'); 
    }
function isduplicate($username)
    {
        
         if ($this->m_petugas->isduplicate($username) == 1)
        {
            $this->form_validation->set_message('isduplicate', 'Username telah digunakan.');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
     function isduplicateubah($username)
    {
        
         if ($this->m_petugas->isduplicateubah($username,$this->input->post('id_user')) == 1)
        {
            $this->form_validation->set_message('isduplicateubah', 'Username telah digunakan.');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
     function isduplicatehp()
    {
        $no_hp ='+62'.$this->input->post('no_hp');
        
         if ($this->m_petugas->isduplicatehp($no_hp) >= 1)
        {
            $this->form_validation->set_message('isduplicatehp', 'Nomor hp telah digunakan.');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function isduplicatehpubah()
    {
        
         if ($this->m_petugas->isduplicatehpubah('+62'.$this->input->post('no_hp'),$this->input->post('id_user')) >= 1)
        {
            $this->form_validation->set_message('isduplicatehpubah', 'Nomor hp telah digunakan.');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    function simpan_relawan() {
        if($this->session->userdata('logged_in'))
        {
            $nama_lengkap = $this->input->post('nama_lengkap', TRUE);
            $username = $this->input->post('username',TRUE);
            $no_hp = $this->input->post('no_hp',TRUE);
            $password = 'monitoring';
            $status = 0;
            $id_role = 3; 
            
            $this->form_validation->set_rules('nama_lengkap', 'Nama Petugas', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required|callback_isduplicate|min_length[6]');
            $this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'required|callback_isduplicatehp');

            if ($this->form_validation->run() == TRUE)
            {      
                $data = array(
                    'nama_lengkap' => $nama_lengkap,
                    'username' => $username,
                    'no_hp' => '+62'.$no_hp,
                    'password' => MD5($password),
                    'status' => $status, 
                    'id_role' => $id_role
                );
                $this->m_relawan->insertrelawan($data);
                
                redirect('admin/c_relawan','refresh');
            }
            else $this->add();
        }else{
            redirect('c_login','refresh');
        }
    }
    function edit($id_user){
        if($this->session->userdata('logged_in'))
        {
            $data['data_petugas'] = $this->m_relawan->getrelawan($id_user);
            $data['id_user'] = $id_user;

            $data['page_title'] = 'Ubah Data Relawan';
            $data['content'] = $this->load->view('relawan/v_ubah', $data, TRUE);
                                
            $this->load->view('v_utama', $data);
            //echo json_encode($data['coord_kecamatan']);
        }else
            redirect('c_login', 'refresh');
    }

    function update_relawan(){
        if($this->session->userdata('logged_in'))
        {
            $id_user = $this->input->post('id_user', TRUE);
            $nama_lengkap = $this->input->post('nama_lengkap', TRUE);
            $username = $this->input->post('username',TRUE);
            $no_hp = $this->input->post('no_hp',TRUE);
        
            $status = 0;
            $no_hp="+62".$no_hp;
            $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required|callback_isduplicateubah|min_length[6]');
            $this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'required|callback_isduplicatehpubah');

            if ($this->form_validation->run() == TRUE)
            {
                $data = array(
                     'nama_lengkap' => $nama_lengkap,
                    'username' => $username,
                    'no_hp' => $no_hp,
                   
                );
        
               $result = $this->m_relawan->updaterelawan($id_user, $data);
                if($result>0){
                redirect('admin/c_relawan','refresh');
                }else{
                   redirect('admin/c_relawan','refresh');
                }
            }
            else $this->edit($id_user);
        }else{
            redirect('c_login','refresh');
        }
        
    }
    function delete()    {
        if($this->session->userdata('logged_in'))
        {
            $post = $this->input->post('items');
            $status = 1;
            $data = array(
                    'status' => $status
                );
                $this->m_relawan->deleterelawan($post,$data);          
                redirect('admin/c_relawan', 'refresh');
        }else{
            redirect('c_login','refresh');
        }
        
    }
}
?>