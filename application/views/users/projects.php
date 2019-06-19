    <link href="<?=base_url('assets/themes/metro')?>/apps/css/todo-2.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/themes/metro')?>/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
<style>
    .user-pictime{
        background-size: cover;
        background-position: center center;
        width: 80px;
        height: 80px;
        border-radius: 40px !important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN TODO SIDEBAR -->
        <div class="todo-ui">
            <div class="todo-sidebar">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption" data-toggle="collapse" data-target=".todo-project-list-content">
                            <span class="caption-subject font-red-flamingo bold uppercase">PROJECTS </span>
                            <span class="caption-helper visible-sm-inline-block visible-xs-inline-block">click to view project list</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <a class="btn btn-circle red-flamingo btn-sm btn-outline" href="javascript:void(0);" id="add-project"> <i class="fa fa-plus"></i> Add</a>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body todo-project-list-content">
                        <div class="todo-project-list">
                            <ul class="nav nav-stacked" id="project-lists">
                                <?php
                                $firstLoad=false;
                                if($projects) {
                                    foreach($projects as $val) {
                                        if($firstLoad==false){
                                            $firstLoad=$val->project_id;
                                        }
                                ?>
                                <li class="project-item <?=($firstLoad==$val->project_id)? 'active' : ''?>" data-projectid="<?=$val->project_id?>" id="project-list-<?=$val->project_id ?>">
                                    <a href="javascript:void(0);"> <?=$val->project_name?> (<small><?=date('d M Y',strtotime($val->created))?></small>)</a>
                                </li>
                                <?php
                                    }
                                } else {
                                ?>
                                <li class="active project-item" data-projectid="1" id="project-list-1">
                                  <span class="caption-subject">There's no project</span>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END TODO SIDEBAR -->
				<!-- BEGIN TODO CONTENT -->
        <div id="contentProject" class="todo-content">

				<!-- END TODO CONTENT -->
        </div>
    </div>
    <!-- END PAGE CONTENT-->
</div>
<div class="modal fade" id="add-project-modal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background:#EF4836;color:#fff">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Project</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="addProject">
                    <div class="form-body">
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Client</label>
                            <div class="col-md-9">
                                <select class="form-control" id="client" name="client">
                                    <option value="0" selected>---Pilih Client----</option>
                                    <?php foreach ($clients as $c){ ?>
                                    <option value="<?=$c->client_id?>"><?=$c->client_name?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Client PIC</label>
                            <div class="col-md-9">
                                <div id = "client_result">Select the client first
                                </div>
<!--                                 <select class="form-control" id="client_pic" name="client_pic">
                                    <option value="0" selected>Pilih Client PIC</option>
                                    <?php //foreach ($clients_pic as $x){ ?>
                                    <option value="<?=$x->client_detail_id?>"><?=$x->nama?></option>
                                    <?php // } ?>
                                </select> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Project Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Leader</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="leader" id="tagInputLeader" data-provide="typeahead" placeholder="Project Leader">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Status</label>
                            <div class="col-md-9">
<!--                                <input type="text" class="form-control" id="status" name="status" placeholder="Project Status">-->
                                <select  class="form-control"  id="status" name="status">
                                    <option value="old">Old</option>
                                    <option value="new">New</option>
                                    <option value="maintain">Maintain</option>
                                    <option value="deal">Deal</option>
                                    <option value="pdkt">PDKT</option>
                                    <option value="complete">Complete</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="desc" id="desc" placeholder="Project Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Team</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="team" id="tagInput" data-provide="typeahead" placeholder="Team Project">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background:#E9EDEF">
                <button type="button" id="buttonAdd" class="btn red-flamingo">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="edit-project-modal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Edit Project</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="form-edit-project">
                    <input type="hidden" name="project_id" id="edit-project-id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Client</label>
                            <div class="col-md-9">
                                <select class="form-control" name="project_client" id="edit-project-client">
                                    <option selected disabled>---Pilih Client----</option>
                                    <?php foreach ($clients as $c){ ?>
                                    <option value="<?=$c->client_id?>"><?=$c->client_name?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name</label>
                            <div class="col-md-9">
                                <input type="text" name="project_name" id="edit-project-name" class="form-control" placeholder="Project Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Leader</label>
                            <div class="col-md-9">
                                <input type="text" name="project_leader" id="edit-project-leader" class="form-control" placeholder="Project Leader">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Status</label>
                            <div class="col-md-9">
<!--                                <input type="text" name="project_status" id="edit-project-status" class="form-control" placeholder="Project Status">-->
                                <select  class="form-control"  id="edit-project-status" name="project_status">
                                    <option value="old">Old</option>
                                    <option value="new">New</option>
                                    <option value="maintain">Maintain</option>
                                    <option value="deal">Deal</option>
                                    <option value="pdkt">PDKT</option>
                                    <option value="complete">Complete</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Description</label>
                            <div class="col-md-9">
                                <input type="text" name="project_desc" id="edit-project-desc" class="form-control" placeholder="Project Description">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Team</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="edit-project-team" name="project_team" id="tagInput" data-provide="typeahead" placeholder="Team Project">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn green" id="edit-project-save">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="member-project-modal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Project Team</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">User to Add</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="user-project" data-provide="typeahead" placeholder="Enter User">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn green" id="add-member-submit">Add User</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
	var users = <?=$users;?>;
	var firstLoad = '<?=$firstLoad;?>';
	var user_id=  <?=(string)$user_id;?>;
	var divisi=  <?=$divisi_id;?>;

        var id = <?=$id;?>;
</script>
