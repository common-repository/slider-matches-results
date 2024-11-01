<?php

defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!');

class Settings_Matches{
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
     * Constructor
     *
     * @since 1.0.0
     *
     * @param (int)         $order_by
     * @param (int)         $nb_elements
     * 
     */
    public function __construct( $order_by, $nb_elements ){
        $this->set_order_by( $order_by );
        $this->set_nb_elements( $nb_elements );
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
    
    /** Public methods *****************************/


}



?>