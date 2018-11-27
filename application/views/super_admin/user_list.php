<script> function account(val) { window.location = "<?php echo base_url();?>super_admin/users/index?search" + val; } </script>

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
                                            <div class="h4">Active Users List</div>
                                            <div class="">Total Active Users: <?php echo count($records); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <form method="post" action="<?php echo base_url("super_admin/users/ips_delete"); ?>">
                                    <div class="col search-wrapper px-2">
                                        <div class="input-group">
                                            <input id="products-search-input1" type="text" name="ips" class="form-control" placeholder="IPS" aria-label="IPS" />
                                            <input type="submit" name="submit" value="DELETE" class="btn btn-light">
                                        </div>
                                    </div>
                                </form>
                                <form method="post" action="<?php echo base_url("super_admin/users/index"); ?>">
                                    <div class="col search-wrapper px-2">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-icon">
                                                    <i class="fa fa-2x fa-search"></i>
                                                </button>
                                            </span>
                                            <input id="products-search-input" type="text" name="search" class="form-control" placeholder="Search" aria-label="Search" />
                                            <input type="submit" name="submit" value="Search" class="btn btn-light">
                                        </div>
                                    </div>
                            </form>
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
                                                                                <span class="column-title">Mobile</span>
                                                                            </div>
                                                                        </th>
                                                                        <th class="secondary-text">
                                                                            <div class="table-header">
                                                                                <span class="column-title">IMEI</span>
                                                                            </div>
                                                                        </th>
                                                                        <th class="secondary-text">
                                                                            <div class="table-header">
                                                                                <span class="column-title">A.Id</span>
                                                                            </div>
                                                                        </th>
                                                                        <th class="secondary-text">
                                                                            <div class="table-header">
                                                                                <span class="column-title">IPS</span>
                                                                            </div>
                                                                        </th>
                                                                        <th class="secondary-text">
                                                                            <div class="table-header">
                                                                                <span class="column-title">Balance</span>
                                                                            </div>
                                                                        </th>
                                                                        <th class="secondary-text">
                                                                            <div class="table-header">
                                                                                <span class="column-title">Referral</span>
                                                                            </div>
                                                                        </th>
                                                                        <th class="secondary-text">
                                                                            <div class="table-header">
                                                                                <span class="column-title">Status</span>
                                                                            </div>
                                                                        </th>
                                                                        <th class="secondary-text">
                                                                            <div class="table-header">
                                                                                <span class="column-title">Option</span>
                                                                            </div>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php foreach ($records as $r) { ?>
                                                                    <tr>
                                                                        <td data-toggle="modal" onclick="userData(<?php echo $r['user_id']; ?>)" data-target="#profile"><?php echo $r['user_id']; ?></td>
                                                                        <td data-toggle="modal" onclick="userData(<?php echo $r['user_id']; ?>)" data-target="#profile"><?php echo $r['mobile']; ?></td>
                                                                        <td data-toggle="modal" onclick="userData(<?php echo $r['user_id']; ?>)" data-target="#profile"><?php echo $r['imei']; ?></td>
                                                                        <td data-toggle="modal" onclick="userData(<?php echo $r['user_id']; ?>)" data-target="#profile"><?php echo $r['app_id']; ?></td>
                                                                        <td data-toggle="modal" onclick="userData(<?php echo $r['user_id']; ?>)" data-target="#profile"><?php echo explode(',',$r['user_ips'])[0] ?></td>
                                                                        <td data-toggle="modal" onclick="userData(<?php echo $r['user_id']; ?>)" data-target="#profile"><?php echo $r['balance']; ?></td>
                                                                        <td data-toggle="modal" onclick="referralData(<?php echo $r['user_id']; ?>)" data-target="#referral"><?php echo $r['referral_count']; ?></td>
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
                                                                        <td>
                                                                        <a class="fa fa-trash btn btn-danger" id="aaa" onClick="dlt_user(<?php echo $r['user_id']; ?>)"></a>
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                

                                                                </tbody>
                                                            </table>

                                                            <nav aria-label="...">
                                                                    <ul class="pagination" style="float: right;">
                                                            <?php
                                                            if(isset($count)){
                                                                if($id == 0) { ?>
                                                                    <li class="page-item disabled">
                                                                        <a class="page-link" href="#">Previous</a>
                                                                    </li>
                                                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                            <?php    
                                                                }else{ $prev = $id-1;?>
                                                                    <li class="page-item">
                                                                        <a class="page-link" href="<?php echo base_url('super_admin/users/index').'/'.$prev;?>">Previous</a>
                                                                    </li>
                                                                    <li class="page-item"><a class="page-link" href="<?php echo base_url('super_admin/users/index');?>">1</a></li>
                                                                <?php 
                                                                }
                                                                    for($i=1;$i<=$count-1;$i++) {
                                                                        if($i > $id-4 AND $i < $id+4 ){
                                                                                if($i == $id) { ?>
                                                                                    <li class="page-item active">
                                                                                <?php }else{ ?>
                                                                                    <li class="page-item">
                                                                                <?php } ?>
                                                                                    <a class="page-link" href="<?php echo base_url('super_admin/users/index').'/'.$i;?>"><?php echo $i+1 ?></a>
                                                                                </li>
                                                                                <?php
                                                                                    }
                                                                                } $next = $id+1;
                                                                                   $last = $count-1 ;
                                                                                 ?>
                                                                                <li class="page-item">
                                                                                    <a class="page-link" href="<?php echo base_url('super_admin/users/index').'/'.$next;?>">Next</a>
                                                                                </li>
                                                                                <li class="page-item">
                                                                                    <a class="page-link" href="<?php echo base_url('super_admin/users/index').'/'.$last;?>">Last</a>
                                                                                </li>
                                                                        <?php   }
                                                                        ?>
                                                                    </ul>
                                                                </nav>                    

                                                            <script type="text/javascript">
                                                                $('#sample-data-table').DataTable({
                                                                    responsive: true,
                                                                    dom       : '<lf<t>ip>',
                                                                    "bPaginate": false
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
        <div class="modal-content" style="width: 770px;">
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
        <div class="modal-content" style="width: 770px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="return_data"></div>
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
        $('#example2').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function (e) {
        $("#active_users a").addClass('active');
    });
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

    function dlt_user(user_id) {
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('super_admin/users/delete');?>',
                data: {user_id : user_id},
                success: function(data) {
                    if(data == 1){
                        location.reload();
                    }else{
                        alert('User not deleted! Please try again');
                    }
                }
            })
    }
</script>