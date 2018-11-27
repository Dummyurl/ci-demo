<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller {
    public function Users()
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
        $view_data['what'] = 1;
        if(isset($_POST['submit'])){
            $search = $_POST['search'];
            $view_data['records']=$this->qm->SelectQuery("SELECT * FROM tbl_users WHERE username 
                LIKE '%".$search."%' OR mobile LIKE '%".$search."%' OR imei LIKE '%".$search."%' OR user_ips LIKE '%".$search."%'");
        }else{
            $id = $this->uri->segment(4);
            if ($id != '') {
                $start = $id*OFFSET;
                $view_data['records']=$this->qm->SelectQuery("SELECT * FROM tbl_users WHERE status = 1 LIMIT ".OFFSET." OFFSET $start");
                $count = $this->qm->num_where_row('tbl_users',array('status'=>1));
                $view_data['count'] = round($count/OFFSET,0);
                $view_data['id'] = $id;
            } else {
                $view_data['records']=$this->qm->SelectQuery("SELECT * FROM tbl_users WHERE status = 1 LIMIT ".OFFSET." OFFSET 0");
                $count = $this->qm->num_where_row('tbl_users',array('status'=>1));
                $view_data['count'] = round($count/OFFSET,0);
                $view_data['id'] = 0;
            }
        }
        $this->load->view('super_admin/header');
        $this->load->view('super_admin/user_list',$view_data);
        $this->load->view('super_admin/footer');
    }

    public function index_deactive()
    {
        $view_data['what'] = 0;
        $this->load->view('super_admin/header');
        if(isset($_POST['submit'])){
            $search = $_POST['search'];
            $view_data['records']=$this->qm->SelectQuery("SELECT * FROM tbl_users WHERE username LIKE '%".$search."%' OR mobile LIKE '%".$search."%' OR imei LIKE '%".$search."%'");
        }else{
            $id = $this->uri->segment(4);
            if ($id != '') {
                $start = $id*OFFSET;
                $view_data['records']=$this->qm->SelectQuery("SELECT * FROM tbl_users WHERE status = 0 LIMIT ".OFFSET." OFFSET $start");
                $count = $this->qm->num_where_row('tbl_users',array('status'=>0));
                $view_data['count'] = round($count/OFFSET,0);
                $view_data['id'] = $id;
            } else {
                $view_data['records']=$this->qm->SelectQuery("SELECT * FROM tbl_users WHERE status = 0 LIMIT ".OFFSET." OFFSET 0");
                $count = $this->qm->num_where_row('tbl_users',array('status'=>0));
                $view_data['count'] = round($count/OFFSET,0);
                $view_data['id'] = 0;
            }
        }
        $this->load->view('super_admin/duser_list',$view_data);
        $this->load->view('super_admin/footer');
    }

    public function topusers()
    {
        $view_data['records']=$this->qm->SelectQuery("SELECT * FROM tbl_users WHERE status = 1 ORDER BY referral_count DESC LIMIT 100");
        $this->load->view('super_admin/header');
        $this->load->view('super_admin/topusers_list',$view_data);
        $this->load->view('super_admin/footer');
    }

    public function active_deactive(){
        $val = $_POST['val'];
        $user_id = $_POST['user_id'];
        $data['tbl_users'] = 'tbl_users';
        $where=array('user_id'=>$user_id);
        $user=$this->qm->select_where_row('tbl_users',['user_id' => $user_id]);
        $setting = $this->qm->select_where_row('tbl_setting', ['id' => 1]);
        $joinincm = $setting['join_referral'];
        if ($val == 0) {
            $this->qm->decrement('tbl_users', ['mobile'=>$user['referral']], $joinincm,'balance');
            $this->qm->decrement('tbl_users', ['mobile'=>$user['referral']], $joinincm,'referral_balance');
        }
        $data=array('status'=>$val);
        $this->qm->updt("tbl_users",$data,$where);
        
        echo $val;
    }
    public function updateBal(){
        $val = $_POST['val'];
        $user_id = $_POST['user_id'];
        $where=array('user_id'=>$user_id);
        $data=array('balance'=>$val);
        $this->qm->updt("tbl_users",$data,$where);
    }
    public function ips_delete(){
        $ips = $_POST['ips'].', 127.0.0.1';
        $where=array('user_ips'=>$ips);
        $users = $this->qm->select_where('tbl_users', $where);
        $users_id = array();
        foreach($users as $user){
            if(!in_array($user['referral'],$mobiles)){
                array_push($users_id,$user['user_id']);
            }
        }
        foreach ($users_id as $user_id) {
            $this->qm->dlt("tbl_payreq",array('user_id'=>$user_id));    
            $this->qm->updt("tbl_users",array('status'=>0),array('user_id'=>$user_id));
        }
        $this->qm->updt("tbl_users",array('status'=>0),$where);
        redirect('super_admin/users/index', 'refresh');
    }
    public function userProfile()
    {
        $user_id = $_POST['user_id'];
        $records=$this->qm->select_where_row("tbl_users",array('user_id'=>$user_id)); ?>
        <div class="box-body box-profile">
            <div class="container">
            <div class="col-md-12">
                <div class="text-center">
                     <img class="profile-user-img img-circle" src="<?php if($records['profile']) echo $records['profile']; else echo IMAGE.'nouser.png'; ?>" style="height: 100px; width: 100px">
                </div>
                <h3 class="profile-username text-center"><?php echo $records['username']; ?></h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="list-group">
                            <div class="list-group-item">
                                <h3><b> Mobile : </b>&nbsp;&nbsp;</h3>
                                    <span><?php echo $records['mobile']; ?></span>
                            </div>
                            <div class="list-group-item">
                                <h3> <b>Referral : </b>&nbsp;&nbsp;</h3>
                                    <span><?php echo $records['referral']; ?></span>
                            </div>
                            <div class="list-group-item">
                                <h3><b> Balance : </b>&nbsp;&nbsp;</h3>
                                <input type="text" style="border: 0px; padding:0 3px; color: red" onchange="updateBal(<?php echo $records['user_id'];?>,this.value);" value="<?php echo $records['balance'];?>">
                            </div>
                            <div class="list-group-item">
                                <h3><b> FB ID : </b>&nbsp;&nbsp;</h3>
                                <span><?php echo $records['fbid']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="list-group">
                            <div class="list-group-item">
                                <h3><b> IMEI : </b>&nbsp;&nbsp;</h3>
                                    <span><?php echo $records['imei']; ?></span>
                            </div>
                            <div class="list-group-item">
                                <h3><b> Joining : </b>&nbsp;&nbsp;</h3>
                                    <span><?php echo date('j, F Y, g:i a', strtotime($records['create_date'])); ?></span>
                            </div>
                            <div class="list-group-item">
                                <h3><b> Status : </b>&nbsp;&nbsp;</h3>
                                <p><?php if(($records['status']) == 1) echo '<b style="color: green">Active</b>'; else echo '<b style="color: red">Deative</b>'; ?></p>
                            </div>
                            <div class="list-group-item">
                                <h3><b> Referrl Count : </b>&nbsp;&nbsp;</h3>
                                <span><?php echo $records['referral_count']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <table style="border-color:aliceblue !important" id="example1" class="table table-bordered table-hover dataTable">
                    <thead style="background:#3f96da !important">
                    <tr>
                        <th>Date</th>
                        <th>impression</th>
                        <th>Click </th>
                        <th>Install </th>
                        <th>Earning </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $work = $this->qm->SelectQuery("SELECT * FROM tbl_work WHERE user_id = '".$user_id."'ORDER BY today DESC LIMIT 10");
                    foreach ($work as $w) { ?>
                        <tr>
                            <td><?php echo date('j, F Y', strtotime(''.$w['today'])); ?></td>
                            <td><?php echo $w['impression']; ?></td>
                            <td><?php echo $w['click']; ?></td>
                            <td><?php echo $w['installed']; ?></td>
                            <td><?php echo number_format(($w['impression_earn'] + $w['click_earn'] + $w['install_earn']),2); ?></td>
                        </tr><?php } ?>
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
            </div>
           
        </div>
        <?php
    }

    public function referralData()
    {
        $user_id = $_POST['user_id'];
        $records=$this->qm->select_where_row("tbl_users",array('user_id'=>$user_id)); ?>
        <div class="box-body box-profile">

            <div class="container">
            <div class="col-md-12">
                <div class="text-center">
                <img class="profile-user-img img-circle" src="<?php if($records['profile']) echo $records['profile']; else echo IMAGE.'nouser.png'; ?>" style="height: 100px; width: 100px">
                </div>
                <h3 class="profile-username text-center"><?php echo $records['username']; ?></h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="list-group">
                            <div class="list-group-item">
                                <h3><b> Mobile : </b>&nbsp;&nbsp;</h3>
                                    <span><?php echo $records['mobile']; ?></span>
                            </div>
                            <div class="list-group-item">
                                <h3> <b>Referral : </b>&nbsp;&nbsp;</h3>
                                    <span><?php echo $records['referral']; ?></span>
                            </div>
                            <div class="list-group-item">
                                <h3><b> Balance : </b>&nbsp;&nbsp;</h3>
                                <input type="text" style="border: 0px; padding:0 3px; color: red" onchange="updateBal(<?php echo $records['user_id'];?>,this.value);" value="<?php echo $records['balance'];?>">
                            </div>
                            <div class="list-group-item">
                                <h3><b> FB ID : </b>&nbsp;&nbsp;</h3>
                                <span><?php echo $records['fbid']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="list-group">
                            <div class="list-group-item">
                                <h3><b> IMEI : </b>&nbsp;&nbsp;</h3>
                                    <span><?php echo $records['imei']; ?></span>
                            </div>
                            <div class="list-group-item">
                                <h3><b> Joining : </b>&nbsp;&nbsp;</h3>
                                    <span><?php echo date('j, F Y, g:i a', strtotime($records['create_date'])); ?></span>
                            </div>
                            <div class="list-group-item">
                                <h3><b> Status11 : </b>&nbsp;&nbsp;</h3>
                                <p><?php if(($records['status']) == 1) echo '<b style="color: green">Active</b>'; else echo '<b style="color: red">Deative</b>'; ?></p>
                            </div>
                            <div class="list-group-item">
                                <h3><b> Referrl Count : </b>&nbsp;&nbsp;</h3>
                                <span><?php echo $records['referral_count']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <table style="border-color:aliceblue !important" id="example1" class="table table-bordered table-hover dataTable">
                    <thead style="background:aliceblue !important">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>IMEI </th>
                        <th>IPS</th>
                        <th>Status</th>
                        <th>OPTION</th>
                        
                    </tr>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $refUser = $this->qm->select_where('tbl_users',['referral' => $records['refferal_key']]);
                     foreach ($refUser as $r) { ?>
                        <tr id="<?php echo $r['user_id'].'row'?>">
                        <td onclick="referralData(<?php echo $r['user_id']; ?>)"><?php echo $r['user_id']; ?></td>
                        <td onclick="referralData(<?php echo $r['user_id']; ?>)"><?php echo $r['username']; ?></td>
                        <td onclick="referralData(<?php echo $r['user_id']; ?>)"><?php echo $r['mobile']; ?></td>
                        <td onclick="referralData(<?php echo $r['user_id']; ?>)"><?php echo $r['imei']; ?></td>
                        <td onclick="referralData(<?php echo $r['user_id']; ?>)"><?php echo $r['user_ips']; ?></td>
                        <td>
                            <?php
                                if($r['status'] == '0') {
                                    ?><button onclick="activeDe_active(<?php echo $r['user_id'] ?>,1)" type="button" id="<?php echo $r['user_id']; ?>" class="btn btn-danger">Deactive</button>
                                <button onclick="activeDe_active(<?php echo $r['user_id'] ?>,0)" style="display: none" type="button" id="<?php echo 'a'.$r['user_id']; ?>" class="btn btn-secondary">Active</button><?php
                                } else {
                                    ?><button onclick="activeDe_active(<?php echo $r['user_id'] ?>,0)" type="button" id="<?php echo 'a'.$r['user_id']; ?>" class="btn btn-secondary">Active</button>
                                <button onclick="activeDe_active(<?php echo $r['user_id'] ?>,1)" style="display: none" type="button" id="<?php echo $r['user_id']; ?>" class="btn btn-danger">Deactive</button><?php
                                }?>
                        </td>
                         <td><a class="fa fa-trash btn btn-xs btn-danger" id="aaa" onClick="deleteRow(<?php echo $r['user_id']; ?>)"></a></td>
                        </tr><?php } ?>
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
            </div>
        </div>
        <div class="modal-footer">
        <?php $back = $this->qm->select_where_row('tbl_users',array('mobile'=>$records['referral']));
        if($back){ ?>
            <button type="button" name="back" onClick="referralData(<?php echo $back['user_id']; ?>)" class="btn btn-primary pull-left"><i
                    class="fa fa-2x fa-chevron-left"></i><span>Back</span>
            </button>
            <?php } ?>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        <script type="text/javascript">
            function deleteRow(user_id) {
                if (confirm("Are you sure want to delete ?")) {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo site_url('super_admin/users/delete1');?>',
                        data: {user_id: user_id},
                        success: function (data) {
                            document.getElementById(user_id + 'row').style.display = 'none';
                        }
                    });
                }
            }

            // function dlt_user(user_id) {
            //     $.ajax({
            //         type: 'POST',
            //         url: '<?php echo site_url('super_admin/users/delete');?>',
            //         data: {user_id : user_id},
            //         success: function(data) {
            //             if(data == 1){
            //                 location.reload();
            //             }else{
            //                 alert('User not deleted! Please try again');
            //             }
            //         }
            //     })
            // }

        </script>
        <?php
    }

//Delete
    function delete1()
    {
        $user_id = $_POST['user_id'];
        $data['tbl_users'] = 'tbl_users';
        // $data['select_field'] = 'profile';
        // $data['where_field'] = "user_id='".$user_id."'";
        // $imgpath = 'images/profile';
        // $data['img_path'] = glob($imgpath.'*');
        // $this->qm->delete_img($data);
        $where=array('user_id'=>$user_id);
        $user=$this->qm->select_where_row('tbl_users',['user_id' => $user_id]);
        $this->qm->decrement('tbl_users', ['mobile'=>$user['referral']], '1','referral_count');
        $this->qm->dlt("tbl_users",$where);
        
    }

    function delete()
    {
        $user_id = $_POST['user_id'];
        $res = $this->db->query("DELETE FROM `tbl_users` WHERE user_id=$user_id");
        if($res == 1){
           echo '1';
        }else{
            echo '0';
        }
    }
}