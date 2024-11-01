<?php

defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!');

class Settings_Slider_Footer{
	const VERSION   = '1.0.0';

    /**
     * display_footer
     * 
     * @var (boolean)
     */
    private $display_footer;

    /**
     * Text_color
     * 
     * @var (string)
     */
    private $text_color;

    /**
     * Background_color
     * 
     * @var (string)
     */
    private $background_color;



    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @param (boolean)        $display_footer
     * @param (string)         $text_color
     * @param (string)         $background_color
     * 
     */
    public function __construct( $display_footer, $text_color, $background_color ){
        $this->set_display_footer( $display_footer );
        $this->set_text_color( $text_color );
        $this->set_background_color( $background_color );
    }

    /** Setter methods *****************************/

    /**
     * Set display_footer.
     *
     * @since 1.0.0
     *
     * @param (boolean)      $display_footer
     * 
     */
    public function set_display_footer( $display_footer ){
        $this->display_footer = $display_footer;
    }

    /**
     * Set text_color.
     *
     * @since 1.0.0
     *
     * @param (string)      $text_color
     * 
     */
    public function set_text_color( $text_color ){
        $this->text_color = $text_color;
    }

    /**
     * Set background_color.
     *
     * @since 1.0.0
     *
     * @param (string)      $background_color
     * 
     */
    public function set_background_color($background_color ){
        $this->background_color = $background_color;
    }


    
    /** Getter methods *****************************/

    /**
     * Get display_footer.
     *
     * @since 1.0.0
     *
     * @return (boolean)      $display_footer
     * 
     */
    public function get_display_footer(){
        return $this->display_footer;
    }

    /**
     * Get text_color.
     *
     * @since 1.0.0
     *
     * @return (string)      $text_color
     * 
     */
    public function get_text_color(){
        return $this->text_color;
    }

     /**
     * Get background_color.
     *
     * @since 1.0.0
     *
     * @return (string)      $background_color
     * 
     */
    public function get_background_color(){
        return $this->background_color;
    }
    
    /** Public methods *****************************/


}



?>