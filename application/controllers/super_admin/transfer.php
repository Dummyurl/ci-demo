<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Transfer extends CI_Controller {
    public function Transfer()
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
            $view_data['records'] = $this->qm->select_where('tbl_transfer', array('transStatus' => $id));
            $view_data['id'] = $id;
        } else {
            $view_data['records'] = $this->qm->select_where('tbl_transfer',array('transStatus' => 2));
        }
        $this->load->view('super_admin/header');
        $this->load->view('super_admin/transfer_list',$view_data);
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
            $this->qm->increment('tbl_users', array('user_id'=>$uid), $amount, 'balance');
            $where=array('transfer_id'=>$id);
            $data=array('transStatus'=>$val,'notify_msg'=>$setting['decline_msg'],'pay_datetime'=>date('Y-m-d H:i:s'));
            $this->qm->updt("tbl_transfer",$data,$where);
            $this->push_notification($userArr['token'],$setting['decline_msg']);
            echo $val;
        }else if($val==1){
            $where=array('transfer_id'=>$id);
            $data=array('transStatus'=>$val,'notify_msg'=>$setting['accept_msg'],'pay_datetime'=>date('Y-m-d H:i:s'));
            $this->qm->updt("tbl_transfer",$data,$where);
            $this->push_notification($userArr['token'],$setting['accept_msg']);
            echo $val;
        }else{
            $this->qm->decrement('tbl_users', array('user_id'=>$uid), $amount, 'balance');
            $where=array('transfer_id'=>$id);
            $data=array('transStatus'=>$val,'notify_msg'=>'Pending for your bank transfer request');
            $this->qm->updt("tbl_transfer",$data,$where);
            echo $val;
        }
    }

    public function push_notification($token,$message)
    {
        $registrationIDs = array($token);
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids'  => $registrationIDs,
            'data' => array(
                "message" => (string)$message
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