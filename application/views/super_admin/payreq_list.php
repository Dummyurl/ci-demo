<?php $db = mysqli_connect(HOST,USER,PASS,DB); ?>
<script> function account(id) { window.location = "<?php echo base_url();?>super_admin/payreq/index/" + id; } </script>
<div class="content-wrapper">
                <nav id="toolbar" class="bg-white">
                    <div class="row no-gutters align-items-center flex-nowrap">
                        <div class="col">
                            <div class="row no-gutters align-items-center flex-nowrap">
                                <button type="button" class="toggle-aside-button btn btn-icon d-block d-lg-none" data-fuse-bar-toggle="aside">
                                    <i class="icon icon-menu"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="row no-gutters align-items-center justify-content-end">
                                <button type="button" class="quick-panel-button btn btn-icon" data-fuse-bar-toggle="quick-panel-sidebar">
                                        <div class="avatar-wrapper">
                                            <img class="avatar" src="../images/avatars/profile.jpg">
                                        </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="content custom-scrollbar">
                    <div id="e-commerce-products" class="page-layout carded full-width">
                        <div class="top-bg bg-secondary"></div>
                        <div class="page-content-wrapper">
                            <div class="page-header light-fg row no-gutters align-items-center justify-content-between">
                                <div class="col-12 col-sm">
                                    <div class="logo row no-gutters justify-content-center align-items-start justify-content-sm-start">
                                        <div class="logo-icon mr-3 mt-1">
                                            <i class="fa fa-2x fa-cubes"></i>
                                        </div>
                                        <div class="logo-text">
                                            <div class="h4">Paytm Request list</div>
                                            <div class="">Total Paytm Request list: <?php echo count($records); ?></div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="col search-wrapper px-2">
                                        <div class="input-group">
                                            <div class="alert alert-success paytm_sucess_alert" role="alert" style="display:none;">
                                            </div>
                                            <div class="alert alert-danger paytm_failure_alert" role="alert" style="display:none;">
                                            </div>
                                            <select class="form-control pull-left" style="margin: 0 2%;" onchange="account(this.value)">
                                                <option value=" " <?php if (isset($id) && $id == ' ') echo "selected";?>>Pending</option>
                                                <option value="0" <?php if (isset($id) && $id == '0') echo "selected";?>>Declined</option>
                                                <option value="1"<?php if (isset($id) && $id == '1') echo "selected"; ?>>Accepted</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <div class="page-content-card">
                                <div class="content custom-scrollbar">
                                    <table id="sample-data-table" class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">Id</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">Referral</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">Mobile</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">A.Id</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">Amount</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">GST</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">Payment By</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">Request Time</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">Status</span>
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($records as $r) { ?>
                                                                <tr>
                                                                    <td><?php echo $r['pay_id']; ?></td>
                                                                    <td data-toggle="modal" onclick="referralData(<?php echo $r['user_id']; ?>)" data-target="#referral"><li class="fa fa-2x fa-list"></li></td>
                                                                    <?php $u=mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM tbl_users WHERE user_id='".$r['user_id']."'"))?>
                                                                    <td data-toggle="modal" onclick="viewBarcode(<?php echo $r['pay_id']?>)" data-target="#barcode"><?php echo $r['mobile']; ?></td>
                                                                    <td data-toggle="modal" onclick="viewBarcode(<?php echo $r['pay_id']?>)" data-target="#barcode"><?php echo $r['android_id']; ?></td>
                                                                    <td data-toggle="modal" onclick="viewBarcode(<?php echo $r['pay_id']?>)" data-target="#barcode"><?php echo $r['amount']; ?></td>
                                                                    <?php $gst = $r['amount']-($r['amount']*28/100);  ?>
                                                                    <td data-toggle="modal" onclick="viewBarcode(<?php echo $r['pay_id']?>)" data-target="#barcode"><?php echo $gst; ?></td>
                                                                    <td data-toggle="modal" onclick="viewBarcode(<?php echo $r['pay_id']?>)" data-target="#barcode"><?php echo $r['payment_by']; ?></td>
                                                                    <td data-toggle="modal" onclick="viewBarcode(<?php echo $r['pay_id']?>)" data-target="#barcode"><?php echo date('j, M Y', strtotime($r['req_date'])); ?></td>
                                                                    <td >
                                                                    <?php
                                                                        if($r['payStatus'] == '2') { ?>
                                                                            <button onclick="payReqStatus(<?php echo $r['pay_id'].','.'1'.','.$r['user_id'].','.$r['amount']; ?>)" type="button" id="<?php echo 'pa'.$r['pay_id'];?>" class="btn btn-secondary fa fa-check"></button>
                                                                            <button onclick="payReqStatus(<?php echo $r['pay_id'].','.'0'.','.$r['user_id'].','.$r['amount'];?>)" type="button" id="<?php echo 'pd'.$r['pay_id'];?>" class="btn btn-danger fa fa-times"></button>
                                                                            <button class="btn btn-secondary" onclick="payReqStatus(<?php echo $r['pay_id'].','.'2'.','.$r['user_id'].','.'0';?>)" style="display:none" id="<?php echo 'accept'.$r['pay_id'];?>">Accepted</button>
                                                                            <button class="btn btn-danger" onclick="payReqStatus(<?php echo $r['pay_id'].','.'2'.','.$r['user_id'].','.$r['amount']; ?>)" style="display:none" id="<?php echo 'decline'.$r['pay_id'];?>">Declined</button>
                                                                        <?php } else if($r['payStatus'] == '1') { ?>
                                                                            <button style="display: none"  type="button" id="<?php echo 'pa'.$r['pay_id'];?>" class="btn btn-secondary fa fa-check"></button>
                                                                            <button style="display: none"  type="button" id="<?php echo 'pd'.$r['pay_id'];?>" class="btn btn-danger fa fa-times"></button>
                                                                            <button class="btn btn-secondary"  id="<?php echo 'accept'.$r['pay_id'];?>">Accepted</button>
                                                                        <?php } else { ?>
                                                                            <button style="display: none" onclick="payReqStatus(<?php echo $r['pay_id'].','.'1'.','.$r['user_id'].','.$r['amount']; ?>)" type="button" id="<?php echo 'pa'.$r['pay_id'];?>" class="btn btn-secondary fa fa-check"></button>
                                                                            <button style="display: none" onclick="payReqStatus(<?php echo $r['pay_id'].','.'0'.','.$r['user_id'].','.$r['amount'];?>)" type="button" id="<?php echo 'pd'.$r['pay_id'];?>" class="btn btn-danger fa fa-times"></button>
                                                                            <button class="btn btn-danger" onclick="payReqStatus(<?php echo $r['pay_id'].','.'2'.','.$r['user_id'].','.$r['amount']; ?>)" id="<?php echo 'decline'.$r['pay_id'];?>">Declined</button>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                               

                                                            </tbody>
                                                        </table>

                                                        <script type="text/javascript">
                                                            $('#sample-data-table').DataTable({
                                                                dom       : '<lf<t>ip>'
                                                            });
                                                        </script>
                                </div>
                            </div>
                        </div>
                        <!-- / CONTENT -->
                    </div>

                    <script type="text/javascript" src="<?php echo URL;?>js/apps/e-commerce/products/products.js"></script>

                </div>
            </div>


    <div id="profile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 670px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="resData"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

   <div id="referral" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 670px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="return_data"></div>
        </div>
    </div>
</div>

    <div id="barcode" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body" id="barcodeImg"></div>
            </div>
        </div>
    </div>
<style>
.btn-secondary, 
.btn-danger{
    font-size: 10px;
    min-width: 50px;
    font-weight: 600;
    height: 2.6rem;
    line-height: 2.6rem;
}

table.dataTable tbody th, table.dataTable tbody td {
    padding: 5px 8px;
    font-size: 11px;
    text-align: center;
}
table.dataTable, table.dataTable th, table.dataTable td {
    text-align: center !important;
}
</style>
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
        $("#pay a").addClass('active');

    });

    function viewBarcode(pay_id) {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('super_admin/payreq/getBarcode');?>',
            data: 'pay_id='+pay_id,
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

    function activeDe_active(user_id,val) {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('super_admin/users/active_deactive');?>',
            data: {user_id : user_id, val },
            success: function(data) {
                if(data == 1) {
                    document.getElementById(user_id).style.display = 'none';
                    document.getElementById('a'+user_id).style.display = '';
                }else{
                    document.getElementById(user_id).style.display = '';
                    document.getElementById('a'+user_id).style.display = 'none';
                }
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
        $('#pa'+id).closest("tr").hide();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('super_admin/payreq/active_deactive');?>',
            data: {id : id, val, uId, amnt },
            success: function(response) {
                var res = JSON.parse(response);
                console.log(res);
                if(res.data == 1) {
                    if(res.status == 'SUCCESS'){
                        $('.paytm_sucess_alert').html(res.msg);
                        $('.paytm_sucess_alert').attr('style','display:true;text-align: center;');
                        setTimeout(function() { $('#pa'+id).closest("tr").hide(); }, 1000);
                        setTimeout(function() { $(".paytm_sucess_alert").hide(); }, 5000);
                    }
                    if(res.status == 'FAILURE'){
                        $('.paytm_failure_alert').html(res.msg);
                        $('.paytm_failure_alert').attr('style','display:true;text-align: center;');
                        setTimeout(function() { $('#pa'+id).closest("tr").hide(); }, 1000);
                        setTimeout(function() { $(".paytm_failure_alert").hide(); }, 5000);
                    }
                    if(res.status == 'PENDING'){
                        $('.paytm_sucess_alert').html(res.msg);
                        $('.paytm_sucess_alert').attr('style','display:true;text-align: center;');
                        setTimeout(function() { $('#pa'+id).closest("tr").hide(); }, 1000);
                        setTimeout(function() { $(".paytm_sucess_alert").hide(); }, 5000);
                    }
                }else if(res.data == 0){
                    if(res.status == 'SUCCESS'){
                        $('.paytm_sucess_alert').html(res.msg);
                        $('.paytm_sucess_alert').attr('style','display:true;text-align: center;');
                        setTimeout(function() { $('#pa'+id).closest("tr").hide(); }, 1000);
                        setTimeout(function() { $(".paytm_sucess_alert").hide(); }, 5000);
                    }
                    if(res.status == 'FAILURE'){
                        $('.paytm_failure_alert').html(res.msg);
                        $('.paytm_failure_alert').attr('style','display:true;text-align: center;');
                        setTimeout(function() { $('#pa'+id).closest("tr").hide(); }, 1000);
                        setTimeout(function() { $(".paytm_failure_alert").hide(); }, 5000);
                    }
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