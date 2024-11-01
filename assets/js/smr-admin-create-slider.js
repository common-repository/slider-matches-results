
jQuery(document).ready(function($) {
    if ( $('#smr-create-slider').length > 0 ){

        $('#smr-create-teams-order-by').chosen();
        $('#smr-create-teams-nb-elements').chosen();
        $('#smr-create-matches-order-by').chosen();
        $('#smr-create-matches-nb-elements').chosen();
        $('#smr-create-slider-slide-transition-type').chosen();
        $('#smr-create-ranking-team').chosen();
        

        $('#smr-create-slider-header-date-text-color-group, #smr-create-slider-header-date-background-color-group, #smr-create-slider-header-title-text-color-group, #smr-create-slider-header-title-background-color-group').colorpicker({
            format: null
        });
        
        $('#smr-create-slider-content-text-color-group, #smr-create-slider-content-background-color-group').colorpicker({
            format: null
        });

        $('#smr-create-slider-footer-text-color-group, #smr-create-slider-footer-background-color-group').colorpicker({
            format: null
        });

        $('#smr-create-ranking-background-color-group, #smr-create-ranking-text-color-group, #smr-create-ranking-background-color-team-group, #smr-create-ranking-text-color-team-group, #smr-create-ranking-border-color-group').colorpicker({
            format: null
        });

        $('#smr-create-slider-slide-dots-color-group, #smr-create-slider-slide-arrows-color-group').colorpicker({
            format: null
        });


        $(document).on("click", "#smr-update-settings-slider-slide-show", function () {
            
            updateSettingsSliderSlideShow();

        });

        function updateSettingsSliderSlideShow(){
            var infinite            = $('input[name="smr-create-slider-slide-infinite"]').is(':checked');
            var slidesToShow        = parseInt($('input[name="smr-create-slider-slide-slides-to-show"]').val());
            var slidesToScroll      = parseInt($('input[name="smr-create-slider-slide-slides-to-scroll"]').val());
            var adaptativeHeight    = $('input[name="smr-create-slider-slide-adaptative-height"]').val();
            var dots                = $('input[name="smr-create-slider-slide-dots"]').is(':checked');
            var autoplay            = $('input[name="smr-create-slider-slide-autoplay"]').is(':checked');
            var autoplaySpeed       = parseInt($('input[name="smr-create-slider-slide-autoplay-speed"]').val());
            var arrows              = $('input[name="smr-create-slider-slide-arrows"]').is(':checked');
            var arrowsIn            = $('input[name="smr-create-slider-slide-arrows-in"]').is(':checked');
            var fade                = $('input[name="smr-create-slider-slide-fade"]').is(':checked');
            var TransitionType      = $('input[name="smr-create-slider-slide-transition-type"]').val();
            var transitionSpeed     = parseInt($('input[name="smr-create-slider-slide-transition-speed"]').val());
            var swipe               = $('input[name="smr-create-slider-slide-swipe"]').is(':checked');


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
                cssEase             : TransitionType,
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


            $("#smr-form-create-slider").submit(function(e){
            

                var name                        = $('input[name="smr-create-team-name-input"]').val();
                var headerDateTextColor         = $('input[name="smr-create-slider-header-date-text-color"]').val();
                var headerDateBackgroundColor   = $('input[name="smr-create-slider-header-date-background-color"]').val();
                var headerTitleTextColor        = $('input[name="smr-create-slider-header-title-text-color"]').val();
                var headerTitleBackgroundColor  = $('input[name="smr-create-slider-header-title-background-color"]').val();
                var contentTextColor            = $('input[name="smr-create-slider-content-text-color"]').val();
                var contentBackgroundColor      = $('input[name="smr-create-slider-content-background-color"]').val();
                var contentMaxWidthLogo         = $('input[name="smr-create-slider-content-max-width-logo"]').val();
                var footerTextColor             = $('input[name="smr-create-slider-footer-text-color"]').val();
                var footerBackgroundColor       = $('input[name="smr-create-slider-footer-background-color"]').val();
                var autoplaySpeed               = parseInt($('input[name="smr-setting-slider-slide-autoplay-speed"]').val());
                var transitionSpeed             = parseInt($('input[name="smr-setting-slider-slide-transition-speed"]').val());


                if( !checkInput() ){
                    $('#smr-alert-create-error').removeClass('d-none');
                    $('html, body').animate({
                        scrollTop: 0
                    });
                    e.preventDefault();
                }
            });

            function checkInput(){

                var isOk = true;

                var name                        = $('input[name="smr-create-slider-name"]');
                var headerDateTextColor         = $('input[name="smr-create-slider-header-date-text-color"]');
                var headerDateBackgroundColor   = $('input[name="smr-create-slider-header-date-background-color"]');
                var headerTitleTextColor        = $('input[name="smr-create-slider-header-title-text-color"]');
                var headerTitleBackgroundColor  = $('input[name="smr-create-slider-header-title-background-color"]');
                var contentTextColor            = $('input[name="smr-create-slider-content-text-color"]');
                var contentBackgroundColor      = $('input[name="smr-create-slider-content-background-color"]');
                var contentMaxWidthLogo         = $('input[name="smr-create-slider-content-max-width-logo"]');
                var footerTextColor             = $('input[name="smr-create-slider-footer-text-color"]');
                var footerBackgroundColor       = $('input[name="smr-create-slider-footer-background-color"]');
                var autoplaySpeed               = $('input[name="smr-create-slider-slide-autoplay-speed"]');
                var transitionSpeed             = $('input[name="smr-create-slider-slide-transition-speed"]');
                var arrowsColor                 = $('input[name="smr-create-slider-slide-arrows-color"]');
                var dotsColor                   = $('input[name="smr-create-slider-slide-dots-color"]');


                if(name.val() == ""){
                    name.addClass("border border-danger");
                    isOk = false
                }else{
                    name.removeClass("border border-danger");   
                }

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

                if(!arrowsColor.attr('disabled') && arrowsColor.val() == ""){
                    arrowsColor.addClass("border border-danger");
                    isOk = false
                }else{
                    arrowsColor.removeClass("border border-danger");      
                }
    
                if(!dotsColor.attr('disabled') && dotsColor.val() == ""){
                    dotsColor.addClass("border border-danger");
                    isOk = false
                }else{
                    dotsColor.removeClass("border border-danger");      
                }

                return isOk;

            }
        }

        updateSettingsSliderSlideShow();

        $(document).on("click", "#smr-create-slider-slide-autoplay", function () {
            
            if( $('input[name="smr-create-slider-slide-autoplay"]').is(':checked') ){
                $('input[name="smr-create-slider-slide-autoplay-speed"]').prop("disabled", false);
            }else{
                $('input[name="smr-create-slider-slide-autoplay-speed"]').prop("disabled", true);
            }


        });

        $(document).on("click", "#smr-create-slider-slide-dots", function () {
            
            updateSettingsSliderSlideDots();

        });
        updateSettingsSliderSlideDots();

        function updateSettingsSliderSlideDots(){
            if( $('input[name="smr-create-slider-slide-dots"]').is(':checked') ){
                $('#smr-create-slider-slide-dots-color-group').colorpicker('enable');
            }else{
                $('#smr-create-slider-slide-dots-color-group').colorpicker('disable');
            }
        }

        $(document).on("click", "#smr-create-slider-slide-arrows", function () {
            
            updateSettingsSliderSlideArrows();

        });
        updateSettingsSliderSlideArrows();

        function updateSettingsSliderSlideArrows(){
            if( $('input[name="smr-create-slider-slide-arrows"]').is(':checked') ){
                $('input[name="smr-create-slider-slide-arrows-in"]').prop("disabled", false);
                $('#smr-create-slider-slide-arrows-color-group').colorpicker('enable');
            }else{
                $('input[name="smr-create-slider-slide-arrows-in"]').prop("disabled", true);
                $('#smr-create-slider-slide-arrows-color-group').colorpicker('disable');
            }
        }


        $(document).on("click", "#smr-create-slider-footer-display-footer", function () {
            
            fieldsSliderFooterState();

        });

        function fieldsSliderFooterState(){

            if( $('input[name="smr-create-slider-footer-display-footer"]').is(':checked') ){
                $('#smr-create-slider-footer-text-color-group').colorpicker('enable');
                $('#smr-create-slider-footer-background-color-group').colorpicker('enable')
            }else{
                $('#smr-create-slider-footer-text-color-group').colorpicker('disable');
                $('#smr-create-slider-footer-background-color-group').colorpicker('disable')
            }

        }


    }
});