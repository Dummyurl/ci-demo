<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notification extends CI_Controller {
    public function Notification()
    {
        parent::__construct();
        $this->load->model('query_model', 'qm', TRUE);
        $this->load->helper('url');
        if (!isset($this->session->userdata['admin'])) {
            redirect('admin');
        }
    }

    public function index(){
        $data['records'] = $this->qm->select_all('tbl_notification');
        $this->load->view('super_admin/header');
        $this->load->view('super_admin/notification',$data);
        $this->load->view('super_admin/footer');
    }

    public function send_notification(){
        $this->load->view('super_admin/header');
        if(isset($_POST['send']))
        {   
            if (isset($_FILES['exampleFormControlFile123']['name']) && ($_FILES['exampleFormControlFile123']['name']) != "") {
                $type = pathinfo($_FILES['exampleFormControlFile123']['name'], PATHINFO_EXTENSION);
                $icon = rand(1111, 9999) . time() . "." . $type;
                $config['file_name'] = $icon;
                $config['upload_path'] = "images/audio/";
                $config['allowed_types'] = "mp3|3gp|mpeg";
                $this->upload->initialize($config);
                $this->upload->do_upload('exampleFormControlFile123');
                $is_sound = true;
            }else{
                $icon = '';
                $is_sound = false;
            }

            $postData = array(
                'message'=>$_POST['message'],
                'sound' => $icon,
                'is_sound' =>$is_sound,
                'noti_date'=>date("Y-m-d H:i:s")
            );
            $insert_id = $this->qm->ins('tbl_notification', $postData);
            if($insert_id){
                $limit = 999;
                $count = $this->qm->num_row('tbl_users');
                $cnt = ($count / $limit);
                for ($i = 0; $i < $cnt; $i++) {
                    $start = $limit * $i;
                    $token_data = $this->qm->select_limit('tbl_users', $limit, $start);
                    $token_arr = array();
                    foreach ($token_data as $token) {
                        $token_arr[] = ($token['token']);
                    }
                    $result = $this->push_notification($token_arr,$_POST['message'],$icon,$is_sound);
                    if ($result) {
                        $msg = (json_decode($result));
                        $success[] = ($msg->success);
                        $failure[] = ($msg->failure);
                    }
                }
                $sucs = array_sum($success);
                $fail = array_sum($failure);
                $msg_arr = ' Success = ' . $sucs . ' ' . ' Failure = ' . $fail ;
                $this->session->set_userdata("msg", $msg_arr);
            }
            redirect('super_admin/notification');
        }
        $this->load->view('super_admin/footer');
    }

    public function push_notification($token_arr,$message,$icon,$is_sound)
    {
		$registrationIDs = $token_arr;
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids'  => $registrationIDs,
            'data' => array(
                "message" => $message,
                'is_sound' => $is_sound,
                'sound' => URL.'images/audio/'.$icon
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
    //Delete
    function delete($admin_id='')
    {
        if($admin_id=='')
            $noti=$this->input->post('noti');
        else
            $noti = array($admin_id);
        foreach($noti as $admin_id) {
            $where=array('n_id'=>$admin_id);
            $this->qm->dlt("tbl_notification",$where);
        }
        redirect('super_admin/notification');
    }
}