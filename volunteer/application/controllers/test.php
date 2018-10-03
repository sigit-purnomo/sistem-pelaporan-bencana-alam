<?php
class Test extends CI_Controller{
 
    function __construct(){
        parent::__construct();
        $this->load->helper(array('datagrid','url'));
        $this->Datagrid = new Datagrid('users','id');
    }
     
    function index(){
        $this->load->helper('form');
        $this->load->library('session');
 
        $this->Datagrid->hidePkCol(true);
        $this->Datagrid->setHeadings(array('email'=>'E-mail'));
        $this->Datagrid->ignoreFields(array('password'));
         
        if($error = $this->session->flashdata('form_error')){
            echo "<font color=red>$error</font>";
        }
        echo form_open('test/proc');
        echo $this->Datagrid->generate();
        echo Datagrid::createButton('delete','Delete');
        echo form_close();
    }
     
    function proc($request_type = ''){
        $this->load->helper('url');
        if($action = Datagrid::getPostAction()){
            $error = "";
            switch($action){
                case 'delete' :
                    if(!$this->Datagrid->deletePostSelection()){
                        $error = 'Items could not be deleted';
                    }
                break;
            }
            if($request_type!='ajax'){
                $this->load->library('session');
                $this->session->set_flashdata('form_error',$error);
                redirect('test/index');
            } else {
                echo json_encode(array('error' => $error));
            }
        } else {
            die("Bad Request");
        }
    }
 
}
?>