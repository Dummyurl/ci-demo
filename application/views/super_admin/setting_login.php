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
                                            <div class="h4">Settings</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="page-content-card">
                                            <div class="content custom-scrollbar">
                                                <div id="login" class="p-8">
                                                    <div class="form-wrapper md-elevation-8 p-8">
                                                        <div class="title mt-4 mb-8">Log in to your account</div>
                                                        <form action="<?php echo site_url('super_admin/setting/set_pass') ?>" method="post" >
                                                            <div class="form-group mb-4">
                                                                <input type="password" class="form-control" name="pass" id="loginFormInputPassword" placeholder="Password" />
                                                                <label for="loginFormInputPassword">Password</label>
                                                            </div>
                                                            <div id="login_error"><center><p><?php if(isset($error)) { echo $error; } ?></p></center></div>
                                                            <button type="submit" name="enter" class="submit-button btn btn-block btn-secondary my-4 mx-auto" aria-label="LOG IN">
                                                                LOG IN
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                        </div>
                            </div>
                        </div>
                    <script type="text/javascript" src="<?php echo URL;?>js/apps/e-commerce/products/products.js"></script>
                </div>
</div>

<script type="text/javascript">
    $(document).ready(function (e) {
        $(".sidebar-menu li").removeClass("active");
        $("#seting").addClass('active');
        $('.sidebar-menu ul').css('display', 'none').addClass('closed');
    });
</script>