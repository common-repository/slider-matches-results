
jQuery(document).ready(function($) {

    smr_sliders.forEach(function(smr_slider){
        if( $( '.'+smr_slider.slider ).length > 0 ){
            createSlider(smr_slider);
        }
    });

    function createSlider(slider){

        var sliderHtmlClass = '.'+slider.slider;

        var infinite            = slider.infinite == "true";
        var slidesToShow        = parseInt(slider.slides_to_show);
        var slidesToScroll      = parseInt(slider.slides_to_scroll);
        var dots                = slider.dots == "true";
        var autoplay            = slider.autoplay == "true";
        var autoplaySpeed       = parseInt(slider.autoplay_speed);
        var arrows              = slider.arrows == "true";
        var arrowsIn            = slider.arrows_in == "true";
        var fade                = slider.fade == "true";
        var adaptativeHeight    = slider.adaptative_height == "true";
        var transitionType      = slider.transition_type;
        var transitionSpeed     = parseInt(slider.transition_speed); 
        var swipe               = slider.swipe == "true";


        setHeightSmrSliderHeader(sliderHtmlClass);
        setHeightSmrSliderFooter(sliderHtmlClass);
        
        $(sliderHtmlClass).slick({
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
            $( sliderHtmlClass + ' .slick-prev' ).addClass('slick-prev-in-slide');
            $( sliderHtmlClass + ' .slick-next' ).addClass('slick-next-in-slide');
        }else{
            if($( sliderHtmlClass + ' .slick-prev' ).hasClass('slick-prev-in-slide')){
                $( sliderHtmlClass + ' .slick-prev' ).removeClass('slick-prev-in-slide');
                $( sliderHtmlClass + ' .slick-next' ).removeClass('slick-next-in-slide');
            }
        }

    }

    $( window ).resize(function() {
        smr_sliders.forEach(function(smr_slider){
            sliderHtmlClass = '.'+smr_slider.slider;
            if( $( sliderHtmlClass ).length > 0 ){
                setHeightSmrSliderHeader(sliderHtmlClass);
                setHeightSmrSliderFooter(sliderHtmlClass);
            }
        });
    });
      

    function setHeightSmrSliderHeader(sliderHtmlClass){
        var headers     = $( sliderHtmlClass + ' .smr-slider-header' );
        var minHeight   = 0;

        headers.each(function(){
            if( $( this ).height() > minHeight ){
                minHeight = $( this ).height();
            }
        });

        headers.each(function(){
            $( this ).css( "min-height", minHeight+'px' );
        });

    }

    function setHeightSmrSliderFooter(sliderHtmlClass){
        var footers     = $( sliderHtmlClass + ' .smr-slider-footer p' );
        var minHeight   = 0;

        footers.each(function(){
            if( $( this ).height() > minHeight ){
                minHeight = $( this ).height();
            }
        });

        footers.each(function(){
            $( this ).css( "min-height", minHeight+'px' );
        });

    }

    

    

});

