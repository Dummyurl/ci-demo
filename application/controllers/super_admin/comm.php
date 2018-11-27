<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Comm extends CI_Controller {
    public function Comm()
    {
        parent::__construct();
        $this->load->model('query_model','qm',TRUE);
        $this->load->helper('url');
        if (!isset($this->session->userdata['admin'])) {
            redirect('admin');
        }
    }
    public function index()
    {
        $id = $this->uri->segment(4);
        if ($id != '') {
            $view_data['records'] =$this->db->query("SELECT comm.*,users.*,comm.create_date as c_date FROM tbl_comm as comm LEFT JOIN tbl_users as users ON users.user_id=comm.user_id WHERE comm.user=1 AND comm.status=$id Group BY comm.user_id")->result_array();
            $view_data['id'] = $id;
        } else {
            $view_data['records'] =$this->db->query("SELECT comm.*,users.*,comm.create_date as c_date FROM tbl_comm as comm LEFT JOIN tbl_users as users ON users.user_id=comm.user_id WHERE comm.user=1 AND comm.status=2 Group BY comm.user_id")->result_array();
            
        }
        $this->load->view('super_admin/header');
        $this->load->view('super_admin/comm',$view_data);
        $this->load->view('super_admin/footer');
    }

    public function active_deactive(){
        $uid = $_POST['uId'];
        $amount = $_POST['amnt'];
        $val = $_POST['val'];
        $id = $_POST['id'];
        $userArr = $this->qm->select_where_row('tbl_users',array('user_id'=>$uid));
        $setting = $this->qm->select_where_row('tbl_setting',array('id'=>1));
        if($val==0){
            $where=array('comm_id'=>$id);
            $data=array('status'=>$val);
            $this->qm->updt("tbl_comm",$data,$where);
            echo $val;
        }else if($val==1){
            $where=array('comm_id'=>$id);
            $data=array('status'=>$val);
            $this->qm->updt("tbl_comm",$data,$where);
            echo $val;
        }else{
            $where=array('comm_id'=>$id);
            $data=array('status'=>$val);
            $this->qm->updt("tbl_comm",$data,$where);
            echo $val;
        }
    }
    public function viewChartDetails(){
        $user_id = $_POST['user_id'];
        $results_user = $this->db->query("SELECT * FROM tbl_users WHERE user_id = $user_id")->result();
        $results = $this->db->query("SELECT * FROM tbl_comm WHERE user_id = $user_id")->result();
        $datax = [
            'users'=>$results_user,
            'chats'=>$results
        ];
        echo json_encode($datax);
    }

    public function send_msg_to_user(){
        $msg = $_POST['msg'];
        $user_id = $_POST['user_id'];
        $data = [
            'user_id'=>$user_id,
            'msg'=>$msg,
            'user'=>'0',
            'admin'=>'1',
            'status'=>'1',
            'create_date'=>date('Y-m-d'),
            'create_time' => date('H:i:s')
        ];
        $insert_id = $this->qm->ins('tbl_comm',$data);
        if($insert_id){
            $this->qm->updt('tbl_comm', ['status' => '1'], ['user_id' => $user_id]);
            $result = $this->qm->select_where_row('tbl_users',array('user_id'=>$user_id));
            $this->push_notification($result['token'],$msg);
            echo '1';
        }else{
            echo '2';
        }
        

    }

    public function push_notification($token,$message)
    {
        $registrationIDs = array($token);
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids'  => $registrationIDs,
            'data' => array(
                "message" => (string)$message,
                "key123"=>"comm",
                'is_sound' => false,
                'sound' => "",
                "date"=>date('Y-m-d H:i:s')
            ),
        );
        $headers = array(
            'Authorization: key='.firebase_key,
            'Content-Type: application/json');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}