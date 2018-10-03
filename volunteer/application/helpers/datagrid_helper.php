class Datagrid{
     
    private $hide_pk_col = true;
    private $hide_cols = array();
    private $tbl_name = '';
    private $pk_col = '';
    private $headings = array();
    private $tbl_fields = array();
     
    function __construct($tbl_name, $pk_col = 'id'){
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->tbl_fields = $this->CI->db->list_fields($tbl_name);
        if(!in_array($pk_col,$this->tbl_fields)){
            throw new Exception("Primary key column '$pk_col' not found in table '$tbl_name'");
        }
        $this->tbl_name = $tbl_name;
        $this->pk_col = $pk_col;
        $this->CI->load->library('table');
         
    }
     
    public function setHeadings(array $headings){
        $this->headings = array_merge($this->headings, $headings);
    }
     
    public function hidePkCol($bool){
        $this->hide_pk_col = (bool)$bool;
    }
     
    public function ignoreFields(array $fields){
        foreach($fields as $f){
            if($f!=$this->pk_col)
                $this->hide_cols[] = $f;
        }
    }
     
    private function _selectFields(){
        foreach($this->tbl_fields as $field){
            if(!in_array($field,$this->hide_cols)){
                $this->CI->db->select($field);
                // hide pk column heading?
                if($field==$this->pk_col && $this->hide_pk_col) continue;
                $headings[]= isset($this->headings[$field]) ? $this->headings[$field] : ucfirst($field);
            }
        }
        if(!empty($headings)){
            // prepend a checkbox for toggling 
            array_unshift($headings,"<input type='checkbox' class='dg_check_toggler'>");
            $this->CI->table->set_heading($headings);
        }
         
    }
     
    public function generate(){
        $this->_selectFields();
        $rows = $this->CI->db
                ->from($this->tbl_name)
                ->get()
                ->result_array();
        foreach($rows as &$row){
            $id = $row[$this->pk_col];
             
            // prepend a checkbox to enable selection of items
            array_unshift($row, "<input class='dg_check_item' type='checkbox' name='dg_item[]' value='$id' />");
             
            // hide pk column?
            if($this->hide_pk_col){
                unset($row[$this->pk_col]);
            }
        }
         
        return $this->CI->table->generate($rows);
    }
     
    public static function createButton($action_name, $label){
        return "<input type='submit' class='$action_name' name='dg_action[$action_name]' value='$label' />";
    }
     
    public static function getPostAction(){
    // get name of submitted action (if any)
        if(isset($_POST['dg_action'])){
            return key($_POST['dg_action']);
        }
    }
     
    public static function getPostItems(){
        if(!empty($_POST['dg_item'])){
            return $_POST['dg_item'];
        }
        return array();
    }
     
    public function deletePostSelection(){
    // remove selected items from the db
        if(!empty($_POST['dg_item']))
            return $this->CI->db
                ->from($this->tbl_name)
                ->where_in($this->pk_col,$_POST['dg_item'])
                ->delete();
    }
 
}