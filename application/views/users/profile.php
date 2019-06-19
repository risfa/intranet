<link href="<?=base_url('assets/themes/metro')?>/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
<style>
    .img-profile{
        background-size: cover;
        background-position: center center;
        width: 150px;
        height: 150px;
        border-radius: 75px !important;
        margin: auto;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet" style="padding: 10px">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <?php
                    if(isset($detail->photo) && $detail->photo!=""){
                        ?>
                        <div class="img-profile" style="background-image : url('<?=base_url('assets/uploads/files')?>/<?=$detail->photo?>');" ></div>
                    <?php }else{ ?>
                        <div class="img-profile" style="background-image : url('<?=base_url('assets/themes/metro')?>/layouts/layout/img/avatar.png');"></div>
                    <?php } ?>
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"><?=$detail->nama?></div>
                    <div class="profile-usertitle-job">
                        <?=$detail->jabatan?><br/>
                        <span style="color: #aaa !important;"><?=$detail->divisi?> Division</span>
                    </div>
                    <span class="badge badge-succes"><?=$detail->status_intranet?></span><br/><br/><br/>
                </div>
                <!-- END SIDEBAR USER TITLE -->
            </div>
            <!-- END PORTLET MAIN -->
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                                <i class="icon-bar-chart theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">User Info</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-scrollable table-scrollable-borderless">
                                <table class="table table-hover table-light">
                                    <tr>
                                        <td width="30%">Nama</td>
                                        <td width="10%">:</td>
                                        <td width="60%"><?=$detail->nama?></td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Email</td>
                                        <td width="10%">:</td>
                                        <td width="60%"><a href="mailto:<?=$detail->email?>" ><?=$detail->email?></a></td></td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Telp</td>
                                        <td width="10%">:</td>
                                        <td width="60%"><?=$detail->telp?></td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Alamat</td>
                                        <td width="10%">:</td>
                                        <td width="60%"><?=$detail->alamat?></td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Status KTP</td>
                                        <td width="10%">:</td>
                                        <td width="60%"><?=$detail->status_KTP?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>