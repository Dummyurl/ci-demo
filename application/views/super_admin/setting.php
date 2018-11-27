
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
                    <div id="wrapper"></div>
                    <div class="content custom-scrollbar">
                        <div class="col-md-12" style="margin-top: 10px;">
                            <div class="row">
                                <div class="col-md-2">      
                                    <div class="form-wrapper md-elevation-8 p-8">
                                        <div class="title mt-4 mb-2">Referral Level Income</div>
                                        <form role="form" name="form" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputJoin" value="<?php echo $setting['join_referral']; ?>" onchange="getUpdate(this.value,'join_referral');" style="text-align: center">
                                                <label for="settingFormInputJoin">Join :</label>
                                            </div>
                                            <?php foreach($level as $l){ ?>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="settingFormInput<?php echo $l['level_id']; ?>" value="<?php echo $l['price']; ?>" onchange="getReferaal(this.value,<?php echo $l['level_id'];?>);" style="text-align: center">
                                                        <label for="settingFormInput<?php echo $l['level_id']; ?>">Level <?php echo $l['level_id']; ?>:</label>
                                                    </div>
                                            <?php } ?>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-4">      
                                    <div class="form-wrapper md-elevation-8 p-8">
                                        <div class="title mt-4 mb-8">Advertisement Ids</div>
                                        <form role="form" name="form" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputBanner1" value="<?php echo $setting['banner']; ?>" onchange="getUpdate(this.value,'banner');" style="font-size: 11px;">
                                                <label for="settingFormInputBanner1">Banner 1:</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputBanner2" value="<?php echo $setting['banner2']; ?>" onchange="getUpdate(this.value,'banner2');" style="font-size: 11px;">
                                                <label for="settingFormInputBanner2">Banner 2:</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputBanner3" value="<?php echo $setting['banner3']; ?>" onchange="getUpdate(this.value,'banner3');" style="font-size: 11px;">
                                                <label for="settingFormInputBanner3">Banner 3:</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputInterstrial" value="<?php echo $setting['interstrial']; ?>" onchange="getUpdate(this.value,'interstrial');" style="font-size: 11px;">
                                                <label for="settingFormInputInterstrial">Interstrial :</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputRewardvideo" value="<?php echo $setting['reward_video']; ?>" onchange="getUpdate(this.value,'reward_video');" style="font-size: 11px;">
                                                <label for="settingFormInputRewardvideo">Reward Video :</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputRewardvideo" value="<?php echo $setting['fb_bannerid']; ?>" onchange="getUpdate(this.value,'fb_bannerid');" style="font-size: 11px;">
                                                <label for="settingFormInputRewardvideo">FB Banner :</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputRewardvideo" value="<?php echo $setting['fb_fullscreenid']; ?>" onchange="getUpdate(this.value,'fb_fullscreenid');" style="font-size: 11px;">
                                                <label for="settingFormInputRewardvideo">FB Fullscreen :</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputRewardvideo" value="<?php echo $setting['fb_native']; ?>" onchange="getUpdate(this.value,'fb_native');" style="font-size: 11px;">
                                                <label for="settingFormInputRewardvideo">FB Native :</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputRewardvideo" value="<?php echo $setting['startapp_video']; ?>" onchange="getUpdate(this.value,'startapp_video');" style="font-size: 11px;">
                                                <label for="settingFormInputRewardvideo">StartApp Video :</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputTask" value="<?php echo $setting['task']; ?>" onchange="getUpdate(this.value,'task');" style="font-size: 11px;">
                                                <label for="settingFormInputTask">Task :</label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="form-wrapper md-elevation-8 p-8" style="margin-top:30px;">
                                        <div class="title mt-4 mb-8">Earning Price</div>
                                        <form role="form" name="form" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputImp" value="<?php echo $setting['imp_earn']; ?>" onchange="getUpdate(this.value,'imp_earn');" style="font-size: 11px;">
                                                <label for="settingFormInputImp">Impression :</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputClick" value="<?php echo $setting['click_earn']; ?>" onchange="getUpdate(this.value,'click_earn');" style="font-size: 11px;">
                                                <label for="settingFormInputClick">Click :</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputInstall" value="<?php echo $setting['install_earn']; ?>" onchange="getUpdate(this.value,'install_earn');" style="font-size: 11px;">
                                                <label for="settingFormInputInstall">Install :</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputTimerForClick" value="<?php echo $setting['timer']; ?>" onchange="getUpdate(this.value,'timer');" style="font-size: 11px;">
                                                <label for="settingFormInputTimerForClick">Timer for Click :</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputTimerForImp" value="<?php echo $setting['timer1']; ?>" onchange="getUpdate(this.value,'timer1');" style="font-size: 11px;">
                                                <label for="settingFormInputTimerForImp">Timer for Impression :</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-3">      
                                    <div class="form-wrapper md-elevation-8 p-8">
                                        <div class="title mt-4 mb-8">Paytm Request Limit</div>
                                        <form role="form" name="form" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputMinimum" value="<?php echo $setting['paytm_per']; ?>" onchange="getUpdate(this.value,'paytm_per');" style="text-align: center">
                                                <label for="settingFormInputMinimum">Percentage (%)</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputMinimum" value="<?php echo $setting['paytm_min']; ?>" onchange="getUpdate(this.value,'paytm_min');" style="text-align: center">
                                                <label for="settingFormInputMinimum">Minimum</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputMaximum" value="<?php echo $setting['paytm_max']; ?>" onchange="getUpdate(this.value,'paytm_max');" style="text-align: center">
                                                <label for="settingFormInputMaximum">Maximum</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputReqPerDay" value="<?php echo $setting['paytm_limit']; ?>" onchange="getUpdate(this.value,'paytm_limit');" style="text-align: center">
                                                <label for="settingFormInputReqPerDay">How many request send per day</label>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" id="settingFormInputPayMessage" onchange="getUpdate(this.value,'paytm_limit_msg');" rows="5"><?php echo $setting['paytm_limit_msg']; ?></textarea>
                                                <label for="settingFormInputPayMessage">Paytm Limit Message</label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="form-wrapper md-elevation-8 p-8" style="margin-top: 30px;">
                                        <div class="title mt-4 mb-8">Spin Settings</div>
                                        <form role="form" name="form" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputMinimum" value="<?php echo $setting['spin']; ?>" onchange="getUpdate(this.value,'spin');" style="text-align: center">
                                                <label for="settingFormInputMinimum">Spin</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputMinimum" value="<?php echo $setting['today_click']; ?>" onchange="getUpdate(this.value,'today_click');" style="text-align: center">
                                                <label for="settingFormInputMinimum">Today Click</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputMinimum" value="<?php echo $setting['money_per_click']; ?>" onchange="getUpdate(this.value,'money_per_click');" style="text-align: center">
                                                <label for="settingFormInputMinimum">Money per Click</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputMinimum" value="<?php echo $setting['install_click']; ?>" onchange="getUpdate(this.value,'install_click');" style="text-align: center">
                                                <label for="settingFormInputMinimum">Today Install</label>
                                            </div>                                                          
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputMinimum" value="<?php echo $setting['money_per_install']; ?>" onchange="getUpdate(this.value,'money_per_install');" style="text-align: center">
                                                <label for="settingFormInputMinimum">Money per Install</label>
                                            </div>   
                                        </form>
                                    </div>
                                </div> 
                                <div class="col-md-3">      
                                    <div class="form-wrapper md-elevation-8 p-8">
                                        <div class="title mt-4 mb-8">Daily Earn </div>
                                        <form role="form" name="form" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputMinimum" value="<?php echo $setting['today_earn']; ?>" onchange="getUpdate(this.value,'today_earn');" style="text-align: center">
                                                <label for="settingFormInputMinimum">Daily Earn</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputMaximum" value="<?php echo $setting['today_earn1']; ?>" onchange="getUpdate(this.value,'today_earn1');" style="text-align: center">
                                                <label for="settingFormInputMaximum">Daily CheckIn Earn</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputMaximum" value="<?php echo $setting['coin_click']; ?>" onchange="getUpdate(this.value,'coin_click');" style="text-align: center">
                                                <label for="settingFormInputMaximum">Daily Coin</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputMaximum" value="<?php echo $setting['money_per_coin']; ?>" onchange="getUpdate(this.value,'money_per_coin');" style="text-align: center">
                                                <label for="settingFormInputMaximum">Money Per Coin</label>
                                            </div>
                                            
                                            
                                        </form>
                                    </div>
                                    <div class="form-wrapper md-elevation-8 p-8" style="margin-top: 30px;">
                                        <div class="title mt-4 mb-8">Other Settings</div>
                                        <form role="form" name="form" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputMinimum" value="<?php echo $setting['version']; ?>" onchange="getUpdate(this.value,'version');" style="text-align: center">
                                                <label for="settingFormInputMinimum">Version</label>
                                            </div> 
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="settingFormInputMinimum" value="<?php echo $setting['ad_status']; ?>" onchange="getUpdate(this.value,'ad_status');" style="text-align: center">
                                                <label for="settingFormInputMinimum">Status</label>
                                            </div>
                                           
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="<?php echo URL;?>js/apps/e-commerce/products/products.js"></script>
        </div>
    </div>        
</div>

<script type="text/javascript">
    $(document).ready(function (e) {
        $(".sidebar-menu li").removeClass("active");
        $("#seting").addClass('active');
        $('.sidebar-menu ul').css('display', 'none').addClass('closed');
    });
</script>
<script>

    function getUpdate(val,key) {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('super_admin/setting/getUpdate'); ?>",
            data: { val : val, key },
//            success: function(data) {
//                alert(data);
//            }
        });
    }

    function getReferaal(val,id) {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('super_admin/setting/getReferaal'); ?>",
            data: { val : val, id },
        });
    }
</script>