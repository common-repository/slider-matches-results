<?php

defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!');

class Slider{
	const VERSION   = '1.0.0';

    /**
     * slider ID, this element is unique for each slider
     * 
     * @var (int)
     */
    private $id;

    /**
     * slider name, this element is the name for each slider & this is what will appear on the slider
     * 
     * @var (string)
     */
    private $name;

    /**
     * slider shortcode
     * 
     * @var (int)
     */
    private $shortcode;

    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @param (int)         $id         
     * @param (string)      $name       
     * @param (string)      $shortcode 
     * 
     */
    public function __construct( $id, $name ){
        $this->set_id( $id );
        $this->set_name( $name );
        $this->set_shortcode( $id );
    }

    /** Setter methods *****************************/

    /**
     * Set id.
     *
     * @since 1.0.0
     *
     * @param (int)      $id 
     * 
     */
    public function set_id( $id ){
        $this->id = $id;
    }

    /**
     * Set name.
     *
     * @since 1.0.0
     *
     * @param (string)      $name    
     * 
     */
    public function set_name( $name ){
        $this->name = $name;
    }

    /**
     * Set shortcode.
     *
     * @since 1.0.0
     *
     * @param (string)      $shortcode   
     * 
     */
    public function set_shortcode( $id ){
        $this->shortcode = "[smr_slider  id='".$id."']";
    }

    /** Getter methods *****************************/

    /**
     * Get id.
     *
     * @since 1.0.0
     *
     * @return (int)      $id   
     * 
     */
    public function get_id(){
        return $this->id;
    }

    /**
     * Get name.
     *
     * @since 1.0.0
     *
     * @return (string)     $name   
     * 
     */
    public function get_name(){
        return $this->name;
    }

    /**
     * Get shortcode.
     *
     * @since 1.0.0
     *
     * @return (string)      $shortcode   
     * 
     */
    public function get_shortcode(){
        return $this->shortcode;
    }

    /** Public methods *****************************/


}



?>