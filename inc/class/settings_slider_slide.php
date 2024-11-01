<?php

defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!');

class Settings_Slider_Slide{
	const VERSION   = '1.0.0';

    /**
     * infinite
     * 
     * @var (boolean)
     */
    private $infinite;

    /**
     * slides_to_show
     * 
     * @var (int)
     */
    private $slides_to_show;

    /**
     * slides_to_scroll
     * 
     * @var (int)
     */
    private $slides_to_scroll;

    /**
     * dots
     * 
     * @var (boolean)
     */
    private $dots;

    /**
     * dots_color
     * 
     * @var (string)
     */
    private $dots_color;

    /**
     * autoplay
     * 
     * @var (boolean)
     */
    private $autoplay;

    /**
     * autoplay_speed
     * 
     * @var (int)
     */
    private $autoplay_speed;

    /**
     * arrows
     * 
     * @var (boolean)
     */
    private $arrows;

    /**
     * arrows_color
     * 
     * @var (string)
     */
    private $arrows_color;

    /**
     * arrows_in
     * 
     * @var (boolean)
     */
    private $arrows_in;

    /**
     * fade
     * 
     * @var (boolean)
     */
    private $fade;

    /**
     * adaptative_height
     * 
     * @var (boolean)
     */
    private $adaptative_height;

    /**
     * transition_type
     * 
     * @var (string)
     */
    private $transition_type;

    /**
     * transition_speed
     * 
     * @var (int)
     */
    private $transition_speed;

    /**
     * swipe
     * 
     * @var (boolean)
     */
    private $swipe;


    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @param (boolean)     $infinite
     * @param (int)         $slides_to_show
     * @param (int)         $slides_to_scroll
     * @param (boolean)     $dots
     * @param (string)      $dots_color
     * @param (boolean)     $autoplay
     * @param (int)         $autoplay_speed
     * @param (boolean)     $arrows
     * @param (string)      $arrows_color
     * @param (boolean)     $arrows_in
     * @param (boolean)     $fade
     * @param (string)      $transition_type
     * @param (int)         $transition_speed
     * @param (boolean)     $swipe
     * 
     */
    public function __construct( $infinite, $dots, $dots_color, $autoplay, $autoplay_speed, $arrows, $arrows_color, $arrows_in, $fade, $transition_type, $transition_speed, $swipe ){
        $this->set_infinite( $infinite );
        $this->set_slides_to_show( 1 );
        $this->set_slides_to_scroll( 1 );
        $this->set_dots( $dots );
        $this->set_dots_color( $dots_color );
        $this->set_autoplay( $autoplay );
        $this->set_autoplay_speed( $autoplay_speed );
        $this->set_arrows( $arrows );
        $this->set_arrows_color( $arrows_color );
        $this->set_arrows_in( $arrows_in );
        $this->set_fade( $fade );
        $this->set_adaptative_height( true );
        $this->set_transition_type( $transition_type );
        $this->set_transition_speed( $transition_speed );
        $this->set_swipe( $swipe );

    }

    /** Setter methods *****************************/

    /**
     * Set infinite.
     *
     * @since 1.0.0
     *
     * @param (boolean)      $infinite
     * 
     */
    public function set_infinite( $infinite ){
        $this->infinite = $infinite;
    }

    /**
     * Set slides_to_show.
     *
     * @since 1.0.0
     *
     * @param (int)      $slides_to_show
     * 
     */
    public function set_slides_to_show( $slides_to_show ){
        $this->slides_to_show = $slides_to_show;
    }

    /**
     * Set slides_to_scroll.
     *
     * @since 1.0.0
     *
     * @param (int)      $slides_to_scroll
     * 
     */
    public function set_slides_to_scroll( $slides_to_scroll ){
        $this->slides_to_scroll = $slides_to_scroll;
    }

    /**
     * Set dots.
     *
     * @since 1.0.0
     *
     * @param (boolean)      $dots
     * 
     */
    public function set_dots( $dots ){
        $this->dots = $dots;
    }


    /**
     * Set dots_color.
     *
     * @since 1.0.0
     *
     * @param (string)      $dots_color
     * 
     */
    public function set_dots_color( $dots_color ){
        $this->dots_color = $dots_color;
    }

    /**
     * Set autoplay.
     *
     * @since 1.0.0
     *
     * @param (boolean)      $autoplay
     * 
     */
    public function set_autoplay( $autoplay ){
        $this->autoplay = $autoplay;
    }

    /**
     * Set autoplay_speed.
     *
     * @since 1.0.0
     *
     * @param (boolean)      $autoplay_speed
     * 
     */
    public function set_autoplay_speed( $autoplay_speed ){
        $this->autoplay_speed = $autoplay_speed;
    }

    /**
     * Set arrows.
     *
     * @since 1.0.0
     *
     * @param (boolean)      $arrows
     * 
     */
    public function set_arrows( $arrows ){
        $this->arrows = $arrows;
    }

    /**
     * Set arrows_color.
     *
     * @since 1.0.0
     *
     * @param (string)      $arrows_color
     * 
     */
    public function set_arrows_color( $arrows_color ){
        $this->arrows_color = $arrows_color;
    }

    /**
     * Set arrows_in.
     *
     * @since 1.0.0
     *
     * @param (boolean)      $arrows_in
     * 
     */
    public function set_arrows_in( $arrows_in ){
        $this->arrows_in = $arrows_in;
    }

    /**
     * Set fade.
     *
     * @since 1.0.0
     *
     * @param (boolean)      $fade
     * 
     */
    public function set_fade( $fade ){
        $this->fade = $fade;
    }

    /**
     * Set adaptative_height.
     *
     * @since 1.0.0
     *
     * @param (boolean)      $adaptative_height
     * 
     */
    public function set_adaptative_height( $adaptative_height ){
        $this->adaptative_height = $adaptative_height;
    }

    /**
     * Set transition_type.
     *
     * @since 1.0.0
     *
     * @param (string)      $transition_type
     * 
     */
    public function set_transition_type( $transition_type ){
        $this->transition_type = $transition_type;
    }

    /**
     * Set transition_speed.
     *
     * @since 1.0.0
     *
     * @param (int)      $transition_speed
     * 
     */
    public function set_transition_speed( $transition_speed ){
        $this->transition_speed = $transition_speed;
    }

    /**
     * Set swipe.
     *
     * @since 1.0.0
     *
     * @param (boolean)      $swipe
     * 
     */
    public function set_swipe( $swipe ){
        $this->swipe = $swipe;
    }
    
    /** Getter methods *****************************/

    /**
     * Get infinite.
     *
     * @since 1.0.0
     *
     * @return (boolean)      $infinite
     * 
     */
    public function get_infinite(){
        return $this->infinite;
    }

    /**
     * Get slides_to_show.
     *
     * @since 1.0.0
     *
     * @return (int)      $slides_to_show
     * 
     */
    public function get_slides_to_show(){
        return $this->slides_to_show;
    }

    /**
     * Get slides_to_scroll.
     *
     * @since 1.0.0
     *
     * @return (int)      $slides_to_scroll
     * 
     */
    public function get_slides_to_scroll(){
        return $this->slides_to_scroll;
    }


    /**
     * Get dots.
     *
     * @since 1.0.0
     *
     * @return (boolean)      $dots
     * 
     */
    public function get_dots(){
        return $this->dots;
    }

    /**
     * Get dots_color.
     *
     * @since 1.0.0
     *
     * @return (string)      $dots_color
     * 
     */
    public function get_dots_color(){
        return $this->dots_color;
    }

    /**
     * Get autoplay.
     *
     * @since 1.0.0
     *
     * @return (boolean)      $autoplay
     * 
     */
    public function get_autoplay(){
        return $this->autoplay;
    }

    /**
     * Get autoplay_speed.
     *
     * @since 1.0.0
     *
     * @return (int)      $autoplay_speed
     * 
     */
    public function get_autoplay_speed(){
        return $this->autoplay_speed;
    }

    /**
     * Get arrows.
     *
     * @since 1.0.0
     *
     * @return (boolean)      $arrows
     * 
     */
    public function get_arrows(){
        return $this->arrows;
    }


    /**
     * Get arrows_color.
     *
     * @since 1.0.0
     *
     * @return (string)      $arrows_color
     * 
     */
    public function get_arrows_color(){
        return $this->arrows_color;
    }

    /**
     * Get arrows_in.
     *
     * @since 1.0.0
     *
     * @return (boolean)      $arrows_in
     * 
     */
    public function get_arrows_in(){
        return $this->arrows_in;
    }

    /**
     * Get fade.
     *
     * @since 1.0.0
     *
     * @return (boolean)      $fade
     * 
     */
    public function get_fade(){
        return $this->fade;
    }

    /**
     * Get adaptative_height.
     *
     * @since 1.0.0
     *
     * @return (boolean)      $adaptative_height
     * 
     */
    public function get_adaptative_height(){
        return $this->adaptative_height;
    }

    /**
     * Get transition_type.
     *
     * @since 1.0.0
     *
     * @return (string)      $transition_type
     * 
     */
    public function get_transition_type(){
        return $this->transition_type;
    }

    /**
     * Get transition_speed.
     *
     * @since 1.0.0
     *
     * @return (int)      $transition_speed
     * 
     */
    public function get_transition_speed(){
        return $this->transition_speed;
    }

    /**
     * Get Swipe.
     *
     * @since 1.0.0
     *
     * @return (boolean)      $swipe
     * 
     */
    public function get_swipe(){
        return $this->swipe;
    }

    
    /** Public methods *****************************/


}



?>