<?php $db = mysqli_connect(HOST,USER,PASS,DB); ?>
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
        <div id="project-dashboard" class="page-layout simple right-sidebar">
            <div class="page-content-wrapper custom-scrollbar">
                <!-- HEADER -->
                <div class="page-header bg-secondary text-auto d-flex flex-column justify-content-between px-6 pt-4 pb-0">
                    <div class="row no-gutters align-items-start justify-content-between flex-nowrap">
                        <div>
                            <span class="h2">Welcome back, Admin!</span>
                        </div>
                        <button type="button" class="sidebar-toggle-button btn btn-icon d-block d-xl-none" data-fuse-bar-toggle="dashboard-project-sidebar" aria-label="Toggle sidebar">
                            <i class="icon icon-menu"></i>
                        </button>
                    </div>
                </div>
                <div class="page-content">
                    <div class="tab-content">
                        <div class="tab-pane fade show active p-3" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab">
                            <div class="widget-group row no-gutters">
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget1 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Active Users</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-secondary"><?php $activeuser = mysqli_num_rows(mysqli_query($db,"select * from tbl_users where status = 1")); echo $activeuser;?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget2 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Total Impression</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                 <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-danger"><?php $allImp = mysqli_fetch_array(mysqli_query($db,"select sum(impression) as imp from tbl_work")); if(isset($allImp['imp'])) echo $allImp['imp']; else echo '0'; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget3 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Total Click</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                  <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-warning"><?php $allClick = mysqli_fetch_array(mysqli_query($db,"select sum(click) as clk from tbl_work")); if(isset($allClick['clk'])) echo $allClick['clk']; else echo '0'; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget3 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Total Install</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                  <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-warning">
                                            <?php 
                                                $queryData = "select SUM(installed) as clk from tbl_work";
                                                $todayinstalled = mysqli_fetch_assoc(mysqli_query($db,$queryData)); 
                                                if($todayinstalled['clk']) echo $todayinstalled['clk']; else echo '0'; 
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-group row no-gutters">
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget2 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Today Impression</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                 <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-danger"><?php $date = date("Y-m-d"); $todayImp = mysqli_fetch_assoc(mysqli_query($db,"select SUM(impression) as imp from tbl_work where today = '".$date."'")); if($todayImp['imp']) echo $todayImp['imp']; else echo '0';?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget3 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Today Click</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                  <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-warning"><?php $allinstalled = mysqli_fetch_assoc(mysqli_query($db,"select SUM(click) as clc from tbl_work ")); if($allinstalled['clc']) echo $allinstalled['clc']; else echo '0';?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget3 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Today Install</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                  <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-warning">
                                            <?php 
                                                $todayClick = mysqli_fetch_assoc(mysqli_query($db,"select SUM(installed) as clc from tbl_work where today = '".date("Y-m-d")."'")); 
                                                if($todayClick['clc']) echo $todayClick['clc']; else echo '0'; 
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget4 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Inactive Users</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-info"><?php $inactiveuser = mysqli_num_rows(mysqli_query($db,"select * from tbl_users where status = 0")); echo $inactiveuser;?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-group row no-gutters">
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget1 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Total Paytm Request</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-secondary"><?php $totalpay = mysqli_fetch_assoc(mysqli_query($db,"select SUM(amount) as pay from tbl_payreq")); if($totalpay['pay']) echo round($totalpay['pay']); else echo '0';?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget2 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Accepted Paytm Request</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                 <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-danger"><?php $Acceptpay = mysqli_fetch_assoc(mysqli_query($db,"select SUM(amount) as pay from tbl_payreq where payStatus = 1")); if($Acceptpay['pay']) echo round($Acceptpay['pay']); else echo '0';?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget3 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Pending Paytm Request</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                  <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-warning"><?php $pendingpay = mysqli_fetch_assoc(mysqli_query($db,"select SUM(amount) as pay from tbl_payreq where payStatus = 2")); if($pendingpay['pay']) echo round($pendingpay['pay']); else echo '0';?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget4 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Declined Paytm Request</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-info"><?php $declinepay = mysqli_fetch_assoc(mysqli_query($db,"select SUM(amount) as pay from tbl_payreq where payStatus = 0")); if($declinepay['pay']) echo round($declinepay['pay']); else echo '0';?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-group row no-gutters">
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget1 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Total Recharge Request</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-secondary"><?php $totalpay = mysqli_fetch_assoc(mysqli_query($db,"select SUM(amount) as pay from tbl_recharge")); if($totalpay['pay']) echo $totalpay['pay']; else echo '0';?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget2 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Accepted Recharge Request</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                 <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-danger"><?php $Acceptpay = mysqli_fetch_assoc(mysqli_query($db,"select SUM(amount) as pay from tbl_recharge where payStatus = 1")); if($Acceptpay['pay']) echo $Acceptpay['pay']; else echo '0';?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget2 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Pending Recharge Request</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                 <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-danger"><?php $pendingpay = mysqli_fetch_assoc(mysqli_query($db,"select SUM(amount) as pay from tbl_recharge where payStatus = 2")); if($pendingpay['pay']) echo $pendingpay['pay']; else echo '0';?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget3 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Declined Recharge Request</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                  <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-warning"><?php $declinepay = mysqli_fetch_assoc(mysqli_query($db,"select SUM(amount) as pay from tbl_recharge where payStatus = 0")); if($declinepay['pay']) echo $declinepay['pay']; else echo '0';?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-group row no-gutters">
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget1 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Total Shopping Request</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-secondary"><?php $totalpay = mysqli_fetch_assoc(mysqli_query($db,"select SUM(amount) as pay from tbl_shopping_order")); if($totalpay['pay']) echo $totalpay['pay']; else echo '0';?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget2 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Accepted Shopping Request</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                 <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-danger"><?php $Acceptpay = mysqli_fetch_assoc(mysqli_query($db,"select SUM(amount) as pay from tbl_shopping_order where payStatus = 1")); if($Acceptpay['pay']) echo $Acceptpay['pay']; else echo '0';?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget2 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Pending Shopping Request</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                 <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-danger"><?php $pendingpay = mysqli_fetch_assoc(mysqli_query($db,"select SUM(amount) as pay from tbl_shopping_order where payStatus = 2")); if($pendingpay['pay']) echo $pendingpay['pay']; else echo '0';?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget3 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Declined Shopping Request</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                  <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-warning"><?php $declinepay = mysqli_fetch_assoc(mysqli_query($db,"select SUM(amount) as pay from tbl_shopping_order where payStatus = 0")); if($declinepay['pay']) echo $declinepay['pay']; else echo '0';?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-group row no-gutters">
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget1 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Today Users</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-secondary"><?php $date = date("Y-m-d"); $todayusers = mysqli_fetch_assoc(mysqli_query($db,"SELECT COUNT(user_id) as id FROM tbl_users WHERE DATE_FORMAT(create_date, '%Y-%m-%d') = '".$date."'")); if($todayusers['id']) echo $todayusers['id']; else echo '0';?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-xl-3 p-3">
                                    <div class="widget widget2 card">
                                        <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                                            <div class="col">
                                                <span class="h6">Today Accepted Paytm</span>
                                            </div>
                                            <button type="button" class="btn btn-icon">
                                                 <i class="fa fa-2x fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                        <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                                            <div class="title text-danger"><?php $date = date("Y-m-d"); $todayAcceptpay = mysqli_fetch_assoc(mysqli_query($db,"select SUM(amount) as pay from tbl_payreq where DATE_FORMAT(pay_datetime, '%Y-%m-%d') = '".$date."' AND payStatus = 1")); if($todayAcceptpay['pay']) echo round($todayAcceptpay['pay']); else echo '0';?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <script type="text/javascript" src="<?php echo URL;?>js/apps/dashboard/project.js"></script>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(e)
    {
        $(".sidebar-menu li").removeClass("active");
        $("#dashboard a").addClass('active');
        $('.sidebar-menu ul').css('display','none').addClass('closed');
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
    });
</script>
<script>

    function getUserCount() {
        var val = document.getElementById("date");
        $.ajax({
            type: 'post',
            url: '<?php echo site_url('admin/getUserCount');?>',
            data: 'val=' + val.value,
            success: function (data) {
                document.getElementById('usercnt').value = data;
            }
        });
    }

    //Paytm Request Notification Massage
    function getNotiMsg(val,key) {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('admin/getNotiMsg'); ?>",
            data: { val : val, key },
        });
    }
</script>