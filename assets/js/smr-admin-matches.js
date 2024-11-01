jQuery(document).ready(function($) {   
   if( $('#smr-matches-table').length > 0 ){

        var language          = smr_ajax_matches.language;
        var dataTableLanguage = smr_ajax_matches.dataTableLanguage;
        var tableOrderBy      = smr_ajax_matches.table_order_by;
        var tableNbElements   = smr_ajax_matches.table_nb_elements;

        $('#smr-create-home-team-id-select').chosen();
        $('#smr-create-outside-team-id-select').chosen();
        $('#smr-update-home-team-id-select').chosen();
        $('#smr-update-outside-team-id-select').chosen();

        var smrMatchesTable = $('#smr-matches-table').DataTable({
            "columnDefs": [
                { "className": "text-center", "targets": [7,8,9] },
                { "orderable": false, "targets": [7,8,9] },
                { "width": "7%", "targets": [0] },
                { "width": "14%", "targets": [1,2,3,4,5,6] },
                { "width": "4%", "targets": [7,8] },
                { "width": "1%", "targets": [9] }
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

        $('#smr-create-match-date-input').datetimepicker({
            locale: language,
            icons: {
                time:       'dashicons dashicons-clock',
                date:       'dashicons dashicons-calendar-alt',
                up:         'dashicons dashicons-arrow-up',
                down:       'dashicons dashicons-arrow-up',
                previous:   'dashicons dashicons-arrow-left',
                next:       'dashicons dashicons-arrow-right',
                today:      'dashicons dashicons-yes',
                clear:      'dashicons dashicons-trash',
                close:      'dashicons dashicons-no-alt'
            }
        });

        $('#smr-update-match-date-input').datetimepicker({
            locale: language,
            icons: {
                time:       'dashicons dashicons-clock',
                date:       'dashicons dashicons-calendar-alt',
                up:         'dashicons dashicons-arrow-up',
                down:       'dashicons dashicons-arrow-up',
                previous:   'dashicons dashicons-arrow-left',
                next:       'dashicons dashicons-arrow-right',
                today:      'dashicons dashicons-yes',
                clear:      'dashicons dashicons-trash',
                close:      'dashicons dashicons-no-alt'
            }
        });
        
        $(document).on("click", "#smr-select-all-matches", function () {

            var matches = $('.smr-select-match');

            if($(this).is(':checked')){
                matches.each(function() {
                    $(this).prop("checked",true);
                });
            }else{
                matches.each(function() {
                    $(this).prop("checked",false);
                });            
            }
            buttonDeleteMatchesState();
        });


        $(document).on("click", ".smr-select-match", function () {
            buttonDeleteMatchesState();
        });


        function buttonDeleteMatchesState(){
            var attr = $('#smr-button-delete-multiple').attr('disabled');

            if($('.smr-select-match').is(':checked')){
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
                text: translation['You will not be able to recover this match !'],
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: translation['Yes, delete it !'],
                cancelButtonText: translation['No, keep it']
            }).then((result) => {
                if (result.value) {
                    jQuery.post( smr_ajax_matches.ajax_url, {
                        action : smr_ajax_matches.delete_match,
                        id     : data.smrMatchId
                    }, function(response) {
                        smrMatchesTable.row( button.parents('tr') )
                        .remove()
                        .draw();

                        $('#smr-select-all-matches').prop("checked",false);
                        buttonDeleteMatchesState();

                        swal({
                            title: translation['Deleted !'],
                            text: translation['Your match has been deleted.'],
                            type: 'success'
                        })
                    })
                    .fail(function(response) {
                        swal({
                            title: translation['Not deleted !'],
                            text: translation['Your match hasn\'t been deleted.'],
                            type: 'error'
                        })
                    });
                }
            })
        });

        $(document).on("click", "#smr-button-delete-multiple", function () {

            var id = [];
            $(".smr-select-match:checked").each(function(){
                id.push($(this).val());
            });

            swal({
                title: translation['Are you sure ?'],
                text: translation['You will not be able to recover these matches !'],
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: translation['Yes, delete them !'],
                cancelButtonText: translation['No, keep them']
            }).then((result) => {
                if (result.value) {
                    jQuery.post( smr_ajax_matches.ajax_url, {
                        action : smr_ajax_matches.delete_matches,
                        id     : id
                    }, function(response) {      

                        var rows = $(".smr-select-match:checked").parents('tr');
                        
                        smrMatchesTable.rows( rows )
                        .remove()
                        .draw();  
                        
                        buttonDeleteMatchesState();
                        $('#smr-select-all-matches').prop("checked",false);
                                                
                        swal({
                            title: translation['Deleted !'],
                            text: translation['Your matches have been deleted.'],
                            type: 'success'
                        })
                    })
                    .fail(function(response) {
                        swal({
                            title: translation['Not deleted !'],
                            text: translation['Your matches haven\'t been deleted.'],
                            type: 'error'
                        })
                    });
                }
            })
        });

        $(document).on("click", "#smr-button-create-match", function () {
            $('select[name="smr-create-home-team-id-select"]').prop('selectedIndex',0);
            $('select[name="smr-create-home-team-id-select"]').trigger("chosen:updated");
            $('select[name="smr-create-outside-team-id-select"]').prop('selectedIndex',0);
            $('select[name="smr-create-outside-team-id-select"]').trigger("chosen:updated");
            $('input[name="smr-create-match-week-input"]').val('');
            $('#smr-create-match-date-input').datetimepicker('date',null);
            $('input[name="smr-create-match-championship-input"]').val('');
            $('input[name="smr-create-match-score-input"]').val('');
        });

        $("#smr-form-create-match").submit(function(e){
            
            e.preventDefault();

            var homeTeamId        = $('select[name="smr-create-home-team-id-select"]').val();
            var outsideTeamId     = $('select[name="smr-create-outside-team-id-select"]').val();
            var week              = $('input[name="smr-create-match-week-input"]').val();
            var date              = $('#smr-create-match-date-input').datetimepicker('viewDate');
            var championship      = $('input[name="smr-create-match-championship-input"]').val();
            var score             = $('input[name="smr-create-match-score-input"]').val();

            var homeTeamName      = $('select[name="smr-create-home-team-id-select"] option:selected').text()
            var outsideTeamName   = $('select[name="smr-create-outside-team-id-select"] option:selected').text()

            if( homeTeamId == null || outsideTeamId == null || homeTeamId == outsideTeamId ){
                if($('#smr-form-create-match .alert').hasClass("alert-info")){
                    $('#smr-form-create-match .alert').removeClass("alert-info");
                    $('#smr-form-create-match .alert').addClass("alert-danger");
                }
            }else{
                if($('#smr-form-create-match .alert').hasClass("alert-danger")){
                    $('#smr-form-create-match .alert').removeClass("alert-danger");
                    $('#smr-create-home-team-id-select').removeClass("border border-danger");
                }

                var dateUTC = '';

                if(date != null){
                    dateUTC = date.toDate().toUTCString();
                }

                jQuery.post( smr_ajax_matches.ajax_url, {
                    action          : smr_ajax_matches.create_match,
                    homeTeamId      : homeTeamId,
                    outsideTeamId   : outsideTeamId,
                    week            : week,
                    date            : dateUTC,
                    championship    : championship,
                    score           : score
                }, function(response) {

                    var id = response;

                    var dateFormatting = $('#smr-create-match-date-input').val();

                    $('#smr-create-match').modal('toggle');

                    smrMatchesTable.row.add( [
                        id,
                        homeTeamName,
                        outsideTeamName,
                        week,
                        dateFormatting,
                        championship,
                        score,
                        '<button class="btn btn-success smr-button-update" type="button" data-toggle="modal" data-target="#smr-update-match" data-data=\'{"smrMatchId":"'+id+'","smrMatchHomeTeamId":"'+homeTeamId+'","smrMatchOutsideTeamId":"'+outsideTeamId+'","smrMatchWeek":"'+week+'","smrMatchDate":"'+dateFormatting+'","smrMatchChampionship":"'+championship+'","smrMatchScore":"'+score+'"}\'>'+translation['Update']+'</button>',
                        '<button class="btn btn-danger smr-button-delete" type="button" data-data=\'{"smrMatchId":"'+id+'"}\' >'+translation['Delete']+'</button>',
                        '<input class="smr-select-match" type="checkbox" value="'+id+'">'
                    ] ).draw( false );
                    swal({
                        title: translation['Added !'],
                        text: translation['Your match has been added.'],
                        type: 'success'
                    })
                })
                .fail(function(response) {
                    swal({
                        title: translation['Not added !'],
                        text: translation['Your match hasn\'t been added.'],
                        type: 'error'
                    })
                });
            }
        });

        $(document).on("click", ".smr-button-update", function () {
            var data = $(this).data('data');
            $('input[name="smr-update-match-id-input"]').val(data.smrMatchId);
            $('select[name="smr-update-home-team-id-select"] option[value="' + data.smrMatchHomeTeamId + '"]').prop('selected', true);
            $('select[name="smr-update-home-team-id-select"]').trigger("chosen:updated");
            $('select[name="smr-update-outside-team-id-select"] option[value="' + data.smrMatchOutsideTeamId + '"]').prop('selected', true);
            $('select[name="smr-update-outside-team-id-select"]').trigger("chosen:updated");
            $('input[name="smr-update-match-week-input"]').val(data.smrMatchWeek);
            $('#smr-update-match-date-input').datetimepicker('date',null);
            $('#smr-update-match-date-input').datetimepicker('date',data.smrMatchDate);
            $('input[name="smr-update-match-championship-input"]').val(data.smrMatchChampionship);
            $('input[name="smr-update-match-score-input"]').val(data.smrMatchScore);
        });

        $("#smr-form-update-match").submit(function(e){
            
            e.preventDefault();

            var id                = $('input[name="smr-update-match-id-input"]').val();
            var homeTeamId        = $('select[name="smr-update-home-team-id-select"]').val();
            var outsideTeamId     = $('select[name="smr-update-outside-team-id-select"]').val();
            var week              = $('input[name="smr-update-match-week-input"]').val();
            var date              = $('#smr-update-match-date-input').datetimepicker('viewDate');
            var championship      = $('input[name="smr-update-match-championship-input"]').val();
            var score             = $('input[name="smr-update-match-score-input"]').val();

            var homeTeamName      = $('select[name="smr-update-home-team-id-select"] option:selected').text()
            var outsideTeamName   = $('select[name="smr-update-outside-team-id-select"] option:selected').text()

            if( homeTeamId == null || outsideTeamId == null || homeTeamId == outsideTeamId ){
                if($('#smr-form-update-match .alert').hasClass("alert-info")){
                    $('#smr-form-update-match .alert').removeClass("alert-info");
                    $('#smr-form-update-match .alert').addClass("alert-danger");
                }
            }else{
                if($('#smr-form-update-match .alert').hasClass("alert-danger")){
                    $('#smr-form-update-match .alert').removeClass("alert-danger");
                    $('#smr-form-update-match .alert').addClass("alert-info"); 
                }

                var dateUTC = '';

                if(date != null){
                    dateUTC = date.toDate().toUTCString();
                }
                
                jQuery.post( smr_ajax_matches.ajax_url, {
                    action          : smr_ajax_matches.update_match,
                    id              : id,
                    homeTeamId      : homeTeamId,
                    outsideTeamId   : outsideTeamId,
                    week            : week,
                    date            : dateUTC,
                    championship    : championship,
                    score           : score
                }, function(response) {
                    
                    var dateFormatting = $('#smr-update-match-date-input').val();

                    smrMatchesTable.row($('#smr-row-'+id)).data( [
                        id,
                        homeTeamName,
                        outsideTeamName,
                        week,
                        dateFormatting,
                        championship,
                        score,
                        '<button class="btn btn-success smr-button-update" type="button" data-toggle="modal" data-target="#smr-update-match" data-data=\'{"smrMatchId":"'+id+'","smrMatchHomeTeamId":"'+homeTeamId+'","smrMatchOutsideTeamId":"'+outsideTeamId+'","smrMatchWeek":"'+week+'","smrMatchDate":"'+dateFormatting+'","smrMatchChampionship":"'+championship+'","smrMatchScore":"'+score+'"}\'>'+translation['Update']+'</button>',
                        '<button class="btn btn-danger smr-button-delete" type="button" data-data=\'{"smrMatchId":"'+id+'"}\' >'+translation['Delete']+'</button>',
                        '<input class="smr-select-match" type="checkbox" value="'+id+'">'
                    ] ).draw( true );

                    $('#smr-update-match').modal('toggle');
                    
                    swal({
                        title: translation['Updated !'],
                        text: translation['Your match has been updated.'],
                        type: 'success'
                    })
                })
                .fail(function(response) {
                    swal({
                        title: translation['Not updated !'],
                        text: translation['Your match hasn\'t been updated.'],
                        type: 'error'
                    })
                });
            }
        });
    }
});