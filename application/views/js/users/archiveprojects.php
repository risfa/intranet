<!--<script src="--><?//=base_url('assets/themes/metro')?><!--/apps/scripts/timeline.min.js" type="text/javascript"></script>-->
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/bootstrap-typeahead/bootstrap3-typeahead.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/themes/metro')?>/global/plugins/moment.min.js" type="text/javascript"></script>
<script type="text/javascript">
    var page=1;
    var currentProject=null;
    var currentTeam=null;
    $(document).ready(function () {
        $('#menu').change(function () {
           location.href=$(this).val();
        });
        if(firstLoad!=false){
            getProject(firstLoad);
        }
        $('.project-item').on('click',function () {
            var project_id=$(this).data('projectid');
            $('.project-item').removeClass('active');
            $(this).addClass('active');
            getProject(project_id);
        });
        $('#add-project').click(function () {
            $('#add-project-modal').modal('show');
        });
        $('#member-project').click(function () {
            $('#member-project-modal').modal('show');
        });
        $("#tagInputLeader").tagsinput({
            itemValue: 'nama',
            itemText: 'nama',
            typeahead: {
                // source: ['Amsterdam', 'Washington', 'Sydney', 'Beijing', 'Cairo'],
                source: users,
                displayText: function(item) {
                    return item;
                }
            },
            confirmKeys: [13,44],
            maxTags: 1,
        });
        $("#edit-project-leader").tagsinput({
            itemValue: 'nama',
            itemText: 'nama',
            typeahead: {
                // source: ['Amsterdam', 'Washington', 'Sydney', 'Beijing', 'Cairo'],
                source: users,
                displayText: function(item) {
                    return item;
                }
            },
            confirmKeys: [13,44],
            maxTags: 1,
        });
        $("#tagInput").tagsinput({
            itemValue: 'user_id',
            itemText: 'nama',
            typeahead: {
                // source: ['Amsterdam', 'Washington', 'Sydney', 'Beijing', 'Cairo'],
                source: users,
                displayText: function(item) {
                    return item;
                }
            },
            confirmKeys: [13,44]
        });
        $("#edit-project-team").tagsinput({
            itemValue: 'user_id',
            itemText: 'nama',
            typeahead: {
                // source: ['Amsterdam', 'Washington', 'Sydney', 'Beijing', 'Cairo'],
                source: users,
                displayText: function(item) {
                    return item;
                }
            },
            confirmKeys: [13,44]
        });
        $("#user-project").tagsinput({
            itemValue: 'user_id',
            itemText: 'nama',
            typeahead: {
                // source: ['Amsterdam', 'Washington', 'Sydney', 'Beijing', 'Cairo'],
                source: users,
                displayText: function(item) {
                    return item;
                }
            },
            confirmKeys: [13,44]
        });
        $("#add-member-submit").click(function() {
            $.ajax({
                type: "post",
                url: "<?=base_url("index.php/Projects/addMember")?>",
                data: {
                    project_id : currentProject.project_id,
                    team : $("#user-project").val()
                },
                beforeSend: function(){},
                success: function(resp) {
                    var result = JSON.parse(resp);
                    if(result.status) {
                        getProject( currentProject.project_id);
                        $('#member-project-modal').modal('hide');
                    } else {
                        alert(result.message);
                    }
                }
            });
        });
        $("#edit-project-save").click(function() {
            $.ajax({
                type: "post",
                url: "<?=base_url("index.php/Projects/editProject")?>",
                data: $('#form-edit-project').serialize(),
                beforeSend: function(){},
                success: function(resp) {
                    var result = JSON.parse(resp);
                    if(result.status) {
                        getProject( currentProject.project_id);
                        $('#edit-project-modal').modal('hide');
                    } else {
                        alert(result.message);
                    }
                }
            });
        });
        $("#buttonAdd").click(function() {
            var error = "";
            var client = $("#client").val();
            var name = $("#name").val();
            var leader = $("#tagInputLeader").val();
            var status = $("#status").val();
            var desc = $("#desc").val();
            var team = $("#tagInput").val();

            if(client == "0") {
                error += "client must be choose\n";
            }
            if(name == "") {
                error += "name must be filled\n";
            }
            if(leader == "") {
                error += "leader must be filled\n";
            }
            if(status == '') {
                error += "status must be filled\n";
            }
            if(desc == "") {
                error += "description must be filled\n";
            }
            if(team == "") {
                error += "team must be filled\n";
            }

            if(error == "") {
                $.ajax({
                    type: "post",
                    url: "<?=base_url("index.php/Projects/addProject")?>",
                    data: $("#addProject").serialize(),
                    beforeSend: function(){
                        $('#buttonAdd').prop('disabled','disabled');
                    },
                    success: function(resp) {
                        var result = JSON.parse(resp);
                        if(result.status) {
                            // $("#client").val(0);
                            // $("#name").val("");
                            // $("#tagInputLeader").tagsinput('removeAll')
                            // $("#status").val("");
                            // $("#desc").val("");
                            // $("#tagInput").tagsinput('removeAll')
                            // $("#add-project-modal").modal("hide");
                            $('#buttonAdd').prop('disabled','disabled');
                            location.reload();
                        } else {
                            alert(result.message);
                        }
                    }
                });
            } else {
                alert(error);
            }
        });

    });

    function getProject(id) {
        $("#timeline").html("");
        page=1;
        $.ajax({
            url: "<?=base_url('index.php/Projects/getProject')?>",
            type: "POST",
            data: {id: id},
            beforeSend: function() {
                $("#contentProject").hide();
            },
            success: function(resp) {
                var result = JSON.parse(resp);
                var html = "";
                var member = "";
                var detail = "";
                console.log(result);
                $.each(result.data,function(x,y) {
                    currentProject=y;
                    var Btn='';
                    html +=
                        '<div class="portlet light">'+
                        '<div class="portlet-title">'+
                        '<div class="caption">'+
                        '<i class="icon-bar-chart font-red-flamingo hide"></i>'+
                        '<span class="caption-subject font-red-flamingo bold uppercase">'+y.project_name+'</span> '+
                        '<span class="badge badge-danger"> '+y.project_status+'</span>'+
                        '</div>'+
                        '</div>'+
                        '<div class="portlet-body">'+
                        '<div class="row">'+
                        '<div class="col-sm-12">'+
                        '<p>'+y.desc+'</p><br/> created : '+y.created+' By ' +
                        '<a href="<?=site_url('/Profile/index')?>/'+y.user_id+'">'+y.created_by+'</a>'+
                        '<div class="tabbable-line">'+
                        '<ul class="nav nav-tabs ">'+
                        '<li class="active">'+
                        '<a href="#tab_1" data-toggle="tab"> Last Update </a>'+
                        '</li>'+
                        '<li>'+
                        '<a href="#tab_2" data-toggle="tab"> Members </a>'+
                        '</li>'+
                        '<li>'+
                        '<a href="#tab_3" data-toggle="tab"> Documents </a>'+
                        '</li>'+
                        '<li>'+
                        '<a href="#tab_4" data-toggle="tab"> Project Details </a>'+
                        '</li>'+
                        '</ul>'+
                        '<div class="tab-content">'+
                        '<div class="tab-pane active" id="tab_1"><div class="timeline" id="timeline"></div></div>'+
                        '<div class="tab-pane" id="tab_2">'+
                        '<div class="mt-element-card mt-element-overlay">'+
                        '<div class="row" id="memberTab"></div>'+
                        '</div>'+
                        '</div>'+
                        '<div class="tab-pane" id="tab_3"><div class="row"><div class="col-sm-12" id="documentTab"></div></div></div>'+
                        '<div class="tab-pane" id="tab_4">'+
                            '<div class="mt-element-card mt-element-overlay">'+
                                '<table class="table">'+
                                    '<tr>'+
                                        '<td style="width:200px;">Client</td>'+
                                        '<td>'+y.client_name+'</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Client PIC</td>'+
                                        '<td>'+y.user_id+'NOTES AT TRELLO [still under construction]</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Leader</td>'+
                                        '<td>'+y.project_leader+'</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Status</td>'+
                                        '<td>'+y.project_status+'</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Description</td>'+
                                        '<td>'+y.desc+'</td>'+
                                    '</tr>'+
                                '</table>'+
                            '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>';
                });
                currentTeam=result.team;
                $.each(result.team,function(x,y) {
                    var defaultPhoto='<?=base_url('assets/themes/metro')?>/layouts/layout/img/avatar.png';
                    if(y.photo!="" && y.photo!=null){
                        defaultPhoto='<?=base_url('assets/uploads/files')?>/'+y.photo;
                    }
                    member += '<div class="col-sm-3">'+
                        '<div class="mt-card-item">'+
                        '<div class="mt-card-avatar mt-overlay-1">'+
                        '<img src="'+defaultPhoto+'">'+
                        '</div>'+
                        '<div class="mt-card-content">'+
                        '<h3 class="mt-card-name"><a href="<?=site_url('/Profile/index')?>/'+y.user_id+'">'+y.nama+'</a></h3>'+
                        '<p class="mt-card-desc font-grey-mint">'+y.jabatan+'</p>'+
                        '</div>'+
                        '</div>'+
                        '</div>';
                });
                var documentProject='<ul>';
                $.each(result.file,function(x,y) {
                    var file='<?=base_url('assets/uploads/files')?>/'+y.file;
                    if((y.share=='division' && (y.create_by==user_id || divisi==y.divisi_id)) || (y.share=='public') || (y.share=='self' && (y.create_by==user_id || divisi==7))) {
                        documentProject += '<li><a href="' + file + '">' + y.file + '</a></li>';
                    }else{
                        documentProject += '<li>' + y.file + '</li>';
                    }
                });
                documentProject+='</ul>';
                getDetail(id);
//
                $("#contentProject").html(html);
                $("#memberTab").html(member);
                $("#documentTab").html(documentProject);
                $("#contentProject").show();
            },
        });
    }
    function editProject() {
        document.getElementById('form-edit-project').reset();
        $('#edit-project-modal').modal('show');
        $('#edit-project-client').val(currentProject.client_id);
        $('#edit-project-id').val(currentProject.project_id);
        $('#edit-project-name').val(currentProject.project_name);
        $('#edit-project-status').val(currentProject.project_status);
        $('#edit-project-desc').val(currentProject.desc);
        $('#edit-project-leader').tagsinput('add',{nama: currentProject.project_leader});
        $.each(currentTeam,function(x,y) {
            $('#edit-project-team').tagsinput('add',y);
        });
    }
    function getDetail(id) {
        var detail="";
        $.ajax({
            url: "<?=base_url('index.php/Projects/getDetail')?>",
            type: "POST",
            data: {id: id,page : page},
            success: function (resp) {
                $("#loadMore").remove();
                var result = JSON.parse(resp);
                if(result.detail.length > 0) {
                    detail="";
                    $.each(result.detail,function(x,y) {
                        var defaultPhoto='<?=base_url('assets/themes/metro')?>/layouts/layout/img/avatar.png';
                        if(y.photo!="" && y.photo!=null){
                            defaultPhoto='<?=base_url('assets/uploads/files')?>/'+y.photo;
                        }
                        var file=y.file;
                        if(file!=null) {
                            if (file.indexOf("jpg") >= 0 || file.indexOf("jpg") >= 0) {
                                if((y.share=='division' && (y.create_by==user_id || divisi==y.divisi_id)) || (y.share=='public') || (y.share=='self' && (y.create_by==user_id || divisi==7))) {
                                    file = '<img src="<?=base_url('assets/uploads/files')?>/' + file + '" width="100%"/>';
                                }else{
                                    file = '<span>' + file + '</span>';
                                }
                            } else {
                                if((y.share=='division' && (y.create_by==user_id || divisi==y.divisi_id)) || (y.share=='public') || (y.share=='self' && (y.create_by==user_id || divisi==7))) {
                                    file = '<a href="<?=base_url('assets/uploads/files')?>/' + file + '" >' + file + '</a>';
                                }else{
                                    file = '<span>' + file + '</span>';
                                }
                            }
                        }else{
                            file="";
                        }
                        var btn='';
                        var Time=moment(y.created,'YYYY-MM-DD H:mm:ss').fromNow();
                        detail+='<div class="timeline-item"> ' +
                            '<div class="timeline-badge"> ' +
                            '<a href="<?=site_url('/Profile/index')?>/'+y.user_id+'">' +
                            '<div class="user-pictime" style="background-image : url(\''+defaultPhoto+'\')"></div>' +
                            '</a> </div> ' +
                            '<div class="timeline-body"> ' +
                            '<div class="timeline-body-arrow"> </div> ' +
                            '<div class="timeline-body-head"> ' +
                            '<div class="timeline-body-head-caption"> ' +
                            '<a href="<?=site_url('/Profile/index')?>/'+y.user_id+'" class="timeline-body-title font-blue-madison">'+y.nama+' - '+y.status+'</a> ' +
                            '<span class="timeline-body-time font-grey-cascade">'+Time+'</span> ' +
                            '</div> ' +
                            btn+
                            '</div> ' +
                            '<div class="timeline-body-content"> ' +
                            '<span class="font-grey-cascade">'+y.desc+' <br/> <br/> '+file+'</span> ' +
                            '</div> ' +
                            '</div> ' +
                            '</div>';
                    });
                    if(result.detail.length >= 5) {
                        detail += '<div class="row" id="loadMore"><div class="col-sm-12 text-center">' +
                            '<button class="btn btn-primary" onclick="getDetail(' + id + ')">Lihat Lebih Banyak</button>' +
                            '</div></div>';
                        page++;
                    }
                } else {
                    detail = "";
                }
                $("#timeline").html($("#timeline").html()+detail);
            }
        });
    }
</script>