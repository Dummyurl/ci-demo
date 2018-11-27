<div class="quick-panel-sidebar custom-scrollbar" fuse-cloak data-fuse-bar="quick-panel-sidebar" data-fuse-bar-position="right">
                <div class="list-group" class="date">
                    <div class="list-group-item subheader">TODAY</div>
                    <div class="list-group-item two-line">
                        <div class="text-muted">
                            <div class="h1"> <?php echo date("l");?></div>
                            <div class="h2 row no-gutters align-items-start">
                                <span> <?php echo date("d");?></span>
                                <span class="h6">th</span>
                                <span> <?php echo date("M-Y");?></span>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="divider"></div>
                <div class="col-md-12">
                    <div class="title m-4" style="text-align: center;color: #9e9e9e;font-size: 18px;">Change Password Here!...</div>
                        <div class=col-md-12>
                            <div class="form-group">
                                <label for="password">Old Password:</label>
                                <input type="password" name="old_pswd" class="form-control" id="old_pswd" required>
                                <div id="old_pswd_error" class="text-danger"></div>
                            </div>
                        </div>
                        <div class=col-md-12>
                            <div class="form-group">
                                <label for="pwd">New Password:</label>
                                <input type="password" name="new_pswd" id="new_pswd" class="form-control" required>
                                <div id="new_pswd_error" class="text-danger"></div>
                            </div>
                        </div>
                        <div class=col-md-12>
                            <div class="form-group">
                                <label for="pwd">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirm_pswd" required>
                                <div id="confirm_pswd_error" class="text-danger"></div>
                            </div>
                        </div>
                        <div class=col-md-12>
                            <button type="button" id="change_password" class="submit-button btn btn-block btn-secondary my-4 mx-auto fuse-ripple-ready">Change Password</button>
                        </div>
                </div>
                
                 <div class="divider"></div>
                    <div class=col-md-12>
                    <div class=col-md-12>
                        <a href="<?php echo base_url('admin/logout'); ?>" class="btn btn-block btn-secondary my-4 mx-auto fuse-ripple-ready">SignOut</a>
                    </div></div>
                 </div>
        </div>
    </main>
</body>

<script>
    $(document).on('click','#change_password',function(){
        var old_pswd = $('#old_pswd').val();
        var new_pswd = $('#new_pswd').val();
        var confirm_pswd = $('#confirm_pswd').val();
        if (old_pswd=="") {
            $('#old_pswd_error').html('Plaese enter old password.');
            $("#old_pswd_error").delay(5000).slideUp();
		}else if(new_pswd == ""){
            $('#new_pswd_error').html('Plaese enter new password.');
            $("#new_pswd_error").delay(5000).slideUp();
		}else if(confirm_pswd == ""){
            $('#confirm_pswd_error').html('Plaese enter confirm password.');
            $("#confirm_pswd_error").delay(5000).slideUp();
		}else if(confirm_pswd != new_pswd){
            $('#confirm_pswd_error').html('Your passwords are not matched.');
            $("#confirm_pswd_error").delay(5000).slideUp();
		}else{
			$.ajax({
				type: 'post',
				url: '<?php echo site_url('admin/changePass');?>',
				data: { 
                    new_pswd:new_pswd
                    },
				success: function (data) {
					if(data == 1){
						alert("Password is Successfully Changed.");
						location.reload();
					}else{
						alert("Old Password is not correct.");
						$('#old_pswd').focus();
					}
				}
			});
		}
    })
</script>

</html>
