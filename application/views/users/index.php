<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title><?=$title?> | Intranet ARD</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/themes/metro')?>/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/themes/metro')?>/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/themes/metro')?>/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/themes/metro')?>/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?=base_url('assets/themes/metro')?>/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?=base_url('assets/themes/metro')?>/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?=base_url('assets/themes/metro')?>/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/themes/metro')?>/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="<?=base_url('assets/themes/metro')?>/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?=base_url('assets/favicon')?>/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?=base_url('assets/favicon')?>/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?=base_url('assets/favicon')?>/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?=base_url('assets/favicon')?>/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?=base_url('assets/favicon')?>/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?=base_url('assets/favicon')?>/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?=base_url('assets/favicon')?>/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?=base_url('assets/favicon')?>/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('assets/favicon')?>/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?=base_url('assets/favicon')?>/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('assets/favicon')?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?=base_url('assets/favicon')?>/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('assets/favicon')?>/favicon-16x16.png">
    <link rel="shortcut icon" href="<?=base_url('assets/favicon')?>/favicon.ico" type="image/x-icon">
    <link rel="manifest" href="<?=base_url('assets/favicon')?>/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?=base_url('assets/favicon')?>/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo  page-container-bg-solid page-content-white">
<div class="page-wrapper">
    <?=$header?>
    <div class="clearfix"> </div>
    <div class="page-container">
        <?=$sidemenu?>
        <div class="page-content-wrapper">
            <div class="page-content">
                <?=$breadcumb?>
                <?=$content?>
            </div>
        </div>
    </div>
   <?=$footer?>
</div>
<!--[if lt IE 9]>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/respond.min.js"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/excanvas.min.js"></script>
<![endif]-->
<?php if(!$gc){ ?>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<?php } ?>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/scripts/app.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
       $('#notif-btn').click(function () {
           $.ajax({
               url: "<?=base_url('index.php/Messages/readNotif')?>",
               type: "POST",
               success: function (resp) {
                    $('#badge-notif').html();
               }
           });
       });
    });
</script>
<?=$js?>
</body>
</html>
