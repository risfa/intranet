<link href="<?=base_url('assets/themes/metro')?>/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/themes/metro')?>/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/themes/metro')?>/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit bordered calendar">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-red"></i>
                    <span class="caption-subject font-red sbold uppercase">Manage Meeting</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <!-- BEGIN DRAGGABLE EVENTS PORTLET-->
                        <h3 class="event-form-title margin-bottom-20"></h3>
                        <div id="external-events">
                            <form class="inline-form" method="post" id="add-meeting">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button>
                                    <span id="error"></span>
                                </div>
                                <select  class="form-control" name="project_id" id="project_id">
                                    <?php
                                        foreach ($projects as $p){
                                            echo '<option value="'.$p->project_id.'">'.$p->project_name.'</option>';
                                        }
                                    ?>
                                </select>
                                <br/>
                                <input type="text" value="" class="form-control" placeholder="Description" name="meeting_desc"  id="meeting_desc" />
                                <br/>
                                <input type="text" value="" class="form-control" placeholder="Meeting Date" id="meeting_date" name="meeting_date" />
                                <br/>
                                <input type="text" value="" class="form-control" placeholder="Meeting Member" id="meeting_member" name="meeting_member"/>
                                <br/>
                                <a href="#" id="add-btn" class="btn red-flamingo"> Add Meeting </a>
                            </form>
                        </div>
                        <!-- END DRAGGABLE EVENTS PORTLET-->
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <div id="calendar" class="has-toolbar"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="detail-modal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Detail Meeting</h4>
            </div>
            <div class="modal-body" id="detail-content">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    var users = <?=$users;?>;
</script>