<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?=site_url('/home')?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <?php
        foreach ($breadcumb as $b){
            echo '<li><a href="'.$b['link'].'">'.$b['name'].'</a><i class="fa fa-circle"></i></li>';
        }
        ?>
        <li>
            <span><?=$title?></span>
        </li>
    </ul>
</div>
<h1 class="page-title">
    <?=$title?>
    <small><?=$subtitle?></small>
</h1>