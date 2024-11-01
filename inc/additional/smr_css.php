<?php
defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!');


function smr_slider_create_css( $slider_html_class, $settings_slider_header, $settings_slider_content, $settings_slider_footer, $settings_slide ){

    $smr_slider_header_date_text_color          = $settings_slider_header->get_date_text_color();
    $smr_slider_header_date_background_color    = $settings_slider_header->get_date_background_color();
    $smr_slider_header_title_text_color         = $settings_slider_header->get_title_text_color();
    $smr_slider_header_title_background_color   = $settings_slider_header->get_title_background_color();

    $smr_slider_content_text_color              = $settings_slider_content->get_text_color();
    $smr_slider_content_background_color        = $settings_slider_content->get_background_color();
    $smr_slider_content_max_width_logo          = $settings_slider_content->get_max_width_logo();

    $smr_slider_footer_display_footer           = $settings_slider_footer->get_display_footer();
    $smr_slider_footer_text_color               = $settings_slider_footer->get_text_color();
    $smr_slider_footer_background_color         = $settings_slider_footer->get_background_color();

    $smr_slider_display_arrows                  = $settings_slide->get_arrows();
    $smr_slider_arrows_color                    = $settings_slide->get_arrows_color();
    $smr_slider_arrows_in                       = $settings_slide->get_arrows_in();

    $smr_slider_display_dots                    = $settings_slide->get_dots();
    $smr_slider_dots_color                      = $settings_slide->get_dots_color();


    ob_start();

?>

.<?php echo $slider_html_class?> .smr-slider{
    padding : 0% 0%;
}

.<?php echo $slider_html_class?> .smr-slider-header{
    display: flex;
    flex-direction: row;
    display: -webkit-flex;
    -webkit-flex-direction: row;
    display: -moz-flex;
    -moz-flex-direction: row;
    display: -ms-flex;
    -ms-flex-direction: row;
    margin:0% 0% 5% 0%;
}

.<?php echo $slider_html_class?> .smr-slider-header-date{
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    flex-wrap: nowrap;
    flex-grow: 1;

    display: -webkit-flex;
    -webkit-justify-content: center;
    -webkit-flex-direction: column;
    -webkit-align-items: center;
    -webkit-flex-wrap: nowrap;
    -webkit-flex-grow: 1;

    display: -moz-flex;
    -moz-justify-content: center;
    -moz-flex-direction: column;
    -moz-align-items: center;
    -moz-flex-wrap: nowrap;
    -moz-flex-grow: 1;

    display: -ms-flex;
    -ms-justify-content: center;
    -ms-flex-direction: column;
    -ms-align-items: center;
    -ms-flex-wrap: nowrap;
    -ms-flex-grow: 1;

    padding : 5%;
    text-align: center;
    background-color: <?php echo $smr_slider_header_date_background_color; ?>;

}

.<?php echo $slider_html_class?> .smr-slider-header-date p{
    color: <?php echo $smr_slider_header_date_text_color; ?>;
    margin:0% ;
    padding:0%;
}

.<?php echo $slider_html_class?> .smr-slider-header-date p:first-child{
    margin  : 0% 0% 5% 0%;
    padding : 0%;
}

.<?php echo $slider_html_class?> .smr-slider-header-content{
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    flex-wrap: nowrap;
    flex-grow: 3;

    display: -webkit-flex;
    -webkit-justify-content: center;
    -webkit-flex-direction: column;
    -webkit-align-items: center;
    -webkit-flex-wrap: nowrap;
    -webkit-flex-grow: 3;

    display: -moz-flex;
    -moz-justify-content: center;
    -moz-flex-direction: column;
    -moz-align-items: center;
    -moz-flex-wrap: nowrap;
    -moz-flex-grow: 3;

    display: -ms-flex;
    -ms-justify-content: center;
    -ms-flex-direction: column;
    -ms-align-items: center;
    -ms-flex-wrap: nowrap;
    -ms-flex-grow: 3;

    text-align: center;
    background-color: <?php echo $smr_slider_header_title_background_color; ?>;
    color: <?php echo $smr_slider_header_title_text_color; ?>;
}

.<?php echo $slider_html_class?> .smr-slider-header-content p {
    margin: 0%;
}


.<?php echo $slider_html_class?> .smr-slider-content{
    display: flex;
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    flex-direction: row;
    -webkit-flex-direction: row;
    -moz-flex-direction: row;
    -ms-flex-direction: row;
    color: <?php echo $smr_slider_content_text_color; ?>;
    background-color: <?php echo $smr_slider_content_background_color; ?>;
}

.<?php echo $slider_html_class?> .smr-slider-content .smr-slider-content-home-team, 
.<?php echo $slider_html_class?> .smr-slider-content .smr-slider-content-outside-team,
.<?php echo $slider_html_class?> .smr-slider-content .smr-slider-content-score{
    flex-wrap: nowrap;
    align-items: center;
    -webkit-flex-wrap: nowrap;
    -webkit-align-items: center;
    -moz-flex-wrap: nowrap;
    -moz-align-items: center;
    -ms-flex-wrap: nowrap;
    -ms-align-items: center;
}

.<?php echo $slider_html_class?> .smr-slider-content .smr-slider-content-home-team, 
.<?php echo $slider_html_class?> .smr-slider-content .smr-slider-content-outside-team{
    display: flex;
    justify-content: center;
    flex-direction: column;
    flex-grow : 2;
    flex : 2;

    display: -webkit-flex;
    -webkit-justify-content: center;
    -webkit-flex-direction: column;
    -webkit-flex-grow: 2;
    -webkit-flex : 2;

    display: -moz-flex;
    -moz-justify-content: center;
    -moz-flex-direction: column;
    -moz-flex-grow: 2;
    -moz-flex : 2;

    display: -ms-flex;
    -ms-justify-content: center;
    -ms-flex-direction: column;
    -ms-flex-grow: 2;
    -ms-flex : 2;
}

.<?php echo $slider_html_class?> .smr-slider-content .smr-slider-content-home-team img, 
.<?php echo $slider_html_class?> .smr-slider-content .smr-slider-content-outside-team img{
    max-width: <?php echo $smr_slider_content_max_width_logo; ?>;
}

.<?php echo $slider_html_class?> .smr-slider-content .smr-slider-content-score{
    display: flex;
    justify-content: center;
    flex-direction: column;
    flex-grow: 1;
    flex:1;

    display: -webkit-flex;
    -webkit-justify-content: center;
    -webkit-flex-direction: column;
    -webkit-flex-grow: 1;
    -webkit-flex : 1;

    display: -moz-flex;
    -moz-justify-content: center;
    -moz-flex-direction: column;
    -moz-flex-grow: 1;
    -moz-flex : 1;

    display: -ms-flex;
    -ms-justify-content: center;
    -ms-flex-direction: column;
    -ms-flex-grow: 1;
    -ms-flex : 1;
}

.<?php echo $slider_html_class?> .smr-slider-content .smr-slider-content-score p {
    margin : 0%;
}

<?php if( $settings_slider_footer->get_display_footer() ){ ?>
.<?php echo $slider_html_class?> .smr-slider-footer{
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    text-align: center;

    display: -webkit-flex;
    -webkit-justify-content: center;
    -webkit-flex-direction: column;
    -webkit-align-items: center;
    -webkit-text-align: center;

    display: -moz-flex;
    -moz-justify-content: center;
    -moz-flex-direction: column;
    -moz-align-items: center;
    -moz-text-align: center;

    display: -ms-flex;
    -ms-justify-content: center;
    -ms-flex-direction: column;
    -ms-align-items: center;
    -ms-text-align: center;

    margin: 4% 0% 0% 0%;
    padding: 1% 1%;
    background-color: <?php echo $smr_slider_footer_background_color; ?>;
    color: <?php echo $smr_slider_footer_text_color; ?>;
}

.<?php echo $slider_html_class?> .smr-slider-footer p {
    margin : 0%;
    display: flex;
    align-items: center;
    justify-content: center;
}
<?php }else{ ?>
.<?php echo $slider_html_class?> .smr-slider-footer{
    display : none;
}
<?php } ?>

<?php if ($smr_slider_display_arrows){ ?>

.<?php echo $slider_html_class?> .slick-prev:before, 
.<?php echo $slider_html_class?> .slick-next:before {
    color: <?php echo $smr_slider_arrows_color; ?>; 
    padding: 1%;  
}

<?php if ($smr_slider_arrows_in){ ?>

.<?php echo $slider_html_class?> .slick-prev-in-slide {
    left: 10px;
    z-index: 1;
}

.<?php echo $slider_html_class?> .slick-next-in-slide {
    right: 10px;
    z-index: 1;
}

<?php } ?>

<?php } ?>

<?php if($smr_slider_display_dots){ ?>

.<?php echo $slider_html_class?> .slick-dots {
    padding: 0px;
}

.<?php echo $slider_html_class?> .slick-dots li button::before {
    color : <?php echo $smr_slider_dots_color?>;
}

<?php } ?>



@media (max-width: 375px) {
    .<?php echo $slider_html_class?> .smr-slider-content .smr-slider-content-home-team, 
    .<?php echo $slider_html_class?> .smr-slider-content .smr-slider-content-outside-team{
        display: flex;
        justify-content: center;
        flex-direction: column;
        flex-grow : 1;
        flex : 1;

        display: -webkit-flex;
        -webkit-justify-content: center;
        -webkit-flex-direction: column;
        -webkit-flex-grow: 1;
        -webkit-flex : 1;

        display: -moz-flex;
        -moz-justify-content: center;
        -moz-flex-direction: column;
        -moz-flex-grow: 1;
        -moz-flex : 1;

        display: -ms-flex;
        -ms-justify-content: center;
        -ms-flex-direction: column;
        -ms-flex-grow: 1;
        -ms-flex : 1;
    }
}



<?php

    $css = ob_get_clean();

    return $css;

}


