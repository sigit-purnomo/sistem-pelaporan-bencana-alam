<?php
class M_petugas extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='user';
    $this->_tabPos='posisi';
	
    //get instance
    $this->CI = get_instance();
  }
	public function get_petugas_flexigrid()
    {
        //Build contents query
        $this->db->select('id_user,nama_lengkap,username,no_hp')->from($this->_table);
        $this->db-> where('id_role', 2);
        $this->db-> where('status', 0);
       $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_user) as record_count")->from($this->_table);
        $this->db-> where('id_role', 2); 
        $this->db-> where('status', 0);     
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
  function insertPetugas($data)
  {
    $this->db->insert($this->_table, $data);
  }
  
  function deletepetugas($id,$data)
  {
      $this->db->where('id_user', $id);
      $this->db->update($this->_table,$data);
  }

  function getPet($id){
      return $this->db->get_where($this->_table,array('id_user' => $id))->row();
    }

    function updatepetugas($where, $data)
    {
      $this->db->where('id_user',$where);
      $this->db->update($this->_table, $data);
      return $this->db->affected_rows();
    }
function isduplicate($username)
    {
        $this->db->select('username')->from($this->_table);
        $this->db-> where('username', $username);
        $this->db->where('status', 0);
        $query = $this->db->get();
        return $query->num_rows();

    }
    function isduplicateubah($username,$id)
    {
        $this->db->select('username')->from($this->_table);
        $this->db-> where('username', $username);
        $this->db->where('status', 0);
        $this->db-> where('id_user !=', $id);
        $query = $this->db->get();
        return $query->num_rows();

    }
    function isduplicatehp($no_hp)
    {
        $this->db->select('no_hp')->from($this->_table);
        $this->db-> where('no_hp', $no_hp);
        $this->db->where('status', 0);
        $query = $this->db->get();
        return $query->num_rows();

    }
    function isduplicatehpubah($no_hp,$id)
    {
        $this->db->select('no_hp')->from($this->_table);
        $this->db-> where('no_hp', $no_hp);
        $this->db->where('status', 0);
        $this->db-> where('id_user !=', $id);
        $query = $this->db->get();
        return $query->num_rows();

    }
    // function getAll(){
    //     $this->db->select('user.nama_lengkap as nama,user.no_hp as nohp,posisi.waktu_update as waktu, posisi.status as sta, posisi.latitude as lat, posisi.longitude as lon')->from($this->_tabPos);
    //     $this->db->join('user','user.id_user = posisi.id_user');
    //     $this->db->where('user.status',0);
    //     $this->db->order_by('posisi.waktu_update', 'desc');
    //     $q = $this->db->get();
    //     return $q->result();
    //   }
     
  function getAll(){
    $q=$this->db->query('SELECT DISTINCT posisi.id_user as id_user,TIMESTAMPDIFF(Hour,posisi.waktu_update,CURRENT_TIMESTAMP) as jam ,user.nama_lengkap as nama,user.no_hp as nohp,posisi.waktu_update as waktu, posisi.status as sta, posisi.latitude as lat, posisi.longitude as lon, posisi.altitude as alt FROM
posisi JOIN (
  SELECT id_user, MAX(waktu_update) waktu_update
  FROM posisi
  GROUP BY id_user
  ) max_date USING (id_user,waktu_update) JOIN user using (id_user)
  WHERE user.status =0 AND user.id_role=3;');

         return $q->result();
  }

  function markerAll(){
    $q=$this->db->query('SELECT DISTINCT posisi.id_user as id_user,TIMESTAMPDIFF(Hour,posisi.waktu_update,CURRENT_TIMESTAMP) as jam ,user.nama_lengkap as nama,user.no_hp as nohp,posisi.waktu_update as waktu, posisi.status as sta, posisi.latitude as lat, posisi.longitude as lon FROM posisi JOIN ( SELECT id_user, Max(waktu_update) waktu_update FROM posisi where posisi.status=1 GROUP BY id_user ) max_date USING (id_user,waktu_update) JOIN user using (id_user) WHERE user.status =0 AND user.id_role=3 and posisi.status=1;');

         return $q->result();
  }
    function getsearchby2($id_user,$tgl){
      $format='%d-%m-%Y %H:%i';
    $q=$this->db->query('SELECT DISTINCT posisi.id_user as id_user,TIMESTAMPDIFF(Hour,posisi.waktu_update,CURRENT_TIMESTAMP) as jam ,user.nama_lengkap as nama,user.no_hp as nohp,posisi.waktu_update as waktu, posisi.status as sta, posisi.latitude as lat, posisi.longitude as lon FROM
posisi JOIN (
  SELECT id_user, MAX(waktu_update) waktu_update
  FROM posisi
  GROUP BY id_user
  ) max_date USING (id_user,waktu_update) JOIN user using (id_user)
  WHERE user.status =0 AND user.id_user= ? AND posisi.waktu_update > STR_TO_DATE(?,?);',array($id_user,$tgl,$format));

         return $q->result();
  }
   function getsearchbyid($id_user){
    $q=$this->db->query('SELECT DISTINCT posisi.id_user as id_user,TIMESTAMPDIFF(Hour,posisi.waktu_update,CURRENT_TIMESTAMP) as jam ,user.nama_lengkap as nama,user.no_hp as nohp,posisi.waktu_update as waktu, posisi.status as sta, posisi.latitude as lat, posisi.longitude as lon FROM
posisi JOIN (
  SELECT id_user, MAX(waktu_update) waktu_update
  FROM posisi
  GROUP BY id_user
  ) max_date USING (id_user,waktu_update) JOIN user using (id_user)
  WHERE user.status =0 AND user.id_user= ? ;',array($id_user));

         return $q->result();
  }
   function getsearchbytgl($tgl){
    $format='%d-%m-%Y %H:%i';
    $q=$this->db->query('SELECT DISTINCT posisi.id_user as id_user,TIMESTAMPDIFF(Hour,posisi.waktu_update,CURRENT_TIMESTAMP) as jam ,user.nama_lengkap as nama,user.no_hp as nohp,posisi.waktu_update as waktu, posisi.status as sta, posisi.latitude as lat, posisi.longitude as lon FROM
posisi JOIN (
  SELECT id_user, MAX(waktu_update) waktu_update
  FROM posisi
  GROUP BY id_user
  ) max_date USING (id_user,waktu_update) JOIN user using (id_user)
  WHERE user.status =0 AND posisi.waktu_update > STR_TO_DATE(?,?);',array($tgl,$format));

         return $q->result();
  }
  
   public function resetpass($id)  
    {  

            
            if($this->db->query('update user set password=md5("monitoring") where id_user='.$id.'')){
                return TRUE;
            }else{
                return FALSE;
            }
    }
}
?>