<?php $db = mysqli_connect(HOST,USER,PASS,DB); ?>
<section class="content-header">
    <h1 style="font-size:20px">Application list
        <small style="font-size:12px">Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Application</li>
    </ol>
	<section class="content">          <!-- Small boxes (Stat box) -->
   		<div class="row">
        	<form method="post" action="<?php echo base_url('super_admin/application/delete'); ?>" onsubmit="return giveNotation()">
			<div class="box">
                <div class="box-header">
                    <a href="<?php echo base_url('super_admin/application/add_application'); ?>" class="btn btn-success pull-right">Add App</i></a>
                    <input type="submit" name="submit" id="del_btn" value="Delete" class="btn btn-danger pull-left"/>
                    </div><!-- /.box-header -->
                    <div class="box-body mailbox-messages" style="overflow:scroll">
                    <table id="example1" class="table table-bordered table-striped table-hover table-responsive mailbox-messages">
                        <thead>
                        <tr>
                            <th style="text-align:center">
                                <div class="mailbox-controls" >
                                    <button type="button" class="btn btn-default btn-xl checkbox-toggle"
                                            style="margin:0 !important" name="ch[]"><i class="fa fa-square-o" ></i>
                                    </button>
                                </div>
                            </th>
                            <th>Id</th>
                            <th>Icon</th>
                            <th>Application Name</th>
                            <th>Group</th>
                            <th>Impression</th>
                            <th>Click</th>
                            <th>Option</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($records as $r) { ?>
                            <tr>
                                <td width="50px"><input type="checkbox" name="app[]" class="all_del"  value="<?php echo $r['app_id']; ?>"></td>
                                <td align="center"><?php echo $r['app_id']; ?></td>
                                <td align="center"><?php if($r['icon']){ ?><img src="<?php echo IMAGE.'app_icon/'.$r['icon']; ?>" height="50px" width="50px" style="border-radius: 10px"><?php } else { ?><img src="<?php echo IMAGE.'no_image.png'; ?>" height="50px" width="50px" style="border-radius: 10px"><?php } ?> </td>
                                <td align="center"><?php echo $r['application_name']; ?></td>
                                <?php $g = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM tbl_group WHERE g_id = '".$r['g_id']."'")); ?>
                                <td align="center"><?php echo $g['group']; ?></td>
                                <td align="center"><?php echo $r['impression']; ?></td>
                                <td align="center"><?php echo $r['click']; ?></td>
                                <td>
                                    <a class="fa fa-pencil btn btn-primary" href="<?php echo base_url('super_admin/application/add_application') . "/" . $r['app_id']; ?>" style="margin-bottom: 3px"></a>
                                    <a class="fa fa-trash btn btn-danger" onClick="dlt_app(<?php echo $r['app_id']; ?>)" style="margin-bottom: 3px"></a>
                                </td>
                            </tr    ><?php } ?></tbody>
                        <tfoot></tfoot>
                    </table>
                </div><!-- /.box-body -->
    		</div>
    </section><!-- /.row -->
</section>
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
        $("#app").addClass('active');
        $('.sidebar-menu ul').css('display', 'none').addClass('closed');
    });

    function dlt_app(app_id) {
        if (confirm("Are You Sure you want to delete?")) {
            var xmlhttp;
            if (window.XMLHttpRequest) {
                xmlhttp=new XMLHttpRequest();
            } else {
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            var url = "<?php echo base_url('super_admin/application/delete'); ?>" + "/" +app_id;
            xmlhttp.open("GET",url,true);
            xmlhttp.send();
            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState == 4 ) {
                    location.reload();
                }
            }
        }
    }
</script>