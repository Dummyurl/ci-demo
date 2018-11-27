<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo ADMIN_TITLE; ?>&nbsp;|&nbsp; Admin</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700italic,700,900,900italic" rel="stylesheet">
<style type="text/css">
            [fuse-cloak],
            .fuse-cloak {
                display: none !important;
            }
        </style>
	<link rel="stylesheet" href="<?php echo CSS; ?>font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo URL;?>vendor/animate.css/animate.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo URL;?>vendor/pnotify/pnotify.custom.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo URL;?>vendor/nvd3/build/nv.d3.min.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo URL;?>vendor/perfect-scrollbar/css/perfect-scrollbar.min.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo URL;?>vendor/fuse-html/fuse-html.min.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo URL;?>css/main.css">
    <script type="text/javascript" src="<?php echo URL;?>vendor/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo URL;?>vendor/mobile-detect/mobile-detect.min.js"></script>
    <script type="text/javascript" src="<?php echo URL;?>vendor/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo URL;?>vendor/popper.js/index.js"></script>
    <script type="text/javascript" src="<?php echo URL;?>vendor/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo URL;?>vendor/d3/d3.min.js"></script>
    <script type="text/javascript" src="<?php echo URL;?>vendor/nvd3/build/nv.d3.min.js"></script>
    <script type="text/javascript" src="<?php echo URL;?>vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo URL;?>vendor/datatables-responsive/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="<?php echo URL;?>vendor/pnotify/pnotify.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo URL;?>vendor/fuse-html/fuse-html.min.js"></script>
    <script type="text/javascript" src="<?php echo URL;?>js/main.js"></script>
    <script type="text/javascript" src="<?php echo URL;?>js/apps/chat/chat.js"></script>
    <link rel="stylesheet" href="<?php echo PLUGINS; ?>bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="<?php echo PLUGINS; ?>bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
</head>

