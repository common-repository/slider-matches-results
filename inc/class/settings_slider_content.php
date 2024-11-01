<?php

defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!');

class Settings_Slider_Content{
	const VERSION   = '1.0.0';

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
     * max_width_logo
     * 
     * @var (string)
     */
    private $max_width_logo;



    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @param (string)         $text_color
     * @param (string)         $background_color
     * @param (string)         $max_width_logo
     * 
     * 
     */
    public function __construct( $text_color, $background_color, $max_width_logo ){
        $this->set_text_color( $text_color );
        $this->set_background_color( $background_color );
        $this->set_max_width_logo( $max_width_logo );
    }

    /** Setter methods *****************************/

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
    public function set_background_color( $background_color ){
        $this->background_color = $background_color;
    }

    /**
     * Set max_width_logo.
     *
     * @since 1.0.0
     *
     * @param (string)      $max_width_logo
     * 
     */
    public function set_max_width_logo( $max_width_logo ){
        $this->max_width_logo = $max_width_logo;
    }

    
    /** Getter methods *****************************/

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

    /**
     * Get max_width_logo.
     *
     * @since 1.0.0
     *
     * @return (string)      $max_width_logo
     * 
     */
    public function get_max_width_logo(){
        return $this->max_width_logo;
    }
    
    /** Public methods *****************************/


}



?>