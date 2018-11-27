<?php $db = mysqli_connect(HOST,USER,PASS,DB); ?>
<section class="content-header">
    <h1 style="font-size:20px">Add Application
        <small style="font-size:12px">Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('super_admin/application');?>"> Application</a></li>
        <li class="active">Add Application</li>
    </ol>
</section>        <!-- Main content -->
<section class="content">          <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-8 col-xs-12">
            	<form role="form" name="form" action="" method="post" enctype="multipart/form-data">
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Group</label>
                        <select name="g_id" class="form-control" required>
                            <option>Select</option>
                            <?php $sql = mysqli_query($db,"SELECT * FROM tbl_group"); while ($g = mysqli_fetch_assoc($sql)) { ?>
                                <option value="<?php echo $g['g_id']?>"<?php if(isset($app_data)){ if($app_data[0]['g_id'] == $g['g_id']){ echo "selected"; }} ?>><?php echo $g['group'];?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Application Name </label>
                        <input type="text" class="form-control" name="application_name" value="<?php if (isset($app_data)) {echo $app_data[0]['application_name']; } ?>" placeholder=" Application Name" required>
                    </div>

                    <div class="form-group">
                        <label>Application Link </label>
                        <input type="text" class="form-control" name="application_link" value="<?php if (isset($app_data)) {echo $app_data[0]['application_link']; } ?>" placeholder=" Application Link" required>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Impression</label>
                            <input type="text" class="form-control" name="impression" value="<?php if (isset($app_data)) {echo $app_data[0]['impression']; } ?>" placeholder=" Impression" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Click</label>
                            <input type="text" class="form-control" name="click" value="<?php if (isset($app_data)) {echo $app_data[0]['click']; } ?>" placeholder=" Click" required>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group"><label for="exampleInputFile">Icon</label>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-xs-4">
                                <span class="btn btn-primary btn-file"> Browse
                                    <input type="file" class="form-control btn" name="icon" onchange="image_readURL(this);" <?php if (!isset($app_data[0]['icon'])) { echo "required"; } ?> />
                                </span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-xs-4">
                                    <?php if (!isset($app_data)) { ?>
                                        <img src="<?php echo IMAGE."no_image.png";?>" alt="" height="100" id="image" width="100" style="border-radius: 20px" />
                                    <?php } else { ?>
                                        <img src="<?php echo IMAGE.'/app_icon/'.$app_data[0]['icon'];?>" alt="" height="100" width="100" style="border-radius: 20px" id="image"/>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
					
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="button" name="back" onClick="javascript:history.go(-1);" class="btn btn-primary"><i
                            class="fa fa-chevron-circle-left"> &nbsp;</i>Back
                    </button>
                    <button type="submit" name="submit" class="btn btn-success" onclick="return validateForm()">Submit</button>
                </div>
            </form>
        </div>
    </div><!-- /.row -->        </section><!-- /.content -->
<script type="text/javascript">
	$(document).ready(function (e) {
        $(".sidebar-menu li").removeClass("active");
        $("#app").addClass('active');
        $('.sidebar-menu ul').css('display', 'none').addClass('closed');
    });

    function image_readURL(input) {
        if (input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>