<?php $db = mysqli_connect(HOST,USER,PASS,DB); ?>
<body class="layout layout-vertical layout-left-navigation layout-below-toolbar">
    <main>
        <div id="wrapper">
            <aside id="aside" class="aside aside-left" data-fuse-bar="aside" data-fuse-bar-media-step="md" data-fuse-bar-position="left">
                <div class="aside-content-wrapper">
                    <div class="aside-content bg-primary-700 text-auto">
                        <div class="aside-toolbar">
                            <div class="logo">
                                <span class="logo-icon">A</span>
                                <span class="logo-text"><?php echo ADMIN_TITLE; ?></span>
                            </div>
                            <button id="toggle-fold-aside-button" type="button" class="btn btn-icon d-none d-lg-block" data-fuse-aside-toggle-fold>
                                <i class="fa fa-2x fa-outdent" aria-hidden="true"></i>
							</button>
							
						</div>
						
                        <ul class="nav flex-column custom-scrollbar" id="sidenav" data-children=".nav-item">
                            <li class="subheader">
                                <span><?php echo $this->session->userdata('admin');?></span>
							</li>
							<li class="nav-item" id="dashboard">
                                <a class="nav-link ripple" href="<?php echo base_url('admin/dashboard'); ?>">
                                    <i class="fa fa-dashboard"></i><span>Dashboards</span>
                                </a>
							</li>
							
							<li class="treeview" id="user" >
                                <a class="nav-link">
                                    <i class="fa fa-user"></i>
									<span>Users Management</span>
								</a>
                                <ul id="collapse-dashboards" class='collapse show' role="tabpanel" aria-labelledby="heading-dashboards" data-children=".nav-item">
                                    <li id="active_users" class="nav-item">
                                        <a class="nav-link ripple" href="<?php echo base_url('super_admin/users'); ?>" >
											<i class="fa fa-circle-o text-green"></i>
                                            <span>Active Users</span>
                                            <div class="bg-green text-auto unread-message-count p-1" style="width: 30px;text-align: center;">
                                                <?php $active_user=mysqli_num_rows(mysqli_query($db,"select * from tbl_users where status = 1")); echo $active_user; ?>
                                            </div>
                                        </a>
									</li>
									<li id="deactive_users" class="nav-item">
                                        <a class="nav-link ripple" href="<?php echo base_url('super_admin/users/index_deactive'); ?>">
										<i class="fa fa-circle-o text-red"></i>
                                            <span>Deactive Users</span>
                                            <div class="bg-red text-auto unread-message-count p-1" style="width: 30px;text-align: center;">
                                            <?php $inactive_user=mysqli_num_rows(mysqli_query($db,"select * from tbl_users where status = 0")); echo $inactive_user; ?>
                                            </div>
										</a>
					
									</li>
									<li id="top_users" class="nav-item">
                                        <a class="nav-link ripple" href="<?php echo base_url('super_admin/users/topusers'); ?>" >
										<i class="fa fa-circle-o text-yellow"></i>
                                            <span>Top Users</span>
                                        </a>
                                    </li>
                                </ul>
							</li>
							
							<li id="pay" class="nav-item">
                                <a class="nav-link ripple " href="<?php echo base_url('super_admin/payreq'); ?>">
                                    <i class="fa fa-paypal"></i>
                                    <span>Paytm Request</span>
                                    <div class="bg-secondary text-auto unread-message-count p-1" style="width: 30px;text-align: center;">
                                    <?php $paytm=mysqli_num_rows(mysqli_query($db,"select * from tbl_payreq where payStatus = 2"));echo $paytm;?>
                                    </div>
                                </a>
							</li>

							<!-- <li id="recha" class="nav-item">
                                <a class="nav-link ripple " href="<?php echo base_url('super_admin/recharge'); ?>">
                                    <i class="fa fa-money"></i>
                                    <span>Recharge Request</span>
                                    <div class="bg-secondary text-auto unread-message-count p-1" style="width: 30px;text-align: center;">
                                    <?php $recharge=mysqli_num_rows(mysqli_query($db,"select * from tbl_recharge where payStatus = 2"));echo $recharge;?>
                                    </div>
                                </a>
							</li> -->

							<!-- <li id="shopp_request" class="nav-item">
                                <a class="nav-link ripple " href="<?php echo base_url('super_admin/shoppingrequest'); ?>">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Shopping Request</span>
                                    <div class="bg-secondary text-auto unread-message-count p-1" style="width: 30px;text-align: center;">
									<?php $shopping=mysqli_num_rows(mysqli_query($db,"select * from tbl_shopping_order"));echo $shopping;?>
                                    </div>
                                </a>
							</li>

							<li id="shopp" class="nav-item">
                                <a class="nav-link ripple " href="<?php echo base_url('super_admin/shopping'); ?>">
                                    <i class="fa fa-list"></i>
                                    <span>Shopping List</span>
                                    <div class="bg-secondary text-auto unread-message-count p-1" style="width: 30px;text-align: center;">
									<?php $shopping=mysqli_num_rows(mysqli_query($db,"select * from tbl_shopping"));echo $shopping;?>
                                    </div>
                                </a>
							</li> -->
							<li id="comm" class="nav-item">
                                <a class="nav-link ripple " href="<?php echo base_url('super_admin/comm'); ?>">
                                    <i class="fa fa-comments"></i>
                                    <span>Chat</span>
                                    <div class="bg-secondary text-auto unread-message-count p-1" style="width: 30px;text-align: center;">
									<?php $comm=mysqli_num_rows(mysqli_query($db,"select * from tbl_comm where status=2"));echo $comm;?>
                                    </div>
                                </a>
							</li>

							<li id="noti" class="nav-item">
                                <a class="nav-link ripple " href="<?php echo base_url('super_admin/notification'); ?>">
                                    <i class="fa fa-bell"></i>
                                    <span>Notification</span>
                                    <div class="bg-secondary text-auto unread-message-count p-1" style="width: 30px;text-align: center;">
									    <?php $notification=mysqli_num_rows(mysqli_query($db,"select * from tbl_notification"));echo $notification; ?>
                                    </div>
                                </a>
							</li>
							<li id="seting" class="nav-item">
                                <a class="nav-link ripple " href="<?php echo base_url('super_admin/setting'); ?>">
                                    <i class="fa fa-gears"></i>
									<span>Setting</span>
                                </a>
							</li>
                        </ul>
                    </div>
                </div>
            </aside>
           
     
