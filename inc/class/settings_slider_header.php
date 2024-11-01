<?php

defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!');

class Settings_Slider_Header{
	const VERSION   = '1.0.0';

    /**
     * date_text_color
     * 
     * @var (string)
     */
    private $date_text_color;

    /**
     * date_background_color
     * 
     * @var (string)
     */
    private $date_background_color;

    /**
     * title_text_color
     * 
     * @var (string)
     */
    private $title_text_color;

    /**
     * title_background_color
     * 
     * @var (string)
     */
    private $title_background_color;



    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @param (string)         $date_text_color
     * @param (string)         $date_background_color
     * @param (string)         $title_text_color
     * @param (string)         $title_background_color
     * 
     */
    public function __construct( $date_text_color, $date_background_color, $title_text_color, $title_background_color ){
        $this->set_date_text_color( $date_text_color );
        $this->set_date_background_color( $date_background_color );
        $this->set_title_text_color( $title_text_color );
        $this->set_title_background_color( $title_background_color );
    }

    /** Setter methods *****************************/

    /**
     * Set date_text_color.
     *
     * @since 1.0.0
     *
     * @param (string)      $date_text_color
     * 
     */
    public function set_date_text_color( $date_text_color ){
        $this->date_text_color = $date_text_color;
    }

    /**
     * Set date_background_color.
     *
     * @since 1.0.0
     *
     * @param (string)      $date_background_color
     * 
     */
    public function set_date_background_color( $date_background_color ){
        $this->date_background_color = $date_background_color;
    }

    /**
     * Set title_text_color.
     *
     * @since 1.0.0
     *
     * @param (string)      $title_text_color
     * 
     */
    public function set_title_text_color( $title_text_color ){
        $this->title_text_color = $title_text_color;
    }

    /**
     * Set title_background_color.
     *
     * @since 1.0.0
     *
     * @param (string)      $title_background_color
     * 
     */
    public function set_title_background_color( $title_background_color ){
        $this->title_background_color = $title_background_color;
    }


    
    /** Getter methods *****************************/

    /**
     * Get date_text_color.
     *
     * @since 1.0.0
     *
     * @return (string)      $date_text_color
     * 
     */
    public function get_date_text_color(){
        return $this->date_text_color;
    }

     /**
     * Get date_background_color.
     *
     * @since 1.0.0
     *
     * @return (string)      $date_background_color
     * 
     */
    public function get_date_background_color(){
        return $this->date_background_color;
    }

    /**
     * Get title_text_color.
     *
     * @since 1.0.0
     *
     * @return (string)      $title_text_color
     * 
     */
    public function get_title_text_color(){
        return $this->title_text_color;
    }

     /**
     * Get title_background_color.
     *
     * @since 1.0.0
     *
     * @return (string)      $title_background_color
     * 
     */
    public function get_title_background_color(){
        return $this->title_background_color;
    }
    
    /** Public methods *****************************/


}



?>