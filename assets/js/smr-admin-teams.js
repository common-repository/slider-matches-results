jQuery(document).ready(function($) {
    if( $('#smr-teams-table').length > 0 ){

        var language            = smr_ajax_teams.language;
        var dataTableLanguage   = smr_ajax_teams.dataTableLanguage;
        var tableOrderBy        = smr_ajax_teams.table_order_by;
        var tableNbElements     = smr_ajax_teams.table_nb_elements;
        var displayLogo         = smr_ajax_teams.table_display_logo;

        var smrTeamsTable = $('#smr-teams-table').DataTable({
            "columnDefs": [
                { "className": "text-center", "targets": [4,5,6] },
                { "orderable": false, "targets": [5,6,7] },
                { "width": "15%", "targets": [0,1,2,3,4] },
                { "width": "10%", "targets": [4,5] },
                { "width": "5%", "targets": [6] }
            ],
            "order": [[ tableOrderBy, "asc" ]],
            "pageLength": parseInt( tableNbElements ),
            "language": {
                "url": dataTableLanguage
            }
        });

        switch (language) {
            case 'fr':
                translation = translation.fr
                break;
        
            default:
                translation = translation.us
                break;
        }

        $.wpMediaUploader({
            target : '.smr-create-team-logo-uploader', // The class wrapping the textbox
            targetImage: '.smr-create-team-logo',
            uploaderTitle : 'Select or upload image', // The title of the media upload popup
            uploaderButton : 'Set image', // the text of the button in the media upload popup
            multiple : false, // Allow the user to select multiple images
            buttonText : translation['Upload image'], // The text of the upload button
            buttonClass : '.smr-create-team-logo-upload', // the class of the upload button
            buttonClassAdditional : 'btn btn-primary', // Other class of the upload button (for styling)
            previewSize : '150px', // The preview image size
            modal : false, // is the upload button within a bootstrap modal ?
            buttonStyle : { // style the button            
            },
        });

        $.wpMediaUploader({
            target : '.smr-update-team-logo-uploader', // The class wrapping the textbox
            targetImage: '#smr-update-team-logo',
            uploaderTitle : 'Select or upload image', // The title of the media upload popup
            uploaderButton : 'Set image', // the text of the button in the media upload popup
            multiple : false, // Allow the user to select multiple images
            buttonText : translation['Upload image'], // The text of the upload button
            buttonClass : '.smr-update-team-logo-upload', // the class of the upload button
            buttonClassAdditional : 'btn btn-primary', // Other class of the upload button (for styling)
            previewSize : '150px', // The preview image size
            modal : false, // is the upload button within a bootstrap modal ?
            buttonStyle : { // style the button            
            },
        });

        
        $(document).on("click", "#smr-select-all-teams", function () {

            var teams = $('.smr-select-team');

            if($(this).is(':checked')){
                teams.each(function() {
                    $(this).prop("checked",true);
                });
            }else{
                teams.each(function() {
                    $(this).prop("checked",false);
                });            
            }
            buttonDeleteTeamsState();
        });


        $(document).on("click", ".smr-select-team", function () {
            buttonDeleteTeamsState();
        });


        function buttonDeleteTeamsState(){
            var attr = $('#smr-button-delete-multiple').attr('disabled');

            if($('.smr-select-team').is(':checked')){
                if (attr !== undefined) {
                    $('#smr-button-delete-multiple').prop("disabled",false);
                }
            }else{
                if (attr == undefined) {
                    $('#smr-button-delete-multiple').prop("disabled",true);
                }
            }
        }

        $(document).on("click", ".smr-button-delete", function () {
            var button = $(this);
            var data   = $(this).data('data');
            swal({
                title: translation['Are you sure ?'],
                text: translation['You will not be able to recover this team and the matches that are related to this team !'],
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: translation['Yes, delete it !'],
                cancelButtonText: translation['No, keep it']
            }).then((result) => {
                if (result.value) {
                    jQuery.post( smr_ajax_teams.ajax_url, {
                        action : smr_ajax_teams.delete_team,
                        id     : data.smrTeamId
                    }, function(response) {

                        smrTeamsTable.row( button.parents('tr') )
                        .remove()
                        .draw();

                        $('#smr-select-all-teams').prop("checked",false);
                        buttonDeleteTeamsState();

                        swal({
                            title: translation['Deleted !'],
                            text: translation['Your team has been deleted.'],
                            type: 'success'
                        })
                    })
                    .fail(function(response) {
                        swal({
                            title: translation['Not deleted !'],
                            text: translation['Your team hasn\'t been deleted.'],
                            type: 'error'
                        })
                    });
                }
            })
        });

        $(document).on("click", "#smr-button-delete-multiple", function () {

            var id = [];
            $(".smr-select-team:checked").each(function(){
                id.push($(this).val());
            });

            swal({
                title: translation['Are you sure ?'],
                text: translation['You will not be able to recover these teams and the matches that are related to these teams !'],
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: translation['Yes, delete them !'],
                cancelButtonText: translation['No, keep them']
            }).then((result) => {
                if (result.value) {
                    jQuery.post( smr_ajax_teams.ajax_url, {
                        action : smr_ajax_teams.delete_teams,
                        id     : id
                    }, function(response) {      

                        var rows = $(".smr-select-team:checked").parents('tr');
                        
                        smrTeamsTable.rows( rows )
                        .remove()
                        .draw();  
                        
                        buttonDeleteTeamsState();
                        $('#smr-select-all-teams').prop("checked",false);
                                                
                        swal({
                            title: translation['Deleted !'],
                            text: translation['Your teams have been deleted.'],
                            type: 'success'
                        })
                    })
                    .fail(function(response) {
                        swal({
                            title: translation['Not deleted !'],
                            text: translation['Your teams haven\'t been deleted.'],
                            type: 'error'
                        })
                    });
                }
            })
        });

        $(document).on("click", "#smr-button-create-team", function () {
            $('input[name="smr-create-team-name-input"]').val('');
            $('input[name="smr-create-team-position-input"]').val('');
            $('input[name="smr-create-team-points-input"]').val('');
            $('input[name="smr-create-team-logo-input"]').val('');
        });


        $("#smr-form-create-team").submit(function(e){
            
            e.preventDefault();

            var name     = $('input[name="smr-create-team-name-input"]').val();
            var position = $('input[name="smr-create-team-position-input"]').val();
            var points   = $('input[name="smr-create-team-points-input"]').val();
            var logo     = $('input[name="smr-create-team-logo-input"]').val();

            if(name == ""){
                if($('#smr-form-create-team .alert').hasClass("alert-info")){
                    $('#smr-form-create-team .alert').removeClass("alert-info");
                    $('#smr-form-create-team .alert').addClass("alert-danger");
                    $('#smr-create-team-name-input').addClass("border border-danger");
                }
            }else{
                if($('#smr-form-create-team .alert').hasClass("alert-danger")){
                    $('#smr-form-create-team .alert').removeClass("alert-danger");
                    $('#smr-create-team-name-input').removeClass("border border-danger");
                    $('#smr-form-create-team .alert').addClass("alert-info");    
                }
                
                jQuery.post( smr_ajax_teams.ajax_url, {
                    action    : smr_ajax_teams.create_team,
                    name      : name,
                    position  : position,
                    points    : points,
                    logo      : logo
                }, function(response) {

                    var id = response;

                    if( displayLogo ){
                        logo = '<img src="' + logo + '" width="100px">';
                    }

                    $('#smr-create-team').modal('toggle');

                    smrTeamsTable.row.add( [
                        id,
                        name,
                        position,
                        points,
                        logo,
                        '<button class="btn btn-success smr-button-update" type="button" data-toggle="modal" data-target="#smr-update-team" data-data=\'{"smrTeamId":"'+id+'","smrTeamName":"'+name.replace(/'/g,'&#39;')+'","smrTeamPosition":"'+position+'","smrTeamPoints":"'+points+'","smrTeamLogo":"'+logo+'"}\'>'+translation['Update']+'</button>',
                        '<button class="btn btn-danger smr-button-delete" type="button" data-data=\'{"smrTeamId":"'+id+'"}\' >'+translation['Delete']+'</button>',
                        '<input class="smr-select-team" type="checkbox" value="'+id+'">'
                    ] ).draw( false );
                    swal({
                        title: translation['Added !'],
                        text: translation['Your team has been added.'],
                        type: 'success'
                    })
                })
                .fail(function(response) {
                    swal({
                        title: translation['Not added !'],
                        text: translation['Your team hasn\'t been added.'],
                        type: 'error'
                    })
                });
            }
        });

        $(document).on("click", ".smr-button-update", function () {
            var data = $(this).data('data');

            $('input[name="smr-update-team-id-input"]').val(data.smrTeamId);
            $('input[name="smr-update-team-name-input"]').val(data.smrTeamName);
            $('input[name="smr-update-team-position-input"]').val(data.smrTeamPosition);
            $('input[name="smr-update-team-points-input"]').val(data.smrTeamPoints);
            $('input[name="smr-update-team-logo-input"]').val(data.smrTeamLogo);
            $('#smr-update-team-logo img').attr('src',data.smrTeamLogo);
        });

        $("#smr-form-update-team").submit(function(e){
            
            e.preventDefault();

            var id       = $('input[name="smr-update-team-id-input"]').val();
            var name     = $('input[name="smr-update-team-name-input"]').val();
            var position = $('input[name="smr-update-team-position-input"]').val();
            var points   = $('input[name="smr-update-team-points-input"]').val();
            var logo     = $('input[name="smr-update-team-logo-input"]').val();

            if(name == ""){
                if($('#smr-form-update-team .alert').hasClass("alert-info")){
                    $('#smr-form-update-team .alert').removeClass("alert-info");
                    $('#smr-form-update-team .alert').addClass("alert-danger");
                    $('#smr-update-team-name-input').addClass("border border-danger");
                }
            }else{
                if($('#smr-form-update-team .alert').hasClass("alert-danger")){
                    $('#smr-form-update-team .alert').removeClass("alert-danger");
                    $('#smr-update-team-name-input').removeClass("border border-danger");
                    $('#smr-form-update-team .alert').addClass("alert-info");    
                }
                
                jQuery.post( smr_ajax_teams.ajax_url, {
                    action    : smr_ajax_teams.update_team,
                    id        : id,
                    name      : name,
                    position  : position,
                    points    : points,
                    logo      : logo
                }, function(response) {

                    if( displayLogo ){
                        logo = '<img src="' + logo + '" width="100px">';
                    }

                    smrTeamsTable.row($('#smr-row-'+id)).data( [
                        id,
                        name,
                        position,
                        points,
                        logo,
                        '<button class="btn btn-success smr-button-update" type="button" data-toggle="modal" data-target="#smr-update-team" data-data=\'{"smrTeamId":"'+id+'","smrTeamName":"'+name.replace(/'/g,'&#39;')+'","smrTeamPosition":"'+position+'","smrTeamPoints":"'+points+'","smrTeamLogo":"'+logo+'"}\'>'+translation['Update']+'</button>',
                        '<button class="btn btn-danger smr-button-delete" type="button" data-data=\'{"smrTeamId":"'+id+'"}\' >'+translation['Delete']+'</button>',
                        '<input class="smr-select-team" type="checkbox" value="'+id+'">'
                    ] ).draw( false );

                    $('#smr-update-team').modal('toggle');


                    swal({
                        title: translation['Updated !'],
                        text: translation['Your team has been updated.'],
                        type: 'success'
                    })
                })
                .fail(function(response) {
                    swal({
                        title: translation['Not Updated !'],
                        text: translation['Your team hasn\'t been updated.'],
                        type: 'error'
                    })
                });
            }
        });


        $(document).on("click", "#smr-button-update-teams", function () {
            
            var teams  = smrTeamsTable.rows().data();


            for (let index = 0; index < teams.length; index++) {

                var html = '';

                var id       = teams[index][0];
                var name     = teams[index][1];
                var position = teams[index][2];
                var points   = teams[index][3];

                html =  ' \
                <div id="smr-update-teams-' + id + '" class="input-group mb-3 smr-update-teams-row"> \
                <input id="smr-update-teams-id-input" type="hidden" name="smr-update-teams-id-input" value="' + id + '" readonly> \
                <input id="smr-update-teams-name-input" class="form-control" type="text"  name="smr-update-teams-name-input" placeholder="' + translation['name'] + '" aria-label="Name" aria-describedby="smr-update-teams-name-label" value="' + name + '" readonly> \
                <input id="smr-update-teams-position-input" class="form-control" type="number" name="smr-update-teams-position-input" placeholder="' + translation['position'] + '" aria-label="Position" aria-describedby="smr-update-teams-position-label" value="' + position + '"> \
                <input id="smr-update-teams-points-input" class="form-control" type="number" name="smr-update-teams-points-input" placeholder="' + translation['points'] + '" aria-label="Points" aria-describedby="smr-update-teams-points-label" value="' + points + '"> \
                </div>';

                $('#smr-update-teams #smr-form-update-teams .modal-body').append( html );
                
            };


            
        });

        $("#smr-form-update-teams").submit(function(e){
            
            e.preventDefault();

            var idArray         = [];
            var positionArray   = [];
            var pointsArray     = [];

            $('input[name="smr-update-teams-id-input"]').each( function(){
                idArray.push( $(this).val() );
            });

            $('input[name="smr-update-teams-position-input"]').each( function(){
                positionArray.push( $(this).val() );
            });

            $('input[name="smr-update-teams-points-input"]').each( function(){
                pointsArray.push( $(this).val() );
            });

            jQuery.post( smr_ajax_teams.ajax_url, {
                action  : smr_ajax_teams.update_teams,
                idArray : idArray, 
                positionArray : positionArray,
                pointsArray : pointsArray    
            }, function(response) {
                
                var nbRowsInPage = $('.smr-row').length;
                
                for (let index = 0; index < nbRowsInPage ; index++) {

                    var id          = idArray[index];
                    var name        = smrTeamsTable.rows(index).data()[0][1];
                    var logo        = smrTeamsTable.rows(index).data()[0][4];
                    var btnUpdate   = smrTeamsTable.rows(index).data()[0][5];
                    var btnDelete   = smrTeamsTable.rows(index).data()[0][6];
                    var checkbox    = smrTeamsTable.rows(index).data()[0][7];

                    smrTeamsTable.row($('#smr-row-'+id)).data( [
                        id,
                        name,
                        positionArray[index],
                        pointsArray[index],
                        logo,
                        btnUpdate,
                        btnDelete,
                        checkbox
                    ] ).draw( false );

                }

                $('#smr-update-teams').modal('toggle');

                swal({
                    title: translation['Updated !'],
                    html: translation['Your teams has been updated.\nThe page will be refreshed.'],
                    type: 'success'
                }).then((result) => {
                    location.reload();
                });
            })
            .fail(function(response) {
                swal({
                    title: translation['Not Updated !'],
                    text: translation['Your teams hasn\'t been updated.'],
                    type: 'error'
                })
            });
        });
    }
});