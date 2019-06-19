<div class="row profile-account">
    <div class="col-md-3">
        <ul class="ver-inline-menu tabbable margin-bottom-10">
            <li class="active">
                <a data-toggle="tab" href="#tab_1-1">
                    <i class="fa fa-cog"></i> Personal info </a>
                <span class="after"> </span>
            </li>
            <li>
                <a data-toggle="tab" href="#tab_2-2">
                    <i class="fa fa-picture-o"></i> Change Avatar </a>
            </li>
            <li>
                <a data-toggle="tab" href="#tab_3-3">
                    <i class="fa fa-lock"></i> Change Password </a>
            </li>
        </ul>
    </div>
    <div class="col-md-9">
        <div class="tab-content">
            <div id="tab_1-1" class="tab-pane active">
                <form role="form" action="#" id="form-info">
                    <div class="alert alert-danger display-hide" id="custom-alert">
                        <button class="close" data-close="alert"></button>
                        <span id="error"> Enter any username and password. </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input type="text" name="email" placeholder="Email" readonly value="<?=$email?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">nama</label>
                        <input type="text" name="nama" placeholder="John Doe"  value="<?=$nama?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">telp</label>
                        <input type="text" name="telp" placeholder="(021) XXXXX"  value="<?=$telp?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">alamat</label>
                        <input type="text" name="alamat" placeholder="xxxxx" value="<?=$alamat?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">status KTP</label>
                        <select name="status_KTP" class="form-control">
                            <option disabled>---Pilih---</option>
                            <option value="Kawin" <?=($status_KTP=="Kawin")? 'selected' : ''?>>Kawin</option>
                            <option value="Belum Kawin" <?=($status_KTP=="Belum Kawin")? 'selected' : ''?>>Belum Kawin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">status Intranet</label>
                        <select name="status_intranet" class="form-control" id="status_intranet">
                            <option disabled>---Pilih---</option>
                            <option value="Available" <?=($status_intranet=="Available")? 'selected' : ''?>>Available</option>
                            <option value="Meeting" <?=($status_intranet=="Meeting")? 'selected' : ''?>>Meeting</option>
                            <option value="Cuti" <?=($status_intranet=="Cuti")? 'selected' : ''?>>Cuti</option>
                            <option value="Gak di meja" <?=($status_intranet=="Gak di meja")? 'selected' : ''?>>Gak di meja</option>
                            <option value="Lainnya" <?=(is_array(json_decode($status_intranet)))? 'selected' : ''?>>Lainnya</option>
                        </select>
                        <br/>
                        <input type="text" id="intranet_lainnya" placeholder="silahkan isi" value="<?=(is_array(json_decode($status_intranet)))? json_decode($status_intranet)['lainnya'] : ''?>" class="form-control hidden" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Jabatan</label>
                        <input type="text" placeholder="Jabatan" value="<?=$jabatan?>" class="form-control" readonly />
                    </div>
                    <div class="margin-top-10">
                        <button type="submit" class="btn green" id="btn-saveinfo"> Save Change </button>
                    </div>
                </form>
            </div>
            <div id="tab_2-2" class="tab-pane">
                <!--<p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                    eiusmod. </p>-->
                <form action="#" role="form" id="upload-info" enctype="multipart/form-data">
                    <div class="alert alert-danger display-hide" id="custom-alert-upload">
                        <button class="close" data-close="alert"></button>
                        <span id="errorUpload"> </span>
                    </div>
                    <div class="form-group">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 200px;">
                                <?php
                                $photo=$this->session->userdata("user_photo");
                                if(isset($photo) && $photo!=""){
                                    ?>
                                    <img id="myImage" alt="" src="<?=base_url('assets/uploads/files')?>/<?=$photo?>" />
                                <?php }else{ ?>
                                    <img id="myImage" alt=""  src="<?=base_url('assets/themes/metro')?>/layouts/layout/img/avatar.png" />
                                <?php } ?>
                            </div>
                            <!--<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>-->
                            <div class="form-group">
                                <span class="btn default btn-file">
                                <!--<span class="fileinput-new"> Select image </span>
                                <span class="fileinput-exists"> Change </span>-->
                                <input type="file" name="fileUpload" id="fileUpload"> </span>
                                <!--<a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>-->
                            </div>
                        </div>
                        <div class="clearfix margin-top-10">
                            <span class="label label-danger"> NOTE! </span>
                            <span> Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                        </div>
                    </div>
                    <div class="margin-top-10">
                        <button type="button" class="btn green" id="btn-upload"> Upload </button>
                    </div>
                </form>
            </div>
            <div id="tab_3-3" class="tab-pane">
                <form action="#" role="form" id="password-info">
					<div class="alert alert-danger display-hide" id="custom-alert-password">
                        <button class="close" data-close="alert"></button>
                        <span id="errorPass"> </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Current Password</label>
                        <input type="password" name="oldPassword" class="form-control" /> </div>
                    <div class="form-group">
                        <label class="control-label">New Password</label>
                        <input type="password" name="newPassword" class="form-control" /> </div>
                    <div class="form-group">
                        <label class="control-label">Re-type New Password</label>
                        <input type="password" name="rePassword" class="form-control" /> </div>
                    <div class="margin-top-10">
                        <button type="submit" class="btn green" id="btn-updatePassword"> Save Change </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end col-md-9-->
</div>
</div>
<!--end tab-pane-->