function smr_ranking_create_css($ranking){

    $smr_ranking_background_color           = $ranking->get_background_color();
    $smr_ranking_text_color                 = $ranking->get_text_color();
    $smr_ranking_your_team_background_color = $ranking->get_background_color_team();
    $smr_ranking_your_team_text_color       = $ranking->get_text_color_team();
    $smr_ranking_display_border             = $ranking->get_display_border();
    $smr_ranking_border_width               = $ranking->get_border_width();
    $smr_ranking_border_style               = $ranking->get_border_style();
    $smr_ranking_border_color               = $ranking->get_border_color();
    
    ob_start();

?>

.smr-ranking {
    background-color : <?php echo $smr_ranking_background_color; ?>;
    color : <?php echo $smr_ranking_text_color; ?>;
    border: 0px;
}

.smr-ranking-team-position, 
.smr-ranking-team-points{
    width: 12.5%;
    text-align:center;
}

.smr-ranking-team-name{
    width:75%;
}

.smr_ranking_active_team{
    background-color : <?php echo $smr_ranking_your_team_background_color; ?>;
    color : <?php echo $smr_ranking_your_team_text_color; ?>;
}

.smr-ranking-team td{
    padding :5% 0%;
}

<?php if( $smr_ranking_display_border ){ ?>

.smr-ranking-team{
    border-width : <?php echo $smr_ranking_border_width; ?>;
    border-style : <?php echo $smr_ranking_border_style; ?>;
    border-color : <?php echo $smr_ranking_border_color; ?>;
}
<?php }else{ ?>

.smr-ranking-team{
    border:none;
}

<?php } ?>

<?php
    $css = ob_get_clean();

    return $css;

}

?>



