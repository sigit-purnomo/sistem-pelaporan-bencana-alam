<?php
class M_pesan extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='user';
    $this->_tabPos='posisi';
    //get instance
    $this->CI = get_instance();
  }
	  
    function insertrelawan($data)
    {
      $this->db->insert($this->_table, $data);
    }

    function getrelawan($id){
      return $this->db->get_where($this->_table,array('id_user' => $id))->row();
    }

    function getregid($id){
     $this->db->select('reg_id')->from($this->_table);
        $this->db-> where('id_user', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function sendMessageThroughGCM($registatoin_ids, $message) {
		//Google cloud messaging GCM-API url
	
        $url = 'https://gcm-http.googleapis.com/gcm/send';
        $fields = array(
            'to' => $registatoin_ids,
            'data' => $message,
        );
       // return print json_encode($fields);
		// Update your Google Cloud Messaging API Key
		define("GOOGLE_API_KEY", "AIzaSyADX7xuxdzWujwA5yOEVqsj-PQZrrlWvx4"); 		
        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);	
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);				
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
     
}
?>