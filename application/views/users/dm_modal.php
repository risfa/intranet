<div class="row">
    <div class="col-sm-3">Project Name</div>
    <div class="col-sm-9"><?=$detail['detail']->project_name?></div>
    <div class="col-sm-3">Description</div>
    <div class="col-sm-9"><?=$detail['detail']->title?></div>
    <div class="col-sm-3">Meeting Time</div>
    <div class="col-sm-9"><?=date('d M Y H:i',strtotime($detail['detail']->start))?></div>
    <div class="col-sm-3">Meeting Member</div>
    <div class="col-sm-9">
        <ul>
            <?php
                if($detail['detail']->create_by==$user_id){
                    echo '<li><a href="'.site_url('/Profile/index/'.$user_id).'">'.$nama.'</a> - Meeting Creator ( '.$email.' )</li>';
                }
                foreach ($detail['team'] as $d){
                    echo '<li><a href="'.site_url('/Profile/index/'.$d->user_id).'">'.$d->nama.'</a> ( '.$d->email.' )</li>';
                }
            ?>
        </ul>
    </div>
</div>