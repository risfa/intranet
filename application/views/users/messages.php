<?php
/**
 * Created by PhpStorm.
 * User: kai303
 * Date: 2017-04-03
 * Time: 1:41 PM
 */
?>
<link href="<?=base_url('assets/themes/metro')?>/apps/css/todo-2.min.css" rel="stylesheet" type="text/css" />
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN TODO SIDEBAR -->
        <div class="todo-ui">
            <div class="todo-sidebar">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption" data-toggle="collapse" data-target=".todo-project-list-content">
                            <span class="caption-subject font-red-flamingo bold uppercase">Active Chats</span>
                        </div>
                    </div>
                    <div class="portlet-body todo-project-list-content">
                        <div class="todo-project-list">
                            <ul class="nav nav-stacked">
                                <?php
                                $first=false;
                                foreach ($group as $g){
                                    if(!$first){
                                        $first=$g->cg_id;
                                    }
                                    $active=($first==$g->cg_id)? 'active' : '';
                                    echo '
                                            <li class="'.$active.'">
                                                <a href="#" data-cgid="'.$g->cg_id.'" class="cg">'.$g->cg_name.'</a>
                                            </li>
                                        ';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END TODO SIDEBAR -->
            <!-- BEGIN TODO CONTENT -->
            <div class="todo-content">
                <div class="portlet light ">
                    <div class="portlet-title">
						<div class="caption">
							<i class="icon-bubble font-red-flamingo"></i>
							<span class="caption-subject font-red-flamingo bold uppercase" id="chat-group"></span>
						</div>						
					</div>
					<div class="portlet-body" id="chats">
						<div class="scroller" style="height: 525px;" data-always-visible="1" data-rail-visible1="1">
							<ul class="chats" id="chat-content">
								<!--<li class="out">
									<img class="avatar" alt="" src="../assets/layouts/layout/img/avatar2.jpg" />
									<div class="message">
										<span class="arrow"> </span>
										<a href="javascript:;" class="name"> Lisa Wong </a>
										<span class="datetime"> at 20:11 </span>
										<span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
									</div>
								</li>
								<li class="out">
									<img class="avatar" alt="" src="../assets/layouts/layout/img/avatar2.jpg" />
									<div class="message">
										<span class="arrow"> </span>
										<a href="javascript:;" class="name"> Lisa Wong </a>
										<span class="datetime"> at 20:11 </span>
										<span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
									</div>
								</li>
								<li class="in">
									<img class="avatar" alt="" src="../assets/layouts/layout/img/avatar1.jpg" />
									<div class="message">
										<span class="arrow"> </span>
										<a href="javascript:;" class="name"> Bob Nilson </a>
										<span class="datetime"> at 20:30 </span>
										<span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
									</div>
								</li>
								<li class="in">
									<img class="avatar" alt="" src="../assets/layouts/layout/img/avatar1.jpg" />
									<div class="message">
										<span class="arrow"> </span>
										<a href="javascript:;" class="name"> Bob Nilson </a>
										<span class="datetime"> at 20:30 </span>
										<span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
									</div>
								</li>
								<li class="out">
									<img class="avatar" alt="" src="../assets/layouts/layout/img/avatar3.jpg" />
									<div class="message">
										<span class="arrow"> </span>
										<a href="javascript:;" class="name"> Richard Doe </a>
										<span class="datetime"> at 20:33 </span>
										<span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
									</div>
								</li>
								<li class="in">
									<img class="avatar" alt="" src="../assets/layouts/layout/img/avatar3.jpg" />
									<div class="message">
										<span class="arrow"> </span>
										<a href="javascript:;" class="name"> Richard Doe </a>
										<span class="datetime"> at 20:35 </span>
										<span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
									</div>
								</li>
								<li class="out">
									<img class="avatar" alt="" src="../assets/layouts/layout/img/avatar1.jpg" />
									<div class="message">
										<span class="arrow"> </span>
										<a href="javascript:;" class="name"> Bob Nilson </a>
										<span class="datetime"> at 20:40 </span>
										<span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
									</div>
								</li>
								<li class="in">
									<img class="avatar" alt="" src="../assets/layouts/layout/img/avatar3.jpg" />
									<div class="message">
										<span class="arrow"> </span>
										<a href="javascript:;" class="name"> Richard Doe </a>
										<span class="datetime"> at 20:40 </span>
										<span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
									</div>
								</li>
								<li class="out">
									<img class="avatar" alt="" src="../assets/layouts/layout/img/avatar1.jpg" />
									<div class="message">
										<span class="arrow"> </span>
										<a href="javascript:;" class="name"> Bob Nilson </a>
										<span class="datetime"> at 20:54 </span>
										<span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. sed diam nonummy nibh euismod tincidunt ut laoreet.
											</span>
									</div>
								</li>-->
							</ul>
						</div>
						<div class="chat-form">
							<div class="input-cont">
								<input class="form-control" type="text" placeholder="Type a message here..."  id="msq-chat"/> </div>
							<div class="btn-cont">
								<span class="arrow"> </span>
								<a href="" class="btn blue icn-only" id="send-chat">
									<i class="fa fa-check icon-white"></i>
								</a>
							</div>
						</div>
					</div>
                    <!--<div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bar-chart font-red-flamingo hide"></i>
                            <span class="caption-helper"><img src="<?=base_url('assets/themes/metro')?>/layouts/layout/img/avatar.png" width="60" style="border-radius: 30px"/></span> &nbsp;
                            <span class="caption-subject font-red-flamingo bold uppercase" id="chat-group"></span>
                        </div>
                    </div>
                
                    <div class="portlet-body">						
						<div class="scroller" style="height: 405px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
							<div class="general-item-list" id="chat-content">
							</div>
						</div>
						
                    </div>
					<div class="portlet-footer">
						<br/>
						<br/>
						<textarea class="form-control" rows="5" id="msq-chat"></textarea>
						<br/>
						<button style="width: 100%" type="button" class="btn red-flamingo" id="send-chat"><i class="fa fa-paper-plane"></i> Send</button>
					</div>-->
                </div>
				<!-- BEGIN PORTLET -->				
				<!-- END PORTLET -->
            </div>
            <!-- END TODO CONTENT -->
        </div>
    </div>
    <!-- END PAGE CONTENT-->
</div>
<script>
    var firstLoad=<?=$first?>;
    var group=<?=json_encode($group)?>;
    var activeChat=<?=$first?>;
    var user_id=<?=$user_id?>;
</script>