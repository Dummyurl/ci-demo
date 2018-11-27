<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo ADMIN_TITLE; ?> | login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700italic,700,900,900italic" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo CSS; ?>AdminLTE.min.css">
    <link type="text/css" rel="stylesheet" href="<?php URL;?>css/style.css">
    <link type="text/css" rel="stylesheet" href="<?php URL;?>vendor/animate.css/animate.min.css">
    <link type="text/css" rel="stylesheet" href="<?php URL;?>vendor/pnotify/pnotify.custom.min.css">
    <link type="text/css" rel="stylesheet" href="<?php URL;?>vendor/nvd3/build/nv.d3.min.css" />
    <link type="text/css" rel="stylesheet" href="<?php URL;?>vendor/perfect-scrollbar/css/perfect-scrollbar.min.css" />
    <link type="text/css" rel="stylesheet" href="<?php URL;?>vendor/fuse-html/fuse-html.min.css" />
    <link type="text/css" rel="stylesheet" href="<?php URL;?>css/main.css">

    <script type="text/javascript" src="<?php URL;?>vendor/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="<?php URL;?>vendor/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php URL;?>vendor/fuse-html/fuse-html.min.js"></script>
    <script type="text/javascript" src="<?php URL;?>js/main.js"></script>
    
  </head>
  <body class="layout layout-vertical layout-left-navigation layout-below-toolbar">
    <main>
        <div id="wrapper">
                <div class="content custom-scrollbar">
                    <div id="login" class="p-8">
                        <div class="form-wrapper md-elevation-8 p-8">
                        
                            <div class="logo1">
                            <img style="width: 150px" src="<?php echo IMAGE.'profile.png'; ?>">    
                            </div>
                            <div class="title mt-4 mb-8">Log in to your account</div>
                            <form action="" method="post">
                                 <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
                                <div class="form-group mb-4">
                                    <input type="email" class="form-control" name="username" id="loginFormInputEmail" aria-describedby="emailHelp" placeholder=" " />
                                    <label for="loginFormInputEmail">Email address</label>
                                </div>
                                <div class="form-group mb-4">
                                    <input type="password" class="form-control" name="password" id="loginFormInputPassword" placeholder="Password" />
                                    <label for="loginFormInputPassword">Password</label>
                                </div>
                                <div id="login_error"><center><p><?php if(isset($error)) { echo $error; } ?></p></center></div>
                                <button type="submit" name="login" class="submit-button btn btn-block btn-secondary my-4 mx-auto" aria-label="LOG IN">
                                    LOG IN
                                </button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </main>
</body>
<script>
	$(document).ready(function(e)
	{
    var timer = setInterval( hideMsg, 4000);
		function hideMsg()
		{
			$('#login_error').stop().slideUp('slow');
		}
    });
    </script>
</html>