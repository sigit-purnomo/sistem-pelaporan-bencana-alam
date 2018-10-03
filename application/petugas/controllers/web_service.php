<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Web_service extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('bencana_model');
        $this->load->model('posko_model');
        
    }	

    /* ------ LOGIN CONTROL --------*/
    function login2($username, $password)
    {
        $result = $this->user_model->login4($username, $password);

        $data = json_encode($result);

        header('HTTP/1.1: 200');
        header('Status: 200');
        header('Content-Length: '.strlen($data));
        exit($data);
    }

    function login3($username, $password)
    {
        $result = $this->user_model->login3($username, $password);

        $data = json_encode($result);

        header('HTTP/1.1: 200');
        header('Status: 200');
        header('Content-Length: '.strlen($data));
        exit($data);
    }


    /* ------ PETUGAS CONTROL --------*/
    function show_all_pegawai(){
        $petugas = $this->user_model->show2();
        $data = json_encode($petugas);

        header('HTTP/1.1: 200');
        header('Status: 200');
        header('Content-Length: '.strlen($data));
        exit($data);
    }

    function show_all_pegawai_relawan(){
        $petugas = $this->user_model->show3();
        $data = json_encode($petugas);

        header('HTTP/1.1: 200');
        header('Status: 200');
        header('Content-Length: '.strlen($data));
        exit($data);
    }

    function search_pegawai($cari){
        $petugas = $this->user_model->search_by2($cari);
        $data = json_encode($petugas);

        header('HTTP/1.1: 200');
        header('Status: 200');
        header('Content-Length: '.strlen($data));
        exit($data);
    }

    function search_no_hp_pegawai($cari){
        $no_hp = $this->user_model->search_no_hp_by_id_user($cari);
        $data = json_encode($no_hp);

        header('HTTP/1.1: 200');
        header('Status: 200');
        header('Content-Length: '.strlen($data));
        exit($data);
    }

    /* ------ BENCANA CONTROL --------*/
    function show_all_bencana(){
        // mengambil data mahasiswa dari database
        $bencana = $this->bencana_model->show();
        $data = json_encode($bencana);

        header('HTTP/1.1: 200');
        header('Status: 200');
        header('Content-Length: '.strlen($data));
        exit($data);
    }
    function search_bencana($cari){
        $bencana = $this->bencana_model->search_bencana_by_id_bencana($cari);
        $data = json_encode($bencana);

        header('HTTP/1.1: 200');
        header('Status: 200');
        header('Content-Length: '.strlen($data));
        exit($data);
    }


    /* ------ POSKO CONTROL --------*/
    function show_all_posko(){
        $posko = $this->posko_model->show();
        $data = json_encode($posko);

        header('HTTP/1.1: 200');
        header('Status: 200');
        header('Content-Length: '.strlen($data));
        exit($data);
    }
    function search_posko($cari){
        $posko = $this->posko_model->search_posko_by_id_posko($cari);
        $data = json_encode($posko);

        header('HTTP/1.1: 200');
        header('Status: 200');
        header('Content-Length: '.strlen($data));
        exit($data);
    }
}