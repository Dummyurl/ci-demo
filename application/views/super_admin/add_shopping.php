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
                                            <div class="h4">Add Shopping Product</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="page-content-card "> 
                                  <div class="custom-scrollbar">  
                                    <div class="col-md-12 mt-5">
                                        <form role="form" action="" id="myForm" method="post" enctype="multipart/form-data">
                                        <div class="col-md-12">
                                            <div class="row">
                                            <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputCategory">Category</label>
                                                                <select  class="form-control" name="category" id="exampleInputCategory" required>
                                                                    <option value="our_product">Our Product</option>                            
                                                                    <option value="amazon">Amazon</option>
                                                                    <option value="flipkart">Flipkart</option>
                                                                    <option value="snapdeal">Snapdeal</option>
                                                                </select>
                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="col-md-12">
                                            <div class="row">       
                                            <div class="col-md-6">
                                                        <div class="form-group">
                                                                <input type="text" name="title" id="exampleInputTitle" class="form-control">
                                                                <label for="exampleInputTitle">Title :</label>
                                                        </div>
                                                </div>                             
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" name="price" class="form-control" id="exampleInputPrice">
                                                            <label for="exampleInputPrice">Price : <span class="h6" style="font-size: 10px;color:red;"> (GST Included Price)<span></label>
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" name="quantity" class="form-control" id="exampleInputQuantity">
                                                            <label for="exampleInputQuantity">Quantity :</label>
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div> 

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="description" id="shopping_product_description" rows="10"></textarea>
                                                        <label for="shopping_product_description">Description</label>
                                                    </div>    
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group"><label for="exampleInputFile">Thumbnail :</label>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <span class="btn btn-primary btn-file"> Browse
                                                                    <input type="file"  name="thumb_image" onchange="readURL1(this);" class="custom-file-input"  <?php if (!isset($image)) { echo "required"; } ?> />
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="row-md-12 col-md-12" id="up_images1" ></div>
                                                    </div>               
                                                </div>
                                                <div class="col-md-12">         
                                                    <div class="form-group"><label for="exampleInputFile">Image :</label>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <span class="btn btn-primary btn-file"> Browse
                                                                    <input type="file"  name="image[]" multiple onchange="readURL(this);" class="custom-file-input" <?php if (!isset($image)) { echo "required"; } ?> />
                                                                </span>
                                                            </div>
                                                            <div class="row-md-12 col-md-12">
                                                                <?php if(isset($image)) {
                                                                    foreach($image as $img) { ?>
                                                                        <div style=" margin-top: 20px; width:120px; height:120px; float:left">
                                                                            <img src="<?php echo IMAGE. $img['image']; ?>" alt="" height="100" width="100" style="position:absolute; vertical-align:super"/>
                                                                            <a class="fa fa-trash btn btn-danger btn-xs" href="<?php echo base_url('super_admin/images/delete_img?id=').$img['image_id'].'&images_id='.$return[0]['app_id'];?>" style="position: relative; margin:80px 0px 0px 75px "></a>
                                                                        </div>
                                                                    <?php } } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>   
                                                <div class="col-md-12">                        
                                                    <div class="row">
                                                        <div class="row-md-12 col-md-12" id="up_images" ></div>
                                                    </div>
                                                </div>                                   
                                                <div class="col-md-12">   
                                                <div class="form-group">                               
                                                    <button type="button" name="back" onClick="javascript:history.go(-1);" class="btn btn-primary"><i 
                                                            class="fa fa-2x fa-chevron-circle-left"> &nbsp;</i>
                                                    </button>
                                                    <button type="submit" name="submit" class="btn btn-secondary">Submit</button>
                                                </div>
                                                </div>
                                        </form>
                                    </div>
                                  </div>                                          
                                   

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
        $('#shopping_product_description').wysihtml5();
        $('.glyphicon-quote').removeClass().addClass( "fa fa-quote-left" );
        $('.glyphicon-list').removeClass().addClass( "fa fa-list-ul" );
        $('.glyphicon-th-list').removeClass().addClass( "fa fa-list-ol" );
        $('.glyphicon-indent-right').removeClass().addClass( "fa fa-align-right" );
        $('.glyphicon-indent-left').removeClass().addClass( "fa fa-align-left" );
        $('.glyphicon-share').removeClass().addClass( "fa fa-share-square" );
        $('.glyphicon-picture').removeClass().addClass( "fa fa-image" );
    });


    var readURL = function(input) {
        $('#up_images').empty();
        var number = 0;
        $.each(input.files, function(value) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var id = (new Date).getTime();
                number++;
                $('#up_images').prepend('<img id='+id+' src='+e.target.result+' width="100px" style="margin:0 20px 20px 0" height="100px" data-index='+number+' onclick="removePreviewImage('+id+')"/>')
            };
            reader.readAsDataURL(input.files[value]);
        });
    }
    var readURL1 = function(input) {
        $('#up_images1').empty();
        var number = 0;
        $.each(input.files, function(value) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var id = (new Date).getTime();
                number++;
                $('#up_images1').prepend('<img id='+id+' src='+e.target.result+' width="100px" style="margin:0 20px 20px 0" height="100px" data-index='+number+' onclick="removePreviewImage('+id+')"/>')
            };
            reader.readAsDataURL(input.files[value]);
        });
    }
</script>