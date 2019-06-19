<script src="<?=base_url('assets/themes/metro')?>/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        function bytesToSize(bytes) {
           var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
           if (bytes == 0) return '0 Byte';
           var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
           return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
        };


        $('#status_intranet').on('change',function () {
            var val=$(this).val();
            if(val=="Lainnya"){
                $('#intranet_lainnya').removeClass('hidden');
            }else{
                $('#intranet_lainnya').addClass('hidden');
            }
        });
        $('#form-info').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                email: {
                    required: true
                },
                nama: {
                    required: true
                },
                telp: {
                    required: true
                },
                alamat: {
                    required: true
                },
                status_KTP: {
                    required: true
                },
                status_intranet: {
                    required: true
                }
            },

            messages: {
                email: {
                    required: "Email is required"
                },
                nama: {
                    required: "Nama is required"
                },
                telp: {
                    required: "Telp is required"
                },
                alamat: {
                    required: "Alamat is required"
                },
                status_KTP: {
                    required: "Status KTP is required"
                },
                status_intranet: {
                    required: "Status Intranet is required"
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
                    url : '<?=site_url().'/EditProfile/saveInfo'?>',
                    data :  $('#form-info').serialize(),
                    beforeSend : function (form) {
                        $("#btn-saveinfo").addClass('disabled');
                    },
                    type : 'post',
                    success : function (response) {
                        $("#btn-saveinfo").removeClass('disabled');
                        var resp=JSON.parse(response);
                        if(resp.status){
                            $("#custom-alert").addClass('alert-success');
                            $("#custom-alert").removeClass('alert-danger');
                            $('#error').html(resp.message);
                            $('#custom-alert').show();
                        }else{
                            $("#custom-alert").removeClass('alert-success');
                            $("#custom-alert").addClass('alert-danger');
                            $('#error').html(resp.message);
                            $('#custom-alert').show();
                        }
                    },
                    failure : function (err) {
                        alert("Error Network !");
                        $('#custom-alert').show();
                    }
                });
            }
        });
		
		$('#password-info').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                oldPassword: {
                    required: true
                },
                newPassword: {
                    required: true
                },
                rePassword: {
                    required: true
                },
            },
            messages: {
                oldPassword: {
                    required: "Current password is required"
                },
                newPassword: {
                    required: "New Password is required"
                },
                rePassword: {
                    required: "Re-type New Password is required"
                },
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
                    url : '<?=site_url().'/EditProfile/changePass'?>',
                    data :  $('#password-info').serialize(),
                    beforeSend : function (form) {
                        $("#btn-updatePassword").addClass('disabled');
                    },
                    type : 'post',
                    success : function (response) {
                        $("#btn-updatePassword").removeClass('disabled');
                        var resp=JSON.parse(response);
                        if(resp.status){
							var form = $("#password-info");
							form.validate().resetForm();
							form[0].reset();
                            $("#custom-alert-password").addClass('alert-success');
                            $("#custom-alert-password").removeClass('alert-danger');
                            $('#errorPass').html(resp.message);
                            $('#custom-alert-password').show();
                        }else{
                            $("#custom-alert-password").removeClass('alert-success');
                            $("#custom-alert-password").addClass('alert-danger');
                            $('#errorPass').html(resp.message);
                            $('#custom-alert-password').show();
                        }
                    },
                    failure : function (err) {
                        alert("Error Network !");
                        $('#custom-alert-password').show();
                    }
                });
            }
        });

        $("#btn-upload").on('click',function(event) {
            event.preventDefault();
            var file = $('#fileUpload')[0].files[0];
            if(file.name) {
                if(file.size > 1000000) {
                    $("#custom-alert-upload").removeClass('alert-success');
                    $("#custom-alert-upload").addClass('alert-danger');
                    $('#errorUpload').html("Max image size 1MB");
                    $('#custom-alert-upload').show();
                } else {
                    $.ajax({
                        url:'<?php echo site_url('/EditProfile/upload') ?>',
                        type: 'post',
                        data: new FormData($('#upload-info')[0]),
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $("#btn-upload").addClass("disabled");
                        },
                        success : function (resp) {
                            $("#btn-upload").removeClass("disabled");
                            var result = JSON.parse(resp);
                            if(result.status){
                                $("#custom-alert-upload").addClass('alert-success');
                                $("#custom-alert-upload").removeClass('alert-danger');
                                $('#errorUpload').html(result.message);
                                $('#custom-alert-upload').show();
                                $("#fileUpload").val(null);
                                $("#myImage").attr("src",'<?=base_url()."assets/uploads/files/".$this->session->userdata("user_photo") ?>')
                            }else{
                                $("#custom-alert-upload").removeClass('alert-success');
                                $("#custom-alert-upload").addClass('alert-danger');
                                $('#errorUpload').html(result.message);
                                $('#custom-alert-upload').show();
                            }
                        }
                    });
                }
            } else {
                $("#custom-alert-upload").removeClass('alert-success');
                $("#custom-alert-upload").addClass('alert-danger');
                $('#errorUpload').html("Please add image first");
                $('#custom-alert-upload').show();
            }
        });
    });
</script>