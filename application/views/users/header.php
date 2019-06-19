<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="<?=base_url()?>">
                <img src="<?=base_url('assets/themes/metro')?>/logo-white.png" width="150px" alt="logo" class="logo-default" style="margin-top:11px" /> </a>
            <div class="menu-toggler sidebar-toggler">
                <span></span>
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="#" id="notif-btn" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-bell"></i>
                        <?php
                         if($notif['total']>0){
                             echo ' <span class="badge badge-default" id="badge-notif">'.$notif['total'].'</span>';
                         }else{
                             echo ' <span class="badge badge-default" id="badge-notif"></span>';
                         }
                        ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <ul class="dropdown-menu-list" style="max-height: 250px;min-height: 50px !important;overflow-y: auto;overflow-x: hidden" data-handle-color="#637283">
                                <?php
                                foreach ($notif['data'] as $d) {
                                    ?>
                                    <li>
                                        <a href="<?=$d->notifikasi_link?>">
                                            <span class="time"><?=(date('d M',strtotime($d->notifikasi_date))==date('d M'))? 'today' : date('d M',strtotime($d->notifikasi_date))?></span>
                                            <span class="details">
                                                <?=$d->notifikasi_isi?>
                                            </span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                if($notif['total']<1){
                                    echo '<li><a href="javascript:;">No New Notifications !</a></li>';
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>
                </li>
<!--                <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">-->
<!--                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">-->
<!--                        <i class="icon-envelope-open"></i>-->
<!--                        <span class="badge badge-default"> 4 </span>-->
<!--                    </a>-->
<!--                    <ul class="dropdown-menu">-->
<!--                        <li class="external">-->
<!--                            <h3>You have-->
<!--                                <span class="bold">7 New</span> Messages</h3>-->
<!--                            <a href="app_inbox.html">view all</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">-->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                                    <span class="photo">-->
<!--                                                        <img src="--><?//=base_url('assets/themes/metro')?><!--/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>-->
<!--                                        <span class="subject">-->
<!--                                                        <span class="from"> Lisa Wong </span>-->
<!--                                                        <span class="time">Just Now </span>-->
<!--                                                    </span>-->
<!--                                        <span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--              </li>-->

                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <?php
                        if(isset($photo) && $photo!=""){
                        ?>
                        <img alt="" class="img-circle" src="<?=base_url('assets/uploads/files')?>/<?=$photo?>" />
                        <?php }else{ ?>
                        <img alt="" class="img-circle" src="<?=base_url('assets/themes/metro')?>/layouts/layout/img/avatar.png" />
                        <?php } ?>
                        <span class="username username-hide-on-mobile"><?=$nama?> (<?=$email?>)</span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="<?=site_url('EditProfile')?>">
                                <i class="icon-user"></i>Edit Profile </a>
                        </li>
                        <li>
                            <a href="<?=site_url('Logout')?>">
                                <i class="icon-key"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->