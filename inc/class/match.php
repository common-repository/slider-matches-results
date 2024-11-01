<?php

defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!');

class Match{
	const VERSION   = '1.0.0';

    /**
     * Match ID
     * 
     * @var (int)
     */
    private $id;

    /**
     * Team home team id
     * 
     * @var (int)
     */
    private $home_team_id;

    /**
     * Match outside team id
     * 
     * @var (int)
     */
    private $outside_team_id;

    /**
     * Team week
     * 
     * @var (string)
     */
    private $week;

    /**
     * Team date
     * 
     * @var (timestamp)
     */
    private $date;

    /**
     * Match championship
     * 
     * @var (string)
     */
    private $championship;

    /**
     * Match score
     * 
     * @var (string)
     */
    private $score;

    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @param (int)         $id
     * @param (int)         $home_team_id
     * @param (int)         $outside_team_id
     * @param (string)      $week         
     * @param (timestamp)   $date       
     * @param (string)      $championship
     * @param (string)      $score
     * 
     */
    public function __construct( $id, $home_team_id, $outside_team_id, $week, $date, $championship, $score ){
        $this->set_id( $id );
        $this->set_home_team_id( $home_team_id );
        $this->set_outside_team_id( $outside_team_id );
        $this->set_week( $week );
        $this->set_date( $date );
        $this->set_championship( $championship );
        $this->set_score( $score );
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
     * Set home_team_id.
     *
     * @since 1.0.0
     *
     * @param (int)      $home_team_id
     * 
     */
    public function set_home_team_id( $home_team_id ){
        $this->home_team_id = $home_team_id;
    }

    /**
     * Set outside_team_id.
     *
     * @since 1.0.0
     *
     * @param (int)      $outside_team_id
     * 
     */
    public function set_outside_team_id( $outside_team_id ){
        $this->outside_team_id = $outside_team_id;
    }

    /**
     * Set week.
     *
     * @since 1.0.0
     *
     * @param (string)      $week
     * 
     */
    public function set_week( $week ){
        $this->week = $week;
    }

    /**
     * Set date.
     *
     * @since 1.0.0
     *
     * @param (timestamp)      $date
     * 
     */
    public function set_date( $date ){
        $this->date = $date;
    }

    /**
     * Set championship.
     *
     * @since 1.0.0
     *
     * @param (string)      $championship
     * 
     */
    public function set_championship( $championship ){
        $this->championship = $championship;
    }

    /**
     * Set score.
     *
     * @since 1.0.0
     *
     * @param (string)      $score
     * 
     */
    public function set_score( $score ){
        $this->score = $score;
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
     * Get home_team_id.
     *
     * @since 1.0.0
     *
     * @return (int)      $home_team_id
     * 
     */
    public function get_home_team_id(){
        return $this->home_team_id;
    }

    /**
     * Get outside_team_id.
     *
     * @since 1.0.0
     *
     * @return (int)      $outside_team_id
     * 
     */
    public function get_outside_team_id(){
        return $this->outside_team_id;
    }

    /**
     * Get week.
     *
     * @since 1.0.0
     *
     * @return (string)      $week
     * 
     */
    public function get_week(){
        return $this->week;
    }

    /**
     * Get date.
     *
     * @since 1.0.0
     *
     * @return (timestamp)      $date
     * 
     */
    public function get_date(){
        return $this->date;
    }

    /**
     * Get championship.
     *
     * @since 1.0.0
     *
     * @return (string)      $championship
     * 
     */
    public function get_championship(){
        return $this->championship;
    }

    /**
     * Get score.
     *
     * @since 1.0.0
     *
     * @return (string)      $score
     * 
     */
    public function get_score(){
        return $this->score;
    }

    
    /**
     * Get day of the date.
     *
     * @since 1.0.0
     *
     * @return (string)
     * 
     */
    public function get_date_slide_header_date_day( $local ){

        $date = $this->get_date();
        if( !empty( $date ) ){
            $date_local = new DateTime( $date );

            switch( $local ) {
                case 'fr':
                    # Fr
                    $date_local = $date_local->format( 'd' );
                    break;
                
                default:
                    # En
                    $date_local = $date_local->format( 'd' );
                    break;
            }
            return $date_local;
        }
    }

    /**
     * Get month of the date.
     *
     * @since 1.0.0
     *
     * @return (string)
     * 
     */
    public function get_date_slide_header_date_month( $local ){

        $date = $this->get_date();
        if( !empty( $date ) ){
            switch( $local ) {
                case 'fr':
                    # Fr
                    $date_local = new DateTime( $date );

                    setlocale(LC_ALL, 'fr_FR');

                    $date_local = strtoupper( strftime( "%B", $date_local->getTimestamp() ) );

                    break;
                
                default:
                    # Us
                    $date_local = new DateTime( $date );


                    setlocale(LC_ALL, 'us_US');

                    $date_local = strtoupper( strftime( "%B", $date_local->getTimestamp() ) );

                    break;
            }
            return $date_local;
        }
    }

    /**
     * Get date - format using in slide (header).
     *
     * @since 1.0.0
     *
     * @return (string)
     * 
     */
    public function get_date_slide_header_content( $local ){

        $date       = $this->get_date();
        $date_local = '';

        if( !empty( $date ) ){
            $date_local = new DateTime( $date );

            switch( $local ) {
                case 'fr':
                    # Fr

                    setlocale(LC_ALL, 'fr_FR');

                    $date_local = strftime( "%A, %H:%M", $date_local->getTimestamp() );
                
                    break;

                default:
                    # Us

                    setlocale(LC_ALL, 'us_US');

                    $date_local = strftime( "%A, %I:%M %p", $date_local->getTimestamp() );
 
                    break;
            }
        }

        return $date_local;
    }

    /**
     * Get header content in the slide.
     *
     * @since 1.0.0
     *
     * @return (string)
     * 
     */
    public function get_slide_header_content( $local ){

        $date           = $this->get_date_slide_header_content( $local );
        $championship   = $this->get_championship();
        $week           = $this->get_week();

        $slide_header_content = '';

        $week_string = ' '.__( 'day', 'slider-matches-results' ).' ' ;

        if( !empty( $date ) && !empty( $championship ) && !empty( $week ) ){
            $slide_header_content = $date.' - '.$championship.','.$week_string.$week;
        }elseif( empty( $date ) && !empty( $championship ) && !empty( $week ) ){
            $slide_header_content = $championship.','.$week_string.$week;
        }elseif( empty( $date ) && empty( $championship ) && !empty( $week ) ){
            $slide_header_content = $week_string.$week;
        }elseif( empty( $date ) && !empty( $championship ) && empty( $week ) ){
            $slide_header_content = $championship;
        }elseif( !empty( $date ) && empty( $championship ) && !empty( $week ) ){
            $slide_header_content = $date.' - '.$week_string.$week;
        }elseif( !empty( $date ) && empty( $championship ) && empty( $week ) ){
            $slide_header_content = $date;
        }elseif( !empty( $date ) && !empty( $championship ) && empty( $week ) ){
            $slide_header_content = $date.' - '.$championship;
        }

        return $slide_header_content;
    }

    /** Public methods *****************************/

    

}



?>