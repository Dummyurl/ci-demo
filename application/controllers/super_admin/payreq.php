<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payreq extends CI_Controller {
    public function Payreq()
    {
        parent::__construct();
        $this->load->library('encdec_paytm');
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
            $view_data['records'] = $this->qm->select_where('tbl_payreq', array('paystatus' => $id));
            $view_data['id'] = $id;
        } else {
            $view_data['records'] = $this->qm->select_where('tbl_payreq',array('paystatus' => 2));
        }
        $this->load->view('super_admin/header');
        $this->load->view('super_admin/payreq_list',$view_data);
        $this->load->view('super_admin/footer');
    }

    public function active_deactive(){
        $uid = $_POST['uId'];
        $amount = $_POST['amnt'];
        $val = $_POST['val'];
        $id = $_POST['id'];

        $userArr = $this->qm->select_where_row('tbl_users',array('user_id'=>$uid));
        $setting = $this->qm->select_where_row('tbl_setting',array('id'=>1));
        if(count($userArr) > 0){    
            if($val==0){
                // $this->qm->increment('tbl_users', array('user_id'=>$uid), $amount, 'balance');
                $where=array('pay_id'=>$id);
                $data=array('payStatus'=>$val,'notify_msg'=>$setting['decline_msg'],'pay_datetime'=>date('Y-m-d H:i:s'));
                $this->qm->updt("tbl_payreq",$data,$where);
                $this->push_notification($userArr['token'],$setting['decline_msg']);
                echo json_encode(array('data'=>$val,'status'=>'SUCCESS','msg'=>"SUCCESS!"));
            }else if($val==1){
                $result = $this->qm->select_where('tbl_payreq', array('pay_id' => $id));
                if($result[0]['payment_by'] == 'PAYTM'){
                    $order_id = "Order-".PAYTM_APP_NAME.'-'.rand('00000','99999').rand('00000','99999').rand('00000','99999').'-'.$id;
                    $data = array(  "request" => array("requestType" => null, 
                                "merchantGuid" => PAYTM_MERCHANT_GUID,
                                "merchantOrderId" => $order_id,   
                                "salesWalletName"=> null, 
                                "salesWalletGuid"=>PAYTM_SALES_WALLET_GUID, 
                                "payeeEmailId"=>null, 
                                "payeePhoneNumber"=>$result[0]['mobile'], 
                                "payeeSsoId"=>"", 
                                "appliedToNewUsers"=>"Y",
                                "amount"=>$result[0]['amount']-($result[0]['amount']*28/100),
                                "currencyCode"=>"INR"
                            ),
                            "metadata"=>"gujaratijokes data", 
                            "ipAddress"=>$_SERVER['SERVER_ADDR'],
                            "platformName"=>"PayTM", 
                            "operationType"=>"SALES_TO_USER_CREDIT"); 
                  $requestData=json_encode($data);
                  $Checksumhash = $this->encdec_paytm->getChecksumFromString($requestData,PAYTM_MERCHANT_KEY);
                  $headerValue = array('Content-Type:application/json','mid:'.PAYTM_MERCHANT_GUID,'checksumhash:'.$Checksumhash);
                    $ch = curl_init(PAYTM_GRATIFICATION_URL);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);     
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);   
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headerValue);
                    $result = json_decode(curl_exec($ch));
                    if($result->status == 'SUCCESS'){
                        $where=array('pay_id'=>$id);
                        $data=array('payStatus'=>$val,'notify_msg'=>$setting['accept_msg'],'pay_datetime'=>date('Y-m-d H:i:s'));
                        $this->qm->updt("tbl_payreq",$data,$where);
                        $this->push_notification($userArr['token'],$setting['accept_msg']);
                        echo json_encode(array('data'=>$val,'status'=>'SUCCESS','msg'=>$result->statusMessage.'!'));
                    }
                    if($result->status == 'FAILURE'){
                        $val1 = '0';
                        $this->qm->increment('tbl_users', array('user_id'=>$uid), $amount, 'balance');
                        $where=array('pay_id'=>$id);
                        $data=array('payStatus'=>$val1,'notify_msg'=>$setting['decline_msg'],'pay_datetime'=>date('Y-m-d H:i:s'));
                        $this->qm->updt("tbl_payreq",$data,$where);
                        $this->push_notification($userArr['token'],$setting['decline_msg']);
                        echo json_encode(array('data'=>$val1,'status'=>'FAILURE','msg'=>$result->statusMessage));
                    }
                    if($result->status == 'PENDING'){
                        $where=array('pay_id'=>$id);
                        $data=array('payStatus'=>$val,'notify_msg'=>$setting['accept_msg'],'pay_datetime'=>date('Y-m-d H:i:s'));
                        $this->qm->updt("tbl_payreq",$data,$where);
                        $this->push_notification($userArr['token'],$setting['accept_msg']);
                        echo json_encode(array('data'=>$val,'status'=>'PENDING','msg'=>'Payee wallet could not found'));
                    }
                   
                }else{
                    $where=array('pay_id'=>$id);
                    $data=array('payStatus'=>$val,'notify_msg'=>$setting['accept_msg'],'pay_datetime'=>date('Y-m-d H:i:s'));
                    $this->qm->updt("tbl_payreq",$data,$where);
                    $this->push_notification($userArr['token'],$setting['accept_msg']);
                    echo $val;
                }
              
            }else{
                $this->qm->decrement('tbl_users', array('user_id'=>$uid), $amount, 'balance');
                $where=array('pay_id'=>$id);
                $data=array('payStatus'=>$val,'notify_msg'=>'Pending for your paytm request');
                $this->qm->updt("tbl_payreq",$data,$where);
                echo $val;
            }

        }else{
                    $where = array('pay_id' => $id);
                    $this->qm->dlt('tbl_payreq', $where);
                    echo json_encode(array('data'=>0,'status'=>'FAILURE','msg'=>'User alredy deleted'));
                }    
                
    }

    public function getBarcode(){
        $pay_id = $_POST['pay_id'];
        $arr = $this->qm->select_where_row('tbl_payreq',array('pay_id'=>$pay_id));
        ?>
        <div class="box-body box-profile">
            <div class="col-lg-12">
                <h3 class="profile-username text-center" style="color: red"><?php $gst = $arr['amount']-($arr['amount']*45/100); echo 'Pay Amount : '.$gst; ?></h3>
                <div class="text-center">
                    <img class="profile-user-img" src="<?php if($arr['barcode']) echo IMAGE.'barcode/'.$arr['barcode']; else echo IMAGE.'no_image.png'; ?>" style="width:250px;">
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
                "message" => (string)$message,
                 'sound' => "",
                'is_sound' => false,
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