<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
class User extends REST_Controller
{
	public function __construct(){
        parent::__construct();
       
    $this->load->model(array('m_login'));
    }

    public function login_post(){
         
		$input = array(
        'username' => $this->post('username'),
        'password' => $this->post('password'));
		
		$usr = $this->m_login->login_api($input);
        
		if($usr != FALSE) {
            $this->response($usr, 200); 
        }else{
            $this->response(array('message' => 'not valid'), 400);
        }
}
	
public function loginAR_post(){
         
		$input = array(
        'username' => $this->post('username'),
        'password' => $this->post('password'));
		
		$usr = $this->m_login->login_api($input);                                             
        
		if($usr != FALSE) {
           $response["result"]=$usr;
           $response["message"]=1;
        }else{
            $response["message"]=0;
        }

        $response = json_encode($response);
        echo $response;
}

    public function update_password_post(){
        
        $input = array(
        'id_user' => $this->post('id_user'),
         'passbaru' => $this->post('passbaru'),
          'passlama' => $this->post('passlama'));
        
        $usr = $this->m_login->update_password($input);
        $response["message"]=$usr;
        $response = json_encode($response);
        echo $response;
    }

public function update_regid_post(){
        
        $input = array(
        'id_user' => $this->post('id_user'),
         'reg_id' => $this->post('reg_id'));
        
        $usr = $this->m_login->update_regis($input);
        $response["message"]=$usr;
        $response = json_encode($response);
        echo $response;
    }

     public function showall_relawan_get(){
         $this->load->model(array('admin/m_relawan'));
        $usr = $this->m_relawan->showall_relawan();
       if($usr){
            $this->response($usr, 200);
        } else{
            $this->response(array('error' => 'not found!'), 404);
        }   
    }

 public function showreg_relawan_get(){
         $this->load->model(array('admin/m_relawan'));
        $usr = $this->m_relawan->showreg_relawan();
       if($usr){
            $this->response($usr, 200);
        } else{
            $this->response(array('error' => 'not found!'), 404);
        }   
    }

    public function show_relawanpos_get(){
         $this->load->model(array('admin/m_relawan'));
        $usr = $this->m_relawan->show_relawanpos();
       if($usr){
            $this->response($usr, 200);
        } else{
            $this->response(array('error' => 'not found!'), 404);
        }   
    }
       public function iduser_get($nohp){
        $keyword = urldecode($nohp);
         $this->load->model(array('admin/m_relawan'));
        $usr = $this->m_relawan->getiduser($keyword);
       
       if($usr){
            $this->response($usr);
        } else{
            $this->response(array('id_user' => '-1'));
        }   
    }
  
}