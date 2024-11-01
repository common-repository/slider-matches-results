<?php

defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!');

class Team{
	const VERSION   = '1.0.0';

    /**
     * Team ID, this element is unique for each team
     * 
     * @var (int)
     */
    private $id;

    /**
     * Team name, this element is the name for each team & this is what will appear on the slider
     * 
     * @var (string)
     */
    private $name;

    /**
     * Team position, this element is the position for each team, it can be used in the "ranking" option
     * 
     * @var (int)
     */
    private $position;

    /**
     * Team points, this element is the number of the points
     * 
     * @var (int)
     */
    private $points;

    /**
     * Team logo, this element is the URL which refers to the logo & this is what will appear on the slider
     * 
     * @var (string)
     */
    private $logo;

    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @param (int)         $id        
     * @param (string)      $name       
     * @param (int)         $postion    
     * @param (int)         $points     
     * @param (string)      $logo      
     * 
     */
    public function __construct( $id, $name, $position, $points, $logo ){
        $this->set_id( $id );
        $this->set_name( $name );
        $this->set_position( $position );
        $this->set_points( $points );
        $this->set_logo( $logo );
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
     * Set position.
     *
     * @since 1.0.0
     *
     * @param (int)      $position    The position of the team.
     * 
     */
    public function set_position( $position ){
        $this->position = $position;
    }

    /**
     * Set points.
     *
     * @since 1.0.0
     *
     * @param (int)      $points    
     * 
     */
    public function set_points( $points ){
        $this->points = $points;
    }

    /**
     * Set logo.
     *
     * @since 1.0.0
     *
     * @param (string)      $logo  
     * 
     */
    public function set_logo( $logo ){
        $this->logo = $logo;
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
     * Get position.
     *
     * @since 1.0.0
     *
     * @return (int)      $position   
     * 
     */
    public function get_position(){
        return $this->position;
    }

    /**
     * Get points.
     *
     * @since 1.0.0
     *
     * @return (int)      $points    
     * 
     */
    public function get_points(){
        return $this->points;
    }

    /**
     * Get logo.
     *
     * @since 1.0.0
     *
     * @return (string)      $logo   
     * 
     */
    public function get_logo(){
        return $this->logo;
    }

    /** Public methods *****************************/


}



?>