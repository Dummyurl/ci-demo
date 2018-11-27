<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Shoppingrequest extends CI_Controller {
    public function Shoppingrequest()
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
            $view_data['records'] = $this->qm->select_where('tbl_shopping_order', array('paystatus' => $id));
            $view_data['id'] = $id;
        } else {
            $view_data['records'] = $this->qm->select_where('tbl_shopping_order',array('paystatus' => 2));
        }
        $this->load->view('super_admin/header');
        $this->load->view('super_admin/shopping_order_list',$view_data);
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
            $data=array('payStatus'=>$val,'notify_msg'=>$setting['shopping_order_discline_message'],'pay_datetime'=>date('Y-m-d H:i:s'));
            $this->qm->updt("tbl_shopping_order",$data,$where);
            $this->push_notification($userArr['token'],$setting['shopping_order_discline_message']);
            echo $val;
        }else if($val==1){
            $where=array('pay_id'=>$id);
            $data=array('payStatus'=>$val,'notify_msg'=>$setting['shopping_order_accept_message'],'pay_datetime'=>date('Y-m-d H:i:s'));
            $this->qm->updt("tbl_shopping_order",$data,$where);
            $this->push_notification($userArr['token'],$setting['shopping_order_accept_message']);
            echo $val;
        }else{
            $this->qm->decrement('tbl_users', array('user_id'=>$uid), $amount, 'balance');
            $where=array('pay_id'=>$id);
            $data=array('payStatus'=>$val,'notify_msg'=>'Your order is pending. Dispatch soon!');
            $this->qm->updt("tbl_shopping_order",$data,$where);
            echo $val;
        }
    }

    public function viewOrderDetails(){
        $pay_id = $_POST['pay_id'];

        $arr = $this->qm->select_where_row('tbl_shopping_order',array('pay_id'=>$pay_id));
        $arr1 = $this->qm->select_where_row('tbl_shopping',array('shopping_id'=>$arr['shopping_id']));
        ?>
        <div class="box-body box-profile">
            <div class="col-lg-12">
                 <div class="text-center">
                    <img class="profile-user-img" src="<?php if($arr1['thumbnail']) echo IMAGE.'products/'.$arr1['thumbnail']; else echo IMAGE.'no_image.png'; ?>">
                </div>
                <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Title</th>
                        <td><?php echo $arr1['title'];?></td>
                    </tr>
                    <tr>
                        <th scope="row">Category</th>
                        <td><?php echo $arr1['category'];?></td>
                    </tr>
                    <tr>
                        <th scope="row">Price</th>
                        <td><?php echo $arr1['price'];?><span class="h6" style="color:red;"> ( GST % is included in price )<span></td>
                    </tr>
                    <tr>
                        <th scope="row">Order Status</th>
                        <td><?php echo $arr['notify_msg']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Description</th>
                        <td><?php echo $arr1['description'];?></td>
                    </tr>
                </tbody>
                </table>
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