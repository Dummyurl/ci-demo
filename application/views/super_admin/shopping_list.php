<script> function category(id){ window.location="<?php echo base_url();?>super_admin/shopping/index/"+id;} </script>


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
                                            <div class="h4">Shopping Product list</div>
                                            <div class="">Shopping Product list: <?php echo count($records); ?></div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="col search-wrapper px-2">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-icon">
                                                    <i class="fa fa-2x fa-search"></i>
                                                </button>
                                            </span>
                                            <select class="form-control pull-right" style="width: 20%;margin: 0 2%" onchange="category(this.value)">
                                                <?php if($id != "") { ?>
                                                    <option value="all"<?php if($id == 'all' ) { echo 'selected'; }?>>All</option>
                                                    <option value="amazon"<?php if($id == 'amazon' ) { echo 'selected'; }?>>Amazon</option>
                                                    <option value="flipkart"<?php if($id == 'flipkart' ) { echo 'selected'; }?>>Flipkart</option>
                                                    <option value="snapdeal"<?php if($id == 'snapdeal' ) { echo 'selected'; }?>>Snapdeal</option>
                                                    <option value="our_product"<?php if($id == 'our_product' ) { echo 'selected'; }?>>Our Product</option>
                                                <?php } ?>
                                            </select>
                                            <a href="<?php echo base_url('super_admin/shopping/add_shopping'); ?>" class="btn btn-light pull-right">Add</a>
                                        </div>
                                    </div>
                            </div>
                            <div class="page-content-card">
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
                                                                            <span class="column-title">category</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">title</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">Thumbnail</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">quantity</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">price</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">status</span>
                                                                        </div>
                                                                    </th>
                                                                    <th class="secondary-text">
                                                                        <div class="table-header">
                                                                            <span class="column-title">Action</span>
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($records as $r) { ?>
                                                                <?php 
                                                                    $images = explode(",",$r['images']);
                                                                ?>
                                                                 <tr>
                                                                <td><?php echo $r['shopping_id']; ?></td>
                                                                <td><?php echo $r['category']; ?></td>
                                                                <td><?php echo $r['title']; ?></td>
                                                                <td><img class="img" height="65" width="65"  src="<?php echo IMAGE.'products/'.$r['thumbnail']; ?>"></td>
                                                                <td><?php echo $r['quantity']; ?></td>
                                                                <td><?php echo $r['price']; ?><br/><span class="h6" style="color:red;"> ( GST % is included in price )<span></td>
                                                                <td><b>
                                                                    <?php if($r['status']==0){
                                                                        echo 'Active';
                                                                    }else{
                                                                        echo 'Deactive';
                                                                    } ?>
                                                                </b></td>
                                                                <td>
                                                                    <a class="fa fa-2x fa-edit btn btn-secondary btn-xs" href="<?php echo base_url('super_admin/shopping/edit?id=').$r['shopping_id'];?>"></a>
                                                                    <a class="fa fa-2x fa-trash btn btn-danger btn-xs" href="<?php echo base_url('super_admin/shopping/delete?id=').$r['shopping_id'];?>"></a>
                                                                </td>
                                                                </tr><?php } ?>
                                                               

                                                            </tbody>
                                                        </table>

                                                        <script type="text/javascript">
                                                            $('#sample-data-table').DataTable({
                                                                dom       : '<lf<t>ip>'
                                                            });
                                                        </script>
                            </div>
                        </div>
                        <!-- / CONTENT -->
                    </div>

                    <script type="text/javascript" src="<?php echo URL;?>js/apps/e-commerce/products/products.js"></script>

                </div>
</div>
  

<script type="text/javascript">
    $(document).ready(function (e) {
        $("#shopp a").addClass('active');
    });

    function dlt_user(user_id) {
        if (confirm("Are You Sure you want to delete?")) {
            var xmlhttp;
            if (window.XMLHttpRequest) {
                xmlhttp=new XMLHttpRequest();
            } else {
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            var url = "<?php echo base_url('super_admin/users/delete'); ?>" + "/" +user_id;
            xmlhttp.open("GET",url,true);                xmlhttp.send();
            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState == 4 ) {
                    location.reload();
                }
            }
        }
    };
</script>