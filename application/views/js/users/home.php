<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script>
    jQuery(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var h = {};
        if ($('#calendar').parents(".portlet").width() <= 720) {
            $('#calendar').addClass("mobile");
            h = {
                left: 'title',
                center: '',
                right: 'prev,next,month'
            };
        } else {
            $('#calendar').removeClass("mobile");
            h = {
                left: 'title',
                center: '',
                right: 'prev,next,month'
            };
        }
        $('#calendar').fullCalendar('destroy'); // destroy the calendar
        $('#calendar').fullCalendar({ //re-initialize the calendar
            header: h,
            defaultView: 'month', // change default view with available options from http://arshaw.com/fullcalendar/docs/views/Available_Views/
            slotMinutes: 15,
            editable: false,
            droppable: false,
            eventSources : ['<?=site_url('/Meetings/getMeetings')?>'],
            eventClick: function(calEvent, jsEvent, view) {
                $.ajax({
                    url:"<?=site_url('/Meetings/detailMeeting')?>/"+calEvent.id,
                    type:"GET",
                    cache : false,
                    success:function(respon){
                        $('#detail-content').html(respon);
                        $('#detail-modal').modal('show');
                    }
                });
            }
        });
    });
</script>