<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<body lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>Login | Intranet</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /> -->
    <link href="<?=base_url('assets/themes/metro')?>/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/themes/metro')?>/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/themes/metro')?>/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/themes/metro')?>/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/themes/metro')?>/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/themes/metro')?>/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/themes/metro')?>/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?=base_url('assets/themes/metro')?>/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/themes/metro')?>/pages/css/login.min.css" rel="stylesheet" type="text/css" />
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
    <link rel="manifest" href="<?=base_url('assets/favicon')?>/manifest.json">
    <link rel="shortcut icon" href="<?=base_url('assets/favicon')?>/favicon.ico" type="image/x-icon">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?=base_url('assets/favicon')?>/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

	<style>
	/*body
	{
	 
		background: #fe8c00; /* fallback for old browsers */
		background: -webkit-linear-gradient(to left, #fe8c00 , #f83600); /* Chrome 10-25, Safari 5.1-6 */
		background: linear-gradient(to left, #fe8c00 , #f83600); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
			
	}*/
	</style>
	
</head>
<body class=" login"
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="<?=base_url()?>">
        <img src="<?=base_url('assets/themes/metro')?>/logo-white.png" alt="" width="300" /> </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" method="post" action="<?=site_url().'/login/process'?>">
        <h3 class="form-title font-red">Login to Access</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span id="error">Fill Username & Password !</span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" name="username" id="username" autocomplete="off" placeholder="Email" name="username" /> </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" name="password" autocomplete="off" id="password" placeholder="Password" name="password" /> </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-block red uppercase" id="login">Login</button>
<!--            <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>-->
        </div>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="index.html" method="post">
        <h3 class="font-green">Forget Password ?</h3>
        <p> Enter your e-mail address below to reset your password. </p>
        <div class="form-group">
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span id="error-fgt"> Enter any username and password. </span>
            </div>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn green btn-outline">Back</button>
            <button type="button" class="btn btn-success uppercase pull-right" id="forget-btn">Reset Password</button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
</div>
<div class="copyright" style="color:#fff"> 2017 © ARDGROUP. </div>
<!--[if lt IE 9]>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/respond.min.js"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/scripts/app.min.js" type="text/javascript"></script>
<script>
    var Login = function() {

         var handleLogin = function() {

             $('.login-form').validate({
                 errorElement: 'span', //default input error message container
                 errorClass: 'help-block', // default input error message class
                 focusInvalid: false, // do not focus the last invalid input
                 rules: {
                     username: {
                         required: true
                     },
                     password: {
                         required: true
                     },
                     remember: {
                         required: false
                     }
                 },

                 messages: {
                     username: {
                         required: "Username is required."
                     },
                     password: {
                         required: "Password is required."
                     }
                 },

                 invalidHandler: function(event, validator) { //display error alert on form submit
                     $('.alert-danger', $('.login-form')).show();
                 },

                 highlight: function(element) { // hightlight error inputs
                     $(element)
                         .closest('.form-group').addClass('has-error'); // set error class to the control group
                 },

                 success: function(label) {
                     label.closest('.form-group').removeClass('has-error');
                     label.remove();
                 },

                 errorPlacement: function(error, element) {
                     error.insertAfter(element.closest('.input-icon'));
                 },

                 submitHandler: function(form) {
                     $.ajax({
                         url : '<?=site_url().'/login/process'?>',
                         data : {
                             username : $('#username').val(),
                             password : $('#password').val()
                         },
                         beforeSend : function (form) {
                             $("#login").addClass('disabled');
                         },
                         type : 'post',
                         success : function (response) {
                             $("#login").removeClass('disabled');
                             var resp=JSON.parse(response);
                             if(resp.status){
                                 location.href="<?=site_url().'/home'?>";
                             }else{
                                 $('#error').html(resp.message);
                                 $('.alert').show();
                             }
                         },
                         failure : function (err) {
                             alert("Error Network !");
                             $('.alert').show();
                         }
                     });
                 }
             });

             $('.login-form input').keypress(function(e) {
                 if (e.which == 13) {
                     if ($('.login-form').validate().form()) {
                         $('.login-form').submit(); //form validation success, call ajax form submit
                     }
                     return false;
                 }
             });
         }

        var handleForgetPassword = function() {
            $('.forget-form').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                },

                messages: {
                    email: {
                        required: "Email is required."
                    }
                },

                invalidHandler: function(event, validator) { //display error alert on form submit

                },

                highlight: function(element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                success: function(label) {
                    label.closest('.form-group').removeClass('has-error');
                    label.remove();
                },

                errorPlacement: function(error, element) {
                    error.insertAfter(element.closest('.input-icon'));
                },

                submitHandler: function(form) {

                }
            });

            $('.forget-form input').keypress(function(e) {
                if (e.which == 13) {
                    if ($('.forget-form').validate().form()) {
                        $('.forget-form').submit();
                    }
                    return false;
                }
            });

            jQuery('#forget-password').click(function() {
                jQuery('.login-form').hide();
                jQuery('.forget-form').show();
            });

            jQuery('#back-btn').click(function() {
                jQuery('.login-form').show();
                jQuery('.forget-form').hide();
            });

        }

        return {
            //main function to initiate the module
            init: function() {

                 handleLogin();
//                handleForgetPassword();

            }

        };

    }();

    jQuery(document).ready(function() {
        Login.init();
        $('#forget-btn').click(function () {
            $.ajax({
                url : '<?=site_url().'/login/forget'?>',
                data : {
                    email : $('#email').val()
                },
                beforeSend : function (form) {
                    $("#forget-btn").addClass('disabled');
                },
                type : 'post',
                success : function (response) {
                    $("#forget-btn").removeClass('disabled');
                    var resp=JSON.parse(response);
                    if(resp.status){
                        alert(resp.message);
                    }else{
                        $('#error-fgt').html(resp.message);
                        $('.alert').show();
                    }
                },
                failure : function (err) {
                    alert("Error Network !");
                }
            });
        });
    });
</script>
</body>
</html>