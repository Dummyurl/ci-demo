<section class="content-header">
    <h1 style="font-size:20px">Daily Task
        <small style="font-size:12px">Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('super_admin/users');?>">Daily Task</a></li>
        <li class="active">Daily Task</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="login-box">
            <div class="login-box-body">
                <p class="login-box-msg">Enter Password</p>
                <form action="<?php echo site_url('super_admin/task/set_pass') ?>" method="post" >
                    <div class="form-group has-feedback">
                        <input type="password" name="pass" class="form-control" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <button type="submit" name="enter" value="enter" class="btn btn-primary btn-block btn-flat">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function (e) {
        $(".sidebar-menu li").removeClass("active");
        $("#task").addClass('active');
        $('.sidebar-menu ul').css('display', 'none').addClass('closed');
    });
</script>