<?php
 
class Pesan_model extends CI_Model {
 	function __construct() {
 		parent::__construct();
	 
	}

	public function show_pesan_masuk()
	{
		$db = new PDO('mysql:host=localhost;dbname=smsdb;charset=utf8', 'root', '');
		$result = $db->query("SELECT * FROM inbox ORDER BY ReceivingDateTime DESC");

        return $result;
	}

	public function show_pesan_terkirim()
	{
		$db = new PDO('mysql:host=localhost;dbname=smsdb;charset=utf8', 'root', '');
		$result = $db->query("SELECT * FROM sentitems ORDER BY SendingDateTime DESC");

        return $result;
	}

	public function kirim_pesan($no_tujuan, $isi_pesan)//BELOM JADI
	{
		$db = new PDO('mysql:host=localhost;dbname=smsdb;charset=utf8', 'root', '');
		$result = $db->exec("SELECT (DestinationNumber,
        TextDecoded) FROM outbox");
        // $result = $db->exec("INSERT INTO outbox (DestinationNumber,
        // TextDecoded) VALUES ('".$_POST['nohp']."', '".$_POST['pesan']."')");
        return $result;
	}
}