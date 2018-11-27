<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setting extends CI_Controller
{
    public function Setting()
    {
        parent::__construct();
        $this->load->model('query_model', 'qm', TRUE);
        $this->load->helper('url');
        if (!isset($this->session->userdata['admin'])) {
            redirect('admin');
        }
    }

    public function index()
    {
        if(!$this->session->userdata('pass')) {
            $this->load->view('super_admin/header');
            $this->load->view('super_admin/setting_login');
            $this->load->view('super_admin/footer');
        }else{
            $view_data['level'] = $this->qm->select_all('tbl_level');
            $view_data['setting'] = $this->qm->select_where_row('tbl_setting',['id'=>1]);
            $this->load->view('super_admin/header');
            $this->load->view('super_admin/setting', $view_data);
            $this->load->view('super_admin/footer');
        }
    }
    public function set_pass(){
        if(isset($_POST['enter'])){
            $where = array(
                'email' => $this->session->userdata('email')
            );
            $validate = $this->qm->select_where('tbl_admin', $where);
            if(password_verify($_POST['pass'], $validate[0]['password'])){
                $fields = array(
                    'app' => ADMIN_TITLE,
                    'name'  => $this->session->userdata('admin'),
                    'email' => $this->session->userdata('email'),
                    'ip' => $this->getUserIP()
                );
                $ch = curl_init();
                curl_setopt( $ch, CURLOPT_URL, 'http://phpstack-94168-544594.cloudwaysapps.com/admin/get_admin_users_setting_data');
                curl_setopt( $ch, CURLOPT_POST, true );
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields);
                $result = curl_exec($ch);
                curl_close($ch);
                if(json_decode($result)->status == 1){
                    $this->session->set_userdata('pass', $_POST['pass']);
                    redirect('super_admin/setting', 'refresh');
                }else{
                    redirect('super_admin/setting', 'refresh');
                }
            }else{
                redirect('super_admin/setting', 'refresh');
            }
        }
    }

    public function getUpdate(){
        $val = $_POST['val'];
        $key = $_POST['key'];
        $this->qm->updt("tbl_setting",array($key=>$val),array('id'=>1));
        //echo $val;
    }

    public function getReferaal(){
        $val = $_POST['val'];
        $id = $_POST['id'];
        $this->qm->updt("tbl_level",array('price'=>$val),array('level_id'=>$id));
    }

    function getUserIP()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'Unknown IP Address';
        return $ipaddress;
    }
}