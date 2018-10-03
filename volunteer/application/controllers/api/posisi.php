<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
class Posisi extends REST_Controller
{
	public function __construct(){
        parent::__construct();
       
    
    }

  
    public function insert_posisi_post(){
        $this->load->model(array('admin/m_relawan'));
        $input = array(
            'longitude' => $this->post('longitude'),
            'latitude' => $this->post('latitude'),
            'waktu_update' => $this->post('waktu_update'),
            'id_user' => $this->post('id_user'),
            'status' => $this->post('status'));
      
        $pos = $this->m_relawan->insertPosisi($input);

       
        if($pos == 1){
            $this->response(array('status' => 'success'), 200); 
        } else{
            
            $this->response(array('status' => 'failed'), 400);
        }
    }

	public function insert_posisiAR_post(){
        $this->load->model(array('admin/m_relawan'));
        $input = array(
            'longitude' => $this->post('longitude'),
            'latitude' => $this->post('latitude'),
            'waktu_update' => $this->post('waktu_update'),
            'id_user' => $this->post('id_user'),
            'status' => $this->post('status'));
      
        $pos = $this->m_relawan->insertPosisi($input);

       
        if($pos == 1){
           $response["message"]=1;
        } else{
            $response["message"]=0;
        }
        $response = json_encode($response);
        echo $response;
    }
    
     public function showall_posisi_get(){

 	$this->load->model(array('admin/m_petugas'));
	  $pos = $this->m_petugas->getAll();
	
	$response["tbl_lokasi"]= $pos;
       
	$response = json_encode($response); 
	echo $response; 
    }

     public function ubahgawat_get($id_user,$waktu_update){
         $this->load->model(array('admin/m_relawan'));
        return $this->m_relawan->janganubahgawat($id_user,$waktu_update);
    }
    
}