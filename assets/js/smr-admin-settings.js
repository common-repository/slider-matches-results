jQuery(document).ready(function($) {
    if( $('#smr-settings').length > 0 ){
        //settings SCRIPT

        $('#smr-setting-teams-order-by').chosen();
        $('#smr-setting-teams-nb-elements').chosen();
        $('#smr-setting-matches-order-by').chosen();
        $('#smr-setting-matches-nb-elements').chosen();
        $('#smr-setting-slider-slide-transition-type').chosen();
        $('#smr-setting-ranking-team').chosen();
        

        $('#smr-setting-slider-header-date-text-color-group, #smr-setting-slider-header-date-background-color-group, #smr-setting-slider-header-title-text-color-group, #smr-setting-slider-header-title-background-color-group').colorpicker({
            format: null
        });
        
        $('#smr-setting-slider-content-text-color-group, #smr-setting-slider-content-background-color-group').colorpicker({
            format: null
        });

        $('#smr-setting-slider-footer-text-color-group, #smr-setting-slider-footer-background-color-group').colorpicker({
            format: null
        });

        $('#smr-setting-ranking-background-color-group, #smr-setting-ranking-text-color-group, #smr-setting-ranking-background-color-team-group, #smr-setting-ranking-text-color-team-group, #smr-setting-ranking-border-color-group').colorpicker({
            format: null
        });

        $('#smr-setting-slider-slide-dots-color-group, #smr-setting-slider-slide-arrows-color-group').colorpicker({
            format: null
        });


        $(document).on("click", "#smr-update-settings-slider-slide-show", function () {
            
            updateSettingsSliderSlideShow();

        });

        function updateSettingsSliderSlideShow(){
            var infinite            = $('input[name="smr-setting-slider-slide-infinite"]').is(':checked');
            var slidesToShow        = parseInt($('input[name="smr-setting-slider-slide-slides-to-show"]').val());
            var slidesToScroll      = parseInt($('input[name="smr-setting-slider-slide-slides-to-scroll"]').val());
            var adaptativeHeight    = $('input[name="smr-setting-slider-slide-adaptative-height"]').val();
            var dots                = $('input[name="smr-setting-slider-slide-dots"]').is(':checked');
            var autoplay            = $('input[name="smr-setting-slider-slide-autoplay"]').is(':checked');
            var autoplaySpeed       = parseInt($('input[name="smr-setting-slider-slide-autoplay-speed"]').val());
            var arrows              = $('input[name="smr-setting-slider-slide-arrows"]').is(':checked');
            var arrowsIn            = $('input[name="smr-setting-slider-slide-arrows-in"]').is(':checked');
            var fade                = $('input[name="smr-setting-slider-slide-fade"]').is(':checked');
            var transitionType      = $('input[name="smr-setting-slider-slide-transition-type"]').val();
            var transitionSpeed     = parseInt($('input[name="smr-setting-slider-slide-transition-speed"]').val());
            var swipe               = $('input[name="smr-setting-slider-slide-swipe"]').is(':checked');


            if($('#smr-update-settings-slider-slide-example.slick-initialized').length > 0){
                $('#smr-update-settings-slider-slide-example').slick('unslick');
            }

            $('#smr-update-settings-slider-slide-example').slick({
                infinite            : infinite,
                slidesToShow        : slidesToShow,
                slidesToScroll      : slidesToScroll,
                dots                : dots,
                autoplay            : autoplay,
                autoplaySpeed       : autoplaySpeed,
                arrows              : arrows,
                fade                : fade,
                adaptativeHeight    : adaptativeHeight,
                cssEase             : transitionType,
                speed               : transitionSpeed,
                swipe               : swipe
            });

            if(arrowsIn){
                $('#smr-update-settings-slider-slide-example .slick-prev').addClass('slick-prev-in-slide');
                $('#smr-update-settings-slider-slide-example .slick-next').addClass('slick-next-in-slide');
            }else{
                if($('#smr-update-settings-slider-slide-example .slick-prev').hasClass('slick-prev-in-slide')){
                    $('#smr-update-settings-slider-slide-example .slick-prev').removeClass('slick-prev-in-slide');
                    $('#smr-update-settings-slider-slide-example .slick-next').removeClass('slick-next-in-slide');
                }
            }

            $('#smr-update-settings-slider-slide-example').slick('setPosition');
        }

        updateSettingsSliderSlideShow();

        $(document).on("click", "#smr-setting-slider-slide-autoplay", function () {
            
            if( $('input[name="smr-setting-slider-slide-autoplay"]').is(':checked') ){
                $('input[name="smr-setting-slider-slide-autoplay-speed"]').prop("disabled", false);
            }else{
                $('input[name="smr-setting-slider-slide-autoplay-speed"]').prop("disabled", true);
            }

        });

        $(document).on("click", "#smr-setting-slider-slide-dots", function () {
            
            updateSettingsSliderSlideDots();

        });
        updateSettingsSliderSlideDots();

        function updateSettingsSliderSlideDots(){
            if( $('input[name="smr-setting-slider-slide-dots"]').is(':checked') ){
                $('#smr-setting-slider-slide-dots-color-group').colorpicker('enable');
            }else{
                $('#smr-setting-slider-slide-dots-color-group').colorpicker('disable');
            }
        }

        $(document).on("click", "#smr-setting-slider-slide-arrows", function () {
            
            updateSettingsSliderSlideArrows();

        });
        updateSettingsSliderSlideArrows();

        function updateSettingsSliderSlideArrows(){
            if( $('input[name="smr-setting-slider-slide-arrows"]').is(':checked') ){
                $('input[name="smr-setting-slider-slide-arrows-in"]').prop("disabled", false);
                $('#smr-setting-slider-slide-arrows-color-group').colorpicker('enable');
            }else{
                $('input[name="smr-setting-slider-slide-arrows-in"]').prop("disabled", true);
                $('#smr-setting-slider-slide-arrows-color-group').colorpicker('disable');
            }
        }

        $(document).on("click", "#smr-setting-ranking-display-ranking", function () {
            
            fieldsRankingState();

        });

        $(document).on("click", "#smr-setting-ranking-display-border", function () {
            
            fieldsRankingBorderState();

        });

        function fieldsRankingState(){

            if( $('input[name="smr-setting-ranking-display-ranking"]').is(':checked') ){
                $('#smr-setting-ranking-background-color-group').colorpicker('enable');
                $('#smr-setting-ranking-text-color-group').colorpicker('enable')
                $('#smr-setting-ranking-team').prop('disabled', false).trigger("chosen:updated");
                $('input[name="smr-setting-ranking-display-border"]').prop("disabled", false);
                $('input[name="smr-setting-ranking-nb-teams"]').prop("disabled", false);
                $('input[name="smr-setting-ranking-nb-teams-above"]').prop("disabled", false);
                $('input[name="smr-setting-ranking-nb-teams-below"]').prop("disabled", false);

            }else{
                $('#smr-setting-ranking-background-color-group').colorpicker('disable');
                $('#smr-setting-ranking-text-color-group').colorpicker('disable')
                $('#smr-setting-ranking-team').prop('disabled', true).trigger("chosen:updated");
                $('input[name="smr-setting-ranking-display-border"]').prop("disabled", true);
                $('input[name="smr-setting-ranking-nb-teams"]').prop("disabled", true);
                $('input[name="smr-setting-ranking-nb-teams-above"]').prop("disabled", true);
                $('input[name="smr-setting-ranking-nb-teams-below"]').prop("disabled", true);
            }

            fieldsRankingTeamState();
            fieldsRankingBorderState();
        }
        
        function fieldsRankingBorderState(){
            if( $('input[name="smr-setting-ranking-display-ranking"]').is(':checked') && $('input[name="smr-setting-ranking-display-border"]').is(':checked') ){
                $('input[name="smr-setting-ranking-border-width"]').prop("disabled", false);
                $('input[name="smr-setting-ranking-border-style"]').prop("disabled", false);
                $('#smr-setting-ranking-border-color-group').colorpicker('enable');
            }else{
                $('input[name="smr-setting-ranking-border-width"]').prop("disabled", true);
                $('input[name="smr-setting-ranking-border-style"]').prop("disabled", true);
                $('#smr-setting-ranking-border-color-group').colorpicker('disable');
            }
        }

        fieldsRankingState();

        function fieldsRankingTeamState(){
            if( $('input[name="smr-setting-ranking-display-ranking"]').is(':checked') && parseInt($('#smr-setting-ranking-team').val()) != 0 ){
                $('#smr-setting-ranking-background-color-team-group').colorpicker('enable');
                $('#smr-setting-ranking-text-color-team-group').colorpicker('enable');
                $('input[name="smr-setting-ranking-nb-teams"]').prop("disabled", true);
                $('input[name="smr-setting-ranking-nb-teams-above"]').prop("disabled", false);
                $('input[name="smr-setting-ranking-nb-teams-below"]').prop("disabled", false);
            }else{
                $('#smr-setting-ranking-background-color-team-group').colorpicker('disable');
                $('#smr-setting-ranking-text-color-team-group').colorpicker('disable');
                $('input[name="smr-setting-ranking-nb-teams-above"]').prop("disabled", true);
                $('input[name="smr-setting-ranking-nb-teams-below"]').prop("disabled", true);

                if( $('input[name="smr-setting-ranking-display-ranking"]').is(':checked') ){
                    $('input[name="smr-setting-ranking-nb-teams"]').prop("disabled", false);
                }
            }
        }

        $(document).on("change", "#smr-setting-ranking-team", function () {
            
            fieldsRankingTeamState();

        });


        $(document).on("click", "#smr-setting-slider-footer-display-footer", function () {
            
            fieldsSliderFooterState();

        });

        function fieldsSliderFooterState(){

            if( $('input[name="smr-setting-slider-footer-display-footer"]').is(':checked') ){
                $('#smr-setting-slider-footer-text-color-group').colorpicker('enable');
                $('#smr-setting-slider-footer-background-color-group').colorpicker('enable')
            }else{
                $('#smr-setting-slider-footer-text-color-group').colorpicker('disable');
                $('#smr-setting-slider-footer-background-color-group').colorpicker('disable')
            }

        }

        fieldsSliderFooterState();

        $("#smr-form-update-settings-slider-header").submit(function(e){
                
            var headerDateTextColor         = $('input[name="smr-setting-slider-header-date-text-color"]');
            var headerDateBackgroundColor   = $('input[name="smr-setting-slider-header-date-background-color"]');
            var headerTitleTextColor        = $('input[name="smr-setting-slider-header-title-text-color"]');
            var headerTitleBackgroundColor  = $('input[name="smr-setting-slider-header-title-background-color"]');

            
            var isOk = true;

            if(headerDateTextColor.val() == ""){
                headerDateTextColor.addClass("border border-danger");
                isOk = false
            }else{
                headerDateTextColor.removeClass("border border-danger");      
            }
            
            if(headerDateBackgroundColor.val() == ""){
                headerDateBackgroundColor.addClass("border border-danger");
                isOk = false
            }else{
                headerDateBackgroundColor.removeClass("border border-danger");      
            }

            if(headerTitleTextColor.val() == ""){
                headerTitleTextColor.addClass("border border-danger");
                isOk = false
            }else{
                headerTitleTextColor.removeClass("border border-danger");      
            }

            if(headerTitleBackgroundColor.val() == ""){
                headerTitleBackgroundColor.addClass("border border-danger");
                isOk = false
            }else{
                headerTitleBackgroundColor.removeClass("border border-danger");      
            }

            if( !isOk ){
                errorInput(e);
            }
        });


        $("#smr-form-update-settings-slider-content").submit(function(e){    

            var contentTextColor            = $('input[name="smr-setting-slider-content-text-color"]');
            var contentBackgroundColor      = $('input[name="smr-setting-slider-content-background-color"]');
            var contentMaxWidthLogo         = $('input[name="smr-setting-slider-content-max-width-logo"]');
            
            var isOk = true;

            if(contentTextColor.val() == ""){
                contentTextColor.addClass("border border-danger");
                isOk = false
            }else{
                contentTextColor.removeClass("border border-danger");      
            }


            if(contentBackgroundColor.val() == ""){
                contentBackgroundColor.addClass("border border-danger");
                isOk = false
            }else{
                contentBackgroundColor.removeClass("border border-danger");      
            }
            
            if(contentMaxWidthLogo.val() == ""){
                contentMaxWidthLogo.addClass("border border-danger");
                isOk = false
            }else{
                contentMaxWidthLogo.removeClass("border border-danger");      
            }

            if( !isOk ){
                errorInput(e);
            }
        });

        $("#smr-form-update-settings-slider-footer").submit(function(e){        

            var footerTextColor             = $('input[name="smr-setting-slider-footer-text-color"]');
            var footerBackgroundColor       = $('input[name="smr-setting-slider-footer-background-color"]');
            
            var isOk = true;

            if(!footerTextColor.attr('disabled') && footerTextColor.val() == ""){
                footerTextColor.addClass("border border-danger");
                isOk = false
            }else{
                footerTextColor.removeClass("border border-danger");      
            }

            if(!footerBackgroundColor.attr('disabled') && footerBackgroundColor.val() == ""){
                footerBackgroundColor.addClass("border border-danger");
                isOk = false
            }else{
                footerBackgroundColor.removeClass("border border-danger");      
            }

            if( !isOk ){
                errorInput(e);
            }
        });

        $("#smr-form-update-settings-slider-slide").submit(function(e){
            
            var autoplaySpeed               = parseInt($('input[name="smr-setting-slider-slide-autoplay-speed"]'));
            var transitionSpeed             = parseInt($('input[name="smr-setting-slider-slide-transition-speed"]'));
            var arrowsColor                 = $('input[name="smr-setting-slider-slide-arrows-color"]');
            var dotsColor                   = $('input[name="smr-setting-slider-slide-dots-color"]');

            var isOk = true;

            if( !autoplaySpeed.attr('disabled') && autoplaySpeed.val() == ""){
                autoplaySpeed.addClass("border border-danger");
                isOk = false
            }else{
                autoplaySpeed.removeClass("border border-danger");      
            }

            if(transitionSpeed.val() == ""){
                transitionSpeed.addClass("border border-danger");
                isOk = false
            }else{
                transitionSpeed.removeClass("border border-danger");      
            }

            if( !arrowsColor.attr('disabled') && arrowsColor.val() == ""){
                arrowsColor.addClass("border border-danger");
                isOk = false;
            }else{
                arrowsColor.removeClass("border border-danger");      
            }

            if( !dotsColor.attr('disabled') && dotsColor.val() == ""){
                dotsColor.addClass("border border-danger");
                isOk = false
            }else{
                dotsColor.removeClass("border border-danger");      
            }

            if( !isOk ){
                errorInput(e);
            }
        });


        $("#smr-form-update-settings-ranking").submit(function(e){
        
            var isOk = true;

            var displayRanking = $('input[name="smr-setting-ranking-display-ranking"]');

            if( displayRanking.is(':checked') ){
                var backgroundColor         = $('input[name="smr-setting-ranking-background-color"]');
                var textColor               = $('input[name="smr-setting-ranking-text-color"]');

                var backgroundColorTeam     = $('input[name="smr-setting-ranking-background-color-team"]');
                var textColorTeam           = $('input[name="smr-setting-ranking-text-color-team"]');

                var borderWidth             = $('input[name="smr-setting-ranking-border-width"]');
                var borderStyle             = $('input[name="smr-setting-ranking-border-style"]');
                var borderColor             = $('input[name="smr-setting-ranking-border-color"]');

                var nbTeams                 = $('input[name="smr-setting-ranking-nb-teams"]');
                var nbTeamsAbove            = $('input[name="smr-setting-ranking-nb-teams-above"]');
                var nbTeamsBelow            = $('input[name="smr-setting-ranking-nb-teams-below"]');
            
                var rankingTeam             = $('select[name="smr-setting-ranking-team"]').val();
            
                if( backgroundColor.val() == ""){
                    backgroundColor.addClass("border border-danger");
                    isOk = false
                }else{
                    backgroundColor.removeClass("border border-danger");      
                }

                if( textColor.val() == ""){
                    textColor.addClass("border border-danger");
                    isOk = false
                }else{
                    textColor.removeClass("border border-danger");      
                }

                if( !backgroundColorTeam.attr('disabled') && backgroundColorTeam.val() == ""){
                    backgroundColorTeam.addClass("border border-danger");
                    isOk = false
                }else{
                    backgroundColorTeam.removeClass("border border-danger");      
                }

                if( !textColorTeam.attr('disabled') && textColorTeam.val() == ""){
                    textColorTeam.addClass("border border-danger");
                    isOk = false
                }else{
                    textColorTeam.removeClass("border border-danger");      
                }

                if( !borderWidth.attr('disabled') && borderWidth.val() == ""){
                    borderWidth.addClass("border border-danger");
                    isOk = false
                }else{
                    borderWidth.removeClass("border border-danger");      
                }

                if( !borderStyle.attr('disabled') && borderStyle.val() == ""){
                    borderStyle.addClass("border border-danger");
                    isOk = false
                }else{
                    borderStyle.removeClass("border border-danger");      
                }

                if( !borderColor.attr('disabled') && borderColor.val() == ""){
                    borderColor.addClass("border border-danger");
                    isOk = false
                }else{
                    borderColor.removeClass("border border-danger");      
                }

                if( nbTeams.val() == "" && rankingTeam == 0 ){
                    nbTeams.addClass("border border-danger");
                    isOk = false
                }else{
                    nbTeams.removeClass("border border-danger");      
                }

                if( nbTeamsAbove.val() == "" && rankingTeam != 0 ){
                    nbTeamsAbove.addClass("border border-danger");
                    isOk = false
                }else{
                    nbTeamsAbove.removeClass("border border-danger");      
                }

                if( nbTeamsBelow.val() == "" && rankingTeam != 0 ){
                    nbTeamsBelow.addClass("border border-danger");
                    isOk = false
                }else{
                    nbTeamsBelow.removeClass("border border-danger");      
                }

            }

            if( !isOk ){
                errorInput(e);
            }
        });

        function errorInput(e){
            $('.smr-alert-update-error').removeClass('d-none');
            $('html, body').animate({
                scrollTop: 0
            });
            e.preventDefault();
        }
        
    }
});