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
                    <div id="chat" class="page-layout carded full-width">
                        <div class="top-bg bg-secondary"></div>
                        <div class="page-content-wrapper w-100 mx-auto px-0 pt-0 pt-sm-4 px-sm-4 pt-sm-8">
                            <div class="page-content-card">
                                <aside class="left-sidebar" data-fuse-bar="chat-left-sidebar" data-fuse-bar-media-step="lg">
                                    <div id="chat-left-sidebar-views" class="views">
                                        <div id="chats-view" class="view d-flex flex-column no-gutters">
                                            <div class="toolbar">
                                                <div class="toolbar-bottom row align-items-center no-gutters px-4">
                                                    <div class="search-wrapper md-elevation-1 row no-gutters align-items-center w-100 p-2">
                                                        <i class="icon-magnify s-4"></i>
                                                        <input class="col pl-2" type="text" placeholder="Search or start new chat">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content col custom-scrollbar">  
                                                <div class="chat-list">
                                                    <?php 
                                                    foreach($records as $record){
                                                    ?>
                                                    <div class="contact ripple flex-wrap flex-sm-nowrap row p-4 no-gutters align-items-center unread" user_id="<?php echo $record['user_id']; ?>">
                                                        <div class="col-auto avatar-wrapper">
                                                            <img src="<?php echo $record['profile'];?>" class="avatar" alt="Barrera" />
                                                        </div>
                                                        <div class="col px-4">
                                                            <span class="name h6"><?php echo $record['username'];?></span>
                                                            <p class="last-message text-truncate text-muted"><?php echo $record['msg'];?></p>
                                                        </div>
                                                        <div class="col-12 col-sm-auto d-flex flex-column align-items-end">
                                                            <div class="last-message-time"><?php echo date_format(date_create($record['c_date']),'d M y');?></div>
                                                        </div>
                                                    </div>
                                                    <div class="divider"></div>
                                                    <?php } ?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </aside>

                                <div class="page-content">
                                    <div id="chat-content-views" class="views">
                                        <div id="start-view" class="view d-flex flex-column align-items-center justify-content-center">
                                            <div class="big-circle md-elevation-4 row align-items-center justify-content-center no-gutters">
                                                <i class="fa fa-comments" style="font-size: 125px;color: #2196f3;margin-top: -100px;margin-left: -90px;"></i>
                                            </div>
                                            <span class="app-title h3 my-3">Chat App</span>
                                            <span class="text-muted h6 d-none d-xl-block">Select contact to start the chat!..</span>
                                            <button type="button" class="btn btn-secondary d-block d-xl-none" data-fuse-bar-toggle="chat-left-sidebar">
                                                Select contact to start the chat!..
                                            </button>
                                        </div>
                                        <div id="chat-view" class="view flex-column align-items-center justify-content-center d-none">
                                            <div class="toolbar row no-gutters align-items-center justify-content-between w-100 px-4">
                                                <div class="col">
                                                    <div class="row no-gutters align-items-center">
                                                        <button type="button" class="btn btn-icon" data-fuse-bar-toggle="chat-left-sidebar">
                                                            <i class="icon icon-hangouts s-8"></i>
                                                        </button>
                                                        <div class="chat-contact row no-gutters align-items-center">
                                                            <input type="hidden" class="chatting_user_id" value="">
                                                            <div class="avatar-wrapper mr-4">
                                                                <img src="" id="user_avtar_main" class="avatar" alt="Barrera" />
                                                            </div>
                                                            <div class="chat-contact-name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-icon">
                                                    <i class="icon icon-dots-vertical"></i>
                                                </button>
                                            </div>
                                            
                                            <div class="chat-content col custom-scrollbar" style="overflow-y:auto !important;">
                                                <div class="chat-messages">
                                                   
                                                </div>
                                            </div>
                                            
                                            <div class="chat-footer row align-items-center justify-content-center w-100 p-2 pl-4">
                                                <form class="reply-form row no-gutters align-items-center w-100">
                                                  
                                                    <div class="form-group col mr-4">
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Type and hit enter to send message"></textarea>
                                                    </div>
                                                    <button type="button" class="btn btn-fab btn-secondary send_user_comm_msg" aria-label="Send message">
                                                        <i class="fa fa-2x fa-paper-plane" style="margin-top: -5px;margin-left: -5px;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <script type="text/javascript" src="../js/apps/chat/chat.js"></script>
                </div>
            </div>
          
            <script type="text/javascript">
    $(document).ready(function (e) {
        $(".sidebar-menu li").removeClass("active");
        $("#comm    ").addClass('active');
        $('.sidebar-menu ul').css('display', 'none').addClass('closed');
        
        $(document).on('click','.send_user_comm_msg',function(){
            var msg = $('#exampleFormControlTextarea1').val();
            var user_id = $('.chatting_user_id').val();
            if(msg != ''){
                $.ajax({
                type: 'POST',
                url: '<?php echo site_url('super_admin/comm/send_msg_to_user');?>',
                data:{
                    msg:msg,
                    user_id:user_id
                }, 
                success: function(data) {
                    if(data){
                        location.reload();
                    }else{
                        location.reload();
                    }
                }
            });
            }
        });
    });
</script>