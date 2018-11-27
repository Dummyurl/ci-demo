<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Recharge extends CI_Controller {
    public function Recharge()
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
            $view_data['records'] = $this->qm->select_where('tbl_recharge', array('paystatus' => $id));
            $view_data['id'] = $id;
        } else {
            $view_data['records'] = $this->qm->select_where('tbl_recharge',array('paystatus' => 2));
        }
        $this->load->view('super_admin/header');
        $this->load->view('super_admin/recharge_list',$view_data);
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
            $where=array('pay_id'=>$id);
            $data=array('payStatus'=>$val,'notify_msg'=>$setting['decline_msg'],'pay_datetime'=>date('Y-m-d H:i:s'));
            $this->qm->updt("tbl_recharge",$data,$where);
            $this->push_notification($userArr['token'],$setting['decline_msg']);
            echo $val;
        }else if($val==1){
            $where=array('pay_id'=>$id);
            $data=array('payStatus'=>$val,'notify_msg'=>$setting['accept_msg'],'pay_datetime'=>date('Y-m-d H:i:s'));
            $this->qm->updt("tbl_recharge",$data,$where);
            $this->push_notification($userArr['token'],$setting['accept_msg']);
            echo $val;
        }else{
            $this->qm->decrement('tbl_users', array('user_id'=>$uid), $amount, 'balance');
            $where=array('pay_id'=>$id);
            $data=array('payStatus'=>$val,'notify_msg'=>'Pending for your paytm request');
            $this->qm->updt("tbl_recharge",$data,$where);
            echo $val;
        }
    }

    public function getBarcode(){
        $pay_id = $_POST['pay_id'];
        $arr = $this->qm->select_where_row('tbl_recharge',array('pay_id'=>$pay_id));
        ?>
        <div class="box-body box-profile">
            <div class="col-lg-12">
                <h3 class="profile-username text-center" style="color: red"><?php $gst = $arr['amount']-($arr['amount']*45/100); echo 'Pay Amount : '.$gst; ?></h3>
                <div class="text-center">
                    <img class="profile-user-img" src="<?php if($arr['barcode']) echo IMAGE.'recharge/'.$arr['barcode']; else echo IMAGE.'no_image.png'; ?>" style="width:250px;">
                </div>
            </div>
        </div>
        <h3 class="profile-username text-center"><?php echo $arr['mobile']; ?></h3>
        <div class="modal-footer">
            <?php if($arr['payStatus'] == 2) { ?>
                <button onclick="payReqStatus(<?php echo $arr['pay_id'].','.'1'.','.$arr['user_id'].','.$arr['amount']; ?>)" type="button" id="<?php echo 'pa'.$arr['pay_id'];?>" class="btn btn-success pull-left" data-dismiss="modal">Accept</button>
                <button onclick="payReqStatus(<?php echo $arr['pay_id'].','.'0'.','.$arr['user_id'].','.$arr['amount'];?>)" type="button" id="<?php echo 'pd'.$arr['pay_id'];?>" class="btn btn-danger pull-left" data-dismiss="modal">Decline</button>
            <?php } ?>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        <?php
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