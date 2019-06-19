<script src="<?=base_url('assets/themes/metro')?>/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/jquery.form.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('textarea').summernote();
        $('#status').change(function () {
            var val=$(this).val();
            if(val=="Lainnya"){
                $('#status_lainnya').removeClass('hidden');
            }else{
                $('#status_lainnya').addClass('hidden');
            }
        });
        var options = {
            beforeSubmit:  function (formData, jqForm, options) {
                $("#btn-save").addClass('disabled');
                return true;
            },  // pre-submit callback
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                $("#btn-save").html('Uploading Data '+percentVal);
            },
            success:       function showResponse(responseText, statusText, xhr, $form) {
                $("#btn-save").removeClass('disabled');
                $("#btn-save").html('Save Update');
                var resp=JSON.parse(responseText);
                if(resp.status){
                    location.href='<?=site_url('/Projects')?>';
                }else{
                    $("#custom-alert").removeClass('alert-success');
                    $("#custom-alert").addClass('alert-danger');
                    $('#error').html(resp.message);
                    $('.alert').show();
                }
            }// post-submit callback
        }
        // bind form using 'ajaxForm'
        $('#edit-task').ajaxForm(options);
    });
</script>