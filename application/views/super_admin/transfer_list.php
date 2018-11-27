<?php $db = mysqli_connect(HOST,USER,PASS,DB); ?>
<script> function account(id) { window.location = "<?php echo base_url();?>super_admin/transfer/index/" + id; } </script>
<section class="content-header">
    <h1 style="font-size:20px;">Bank Transfer Request list
        <small style="font-size:12px">Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Bank Transfer Request list </li>
    </ol>
    <section class="content">
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <select class="form-control pull-left" style="width: 20%;margin: 0 2%;" onchange="account(this.value)">
                        <option value=" " <?php if (isset($id) && $id == ' ') echo "selected";?>>Pending</option>
                        <option value="0" <?php if (isset($id) && $id == '0') echo "selected";?>>Declined</option>
                        <option value="1"<?php if (isset($id) && $id == '1') echo "selected"; ?>>Accepted</option>
                    </select>
                </div>
                <div class="box-body mailbox-messages" style="overflow:scroll">
                    <table id="example1" class="table table-bordered table-striped table-hover table-responsive mailbox-messages">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Referral</th>
                            <th>Username</th>
                            <th>Account Number</th>
                            <th>Account Holder</th>
                            <th>IFCC</th>
                            <th>Amount</th>
                            <th>GST</th>
                            <th>Request Time</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($records as $r) { ?>

                            <tr>
                            <td align="center" ><?php echo $r['transfer_id']; ?></td>
                            <td align="center"><a class="btn btn-default" data-toggle="modal" onclick="referralData(<?php echo $r['user_id']; ?>)" data-target="#referral""><li class="fa fa-list"></li></a></td>
                            <?php $u=mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM tbl_users WHERE user_id='".$r['user_id']."'"))?>
                            <td align="center" data-toggle="modal" onclick="userData(<?php echo $r['user_id']; ?>)" data-target="#profile"><?php echo $u['username']; ?></td>
                            <td align="center"><?php echo $r['account_number']; ?></td>
                            <td align="center"><?php echo $r['account_holder']; ?></td>
                            <td align="center"><?php echo $r['ifsc_code']; ?></td>
                            <td align="center"><?php echo $r['amount']; ?></td>
                            <?php $gst = $r['amount']-($r['amount']*45/100);  ?>
                            <td align="center"><?php echo $gst; ?></td>
                            <td align="center"><?php echo date('j, M Y', strtotime($r['req_date'])); ?></td>
                            <td>
                                <?php
                                if($r['transStatus'] == '2') { ?>
                                    <button onclick="payReqStatus(<?php echo $r['transfer_id'].','.'1'.','.$r['user_id'].','.$r['amount']; ?>)" type="button" id="<?php echo 'pa'.$r['transfer_id'];?>" class="btn btn-success fa fa-check"></button>
                                    <button onclick="payReqStatus(<?php echo $r['transfer_id'].','.'0'.','.$r['user_id'].','.$r['amount'];?>)" type="button" id="<?php echo 'pd'.$r['transfer_id'];?>" class="btn btn-danger fa fa-times"></button>
                                    <button class="btn btn-success" onclick="payReqStatus(<?php echo $r['transfer_id'].','.'2'.','.$r['user_id'].','.'0';?>)" style="display:none" id="<?php echo 'accept'.$r['transfer_id'];?>">Accepted</button>
                                    <button class="btn btn-danger" onclick="payReqStatus(<?php echo $r['transfer_id'].','.'2'.','.$r['user_id'].','.$r['amount']; ?>)" style="display:none" id="<?php echo 'decline'.$r['transfer_id'];?>">Declined</button>
                                <?php } else if($r['transStatus'] == '1') { ?>
                                    <button style="display: none" onclick="payReqStatus(<?php echo $r['transfer_id'].','.'1'.','.$r['user_id'].','.$r['amount']; ?>)" type="button" id="<?php echo 'pa'.$r['transfer_id'];?>" class="btn btn-success fa fa-check"></button>
                                    <button style="display: none" onclick="payReqStatus(<?php echo $r['transfer_id'].','.'0'.','.$r['user_id'].','.$r['amount'];?>)" type="button" id="<?php echo 'pd'.$r['transfer_id'];?>" class="btn btn-danger fa fa-times"></button>
                                    <button class="btn btn-success" onclick="payReqStatus(<?php echo $r['transfer_id'].','.'2'.','.$r['user_id'].','.'0';?>)" id="<?php echo 'accept'.$r['transfer_id'];?>">Accepted</button>
                                <?php } else { ?>
                                    <button style="display: none" onclick="payReqStatus(<?php echo $r['transfer_id'].','.'1'.','.$r['user_id'].','.$r['amount']; ?>)" type="button" id="<?php echo 'pa'.$r['transfer_id'];?>" class="btn btn-success fa fa-check"></button>
                                    <button style="display: none" onclick="payReqStatus(<?php echo $r['transfer_id'].','.'0'.','.$r['user_id'].','.$r['amount'];?>)" type="button" id="<?php echo 'pd'.$r['transfer_id'];?>" class="btn btn-danger fa fa-times"></button>
                                    <button class="btn btn-danger" onclick="payReqStatus(<?php echo $r['transfer_id'].','.'2'.','.$r['user_id'].','.$r['amount']; ?>)" id="<?php echo 'decline'.$r['transfer_id'];?>">Declined</button>
                                <?php } ?>
                            </td>
                            </tr><?php } ?>
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
    </section>
    <div id="profile" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">User Profile</h4>
                </div>
                <div class="modal-body" id="resData" style="padding: 0px"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="referral" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Under Referral</h4>
                </div>
                <div class="modal-body" id="return_data" style="padding: 0px"></div>

            </div>
        </div>
    </div>

    <div id="barcode" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Barcode</h4>
                </div>
                <div class="modal-body" id="barcodeImg" style="padding: 0px"></div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#example1').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function (e) {
            $(".sidebar-menu li").removeClass("active");
            $("#trans").addClass('active');
            $('.sidebar-menu ul').css('display', 'none').addClass('closed');
        });

        function viewBarcode(transfer_id) {
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('super_admin/payreq/getBarcode');?>',
                data: 'transfer_id='+transfer_id,
                success: function(data) {
                    $('#barcodeImg').html(data)
                }
            });
        }

        function userData(user_id) {
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('super_admin/users/userProfile');?>',
                data: 'user_id='+user_id,
                success: function(data) {
                    $('#resData').html(data)
                }
            });
        }

        function updateBal(user_id,val) {
            if (confirm("Are you sure want to update ?")) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('super_admin/users/updateBal');?>',
                    data: {user_id: user_id, val}
                });
            }
        }

        function referralData(user_id) {
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('super_admin/users/referralData');?>',
                data: 'user_id='+user_id,
                success: function(data) {
                    $('#return_data').html(data)
                }
            });
        }

        function activeDe_active_dilog(user_id,val) {
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('super_admin/users/active_deactive');?>',
                data: {user_id : user_id, val },
                success: function(data) {
                    if(data == 1) {
                        document.getElementById('dcid').style.display = 'none';
                        document.getElementById('acid').style.display = '';
                    }else{
                        document.getElementById('acid').style.display = 'none';
                        document.getElementById('dcid').style.display = '';
                    }
                }
            });
        }
        
        function payReqStatus(id,val,uId,amnt) {
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('super_admin/transfer/active_deactive');?>',
                data: {id : id, val, uId, amnt },
                success: function(data) {
                    if(data == 1) {
                        document.getElementById('pa'+id).style.display = 'none';
                        document.getElementById('pd'+id).style.display = 'none';
                        document.getElementById('accept'+id).style.display = '';
                    }else if(data == 0){
                        document.getElementById('pa'+id).style.display = 'none';
                        document.getElementById('pd'+id).style.display = 'none';
                        document.getElementById('decline'+id).style.display = '';
                    }else{
                        if(amnt == 0){
                            document.getElementById('accept'+id).style.display = 'none';
                        }else{
                            document.getElementById('decline'+id).style.display = 'none';
                        }
                        document.getElementById('pa'+id).style.display = '';
                        document.getElementById('pd'+id).style.display = '';
                    }
                }
            });
        }
    </script>