<?php

defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!');

class Settings_Ranking{
	const VERSION   = '1.0.0';

    /**
     * display_ranking
     * 
     * @var (boolean)
     */
    private $display_ranking;

    /**
     * background_color
     * 
     * @var (string)
     */
    private $background_color;

    /**
     * text_color
     * 
     * @var (string)
     */
    private $text_color;

    /**
     * Team id
     * 
     * @var (int)
     */
    private $team_id;

    /**
     * background_color_team
     * 
     * @var (string)
     */
    private $background_color_team;

    /**
     * text_color_team
     * 
     * @var (string)
     */
    private $text_color_team;

    /**
     * display_border
     * 
     * @var (boolean)
     */
    private $display_border;

    /**
     * border_width
     * 
     * @var (string)
     */
    private $border_width;

    /**
     * border_style
     * 
     * @var (string)
     */
    private $border_style;

    /**
     * border_color
     * 
     * @var (string)
     */
    private $border_color;

    /**
     * nb_teams
     * 
     * @var (int)
     */
    private $nb_teams;

    /**
     * nb_team_above
     * 
     * @var (int)
     */
    private $nb_team_above;


    /**
     * nb_team_below
     * 
     * @var (int)
     */
    private $nb_team_below;

    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @param (boolean)   $display_ranking
     * @param (string)    $background_color
     * @param (string)    $text_color
     * @param (int)       $team_id         
     * @param (string)    $background_color_team       
     * @param (string)    $text_color_team
     * @param (boolean)   $display_border
     * @param (string)    $border_width
     * @param (string)    $border_style
     * @param (string)    $border_color
     * @param (int)       $nb_teams
     * @param (int)       $nb_teams_above
     * @param (int)       $nb_teams_below
     * 
     */

    public function __construct( $display_ranking, $background_color, $text_color, $team_id, $background_color_team, $text_color_team, $display_border, $border_width, $border_style, $border_color, $nb_teams, $nb_teams_above, $nb_teams_below ){
        $this->set_display_ranking( $display_ranking );
        $this->set_background_color( $background_color );
        $this->set_text_color( $text_color );
        $this->set_team_id( $team_id );
        $this->set_background_color_team( $background_color_team );
        $this->set_text_color_team( $text_color_team );
        $this->set_display_border( $display_border );
        $this->set_border_width( $border_width );
        $this->set_border_style( $border_style );
        $this->set_border_color( $border_color );
        $this->set_nb_teams( $nb_teams );
        $this->set_nb_teams_above( $nb_teams_above );
        $this->set_nb_teams_below( $nb_teams_below );
    }

    /** Setter methods *****************************/

    /**
     * Set set_display_ranking.
     *
     * @since 1.0.0
     *
     * @param (boolean)      $set_display_ranking
     * 
     */
    public function set_display_ranking( $display_ranking ){
        $this->display_ranking = $display_ranking;
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
     * Set team_id.
     *
     * @since 1.0.0
     *
     * @param (int)      $team_id
     * 
     */
    public function set_team_id( $team_id ){
        $this->team_id = $team_id;
    }

    /**
     * Set background_color_team.
     *
     * @since 1.0.0
     *
     * @param (string)      $background_color_team
     * 
     */
    public function set_background_color_team( $background_color_team ){
        $this->background_color_team = $background_color_team;
    }

    /**
     * Set text_color_team.
     *
     * @since 1.0.0
     *
     * @param (string)      $text_color_team
     * 
     */
    public function set_text_color_team( $text_color_team ){
        $this->text_color_team = $text_color_team;
    }

    /**
     * Set display_border.
     *
     * @since 1.0.0
     *
     * @param (string)      $display_border
     * 
     */
    public function set_display_border( $display_border ){
        $this->display_border = $display_border;
    }

    /**
     * Set border_width.
     *
     * @since 1.0.0
     *
     * @param (string)      $border_width
     * 
     */
    public function set_border_width( $border_width ){
        $this->border_width = $border_width;   
    }

    /**
     * Set border_style.
     *
     * @since 1.0.0
     *
     * @param (string)      $border_style
     * 
     */
    public function set_border_style( $border_style ){
        $this->border_style = $border_style;
    }

    /**
     * Set border_color.
     *
     * @since 1.0.0
     *
     * @param (string)      $border_color
     * 
     */
    public function set_border_color( $border_color ){
        $this->border_color = $border_color;
    }


    /**
     * Set nb_teams.
     *
     * @since 1.0.0
     *
     * @param (int)      $nb_teams
     * 
     */
    public function set_nb_teams( $nb_teams ){
        $this->nb_teams = $nb_teams;
    }


    /**
     * Set nb_teams_above.
     *
     * @since 1.0.0
     *
     * @param (int)      $nb_teams_above
     * 
     */
    public function set_nb_teams_above( $nb_teams_above ){
        $this->nb_teams_above = $nb_teams_above;
    }


    /**
     * Set nb_teams_below.
     *
     * @since 1.0.0
     *
     * @param (int)      $nb_team_below
     * 
     */
    public function set_nb_teams_below( $nb_teams_below ){
        $this->nb_teams_below = $nb_teams_below;
    }

    /** Getter methods *****************************/

    /**
     * Get display_ranking.
     *
     * @since 1.0.0
     *
     * @param (boolean)      $display_ranking
     * 
     */
    public function get_display_ranking(){
        return $this->display_ranking;
    }

    /**
     * get background_color.
     *
     * @since 1.0.0
     *
     * @param (string)      $background_color
     * 
     */
    public function get_background_color(){
        return $this->background_color;
    }

    /**
     * get text_color.
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
     * get team_id.
     *
     * @since 1.0.0
     *
     * @return (int)      $team_id
     * 
     */
    public function get_team_id(){
        return $this->team_id;
    }

    /**
     * get background_color_team.
     *
     * @since 1.0.0
     *
     * @return (string)      $background_color_team
     * 
     */
    public function get_background_color_team(){
        return $this->background_color_team;
    }

    /**
     * get text_color_team.
     *
     * @since 1.0.0
     *
     * @return (string)      $text_color_team
     * 
     */
    public function get_text_color_team(){
        return $this->text_color_team;
    }

    /**
     * get display_border.
     *
     * @since 1.0.0
     *
     * @return (string)      $display_border
     * 
     */
    public function get_display_border(){
        return $this->display_border;
    }

    /**
     * get border_width.
     *
     * @since 1.0.0
     *
     * @return (string)      $border_width
     * 
     */
    public function get_border_width(){
        return $this->border_width;   
    }

    /**
     * get border_style.
     *
     * @since 1.0.0
     *
     * @return (string)      $border_style
     * 
     */
    public function get_border_style(){
        return $this->border_style;
    }

    /**
     * get border_color.
     *
     * @since 1.0.0
     *
     * @return (string)      $border_color
     * 
     */
    public function get_border_color(){
        return $this->border_color;
    }

    /**
     * get nb_teams.
     *
     * @since 1.0.0
     *
     * @return (int)      $nb_teams
     * 
     */
    public function get_nb_teams(){
        return $this->nb_teams;
    }

    /**
     * get nb_teams_above.
     *
     * @since 1.0.0
     *
     * @return (int)      $nb_teams_above
     * 
     */
    public function get_nb_teams_above(){
        return $this->nb_teams_above;
    }


    /**
     * get nb_teams_below.
     *
     * @since 1.0.0
     *
     * @return (int)      $nb_teams_below
     * 
     */
    public function get_nb_teams_below(){
        return $this->nb_teams_below;
    }


    /** Public methods *****************************/


}



?>