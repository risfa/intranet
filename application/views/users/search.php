<link href="<?=base_url('assets/themes/metro')?>/pages/css/search.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .search-content{
        padding-left: 0px !important;
    }
    .img-profile{
        background-size: cover;
        background-position: center center;
        width: 70px;
        height: 70px;
        border-radius: 35px !important;
        margin: auto;
    }
</style>
<form action="<?=site_url('/Search')?>" method="GET">
<div class="search-page search-content-1">
    <div class="search-bar ">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                        <input value="<?=$q?>" name="q" type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn blue uppercase bold" type="submit">Search</button>
                        </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php
        if(isset($q)){
            ?>
            <div class="<?=(count($users)>0)? 'col-md-7' : 'col-md-12'?>">
                <div class="search-container ">
                    <ul>
                        <?php
                        if(count($updates)==0){
                            echo "<li class='search-item clearfix'><h3>NO UPDATES FOUND WITH KEYWORD '".$q."'</h3></li>";
                        }
                        ?>
                        <?php
                        foreach ($updates as $u){
                            $year=date('Y',strtotime($u->created));
                            $now=date('Y');
                            if($year==$now){
                                $link=site_url('/Projects');
                            }else{
                                $link=site_url('/ArchiveProjects/index/'.$year);
                            }
                        ?>
                        <li class="search-item clearfix">
                            <div class="search-content">
                                <h2 class="search-title">
                                    <a href="<?=$link?>"><?=(strlen($u->desc)>50)? substr(strip_tags($u->desc),0,50).'...' : $u->desc ?></a>
                                </h2>
                                <p class="search-desc">
                                  <?=$u->nama?>'s update (<?=$u->status?>) in  <?=$u->project_name.' ('.$year.')'?> - <?=date('d M Y',strtotime($u->created))?>
                                    <?php
                                        if(isset($u->file) && $u->file!=""){
                                            echo "<br/>";
                                            if(($u->share=="division" && ($user_id==$u->user_id || $divisi_id==$u->divisi_id)) || $u->share=="public" || ($u->share=="self" && ($user_id==$u->user_id || $divisi_id==7))){
                                                echo "<a href='".base_url('assets/uploads/files/'.$u->file)."'>".$u->file."</a>";
                                            }else{
                                                echo $u->file;
                                            }
                                        }
                                    ?>
                                </p>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                    <div class="search-pagination">
                        <?php
                            $pageMax=ceil($total/$perpage);
                            if($pageMax!=1){
                        ?>
                        <ul class="pagination">
                            <?php
                            for ($i=1;$i<=$pageMax;$i++) {
                                ?>
                                <li <?=($page==$i)? ' class="page-active"' : ''?>>
                                    <a href="<?=site_url('/Search?q='.$q.'&page='.$i)?>"><?=$i?></a>
                                </li>
                                <?php
                            }}
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php if(count($users)>0){ ?>
            <div class="col-md-5">
                <!-- BEGIN PORTLET-->
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-edit font-dark"></i>
                            <span class="caption-subject font-dark bold uppercase">Peoples</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                            <?php
                            foreach ($users as $u){ ?>
                                <div class="row">

                                <div class="col-sm-4">
                                        <?php
                                        if(isset($u->photo) && $u->photo!=""){
                                            ?>
                                            <div class="img-profile" style="background-image : url('<?=base_url('assets/uploads/files')?>/<?=$u->photo?>');" ></div>
                                        <?php }else{ ?>
                                            <div class="img-profile" style="background-image : url('<?=base_url('assets/themes/metro')?>/layouts/layout/img/avatar.png');"></div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-sm-8">
                                        <h4><a href="<?=site_url('/Profile/index')?>/<?=$u->user_id?>"><?=$u->nama?></a></h4>
                                        <small><?=$u->status_intranet?></small>
                                    </div>
                                </div>

                            <?php } ?>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
            <?php } ?>
        <?php
        }else{
        ?>
            
        <?php } ?>
    </div>
</div>
<!-- END CONTENT BODY -->
</form>
