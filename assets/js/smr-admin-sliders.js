jQuery(document).ready(function($) {
    if( $('#smr-sliders-table').length > 0 ){


        var language            = smr_ajax_sliders.language;
        var dataTableLanguage   = smr_ajax_sliders.dataTableLanguage;

        var smrSlidersTable = $('#smr-sliders-table').DataTable({
            "columnDefs": [
                { "className": "text-center", "targets": [3,4,5] },
                { "orderable": false, "targets": [3,4,5] },
                { "width": "25%", "targets": [0,1,2] },
                { "width": "10%", "targets": [3,4] },
                { "width": "5%", "targets": [5] }
            ],
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


        $(document).on("click", "#smr-select-all-sliders", function () {

            var sliders = $('.smr-select-slider');

            if($(this).is(':checked')){
                sliders.each(function() {
                    $(this).prop("checked",true);
                });
            }else{
                sliders.each(function() {
                    $(this).prop("checked",false);
                });            
            }
            buttonDeleteSlidersState();
        });


        $(document).on("click", ".smr-select-slider", function () {
            buttonDeleteSlidersState();
        });


        function buttonDeleteSlidersState(){
            var attr = $('#smr-button-delete-multiple').attr('disabled');

            if($('.smr-select-slider').is(':checked')){
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
                text: translation['You will not be able to recover this slider !'],
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: translation['Yes, delete it !'],
                cancelButtonText: translation['No, keep it']
            }).then((result) => {
                if (result.value) {
                    jQuery.post( smr_ajax_sliders.ajax_url, {
                        action : smr_ajax_sliders.delete_slider,
                        id     : data.smrSliderId
                    }, function(response) {
                        smrSlidersTable.row( button.parents('tr') )
                        .remove()
                        .draw();

                        swal({
                            title: translation['Deleted !'],
                            text: translation['Your slider has been deleted.'],
                            type: 'success'
                        })
                    })
                    .fail(function(response) {
                        swal({
                            title: translation['Not deleted '],
                            text: translation['Your slider hasn\'t been deleted.'],
                            type: 'error'
                        })
                    });
                }
            })
        });

        $(document).on("click", "#smr-button-delete-multiple", function () {

            var id = [];
            $(".smr-select-slider:checked").each(function(){
                id.push($(this).val());
            });

            swal({
                title: translation['Are you sure ?'],
                text: translation['You will not be able to recover these sliders !'],
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: translation['Yes, delete them !'],
                cancelButtonText: translation['No, keep them']
            }).then((result) => {
                if (result.value) {
                    jQuery.post( smr_ajax_sliders.ajax_url, {
                        action : smr_ajax_sliders.delete_sliders,
                        id     : id
                    }, function(response) {      

                        var rows = $(".smr-select-slider:checked").parents('tr');
                        
                        smrSlidersTable.rows( rows )
                        .remove()
                        .draw();  
                        
                        buttonDeleteSlidersState();
                        $('#smr-select-all-sliders').prop("checked",false);
                                                                        
                        swal({
                            title: translation['Deleted !'],
                            text: translation['Your sliders have been deleted.'],
                            type: 'success'
                        })
                    })
                    .fail(function(response) {
                        swal({
                            title: translation['Not deleted !'],
                            text: translation['Your sliders haven\'t been deleted.'],
                            type: 'error'
                        })
                    });
                }
            })
        });
        
    }
});