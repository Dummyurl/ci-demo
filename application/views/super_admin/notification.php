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
                                            <div class="h4">Notification List</div>
                                            <div class="">Total Notification: <?php echo count($records); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <?php if($this->session->userdata('msg')!='') { ?>
                                <div class="alert alert-success"><?php echo $this->session->userdata('msg'); ?></div>
                                <?php $this->session->set_userdata('msg', "");} ?>
                                <form method="post" action="<?php echo base_url("super_admin/users/index"); ?>">
                                    <div class="col search-wrapper px-2">
                                            <button type="button" data-toggle="modal" data-target="#profile" class="btn btn-light"><i class="fa fa-bell-o" style="margin-left: -30px;margin-top: 7px;font-weight: 900;"> Push</i></button>
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
                                                                            <span class="column-title">Message</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">Date</span>
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
                                                                <td><?php echo $r['n_id']; ?></td>
                                                                <td><?php echo $r['message']; ?></td>
                                                                <td><?php echo $r['noti_date']; ?></td>
                                                                <td>
                                                                    <a class="fa fa-trash btn btn-danger" onClick="dlt_notification(<?php echo $r['n_id']; ?>)"></a>
                                                                </td>
                                                                </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>

                                                        <script type="text/javascript">
                                                            $('#sample-data-table').DataTable({
                                                                responsive: true,
                                                                dom       : 'rt<"dataTables_footer"ip>'
                                                            });
                                                        </script>
                                </div>
                            </div>
                            </div>
                        </div>
                    <script type="text/javascript" src="<?php echo URL;?>js/apps/e-commerce/products/products.js"></script>
                </div>
</div>

<div id="profile" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" enctype="multipart/form-data" action="<?php echo site_url("super_admin/notification/send_notification"); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Notification<span style="color: red;">*<span> </label>
                        <textarea class="form-control" name="message" placeholder="Text here..." rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile123">Upload Audio Message*</label>
                        <input type="file" name="exampleFormControlFile123" class="form-control-file" id="exampleFormControlFile123">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="send" class="btn btn-primary pull-left">Send</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
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
        $(".sidebar-menu li").removeClass("active");
        $("#noti").addClass('active');
        $('.sidebar-menu ul').css('display', 'none').addClass('closed');
    });

    function dlt_notification(n_id) {
        if (confirm('Are you sure want to delete?')) {
            var xmlhttp;
            if (window.XMLHttpRequest) {
                xmlhttp=new XMLHttpRequest();
            } else {
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            var url = "<?php echo base_url('super_admin/notification/delete'); ?>" + "/" +n_id;
            xmlhttp.open("GET",url,true);                xmlhttp.send();
            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState == 4 ) {
                    location.reload();
                }
            }
        }
    }
</script>