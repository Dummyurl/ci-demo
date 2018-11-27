<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Query_model extends CI_Model {
	
	private $iv = 'K5VkNdbZWrfxWRuZ'; 
	private $key = 'o0ggFE2fNHwqwukK'; 
	
	function Query_model()
	{
		//header('Content-Type: text/html; charset=utf-8');
		//date_default_timezone_set('America/Denver');
		//date_default_timezone_set('UTC');
		//define("DATETIME", date('Y-m-d H:i:s')); //DEFINE DATETIME GLOBAL
		//define("DATE", date('Y-m-d')); //DEFINE DATETIME GLOBAL
		//ini_set('memory_limit', '512M'); //-1 unlimited
		//$this->certificate_path = APPPATH . "/libraries/apns/apns-cert.pem"; // production only
		//$this->apns_host = 'ssl://gateway.push.apple.com:2195'; // production only
	}

	public function select_max_id(){
		$last_row=$this->db->select('g_id')->order_by('user_id',"desc")->limit(1)->get('tbl_users')->row();
		if ($last_row) {
			return $last_row->g_id;
		}
	}

	public function check_where_row($table,$where){
		$sql = $this->db->get_where($table,$where);
		return $sql->num_rows();
	}

	//All Array
	public function select_all($table){
		$result = $this->db->get($table);
		return $result->result_array();
	}
	public function select_where($table,$where){
		$result = $this->db->get_where($table,$where);
		return $result->result_array();
	}

	//Row
	public function select_row($table){
		$result = $this->db->get($table);
		return $result->row_array();
	}
	public function select_where_row($table,$where){
		$this->db->where($where);
		$result = $this->db->get($table);
		return $result->row_array();
	}

	//Limit
	public function select_limit($table, $limit, $start){
		$this->db->limit($limit, $start);
		$result = $this->db->get($table);
		return $result->result_array();
	}
	public function select_where_limit($table,$where, $limit, $start){
		$this->db->limit($limit, $start);
		$result = $this->db->get_where($table,$where);
		return $result->result_array();
	}

	//Increment Decrement
	public function increment($table,$where,$inc,$what) {
		$this->db->where($where);
		$this->db->set($what, $what.'+'.$inc, FALSE);
		$this->db->update($table);
		return true;
	}
	public function decrement($table,$where,$inc,$what) {
		$this->db->where($where);
		$this->db->set($what, $what.'-'.$inc, FALSE);
		$this->db->update($table);
		return true;
	}

	//Num Rows
	public function num_row($table){
		$result = $this->db->get($table);
		return $result->num_rows();
	}
	public function num_where_row($table,$where){
		$result = $this->db->get_where($table,$where);
		return $result->num_rows();
	}

	//Insert Update Delete
	public function ins($table,$where){
		if($this->db->insert($table,$where)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	public function updt($table,$what,$where){
		$this->db->where($where);
		$this->db->update($table,$what);
	}
	public function dlt($table,$where)
	{
		$this->db->delete($table,$where);
	}

	public function SelectQuery($sql) {
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	public function SelectRawQuery($sql) {
		$result = $this->db->query($sql);
		return $result->row_array();
	}

	public function upload($tbl,$a){
		$this->db->insert($tbl,$a);
		return;
	}

//	====================================================================================================================

	public function rawSelectQuery($sql) {
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	public function singlerawSelectQuery($sql) {
		$result = $this->db->query($sql);
		return $result->row_array();
	}

	public function sum_where($table,$field,$where){
		$this->db->where($where);
		$this->db->select_sum($field);
		$result = $this->db->get($table);
		return $result->result_array();
	}

	public function select_field_where($table,$field,$where){
		$this->db->where($where);
		$this->db->select($field);
		$result = $this->db->get($table);
		return $result->result_array();
	}

	public function sum_where_sngle($table,$where){
		$result = $this->db->get_where($table,$where);
		$data=$result->result_array();
		return $data[0];
	}

	public function sum_with_between($table,$field,$where,$field_between,$start_date,$end_date){
		$this->db->from($table);
		$this->db->where($where);
		$this->db->where($field_between.' >=', $start_date);
		$this->db->where($field_between.' <=', $end_date);
		$this->db->select_sum($field);
		$result = $this->db->get();
		return $result->result_array();
	}

	public function group_by_where($table,$where){
		$this->db->from($table);
		$this->db->where($where);
		$this->db->group_by('user_id');
		$result = $this->db->get();
		return $result->num_rows();
	}

	public function group_by_where_result($table,$where){
		$this->db->from($table);
		$this->db->where($where);
		$this->db->group_by('user_id');
		$result = $this->db->get();
		return $result->result_array();
	}

	public function group_by_where_with_field($table,$field){
		$this->db->from($table);
		$this->db->group_by($field);
		$result = $this->db->get();
		return $result->result_array();
	}

    public function group_by_where_with_field_result($table,$where,$field){
        $this->db->from($table);
        $this->db->where($where);
        $this->db->group_by($field);
        $result = $this->db->get();
        return $result->result_array();
    }

	public function sum($table,$field){
		$this->db->select_sum($field);
		$result = $this->db->get($table);
		return $result->result_array();
	}

	public function num_row_with_between($table,$where,$field_between,$start_date,$end_date){
		$this->db->from($table);
		$this->db->where($where);
		$this->db->where($field_between.' >=', $start_date);
		$this->db->where($field_between.' <=', $end_date);
		$this->db->group_by('user_id');
		$result = $this->db->get();
		return $result->num_rows();
	}

	public function select_with_between_result($table,$where,$field_between,$start_date,$end_date){
		$this->db->from($table);
		$this->db->where($where);
		$this->db->where($field_between.' >=', $start_date);
		$this->db->where($field_between.' <=', $end_date);
		$this->db->group_by('user_id');
		$result = $this->db->get();
		return $result->result_array();
	}

	public function SelectAllOrderBy($table,$key,$order_by){
		$this->db->order_by($key,$order_by);
		$result = $this->db->get($table);
		return $result->result_array();
	}


	public function select_where_filter($table,$where,$key,$order_by){
		$this->db->order_by($key,$order_by);
		$result = $this->db->get_where($table,$where);
		return $result->result_array();
	}

	public function dlt_tbl($table)
	{
		if( $this->db->table_exists($table) ){
			$query = "DROP TABLE $table;";
			$this->db->query($query);
		}
	}

	function JoinTwoTable($from,$to,$where,$key,$typ)
	{
		$this->db->select('*');
		$this->db->where($where);
		$this->db->from($from);
		$this->db->join($to,$to.$key=$from.$key,$typ);
		$result=$this->db->get();
		return $result->result_array();
	}
	
	function delete_img($data){
        $tbl = $data['tbl'];
        $select_field = $data['select_field'];
        $where_field = $data['where_field'];
        $img_path = $data['img_path'];
		
		$sql = $this->db->query("SELECT $select_field from $tbl where $where_field");
		$rows = $sql->result();
        foreach ($rows as $p) {
            foreach ($img_path as $unlinks) {
                $path = $unlinks . '/' . $p->$select_field;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }
       // return true;
	}

	function encryptdfg( $q ) {
		$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
		$qEncoded  = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
		return( $qEncoded );
	}
	
	function encryptCryptParam($str, $isBinary = false)
    {
        $iv = $this->iv;
        $str = $isBinary ? $str : utf8_decode($str);
        $td = mcrypt_module_open('rijndael-128', ' ', 'cbc', $iv);
        mcrypt_generic_init($td, $this->key, $iv);
        $encrypted = mcrypt_generic($td, $str);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        return $isBinary ? $encrypted : bin2hex($encrypted);
	}

	function decrypt($code, $isBinary = false)
    {
        $code = $isBinary ? $code : $this->hex2bin($code);
        $iv = $this->iv;
        $td = mcrypt_module_open('rijndael-128', ' ', 'cbc', $iv);
        mcrypt_generic_init($td, $this->key, $iv);
        $decrypted = mdecrypt_generic($td, $code);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        return $isBinary ? trim($decrypted) : utf8_encode(trim($decrypted));
    }
    protected function hex2bin($hexdata)
    {
        $bindata = '';
        for ($i = 0; $i < strlen($hexdata); $i += 2) {
            $bindata .= chr(hexdec(substr($hexdata, $i, 2)));
        }
        return $bindata;
    }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */