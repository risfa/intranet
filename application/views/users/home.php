<link href="<?=base_url('assets/themes/metro')?>/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
<div class="row">
	<div class="col-md-6">
		<div class="col-md-12">
			<div class="portlet light portlet-fit bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-list font-red-flamingo"></i>
						<span class="caption-subject font-red-flamingo sbold uppercase">Active Project</span>
					</div>
				</div>
				<div class="portlet-body visible-lg visible-md" style="height:600px;overflow-y:auto;">
					<div class="row">
						<div class="col-sm-12">
							<?php
								foreach ($projects as $p){
									echo '
										<div class="note note-danger">
											<span>
											<a href="'.site_url('/Projects/').'/index/'.$p->project_id.'">#'.$p->project_name.'</a>
											<span class="badge badge-default">'.$p->project_status.'</span></span>
										</div>
									';
								}
							?>
						</div>
					</div>
				</div>

				<div class="portlet-body visible-sm visible-xs" style="height:100px;overflow-y:auto;">
					<div class="row">
						<div class="col-sm-12">
							<?php
								foreach ($projects as $p){
									echo '
										<div class="note note-danger">
											<span>
											<a href="'.site_url('/Projects/').'/index/'.$p->project_id.'">#'.$p->project_name.'</a>
											<span class="badge badge-default">'.$p->project_status.'</span></span>
										</div>
									';
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="portlet light portlet-fit bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-bell font-red-flamingo"></i>
						<span class="caption-subject font-red-flamingo sbold uppercase">Last Notifications</span>
					</div>
				</div>
				<div class="portlet-body">
					<div class="row">
						<div class="col-sm-12"  style="height: 300px;max-height: 300px;overflow-y: scroll">
							<ul class="feeds">
								<?php
								foreach ($notifs as $d) {
									?>
									<li>
										<a href="<?=$d->notifikasi_link?>">
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-danger">
															<i class="fa fa-bell-o"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc"> <?=$d->notifikasi_isi?>. </div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date"> <?=(date('d M',strtotime($d->notifikasi_date))==date('d M'))? 'today' : date('d M',strtotime($d->notifikasi_date))?></div>
											</div>
										</a>
									</li>
									<?php
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	<div class="col-md-6">
		<div class="col-md-12">
			<div class="portlet light portlet-fit bordered calendar">
				<div class="portlet-title">
					<div class="caption">
						<i class=" icon-calender font-green"></i>
						<span class="caption-subject font-red-flamingo sbold uppercase">Meeting</span>
					</div>
				</div>
				<div class="portlet-body">
					<div class="row">
					<div class="col-sm-12">
						<div id="calendar" class="has-toolbar"></div>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="portlet light portlet-fit bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-feed font-red-flamingo"></i>
						<span class="caption-subject font-red-flamingo	 sbold uppercase">Last Update</span>
					</div>
				</div>
				<div class="portlet-body">
					<div class="row">
						<div class="col-sm-12 mt-comments" style="max-height: 300px;overflow-y: scroll">
							<?php
								foreach ($updates as $u){
									$file=$u->file;
									if(isset($file)){
										if(strpos($file,'.jpg')==false && strpos($file,'.png')==false && strpos($file,'.gif')==false){
											$file='<br/><a href="'.base_url('assets/uploads/files/'.$file).'">'.$file.'</a>';
										}else{
											$file='<br/><img src="'.base_url('assets/uploads/files/'.$file).'" width="100%"/>';
										}
									}
									echo '
										<div class="mt-comment">
											<div class="mt-comment-img">
												<img src="'.base_url('assets/themes/metro/apps/img/project.png').'" width="40px"/>
											</div>
											<div class="mt-comment-body">
												<div class="mt-comment-info">
													<span class="mt-comment-author"><a href="'.site_url('/Projects/').'/index/'.$u->project_id.'">'.$u->project_name.'</a></span>
													<span class="mt-comment-date">'.date('d M Y H:i',strtotime($u->created)).'</span>
												</div>
												<div class="mt-comment-text">
												'.$u->desc.' ('.$u->status.')
												'.$file.'
												</div>
											</div>
										</div>
									';
								}
							?>
						</div>
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
