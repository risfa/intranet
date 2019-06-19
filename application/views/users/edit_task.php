<link href="<?=base_url('assets/themes/metro')?>/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/themes/metro')?>/apps/css/todo-2.min.css" rel="stylesheet" type="text/css" />
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN TODO SIDEBAR -->
        <div class="todo-ui">
            <!-- BEGIN TODO CONTENT -->
            <div class="todo-content">
                <div class="portlet light ">
                    <!-- PROJECT HEAD -->
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bar-chart font-green-sharp hide"></i>
                            <!--                            <span class="caption-helper">Pertamina</span> &nbsp;-->
                            <span class="caption-subject font-green-sharp bold uppercase"><?=$project_name?>'s edit update</span>
                        </div>
                    </div>
                    <!-- end PROJECT HEAD -->
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="<?=site_url().'/Tasks/saveEdit'?>" class="form-horizontal" id="edit-task" method="post">
                                    <input type="hidden" name="project_id" value="<?=$project_id?>"/>
                                    <input type="hidden" name="project_detail_id" value="<?=$project_detail_id?>"/>
                                    <input type="hidden" name="old_file" value="<?=$file?>"/>
                                    <div class="alert alert-danger display-hide" id="custom-alert">
                                        <button class="close" data-close="alert"></button>
                                        <span id="error">Fill Description and Status !</span>
                                    </div>
                                    <!-- TASK HEAD -->
                                    <div class="form">
                                        <!-- TASK DESC -->
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <textarea id="desc" name="desc" class="form-control todo-taskbody-taskdesc" rows="8" placeholder="Project Update Description...">
                                                    <?=$desc?>
                                                </textarea>
                                            </div>
                                        </div>
                                        <!-- END TASK DESC -->
                                        <!-- TASK DUE DATE -->
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                    <?php
                                                    if(isset($file)){
                                                        echo '<a href="'.base_url('/assets/uploads/files/').$file.'">'.$file.'</a><br/>';
                                                    }
                                                    ?>
                                                <div class="input-icon">
                                                    <i class="fa fa-file"></i>
                                                    <input type="file" class="form-control" name="file" id="file" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- TASK TAGS -->
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <select name="status" class="form-control todo-taskbody-tags" id="status">
                                                    <option value="Pending" <?=($status=="Pending")? 'selected' :''?>>Pending (Internal)</option>
                                                    <option value="Pending Ex" <?=($status=="Pending Ex")? 'selected' :''?>>Pending External</option>
                                                    <option value="Approved" <?=($status=="Approved")? 'selected' :''?>>Approved (Internal)</option>
                                                    <option value="Approved Ex" <?=($status=="External Ex")? 'selected' :''?>>Approved External</option>
                                                    <option value="Rejected" <?=($status=="Rejected")? 'selected' :''?>>Rejected (Internal)</option>
                                                    <option value="Rejected Ex" <?=($status=="Rejected Ex")? 'selected' :''?>>Rejected External</option>
                                                    <option value="Deal" <?=($status=="Deal")? 'selected' :''?>>Deal</option>
                                                    <option value="Completed" <?=($status=="Completed")? 'selected' :''?>>Completed</option>
                                                    <option value="Lainnya" <?=($status!="Rejected" && $status!="Deal" && $status!="Rejected Ex" && $status!="Approved Ex"  && $status!="Approved" && $status!="Pending"  && $status!="Pending Ex" && $status!="Completed")? 'selected' :''?>>Lainnya</option>
                                                </select>
                                                <br/>
                                                <input type="text" value="<?=($status!="Rejected" && $status!="Deal"  && $status!="Rejected Ex" && $status!="Approved Ex" && $status!="Approved" && $status!="Pending"  && $status!="Pending Ex" && $status!="Completed")? $status :''?>" name="status_lainnya" id="status_lainnya" placeholder="silahkan isi" class="form-control hidden" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <select name="share" class="form-control todo-taskbody-tags">
                                                    <option value="self" <?=($status=="self")? 'selected' :''?>>Only Me</option>
                                                    <option value="division"  <?=($status=="division")? 'selected' :''?>>Division</option>
                                                    <option value="public" <?=($status=="public")? 'selected' :''?>>Public</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- TASK TAGS -->
                                        <div class="form-actions right todo-form-actions">
                                            <button type="submit" class="btn btn-circle btn-sm green" id="btn-save">Save Update</button>
                                            <a href="<?=site_url('/Projects')?>" class="btn btn-circle btn-sm btn-default">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END TODO CONTENT -->
        </div>
    </div>
    <!-- END PAGE CONTENT-->
</div>
<script>
    var project_name='<?=$project_name?>';
    var project_id='<?=$project_id?>';
</script>