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
                <select class="form-control" id="menu">
                    <?php
                        $startdate=date('Y');
                        $enddate=$startdate-30;
                        while($startdate>=$enddate){
                            $active=($year==$startdate)? 'selected': '';
                            echo '<option '.$active.' value="'.site_url('/ArchiveProjects/index').'/'.$startdate.'">'.$startdate.'</option>';
                            $startdate--;
                        }
                    ?>
                </select>
                <br/>
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption" data-toggle="collapse" data-target=".todo-project-list-content">
                            <span class="caption-subject font-red-flamingo bold uppercase">PROJECTS </span>
                            <span class="caption-helper visible-sm-inline-block visible-xs-inline-block">click to view project list</span>
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
    <script>
        var users = <?=$users;?>;
        var firstLoad = '<?=$firstLoad;?>';
        var user_id=  <?=(string)$user_id;?>;
        var divisi=  <?=$divisi_id;?>;
    </script>