<script src="<?=base_url('assets/themes/metro')?>/global/plugins/moment.min.js" type="text/javascript"></script>
<script>
    var groupParsed=[];
    var groupActive=null;
    $(document).ready(function () {
        $.each(group,function (x,y) {
            var index=y.cg_id;
            groupParsed[index]=y;
        });
        getChat(firstLoad);
        $(document).on('click','.cg',function () {
            var cg_id=$(this).data('cgid');
            $('.cg').parent().removeClass('active');
            $(this).parent().addClass('active');
            getChat(cg_id);
        });
        $('#send-chat').click(function () {
            var msg=$('#msq-chat').val();
            if(msg!='') {
                $.ajax({
                    url: "<?=base_url('index.php/Messages/Send')?>",
                    type: "POST",
                    data: {
                        cg_id: activeChat,
                        message: $('#msq-chat').val(),
                        cg_name : groupParsed[activeChat].cg_name
                    },
                    beforeSend: function () {
                        $("#chat-content").html('');
                    },
                    success: function (resp) {
                        var result = JSON.parse(resp);
                        if (result.status){
                            getChat(activeChat);
                            $('#msq-chat').val('');
                        }else{
                            alert(result.message);
                        }
                    }
                });
            }
        });
    });
    function getChat(cg_id) {
        activeChat=cg_id;
        groupActive=groupParsed[cg_id];
        $('#chat-group').html(groupActive.cg_name);
        $.ajax({
            url: "<?=base_url('index.php/Messages/getMessages')?>/"+cg_id,
            type: "GET",
            beforeSend: function () {
                $("#chat-content").html('');
            },
            cache :false,
            success: function (resp) {
                var result=JSON.parse(resp);
                var html='';
                $.each(result,function (x,y) {
                    var defaultPhoto='<?=base_url('assets/themes/metro')?>/layouts/layout/img/avatar.png';
                    if(y.photo!="" && y.photo!=null){
                        defaultPhoto='<?=base_url('assets/uploads/files')?>/'+y.photo;
                    }
                    var position="in";
                    if(y.user_id==user_id){
                        position="out";
                    }else{
                        position="in";
                    }
                    var Time=moment(y.message_date,'DD MMMM YYYY H:mm:ss').fromNow();
                    // html+='<div class="item">' +
                    html+='<li class="'+position+'">'+
                        '<img class="avatar" alt="" src="'+defaultPhoto+'" />'+
                        '<div class="message">'+
                        '<span class="arrow"> </span>'+
                        '<a href="<?=site_url('/Profile/index')?>/'+y.user_id+'" class="name"> '+y.nama+' </a>'+
                        '<span class="datetime"> '+Time+' </span>'+
                        '<span class="body"> '+y.message+' </span>'+
                        '</div>'+
                        '</li>';
                    // '<div class="item-head">' +
                    // '<div class="item-details">' +
                    // '<img class="item-pic" src="'+defaultPhoto+'"/>' +
                    // '<a href="<?=site_url('/Profile/index')?>/'+y.user_id+'" class="item-name primary-link">'+y.nama+'</a>' +
                    // '<span class="item-label">'+Time+'</span>' +
                    // '</div>' +
                    // '</div>' +
                    // '<div class="item-body">'+y.message+'</div>' +
                    // '</div>';
                });
                $("#chat-content").html(html);
            }
        });
    }
</script>