<?php
class M_relawan extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='user';
    $this->_tabPos='posisi';
    //get instance
    $this->CI = get_instance();
  }
	public function get_relawan_flexigrid()
  {
        //Build contents query
        $this->db->select('id_user, nama_lengkap, username, no_hp')->from($this->_table);
        $this->db->where('id_role', 3);
        $this->db->where('status', 0);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_user) as record_count")->from($this->_table);        
        $this->db->where('id_role', 3);
         $this->db->where('status', 0);
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
  }
  
    function insertrelawan($data)
    {
      $this->db->insert($this->_table, $data);
    }

    function getrelawan($id){
      return $this->db->get_where($this->_table,array('id_user' => $id))->row();
    }
    function getiduser($nohp){
     $this->db->select('id_user')->from($this->_table);
        $this->db-> where('no_hp', $nohp);
        $query = $this->db->get();
        return $query->row();
    }
    
    
    function deleterelawan($id,$data)
    {
      $this->db->where('id_user', $id);
      $this->db->update($this->_table,$data);
    }
    
    function updaterelawan($where, $data)
    {
      $this->db->where('id_user',$where);
      $this->db->update($this->_table, $data);
      return $this->db->affected_rows();
    }
    

      function getAll(){
        $this->db->select('nama_relawan as nama, coordinate as peta')->from($this->_table);
        $q = $this->db->get();
        return $q->result();
      }

       public function showall_relawan(){
    $this->db->select('id_user,username,no_hp,nama_lengkap,status,id_role');
    $this->db->where('status', 0);
    $this->db->where('id_role', 3);
    $this->db->from('user');
    $query = $this->db->get();
    return $query->result();
    }

    public function show_relawanpos(){
   $query= $this->db->query('SELECT user.id_user as id_user, user.username as username,user.no_hp AS no_hp, user.nama_lengkap AS nama_lengkap, user.status AS status, user.id_role AS id_role FROM user RIGHT JOIN posisi  using (id_user) where user.status=0 AND user.id_role=3 GROUP BY user.id_user');

    return $query->result();
    }

  public function showreg_relawan(){
    $this->db->select('id_user,username,nama_lengkap,id_role,reg_id');
    $this->db->where('status', 0);
    $this->db->where('id_role', 3);
    $this->db->from('user');
    $query = $this->db->get();
    return $query->result();
    }
    

     function insertPosisi($data)
  {
     $this->db->limit(1);
     $this->db->insert($this->_tabPos, $data);

      if($this->db->affected_rows()>0){
            return 1;
        }else{
            return 0;
        }
    }
    public function jamgawat($id_user){
      $query = $this->db->query("SELECT TIMESTAMPDIFF(Hour,max(waktu_update),CURRENT_TIMESTAMP) as jam FROM `posisi` WHERE status=1 and id_user=".$id_user.";");
          $hasil= $query->result();
           $array = json_decode(json_encode($hasil),true);
            $jam=100;
          if($array!=0)
          {
            foreach ($array as $key) {
                foreach ($key as $attribute => $value) {
                    if ($attribute =='jam')
                    {
                         $jam= $value;    
                    }
                   
                }
            }
          }
          return $jam;
    }
       public function janganubahgawat($id_user,$waktu_update){
        //untuk dapat mengubah status gawat setelah 12 jam
     $query = $this->db->query("SELECT max(id_posisi) as id_posisi  FROM posisi WHERE id_user=".$id_user.";");
        $hasil= $query->result();
        $jam=0;
        if($query->num_rows()!=0)
        {
              $array = json_decode(json_encode($hasil),true);
        
          $id_posisi="";
          $status="";
          if($array!=0)
          {
            foreach ($array as $key) {
                foreach ($key as $attribute => $value) {
                    if ($attribute =='id_posisi')
                    {
                         $id_posisi= $value;    
                    }
                    
                }
            }
          }
          $query = $this->db->query("SELECT TIMESTAMPDIFF(Hour,waktu_update,'".$waktu_update."') as jam,status FROM `posisi` WHERE id_posisi=".$id_posisi.";");
          $hasil= $query->result();
           $array = json_decode(json_encode($hasil),true);
            
          if($array!=0)
          {
            foreach ($array as $key) {
                foreach ($key as $attribute => $value) {
                    if ($attribute =='jam')
                    {
                         $jam= $value;    
                    }
                     if ($attribute =='status')
                    {
                         $status= $value;    
                    }
                }
            }
          }
         
          if($status==1&&$jam<=12)
            return 1;
          else
            return 0;
        }
        else return 0;

    }
    
   
  
   
}
?>