<?php

defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!');

class Settings_Teams{
	const VERSION   = '1.0.0';

    /**
     * order_by
     * 
     * @var (int)
     */
    private $order_by;

    /**
     * nb_elements
     * 
     * @var (int)
     */
    private $nb_elements;

    /**
     * display_logo
     * 
     * @var (boolean)
     */
    private $display_logo;

    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @param (int)         $order_by
     * @param (int)         $nb_elements
     * @param (boolean)     $display_logo
     * 
     */
    public function __construct( $order_by, $nb_elements, $display_logo ){
        $this->set_order_by( $order_by );
        $this->set_nb_elements( $nb_elements );
        $this->set_display_logo( $display_logo );
    }

    /** Setter methods *****************************/

    /**
     * Set order_by.
     *
     * @since 1.0.0
     *
     * @param (int)      $order_by
     * 
     */
    public function set_order_by( $order_by ){
        $this->order_by = $order_by;
    }

    /**
     * Set nb_elements.
     *
     * @since 1.0.0
     *
     * @param (int)      $nb_elements
     * 
     */
    public function set_nb_elements( $nb_elements ){
        $this->nb_elements = $nb_elements;
    }

    /**
     * Set display_logo.
     *
     * @since 1.0.0
     *
     * @param (boolean)      $display_logo
     * 
     */
    public function set_display_logo( $display_logo ){
        $this->display_logo = $display_logo;
    }

    
    /** Getter methods *****************************/

    /**
     * Get order_by.
     *
     * @since 1.0.0
     *
     * @return (int)      $order_by
     * 
     */
    public function get_order_by(){
        return $this->order_by;
    }

     /**
     * Get nb_elements.
     *
     * @since 1.0.0
     *
     * @return (int)      $nb_elements
     * 
     */
    public function get_nb_elements(){
        return $this->nb_elements;
    }

    /**
     * Get display_logo.
     *
     * @since 1.0.0
     *
     * @return (boolean)      $display_logo
     * 
     */
    public function get_display_logo(){
        return $this->display_logo;
    }

    
    /** Public methods *****************************/


}



?>