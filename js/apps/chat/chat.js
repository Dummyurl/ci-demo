(function ()
{
    $('.chat-list .contact').on('click', function ()
    {   
        $('.chat-messages').html('');
        var user_id = $(this).attr('user_id');
        $.ajax({
            type: 'POST',
            url: 'comm/viewChartDetails',
            data: {
                user_id:user_id
            },
            success: function(dataa) {
                var data = JSON.parse(dataa);
                console.log(data.users[0].profile);
                $('.chatting_user_id').attr("value",data.users[0].user_id);
                $('.chat-contact-name').html(data.users[0].username);
                $('#user_avtar_main').attr('src',data.users[0].profile);
                var html = '';
                for(i=0;i<data.chats.length;i++){
                   if(data.chats[i].admin == '1'){
                        html +='<div class="row flex-nowrap message-row user p-4">'+
                        '<img class="avatar mr-4" src="../images/avatars/profile.jpg" alt="Admin">'+
                        '<div class="bubble">'+
                            '<div class="message">'+data.chats[i].msg+'</div>'+
                            '<div class="time text-muted text-right mt-2">'+data.chats[i].create_date+' '+data.chats[i].create_time+'</div>'+
                        '</div>'+
                        '</div>';
                   }else{
                        html +=  '<div class="row flex-nowrap message-row contact p-4">'+
                        '<img class="avatar mr-4" src='+data.users[0].profile+' />'+
                        '<div class="bubble">'+
                            '<div class="message">'+data.chats[i].msg+'</div>'+
                            '<div class="time text-muted text-right mt-2">'+data.chats[i].create_date+' '+data.chats[i].create_time+'</div>'+
                        '</div>'+
                        '</div>';
                   }
                }
                $('.chat-messages').html(html);
            }
        });
        changeView('#chat-content-views', '#chat-view');
        setInterval(updateScroll2,1000);
    });

    function updateScroll2(){
        var element = document.getElementsByClassName("chat-messages");
        element.scrollTop = element.scrollHeight;
    }
    $('#contacts-button').on('click', function ()
    {
        changeView('#chat-left-sidebar-views', '#contacts-view');
    });

    $('.back-to-chats-button').on('click', function ()
    {
        changeView('#chat-left-sidebar-views', '#chats-view');
    });

    $('#user-avatar-button').on('click', function ()
    {
        changeView('#chat-left-sidebar-views', '#user-view');
    });

    function changeView(wrapper, view)
    {
        var wrapper = $(wrapper);
        wrapper.find('.view').removeClass('d-none d-flex');
        wrapper.find('.view').not(view).addClass('d-none');
        wrapper.find(view).addClass('d-flex');
    }

})();