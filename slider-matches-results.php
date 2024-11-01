<?php
/*
Plugin Name: Slider Matches Results
Plugin URI: 
Description: Allows you to create specific sliders for your sports team (Football, Handball ...)
Version: 1.0.5
Author: Cédric Chevillard
Author URI: https://www.cedricchevillard.fr
License: GPL2
Text Domain: slider-matches-results
Domain Path: /languages
*/

defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!');


class Slider_Matches_Results
{
    const VERSION                  = '1.0.5';
    const SMR_DB_VERSION           = '1.0';
    const OPTION_NAME              = 'smr_options_settings';
    const OPTION_NAME_SLIDER       = 'smr_slider_';
    const OPTION_NAME_STATE_ACTIVE = 'smr_state_active';

    private $table_name_options;
    private $table_name_teams;
    private $table_name_matches;

    private $language;

    function __construct(){

        // Init tables name
        $this->set_tables_name();

        // Init language - based on the WordPress setting
        $this->set_language();
    }

    /** Setter methods *****************************/

    /**
     * Set tables name.
     *
     * @since 1.0.0
     * 
     */
    public function set_tables_name(){
        global $wpdb;

        // Init table name of teams
        $this->table_name_teams   = $wpdb->prefix."smr_teams";

        // Init table name of matches
        $this->table_name_matches = $wpdb->prefix."smr_matches";

        // Init table name of option
        $this->table_name_options = $wpdb->prefix."options";

    }

    /**
     * Set language.
     *
     * @since 1.0.0
     * 
     */
    public function set_language(){
        
        // Textdomain Translation
        add_action( 'plugins_loaded', array( $this, 'slider_matches_results_load_plugin_textdomain_translations' ), 0 );

        // Recover the language of WordPress
        $language_wordpress = get_locale();

        // Init language 
        switch ( $language_wordpress ) {
            case 'fr_FR':
                $this->language = 'fr';
                break;
            
            default:
                $this->language = 'us';
                break;
        }
    }

    /**
     * Set active state.
     *
     * @since 1.0.0
     * 
     */
    public function set_state_active( $value ){

        // Check if the option exists
        if( get_option( $this->get_option_name_state_active() ) ){
            update_option( $this->get_option_name_state_active(), $value );
        }else{
            add_option( $this->get_option_name_state_active(), $value );
        }
        
    }

    /**
     * Set slider option.
     *
     * @since 1.0.0
     * 
     */
    public function set_slider( $id, $value ){
        // Update option of specific slider
        return update_option( $this->get_option_name_slider().$id, $value );
    }

    /** Getter methods *****************************/

    /**
     * Get teams table name.
     *
     * @since 1.0.0
     *
     * @return (string)   
     * 
     */
    public function get_table_name_teams(){
        return $this->table_name_teams;
    }
    
    /**
     * Get matches table name.
     *
     * @since 1.0.0
     *
     * @return (string)   
     * 
     */
    public function get_table_name_matches(){
        return $this->table_name_matches;
    }

    /**
     * Get options table name.
     *
     * @since 1.0.0
     *
     * @return (string)       
     * 
     */
    public function get_table_name_options(){
        return $this->table_name_options;
    }

    /**
     * Get smr db version.
     *
     * @since 1.0.0
     *
     * @return (string)
     * 
     */
    public function get_smr_db_version(){
        return self::SMR_DB_VERSION;
    }

    /**
     * Get option name.
     *
     * @since 1.0.0
     *
     * @return (string)
     * 
     */
    public function get_option_name(){
        return self::OPTION_NAME;
    }

    /**
     * Get option name slider.
     *
     * @since 1.0.0
     *
     * @return (string)
     * 
     */
    public function get_option_name_slider(){
        return self::OPTION_NAME_SLIDER;
    }

    /**
     * Get option name slider.
     *
     * @since 1.0.0
     *
     * @return (string)
     * 
     */
    public function get_option_name_state_active(){
        return self::OPTION_NAME_STATE_ACTIVE;
    }

    /**
     * Get language.
     *
     * @since 1.0.0
     *
     * @return (string)
     * 
     */
    public function get_language(){
        return $this->language;
    }

    /**
     * Get teams present in the db.
     *
     * @since 1.0.0
     *
     * @return (Teams[])   
     * 
     */
    public function get_teams(){
        require_once plugin_dir_path( __FILE__ ).'inc/class/team.php';

        global $wpdb;

        $table_name_teams = sanitize_key( $this->get_table_name_teams() );

        $sql = "SELECT * FROM $table_name_teams";

        // Select all teams in DB
        $results_teams = $wpdb->get_results( $sql );

        // Create Team from the selection 
        $teams = [];
        foreach( $results_teams as $result_team ){
            $teams[] = new Team($result_team->id, $result_team->name, $result_team->position, $result_team->points, $result_team->logo);
        }

        return $teams;
    }

    /**
     * Compare the position of the team.
     *
     * @since 1.0.0
     *
     * @return (boolean)   
     * 
     */
    public function order_teams_ranking( $team_1, $team_2 ){
        return !strcmp( $team_1->get_position(), $team_2->get_position() );
    }

    /**
     * Get teams of the ranking
     *
     * @since 1.0.0
     *
     * @return (Teams[])   
     * 
     */
    public function get_teams_ranking( $your_team_id, $nb_teams, $nb_teams_above, $nb_teams_below ){
        require_once plugin_dir_path( __FILE__ ).'inc/class/team.php';

        global $wpdb;

        $table_name_teams = sanitize_key( $this->get_table_name_teams() );

        $sql = "SELECT * FROM $table_name_teams WHERE POSITION != 0 ORDER BY POSITION ASC";

        // Select all teams in DB
        $results_teams = $wpdb->get_results( $sql );

        // Create Team from the selection 
        $teams = [];
        foreach( $results_teams as $result_team ){
            $teams[] = new Team( $result_team->id, $result_team->name, $result_team->position, $result_team->points, $result_team->logo );
        }

        // Check if a specific team exists
        if( $your_team_id != 0 ){

            // we make a selection to have only the teams that we want
            $index              = 0;
            $index_your_team    = null;

            while( $index < count( $teams ) && empty( $index_your_team ) ){
                if( $teams[$index]->get_id() == $your_team_id ){
                    $index_your_team = $index;
                }
                $index++;
            }

            $index_start = $index_your_team - $nb_teams_above;

            if( $index_start <= 0 ){
                $index_start = 0;
                $length      = $index_your_team;
            }else{
                $length      = $nb_teams_above;
            }

            $teams_temp = array_slice( $teams, $index_start, $length );

            $teams = array_merge( $teams_temp, array_slice( $teams, $index_your_team, $nb_teams_below+1 ) );
        }else{
            $teams = array_slice( $teams, 0, $nb_teams );
        }
        return $teams;
    }

    /**
     * Get matches for the slider
     *
     * @since 1.0.0
     *
     * @return (Matches[])   
     * 
     */
    public function get_matches_for_slider( $matches, $nb_matches_before, $nb_matches_next ){

        $now                        = new DateTime();
        $index                      = 0;
        $index_next_match_first     = null;

        while( $index < count( $matches ) && empty( $index_next_match_first ) ){
            if( new DateTime( $matches[$index]->get_date() ) > $now ){
                $index_next_match_first = $index;
            }
            $index++;
        }

        $matches_temp = array();

        if( $index_next_match_first > 0 ){
            $index_start = $index_next_match_first - $nb_matches_before;

            if( $index_start <= 0 ){
                $index_start = 0;
                $length      = $index_next_match_first;
            }else{
                $length      = $nb_matches_before;
            }

            $matches_temp = array_slice( $matches, $index_start, $length );
        }

        $matches      = array_merge( $matches_temp, array_slice( $matches, $index_next_match_first, $nb_matches_next ) );

        return $matches;
    
    }

    /**
     * Get matches present in the db.
     *
     * @since 1.0.0
     *
     * @return (Matche[])   
     * 
     */
    public function get_matches(){
        require_once plugin_dir_path( __FILE__ ).'inc/class/match.php';

        global $wpdb;

        $table_name_matches = sanitize_key( $this->get_table_name_matches() );

        $sql = "SELECT * FROM $table_name_matches";

        // Select all matches in DB
        $results_matches = $wpdb->get_results( $sql );

        // Create Match from the selection
        $matches = [];
        foreach( $results_matches as $results_match ){
            $matches[] = new Match( $results_match->id, $results_match->home_team_id, $results_match->outside_team_id, $results_match->week, $results_match->date, $results_match->championship, $results_match->score );
        }

        return $matches;
    }

    /**
     * Get matches order by date present in the db.
     *
     * @since 1.0.0
     *
     * @return (Matche[])   
     * 
     */
    public function get_matches_order_by_date(){
        require_once plugin_dir_path( __FILE__ ).'inc/class/match.php';

        global $wpdb;

        $table_name_matches = sanitize_key( $this->get_table_name_matches() );

        $sql = "SELECT * FROM $table_name_matches ORDER BY date";

        // Select all matches in DB
        $results_matches = $wpdb->get_results( $sql );

        // Create Match from the selection
        $matches = [];
        foreach( $results_matches as $results_match ){
            $matches[] = new Match($results_match->id,$results_match->home_team_id,$results_match->outside_team_id,$results_match->week, $results_match->date, $results_match->championship,$results_match->score);
        }

        return $matches;
    }

    /**
     * Get sliders present in the db (WP options).
     *
     * @since 1.0.0
     *
     * @return (Slider[])   
     * 
     */
    public function get_sliders(){
        require_once plugin_dir_path( __FILE__ ).'inc/class/slider.php';

        global $wpdb;

        $table_name_options = sanitize_key( $this->get_table_name_options() );

        $sql = "SELECT * FROM $table_name_options WHERE option_name LIKE %s";

        // Select all sliders in DB (WP option)
        $results_sliders = $wpdb->get_results( $wpdb->prepare( $sql, array( $this->get_option_name_slider().'%' ) ) );

        // Create Slider from the selection
        $sliders = [];
        foreach( $results_sliders as $results_slider ){
            $option_value = $results_slider->option_value;

            $slider       = json_decode( $option_value );

            $sliders[]    = new Slider( $slider->id, $slider->name );
        }

        return $sliders;
    }

    /**
     * Get slider with a specific id (WP options).
     *
     * @since 1.0.0
     *
     * @return (get_option())   
     * 
     */
    public function get_slider( $id ){
        return get_option( $this->get_option_name_slider().$id );
    }

    /**
     * the parameters of the sliders that will be used in the script to generate the slider (All sliders)
     *
     * @since 1.0.0
     *
     * @return (array)   
     * 
     */
    public function get_sliders_script( $sliders ){
        require_once plugin_dir_path( __FILE__ ).'inc/class/slider.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_header.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_content.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_footer.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_slide.php';

        $sliders_script = [];

        // we go through all the sliders
        foreach( $sliders as $slider ){
            $slider_json   = json_decode( $this->get_slider( $slider->get_id() ) );

            $settings_json = $slider_json->settings;

            // SLIDER
            $settings_slider_header_json  = $settings_json->slider->header;

            $settings_slider_header       = new Settings_Slider_Header( $settings_slider_header_json->date_text_color, $settings_slider_header_json->date_background_color, $settings_slider_header_json->title_text_color, $settings_slider_header_json->title_background_color );

            $settings_slider_content_json = $settings_json->slider->content;

            $settings_slider_content      = new Settings_Slider_Content( $settings_slider_content_json->text_color, $settings_slider_content_json->background_color, $settings_slider_content_json->max_width_logo );

            $settings_slider_footer_json  = $settings_json->slider->footer;

            $settings_slider_footer       = new Settings_Slider_Footer( $settings_slider_footer_json->display_footer, $settings_slider_footer_json->text_color, $settings_slider_footer_json->background_color );

            $settings_slide_json          = $settings_json->slider->slide;

            $settings_slide               = new Settings_Slider_Slide($settings_slide_json->infinite, $settings_slide_json->dots, $settings_slide_json->dots_color, $settings_slide_json->autoplay, $settings_slide_json->autoplay_speed, $settings_slide_json->arrows, $settings_slide_json->arrows_color,$settings_slide_json->arrows_in, $settings_slide_json->fade, $settings_slide_json->transition_type, $settings_slide_json->transition_speed, $settings_slide_json->swipe );

            $slider_html_class            = 'smr_slider_'.$slider->get_id();

            // We add the parameters
            $sliders_script[] = array( 'slider' => $slider_html_class , 'infinite' => ( $settings_slide->get_infinite() )  ? 'true' : 'false', 'autoplay', 'slides_to_show' => $settings_slide->get_slides_to_show(), 'slides_to_scroll' => $settings_slide->get_slides_to_scroll(), 'dots' => ( $settings_slide->get_dots() ) ? 'true' : 'false', 'autoplay' => ( $settings_slide->get_autoplay() ) ? 'true' : 'false', 'autoplay_speed' => $settings_slide->get_autoplay_speed(), 'arrows' => ( $settings_slide->get_arrows() ) ? 'true' : 'false', 'arrows_in' => ( $settings_slide->get_arrows_in() ) ? 'true' : 'false', 'fade' => ( $settings_slide->get_fade() ) ? 'true' : 'false', 'adaptative_height' => $settings_slide->get_adaptative_height(), 'transition_type' => $settings_slide->get_transition_type(), 'transition_speed' => $settings_slide->get_transition_speed(), 'swipe' => ( $settings_slide->get_swipe() ) ? 'true' : 'false' );
        }

        return $sliders_script;
    }

    /**
     * Get the active state
     *
     * @since 1.0.0
     *
     * @return (get_option())   
     * 
     */
    public function get_state_active(){
        return get_option( $this->get_option_name_state_active() );
    }

    /**
     * Check if it's the state active
     *
     * @since 1.0.0
     *
     * @return (boolean)   
     * 
     */
    public function is_state_active( $state_active, $state ){
        return $state_active == $state;
    }
    

    /** Main methods *****************************/

    /**
     * Activate plugin
     *
     * @since 1.0.0
     * 
     */
    function activate_plugin(){
        add_action( 'plugins_loaded', array( $this, 'slider_matches_results_textdomain' ) );

        $this->create_table();

        flush_rewrite_rules();
    }

    /**
     * Desactivate plugin
     *
     * @since 1.0.0
     * 
     */
    function desactivate_plugin(){
        flush_rewrite_rules();
    }

    /**
     * Load plugin text domain for translation
     *
     * @since 1.0.0
     * 
     */
    function slider_matches_results_load_plugin_textdomain_translations() {
        load_plugin_textdomain( 'slider-matches-results', false, basename( dirname( __FILE__ ) ).'/languages' );
    }

    /**
     * Create table using in this plugin
     *
     * @since 1.0.0
     * 
     */
    protected function create_table(){
        global $wpdb;

        $table_name_teams   = sanitize_key( $this->get_table_name_teams() );
        $table_name_matches = sanitize_key( $this->get_table_name_matches() );

        $charset_collate    = $wpdb->get_charset_collate();
        
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        // Table Teams
        $sql = "CREATE TABLE $table_name_teams (
            id       mediumint(9)    NOT NULL AUTO_INCREMENT,
            name     tinytext        NOT NULL,
            position mediumint(9)    DEFAULT NULL,
            points   mediumint(9)    DEFAULT NULL,
            logo     tinytext        DEFAULT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        dbDelta( $sql );


        // Table Matches
        $sql = "CREATE TABLE $table_name_matches (
            id                mediumint(9)    NOT NULL AUTO_INCREMENT,
            home_team_id      mediumint(9)    NOT NULL,
            outside_team_id   mediumint(9)    NOT NULL,
            week              tinytext        DEFAULT NULL,
            date              DATETIME        DEFAULT NULL,
            championship      tinytext        DEFAULT NULL,
            score             tinytext        DEFAULT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        dbDelta( $sql );

        add_option( 'smr_db_version', $this->get_smr_db_version() );
    }
    
    /**
     * Add hook - admin
     *
     * @since 1.0.0
     * 
     */
    function register_admin(){ 
        if( isset( $_GET["page"] ) ){
            $page_admin = $_GET["page"];
        }else{
            $page_admin = null;
        }      
        
        // Call function redirect on init
        add_action( 'init', array( $this, 'redirect' ) );

        // Check that you are on a plugin admin page 
        if( $page_admin == 'smr_plugin_sliders' || $page_admin == 'smr_plugin_teams' || $page_admin == 'smr_plugin_matches' || $page_admin == 'smr_plugin_settings' || $page_admin == 'smr_plugin_create_slider' || $page_admin == 'smr_plugin_update_slider' ){
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin' ) );
        }

        // Call function for the admin page (menu)
        add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );

    }

    /**
     * Add hook - Not admin
     *
     * @since 1.0.0
     * 
     */
    function register(){
        // Create shortcode (slider & ranking)
        add_shortcode( 'smr_slider', array( $this, 'generate_smr_slider' ) );        
        add_shortcode( 'smr_ranking', array( $this, 'generate_smr_ranking' ) );
    }


    /**
     * Add script - admin
     *
     * @since 1.0.0
     * 
     */
    function enqueue_admin(){

        // wp_enqueue_script( 'smr_jquery_script', plugins_url( 'assets/js/jquery-3.3.1.min.js', __FILE__ ) );

        wp_enqueue_style( 'smr_bootstrap_style', plugins_url( 'assets/css/bootstrap.min.css', __FILE__ ) );
        wp_enqueue_script( 'smr_bootstrap_script', plugins_url( 'assets/js/bootstrap.min.js', __FILE__ ) );

        if( isset( $_GET["page"] ) ){
            $page_admin = $_GET["page"];
        }else{
            $page_admin = null;
        } 

        // Add specific script for specific page 
        if( $page_admin == 'smr_plugin_sliders' ){

            wp_enqueue_style( 'smr_sweetalert2_style', plugins_url( 'assets/css/sweetalert2.min.css', __FILE__ ) );
            wp_enqueue_style( 'smr_datatables_style', plugins_url( 'assets/css/datatables.min.css', __FILE__ ) );

            wp_enqueue_script( 'smr_datatables_script', plugins_url( 'assets/js/datatables.min.js', __FILE__ ) );
            wp_enqueue_script( 'smr_sweetalert2_script', plugins_url( 'assets/js/sweetalert2.min.js', __FILE__ ) );
            
            wp_enqueue_script( 'smr_admin_script', plugins_url( 'assets/js/smr-admin.js', __FILE__ ), array( 'jquery' ), '1.0', true );
            wp_enqueue_script( 'smr_admin_translation_script', plugins_url( 'assets/js/smr-admin-translation.js', __FILE__ ), array( 'jquery' ), '1.0', true );
            wp_enqueue_script( 'smr_admin_sliders_script', plugins_url( 'assets/js/smr-admin-sliders.js', __FILE__ ), array( 'jquery' ), '1.0', true );
        
            wp_localize_script( 'smr_admin_script', 'smr_ajax_sliders',array( 'ajax_url' => admin_url( 'admin-ajax.php'), 'language' => $this->get_language(), 'dataTableLanguage' => plugins_url( 'languages/js/datatables/'.$this->get_language().'.json', __FILE__ ), 'delete_slider' => 'smr_delete_slider', 'delete_sliders' => 'smr_delete_sliders' ) );

        }elseif( $page_admin == 'smr_plugin_create_slider' ){

            wp_enqueue_style( 'smr_bootstrap_switches_style', plugins_url( 'assets/css/component-custom-switch.min.css', __FILE__ ) );        
            wp_enqueue_style( 'smr_bootstrap_colorpicker_style', plugins_url( 'assets/css/bootstrap-colorpicker.min.css', __FILE__ ) );
            wp_enqueue_style( 'smr_bootstrap_chosen_style', plugins_url( 'assets/css/component-chosen.min.css', __FILE__ ) );
            wp_enqueue_style( 'smr_slick_style', plugins_url( 'assets/css/slick.css', __FILE__ ) );
            wp_enqueue_style( 'smr_slick2_style', plugins_url( 'assets/css/slick-theme.css', __FILE__ ) );

            wp_enqueue_script( 'smr_bootstrap_chosen_script', plugins_url( 'assets/js/chosen.js', __FILE__ ) );
            wp_enqueue_script( 'smr_bootstrap_colorpicker_script', plugins_url( 'assets/js/bootstrap-colorpicker.min.js', __FILE__ ) );
            wp_enqueue_script( 'slick_script', plugins_url( 'assets/js/slick.min.js', __FILE__ ) );

            
            wp_enqueue_script( 'smr_admin_script', plugins_url( 'assets/js/smr-admin.js', __FILE__ ), array( 'jquery' ), '1.0', true );
            wp_enqueue_script( 'smr_admin_create_slider_script', plugins_url( 'assets/js/smr-admin-create-slider.js', __FILE__ ), array( 'jquery' ), '1.0', true );
        
        }elseif( $page_admin == 'smr_plugin_update_slider' ){

            wp_enqueue_style( 'smr_bootstrap_switches_style', plugins_url( 'assets/css/component-custom-switch.min.css', __FILE__ ) );        
            wp_enqueue_style( 'smr_bootstrap_colorpicker_style', plugins_url( 'assets/css/bootstrap-colorpicker.min.css', __FILE__ ) );
            wp_enqueue_style( 'smr_bootstrap_chosen_style', plugins_url( 'assets/css/component-chosen.min.css', __FILE__ ) );
            wp_enqueue_style( 'smr_slick_style', plugins_url( 'assets/css/slick.css', __FILE__ ) );
            wp_enqueue_style( 'smr_slick2_style', plugins_url( 'assets/css/slick-theme.css', __FILE__ ) );

            wp_enqueue_script( 'smr_bootstrap_chosen_script', plugins_url( 'assets/js/chosen.js', __FILE__ ) );
            wp_enqueue_script( 'smr_bootstrap_colorpicker_script', plugins_url( 'assets/js/bootstrap-colorpicker.min.js', __FILE__ ) );
            wp_enqueue_script( 'slick_script', plugins_url( 'assets/js/slick.min.js', __FILE__ ) );

            
            wp_enqueue_script( 'smr_admin_script', plugins_url( 'assets/js/smr-admin.js', __FILE__ ), array( 'jquery' ), '1.0', true );
            wp_enqueue_script( 'smr_admin_update_slider_script', plugins_url( 'assets/js/smr-admin-update-slider.js', __FILE__ ), array( 'jquery' ), '1.0', true );
        
        }elseif( $page_admin == 'smr_plugin_teams' ){

            wp_enqueue_style( 'smr_sweetalert2_style', plugins_url( 'assets/css/sweetalert2.min.css', __FILE__ ) );
            wp_enqueue_style( 'smr_datatables_style', plugins_url( 'assets/css/datatables.min.css', __FILE__ ) );

            wp_enqueue_script( 'smr_datatables_script', plugins_url( 'assets/js/datatables.min.js', __FILE__ ) );
            wp_enqueue_script( 'smr_sweetalert2_script', plugins_url( 'assets/js/sweetalert2.min.js', __FILE__ ) );
            wp_enqueue_media();
            wp_enqueue_script( 'wp-media-uploader', plugins_url( 'assets/js/wp_media_uploader.js', __FILE__ ), array( 'jquery' ), '1.0' );
    
            
            wp_enqueue_script( 'smr_admin_script', plugins_url( 'assets/js/smr-admin.js', __FILE__ ), array( 'jquery' ), '1.0', true );
            wp_enqueue_script( 'smr_admin_translation_script', plugins_url( 'assets/js/smr-admin-translation.js', __FILE__ ), array( 'jquery' ), '1.0', true );
            wp_enqueue_script( 'smr_admin_teams_script', plugins_url( 'assets/js/smr-admin-teams.js', __FILE__ ), array( 'jquery' ), '1.0', true );
        
            $settings_teams_json = $this->get_option_settings_teams();

            wp_localize_script( 'smr_admin_script', 'smr_ajax_teams',array( 'ajax_url' => admin_url( 'admin-ajax.php'), 'language' => $this->get_language(), 'dataTableLanguage' => plugins_url( 'languages/js/datatables/'.$this->get_language().'.json', __FILE__ ), 'create_team' => 'smr_create_team', 'delete_team' => 'smr_delete_team', 'update_teams' => 'smr_update_teams', 'update_team' => 'smr_update_team','delete_teams' => 'smr_delete_teams', 'table_order_by' => $settings_teams_json->order_by, 'table_nb_elements' => $settings_teams_json->nb_elements ) );

        }elseif( $page_admin == 'smr_plugin_matches' ){
            
            wp_enqueue_style( 'smr_sweetalert2_style', plugins_url( 'assets/css/sweetalert2.min.css', __FILE__ ) );
            wp_enqueue_style( 'smr_datatables_style', plugins_url( 'assets/css/datatables.min.css', __FILE__ ) );
            wp_enqueue_style( 'smr_datetimepicker_style', plugins_url( 'assets/css/tempusdominus-bootstrap-4.min.css', __FILE__ ) );
            wp_enqueue_style( 'smr_bootstrap_chosen_style', plugins_url( 'assets/css/component-chosen.min.css', __FILE__ ) );

            wp_enqueue_script( 'smr_datatables_script', plugins_url( 'assets/js/datatables.min.js', __FILE__ ) );
            wp_enqueue_script( 'smr_sweetalert2_script', plugins_url( 'assets/js/sweetalert2.min.js', __FILE__ ) );
            wp_enqueue_script( 'smr_bootstrap_chosen_script', plugins_url( 'assets/js/chosen.js', __FILE__ ) );
            wp_enqueue_script( 'smr_moment_script', plugins_url( 'assets/js/moment.min.js', __FILE__ ) );
            wp_enqueue_script( 'smr_moment_fr_script', plugins_url( 'languages/js/moment/fr.js', __FILE__ ) );
            wp_enqueue_script( 'smr_datetimepicker_script', plugins_url( 'assets/js/tempusdominus-bootstrap-4.min.js', __FILE__ ) );
            
            
            wp_enqueue_script( 'smr_admin_script', plugins_url( 'assets/js/smr-admin.js', __FILE__ ), array( 'jquery' ), '1.0', true );
            wp_enqueue_script( 'smr_admin_translation_script', plugins_url( 'assets/js/smr-admin-translation.js', __FILE__ ), array( 'jquery' ), '1.0', true );
            wp_enqueue_script( 'smr_admin_matches_script', plugins_url( 'assets/js/smr-admin-matches.js', __FILE__ ), array( 'jquery' ), '1.0', true );

            $settings_matches_json = $this->get_option_settings_matches();

            wp_localize_script( 'smr_admin_script', 'smr_ajax_matches',array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'language' => $this->get_language(), 'dataTableLanguage' => plugins_url( 'languages/js/datatables/'.$this->get_language().'.json', __FILE__ ), 'create_match' => 'smr_create_match', 'delete_match' => 'smr_delete_match', 'update_match' => 'smr_update_match', 'delete_matches' => 'smr_delete_matches', 'table_order_by' => $settings_matches_json->order_by, 'table_nb_elements' => $settings_matches_json->nb_elements ) );

        }elseif( $page_admin == 'smr_plugin_settings' ){

            wp_enqueue_style( 'smr_bootstrap_switches_style', plugins_url( 'assets/css/component-custom-switch.min.css', __FILE__ ) );        
            wp_enqueue_style( 'smr_bootstrap_colorpicker_style', plugins_url( 'assets/css/bootstrap-colorpicker.min.css', __FILE__ ) );
            wp_enqueue_style( 'smr_bootstrap_chosen_style', plugins_url( 'assets/css/component-chosen.min.css', __FILE__ ) );
            wp_enqueue_style( 'smr_slick_style', plugins_url( 'assets/css/slick.css', __FILE__ ) );
            wp_enqueue_style( 'smr_slick2_style', plugins_url( 'assets/css/slick-theme.css', __FILE__ ) );

            wp_enqueue_script( 'smr_bootstrap_chosen_script', plugins_url( 'assets/js/chosen.js', __FILE__ ) );
            wp_enqueue_script( 'smr_bootstrap_colorpicker_script', plugins_url( 'assets/js/bootstrap-colorpicker.min.js', __FILE__ ) );
            wp_enqueue_script( 'slick_script', plugins_url( 'assets/js/slick.min.js', __FILE__ ) );
            
            wp_enqueue_script( 'smr_admin_script', plugins_url( 'assets/js/smr-admin.js', __FILE__ ), array( 'jquery' ), '1.0', true );
            wp_enqueue_script( 'smr_admin_settings_script', plugins_url( 'assets/js/smr-admin-settings.js', __FILE__ ), array( 'jquery' ), '1.0', true );

        }

        wp_enqueue_style( 'smr_admin_style', plugins_url( 'assets/css/smr-admin.css', __FILE__ ) );
        
    }

    /**
     * Add ajax - admin
     *
     * @since 1.0.0
     * 
     */
    function ajax_admin(){
        require_once plugin_dir_path( __FILE__ ).'inc/ajax/sliders.php';
        require_once plugin_dir_path( __FILE__ ).'inc/ajax/teams.php';
        require_once plugin_dir_path( __FILE__ ).'inc/ajax/matches.php';
    }
    

    /**
     * Add page (menu) - admin
     *
     * @since 1.0.0
     * 
     */
    public function add_admin_pages(){
        add_menu_page( 'Slider Matches Results Plugin', 'SMR', 'manage_options', 'smr_plugin_sliders', array( $this, 'slider_index' ), "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAyMDAxMDkwNC8vRU4iICAgICAgICAgICAgICAiaHR0cDovL3d3dy53My5vcmcvVFIvMjAwMS9SRUMtU1ZHLTIwMDEwOTA0L0RURC9zdmcxMC5kdGQiPjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiAgICAgd2lkdGg9IjIuODQ0NDRpbiIgaGVpZ2h0PSIyLjg0NDQ0aW4iICAgICB2aWV3Qm94PSIwIDAgMjU2IDI1NiI+ICA8cGF0aCBpZD0iQ2hlbWluIGltcG9ydMOpIiAgICAgICAgZmlsbD0iI0ZGRkZGRiIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiICAgICAgICBkPSJNIDE4MS4zMywyMDcuNjcgICAgICAgICAgIEMgMTgxLjMzLDIwNy42NyAxODEuMzMsMjA3LjY3IDE4MS4zMywyMDcuNjcgICAgICAgICAgICAgMTgxLjMzLDIwNC43MiAxNzguOTQsMjAyLjMzIDE3Ni4wMCwyMDIuMzMgICAgICAgICAgICAgMTc2LjAwLDIwMi4zMyAxNzYuMDAsMjAyLjMzIDE3Ni4wMCwyMDIuMzMgICAgICAgICAgICAgMTczLjA2LDIwMi4zMyAxNzAuNjcsMjA0LjcyIDE3MC42NywyMDcuNjcgICAgICAgICAgICAgMTcwLjY3LDIwNy42NyAxNzAuNjcsMjA3LjY3IDE3MC42NywyMDcuNjcgICAgICAgICAgICAgMTcwLjY3LDIxMC42MSAxNzMuMDYsMjEzLjAwIDE3Ni4wMCwyMTMuMDAgICAgICAgICAgICAgMTc2LjAwLDIxMy4wMCAxNzYuMDAsMjEzLjAwIDE3Ni4wMCwyMTMuMDAgICAgICAgICAgICAgMTc4Ljk0LDIxMy4wMCAxODEuMzMsMjEwLjYxIDE4MS4zMywyMDcuNjcgWiAgICAgICAgICAgTSAxNDkuMzMsMjA3LjY3ICAgICAgICAgICBDIDE0OS4zMywyMDcuNjcgMTQ5LjMzLDIwNy42NyAxNDkuMzMsMjA3LjY3ICAgICAgICAgICAgIDE0OS4zMywyMDQuNzIgMTQ2Ljk0LDIwMi4zMyAxNDQuMDAsMjAyLjMzICAgICAgICAgICAgIDE0NC4wMCwyMDIuMzMgMTQ0LjAwLDIwMi4zMyAxNDQuMDAsMjAyLjMzICAgICAgICAgICAgIDE0MS4wNiwyMDIuMzMgMTM4LjY3LDIwNC43MiAxMzguNjcsMjA3LjY3ICAgICAgICAgICAgIDEzOC42NywyMDcuNjcgMTM4LjY3LDIwNy42NyAxMzguNjcsMjA3LjY3ICAgICAgICAgICAgIDEzOC42NywyMTAuNjEgMTQxLjA2LDIxMy4wMCAxNDQuMDAsMjEzLjAwICAgICAgICAgICAgIDE0NC4wMCwyMTMuMDAgMTQ0LjAwLDIxMy4wMCAxNDQuMDAsMjEzLjAwICAgICAgICAgICAgIDE0Ni45NCwyMTMuMDAgMTQ5LjMzLDIxMC42MSAxNDkuMzMsMjA3LjY3IFogICAgICAgICAgIE0gMTE3LjMzLDIwNy42NyAgICAgICAgICAgQyAxMTcuMzMsMjA3LjY3IDExNy4zMywyMDcuNjcgMTE3LjMzLDIwNy42NyAgICAgICAgICAgICAxMTcuMzMsMjA0LjcyIDExNC45NCwyMDIuMzMgMTEyLjAwLDIwMi4zMyAgICAgICAgICAgICAxMTIuMDAsMjAyLjMzIDExMi4wMCwyMDIuMzMgMTEyLjAwLDIwMi4zMyAgICAgICAgICAgICAxMDkuMDYsMjAyLjMzIDEwNi42NywyMDQuNzIgMTA2LjY3LDIwNy42NyAgICAgICAgICAgICAxMDYuNjcsMjA3LjY3IDEwNi42NywyMDcuNjcgMTA2LjY3LDIwNy42NyAgICAgICAgICAgICAxMDYuNjcsMjEwLjYxIDEwOS4wNiwyMTMuMDAgMTEyLjAwLDIxMy4wMCAgICAgICAgICAgICAxMTIuMDAsMjEzLjAwIDExMi4wMCwyMTMuMDAgMTEyLjAwLDIxMy4wMCAgICAgICAgICAgICAxMTQuOTQsMjEzLjAwIDExNy4zMywyMTAuNjEgMTE3LjMzLDIwNy42NyBaICAgICAgICAgICBNIDg1LjMzLDIwNy42NyAgICAgICAgICAgQyA4NS4zMywyMDcuNjcgODUuMzMsMjA3LjY3IDg1LjMzLDIwNy42NyAgICAgICAgICAgICA4NS4zMywyMDQuNzIgODIuOTQsMjAyLjMzIDgwLjAwLDIwMi4zMyAgICAgICAgICAgICA4MC4wMCwyMDIuMzMgODAuMDAsMjAyLjMzIDgwLjAwLDIwMi4zMyAgICAgICAgICAgICA3Ny4wNiwyMDIuMzMgNzQuNjcsMjA0LjcyIDc0LjY3LDIwNy42NyAgICAgICAgICAgICA3NC42NywyMDcuNjcgNzQuNjcsMjA3LjY3IDc0LjY3LDIwNy42NyAgICAgICAgICAgICA3NC42NywyMTAuNjEgNzcuMDYsMjEzLjAwIDgwLjAwLDIxMy4wMCAgICAgICAgICAgICA4MC4wMCwyMTMuMDAgODAuMDAsMjEzLjAwIDgwLjAwLDIxMy4wMCAgICAgICAgICAgICA4Mi45NCwyMTMuMDAgODUuMzMsMjEwLjYxIDg1LjMzLDIwNy42NyBaICAgICAgICAgICBNIDE4LjQ5LDE0NC4zNyAgICAgICAgICAgQyAxOC40OSwxNDQuMzcgMTMuMTUsMTQ0LjM3IDEzLjE1LDE0NC4zNyAgICAgICAgICAgICAxMS42OSwxNDQuMzcgMTAuNjksMTQzLjg2IDEwLjY3LDE0NC40MiAgICAgICAgICAgICAxMC42NywxNDQuNDIgMTAuNDAsOTMuMjUgMTAuNDAsOTMuMjUgICAgICAgICAgICAgMTAuNjIsOTMuMDAgMTEuNjIsOTIuNDcgMTMuMTUsOTIuNDcgICAgICAgICAgICAgMTMuMTUsOTIuNDcgMTguNDksOTIuNDcgMTguNDksOTIuNDcgICAgICAgICAgICAgMTguNDksOTIuNDcgMTguNDksODEuODAgMTguNDksODEuODAgICAgICAgICAgICAgMTguNDksODEuODAgMTMuMTUsODEuODAgMTMuMTUsODEuODAgICAgICAgICAgICAgNS43OCw4MS44MCAwLjAwLDg2LjQzIDAuMDAsOTIuMzUgICAgICAgICAgICAgMC4wMCw5Mi4zNSAwLjAwLDE0NC41MCAwLjAwLDE0NC41MCAgICAgICAgICAgICAwLjAwLDE1MC40MSA1Ljc4LDE1NS4wNCAxMy4xNSwxNTUuMDQgICAgICAgICAgICAgMTMuMTUsMTU1LjA0IDE4LjQ5LDE1NS4wNCAxOC40OSwxNTUuMDQgICAgICAgICAgICAgMTguNDksMTU1LjA0IDE4LjQ5LDE0NC4zNyAxOC40OSwxNDQuMzcgWiAgICAgICAgICAgTSA1MC40OSwxNzAuNjkgICAgICAgICAgIEMgNTAuNDksMTcwLjY5IDUwLjQ5LDE2MC4wMiA1MC40OSwxNjAuMDIgICAgICAgICAgICAgNTAuNDksMTYwLjAyIDQ1LjE1LDE2MC4wMiA0NS4xNSwxNjAuMDIgICAgICAgICAgICAgNDMuODEsMTYwLjAyIDQyLjY3LDE1OC44OSA0Mi42NywxNTcuNTMgICAgICAgICAgICAgNDIuNjcsMTU3LjUzIDQyLjY3LDc5LjMxIDQyLjY3LDc5LjMxICAgICAgICAgICAgIDQyLjY3LDc3Ljk2IDQzLjgxLDc2LjgyIDQ1LjE1LDc2LjgzICAgICAgICAgICAgIDQ1LjE1LDc2LjgzIDUwLjQ5LDc2LjgzIDUwLjQ5LDc2LjgzICAgICAgICAgICAgIDUwLjQ5LDc2LjgzIDUwLjQ5LDY2LjE2IDUwLjQ5LDY2LjE2ICAgICAgICAgICAgIDUwLjQ5LDY2LjE2IDQ1LjE1LDY2LjE2IDQ1LjE1LDY2LjE2ICAgICAgICAgICAgIDM3LjkwLDY2LjE2IDMyLjAwLDcyLjA2IDMyLjAwLDc5LjMxICAgICAgICAgICAgIDMyLjAwLDc5LjMxIDMyLjAwLDE1Ny41MyAzMi4wMCwxNTcuNTMgICAgICAgICAgICAgMzIuMDAsMTY0Ljc4IDM3LjkwLDE3MC42OSA0NS4xNSwxNzAuNjkgICAgICAgICAgICAgNDUuMTUsMTcwLjY5IDUwLjQ5LDE3MC42OSA1MC40OSwxNzAuNjkgICAgICAgICAgICAgNTAuNDksMTcwLjY5IDUwLjQ5LDE3MC42OSA1MC40OSwxNzAuNjkgWiAgICAgICAgICAgTSAyNTYuMDAsMTQ0LjUwICAgICAgICAgICBDIDI1Ni4wMCwxNDQuNTAgMjU2LjAwLDkyLjM1IDI1Ni4wMCw5Mi4zNSAgICAgICAgICAgICAyNTYuMDAsODYuNDMgMjUwLjIyLDgxLjgwIDI0Mi44NSw4MS44MCAgICAgICAgICAgICAyNDIuODUsODEuODAgMjM3LjUxLDgxLjgwIDIzNy41MSw4MS44MCAgICAgICAgICAgICAyMzcuNTEsODEuODAgMjM3LjUxLDkyLjQ3IDIzNy41MSw5Mi40NyAgICAgICAgICAgICAyMzcuNTEsOTIuNDcgMjQyLjg1LDkyLjQ3IDI0Mi44NSw5Mi40NyAgICAgICAgICAgICAyNDQuMzMsOTIuNDcgMjQ1LjMxLDkyLjk4IDI0NS4zMyw5Mi40MSAgICAgICAgICAgICAyNDUuMzMsOTIuNDEgMjQ1LjYwLDE0My41OSAyNDUuNjAsMTQzLjU5ICAgICAgICAgICAgIDI0NS4zOCwxNDMuODQgMjQ0LjM5LDE0NC4zNyAyNDIuODUsMTQ0LjM3ICAgICAgICAgICAgIDI0Mi44NSwxNDQuMzcgMjM3LjUxLDE0NC4zNyAyMzcuNTEsMTQ0LjM3ICAgICAgICAgICAgIDIzNy41MSwxNDQuMzcgMjM3LjUxLDE1NS4wNCAyMzcuNTEsMTU1LjA0ICAgICAgICAgICAgIDIzNy41MSwxNTUuMDQgMjQyLjg1LDE1NS4wNCAyNDIuODUsMTU1LjA0ICAgICAgICAgICAgIDI1MC4yMiwxNTUuMDQgMjU2LjAwLDE1MC40MSAyNTYuMDAsMTQ0LjUwIFogICAgICAgICAgIE0gMjI0LjAwLDE1Ny41MyAgICAgICAgICAgQyAyMjQuMDAsMTU3LjUzIDIyNC4wMCw3OS4zMSAyMjQuMDAsNzkuMzEgICAgICAgICAgICAgMjI0LjAwLDcyLjA2IDIxOC4xMCw2Ni4xNiAyMTAuODUsNjYuMTYgICAgICAgICAgICAgMjEwLjg1LDY2LjE2IDIwNS41MSw2Ni4xNiAyMDUuNTEsNjYuMTYgICAgICAgICAgICAgMjA1LjUxLDY2LjE2IDIwNS41MSw3Ni44MyAyMDUuNTEsNzYuODMgICAgICAgICAgICAgMjA1LjUxLDc2LjgzIDIxMC44NSw3Ni44MyAyMTAuODUsNzYuODMgICAgICAgICAgICAgMjEyLjIwLDc2LjgzIDIxMy4zMyw3Ny45NyAyMTMuMzMsNzkuMzEgICAgICAgICAgICAgMjEzLjMzLDc5LjMxIDIxMy4zMywxNTcuNTMgMjEzLjMzLDE1Ny41MyAgICAgICAgICAgICAyMTMuMzMsMTU4Ljg5IDIxMi4yMCwxNjAuMDIgMjEwLjg1LDE2MC4wMiAgICAgICAgICAgICAyMTAuODUsMTYwLjAyIDIwNS41MSwxNjAuMDIgMjA1LjUxLDE2MC4wMiAgICAgICAgICAgICAyMDUuNTEsMTYwLjAyIDIwNS41MSwxNzAuNjkgMjA1LjUxLDE3MC42OSAgICAgICAgICAgICAyMDUuNTEsMTcwLjY5IDIxMC44NSwxNzAuNjkgMjEwLjg1LDE3MC42OSAgICAgICAgICAgICAyMTguMDksMTcwLjY5IDIyNC4wMCwxNjQuNzggMjI0LjAwLDE1Ny41MyBaICAgICAgICAgICBNIDE5Mi4wMCwxNTkuNjUgICAgICAgICAgIEMgMTkyLjAwLDE1OS42NSAxOTIuMDAsNzQuMzUgMTkyLjAwLDc0LjM1ICAgICAgICAgICAgIDE5Mi4wMCw2Mi41OCAxODIuNDIsNTMuMDAgMTcwLjY1LDUzLjAwICAgICAgICAgICAgIDE3MC42NSw1My4wMCA4NS4zNSw1My4wMCA4NS4zNSw1My4wMCAgICAgICAgICAgICA3My41OCw1My4wMCA2NC4wMCw2Mi41OCA2NC4wMCw3NC4zNSAgICAgICAgICAgICA2NC4wMCw3NC4zNSA2NC4wMCwxNTkuNjUgNjQuMDAsMTU5LjY1ICAgICAgICAgICAgIDY0LjAwLDE3MS40MiA3My41OCwxODEuMDAgODUuMzUsMTgxLjAwICAgICAgICAgICAgIDg1LjM1LDE4MS4wMCAxNzAuNjUsMTgxLjAwIDE3MC42NSwxODEuMDAgICAgICAgICAgICAgMTgyLjQyLDE4MS4wMCAxOTIuMDAsMTcxLjQyIDE5Mi4wMCwxNTkuNjUgWiAgICAgICAgICAgTSAxNzAuNjUsNjMuNjcgICAgICAgICAgIEMgMTc2LjU0LDYzLjY3IDE4MS4zMyw2OC40NyAxODEuMzMsNzQuMzUgICAgICAgICAgICAgMTgxLjMzLDc0LjM1IDE4MS4zMywxNTkuNjUgMTgxLjMzLDE1OS42NSAgICAgICAgICAgICAxODEuMzMsMTY1LjU0IDE3Ni41NCwxNzAuMzMgMTcwLjY1LDE3MC4zMyAgICAgICAgICAgICAxNzAuNjUsMTcwLjMzIDg1LjM1LDE3MC4zMyA4NS4zNSwxNzAuMzMgICAgICAgICAgICAgNzkuNDcsMTcwLjMzIDc0LjY3LDE2NS41NCA3NC42NywxNTkuNjUgICAgICAgICAgICAgNzQuNjcsMTU5LjY1IDc0LjY3LDc0LjM1IDc0LjY3LDc0LjM1ICAgICAgICAgICAgIDc0LjY3LDY4LjQ3IDc5LjQ3LDYzLjY3IDg1LjM1LDYzLjY3ICAgICAgICAgICAgIDg1LjM1LDYzLjY3IDE3MC42NSw2My42NyAxNzAuNjUsNjMuNjcgWiIgLz48L3N2Zz4=", 110 );
        add_submenu_page( 'smr_plugin_sliders', 'Sliders', __( 'Sliders', 'slider-matches-results' ), 'manage_options', 'smr_plugin_sliders', array( $this, 'slider_index' ) );
        add_submenu_page( 'smr_plugin_sliders', 'Create slider', 'Create slider', 'manage_options', 'smr_plugin_create_slider', array( $this,'create_slider_index' ) );
        add_submenu_page( 'smr_plugin_sliders', 'Update slider', 'Update slider', 'manage_options', 'smr_plugin_update_slider', array( $this,'update_slider_index' ) );
        add_submenu_page( 'smr_plugin_sliders', 'Teams', __( 'Teams', 'slider-matches-results' ), 'manage_options', 'smr_plugin_teams', array( $this,'teams_index' ) );
        add_submenu_page( 'smr_plugin_sliders', 'Matches', __( 'Matches', 'slider-matches-results' ), 'manage_options', 'smr_plugin_matches', array( $this,'matches_index' ) );
        add_submenu_page( 'smr_plugin_sliders', 'Settings', __( 'Settings', 'slider-matches-results' ), 'manage_options', 'smr_plugin_settings', array( $this,'settings_index' ) );   
    
        add_action( 'admin_head', function() {
            remove_submenu_page( 'smr_plugin_sliders', 'smr_plugin_create_slider' );
            remove_submenu_page( 'smr_plugin_sliders', 'smr_plugin_update_slider' );
        } );
    }

    /**
     * Redirection - admin
     *
     * @since 1.0.0
     * 
     */
    function redirect() {          
        if ( is_admin() ){
            
            if( isset( $_GET["page"] ) ){
                $page_admin = $_GET["page"];
            }else{
                $page_admin = null;
            } 

            if( $page_admin == 'smr_plugin_create_slider' && isset( $_POST['smr-form-create-slider'] ) ) { 
                
                if( $this->create_option( $_POST ) ){
                    $this->set_state_active( 'create_success' );
                    wp_redirect( admin_url( 'admin.php?page=smr_plugin_update_slider&id='.$_POST['smr-create-slider-id'] ) );
                    exit;
                }else{
                    $this->set_state_active( 'create_error' );
                    wp_redirect( admin_url( 'admin.php?page=smr_plugin_create_sliders' ) );
                    exit;
                }
            }elseif( $page_admin == 'smr_plugin_update_slider' && isset( $_GET['id'] ) && !$this->get_slider( $_GET['id'] ) ){
                wp_redirect( admin_url( 'admin.php?page=smr_plugin_slider' ) );
                exit;
            }

        }

    } 

    /**
     * Get option of this plugin
     *
     * @since 1.0.0
     * 
     * @return (get_option())  
     * 
     */
    public function get_option(){
        
        // Recover the option
        $value_option = get_option( $this->get_option_name() );

        // if it does not exist 
        if( !$value_option ){

            $value_option = $this->get_option_value_default();

            add_option( $this->get_option_name(), $value_option );
        }

        return $value_option;

    }

    /**
     * Get option of the matches
     *
     * @since 1.0.0
     * 
     * @return (string)  
     * 
     */
    public function get_option_settings_matches(){
        $settings_json         = json_decode( $this->get_option() );

        $settings_matches_json = $settings_json->settings->matches;

        return $settings_matches_json;
    }

    /**
     * Get option of the teams
     *
     * @since 1.0.0
     * 
     * @return (string)  
     * 
     */
    public function get_option_settings_teams(){
        $settings_json       = json_decode( $this->get_option() );

        $settings_teams_json = $settings_json->settings->teams;

        return $settings_teams_json;
    }

    /**
     * Get option of the slider
     *
     * @since 1.0.0
     * 
     * @return (string)  
     * 
     */
    public function get_option_settings_slider(){
        $settings_json        = json_decode( $this->get_option() );

        $settings_slider_json = $settings_json->settings->slider;

        return $settings_slider_json;
    }

    /**
     * Get the default option
     *
     * @since 1.0.0
     * 
     * @return (string)  
     * 
     */
    public function get_option_value_default(){

        $json_option = '
        {
            "settings": {
                "slider": {
                    "header":{
                        "date_text_color" : "rgba(255, 255, 255, 1)",
                        "date_background_color" : "rgba(213, 107, 19, 1)",
                        "title_text_color" : "rgba(255, 255, 255, 1)",
                        "title_background_color" : "rgba(172, 210, 221, 0.2)"
                    },
                    "content":{
                        "text_color" : "rgba(0, 0, 0, 1)",
                        "background_color" : "rgba(0, 0, 0, 0)",
                        "max_width_logo" : "50%"
                    },
                    "footer":{
                        "display_footer": true,
                        "text_color" : "rgba(255, 255, 255, 1)",
                        "background_color" : "rgb(213, 107, 19)"
                    },
                    "slide":{
                        "infinite": true,
                        "dots" : false,
                        "dots_color" : "rgba(0, 0, 0, 1)",
                        "autoplay" : false,
                        "autoplay_speed" : 2000,
                        "arrows" : true,
                        "arrows_color" : "rgba(0, 0, 0, 1)",
                        "arrows_in" : false,
                        "fade" : false,
                        "transition_type" : "ease",
                        "transition_speed" : 300,
                        "swipe":true
                    }
                }, 
                "ranking": {
                    "display_ranking" : false,
                    "background_color" : "rgba(255,255,255,0)",
                    "text_color" : "rgba(0,0,0,1)",
                    "team_id" : 0,
                    "background_color_team" : "rgba(213,107,19,1)",
                    "text_color_team" : "rgba(255,255,255,1)",
                    "display_border" : true,
                    "border_width" : "1px 0px 1px 0px",
                    "border_style" : "solid",
                    "border_color" : "rgba(255,255,255,1)",
                    "nb_teams" : 1,
                    "nb_teams_above" : 2,
                    "nb_teams_below" : 1
                },
                "teams": {
                    "order_by": 0 ,
                    "nb_elements": 10 ,
                    "display_logo": false
                },
                "matches": {
                    "order_by": 0 ,
                    "nb_elements": 10
                }
                 
            }
        }';

        
        return json_encode( json_decode( $json_option ) );

    }

    /**
     * Update option (WP option)
     *
     * @since 1.0.0
     * 
     */
    public function update_option( $post ){

        // If we update settings
        if( isset( $post['smr-form-update-settings'] ) ){
            
            $page = null;

            // If we update slider settings
            if( isset( $post['smr-form-update-settings-slider-page'] ) ){

                $page    = htmlspecialchars( $post['smr-form-update-settings-slider-page'] );
                $subpage = htmlspecialchars( $_POST['smr-form-update-settings-slider-subpage'] );

                // If we update slider header settings
                if( $subpage == 'header' ){
                    $date_text_color        = htmlspecialchars( $post['smr-setting-slider-header-date-text-color'] );
                    $date_background_color  = htmlspecialchars( $post['smr-setting-slider-header-date-background-color'] );
                    $title_text_color       = htmlspecialchars( $post['smr-setting-slider-header-title-text-color'] );
                    $title_background_color = htmlspecialchars( $post['smr-setting-slider-header-title-background-color'] );

                    $settings_json          = json_decode( $this->get_option() );

                    $settings_json->settings->slider->header->date_text_color         = $date_text_color;
                    $settings_json->settings->slider->header->date_background_color   = $date_background_color;
                    $settings_json->settings->slider->header->title_text_color        = $title_text_color;
                    $settings_json->settings->slider->header->title_background_color  = $title_background_color;

                    $settings = json_encode( $settings_json );

                // If we update slider content settings
                }elseif( $subpage == 'content' ){

                    $text_color       = htmlspecialchars( $post['smr-setting-slider-content-text-color'] );
                    $background_color = htmlspecialchars( $post['smr-setting-slider-content-background-color'] );
                    $max_width_logo   = htmlspecialchars( $post['smr-setting-slider-content-max-width-logo'] );

                    $settings_json    = json_decode( $this->get_option() );

                    $settings_json->settings->slider->content->text_color         = $text_color;
                    $settings_json->settings->slider->content->background_color   = $background_color;
                    $settings_json->settings->slider->content->max_width_logo     = $max_width_logo;

                    $settings = json_encode($settings_json);

                // If we update slider footer settings
                }elseif( $subpage == 'footer' ){
                    
                    $display_footer   = htmlspecialchars( $post['smr-setting-slider-footer-display-footer'] );
                    $text_color       = htmlspecialchars( $post['smr-setting-slider-footer-text-color'] );
                    $background_color = htmlspecialchars( $post['smr-setting-slider-footer-background-color'] );

                    $settings_json = json_decode( $this->get_option() );

                    if( !empty( $display_footer ) ){
                        $settings_json->settings->slider->footer->display_footer     = true;
                        $settings_json->settings->slider->footer->text_color         = $text_color;
                        $settings_json->settings->slider->footer->background_color   = $background_color;
                    }else{
                        $settings_json->settings->slider->footer->display_footer = false;
                    }

                    $settings = json_encode( $settings_json );

                // If we update slider slide settings
                }elseif( $subpage == 'slide' ){
                    $settings_json = json_decode( $this->get_option() );

                    $infinite           = htmlspecialchars( $post['smr-setting-slider-slide-infinite'] );
                    $dots               = htmlspecialchars( $post['smr-setting-slider-slide-dots'] );
                    $dots_color         = htmlspecialchars( $post['smr-setting-slider-slide-dots-color'] );
                    $autoplay           = htmlspecialchars( $post['smr-setting-slider-slide-autoplay'] );
                    $autoplay_speed     = intval( htmlspecialchars($post['smr-setting-slider-slide-autoplay-speed'] ) );
                    $arrows             = htmlspecialchars( $post['smr-setting-slider-slide-arrows'] );
                    $arrows_color       = htmlspecialchars( $post['smr-setting-slider-slide-arrows-color'] );
                    $arrows_in          = htmlspecialchars( $post['smr-setting-slider-slide-arrows-in'] );
                    $fade               = htmlspecialchars( $post['smr-setting-slider-slide-fade'] );
                    $transition_type    = htmlspecialchars( $post['smr-setting-slider-slide-transition-type'] );
                    $transition_speed   = intval( htmlspecialchars( $post['smr-setting-slider-slide-transition-speed'] ) );
                    $swipe              = htmlspecialchars( $post['smr-setting-slider-slide-swipe'] );


                    if( !empty( $infinite ) ){
                        $settings_json->settings->slider->slide->infinite = true;
                    }else{
                        $settings_json->settings->slider->slide->infinite = false;
                    }

                    if( !empty( $dots ) ){
                        $settings_json->settings->slider->slide->dots       = true;
                        $settings_json->settings->slider->slide->dots_color = $dots_color;
                    }else{
                        $settings_json->settings->slider->slide->dots = false;
                    }

                    if( !empty( $autoplay ) ){
                        $settings_json->settings->slider->slide->autoplay = true;
                    }else{
                        $settings_json->settings->slider->slide->autoplay = false;
                    }

                    if( !empty( $autoplay_speed ) ){
                        $settings_json->settings->slider->slide->autoplay_speed = $autoplay_speed;
                    }

                    if( !empty( $arrows ) ){
                        $settings_json->settings->slider->slide->arrows       = true;
                        $settings_json->settings->slider->slide->arrows_color = $arrows_color;

                        if( !empty( $arrows_in ) ){
                            $settings_json->settings->slider->slide->arrows_in = true;
                        }else{
                            $settings_json->settings->slider->slide->arrows_in = false;
                        }

                    }else{
                        $settings_json->settings->slider->slide->arrows = false;
                    }

                    if( !empty( $fade ) ){
                        $settings_json->settings->slider->slide->fade = true;
                    }else{
                        $settings_json->settings->slider->slide->fade = false;
                    }

                    $settings_json->settings->slider->slide->transition_type  = $transition_type;

                    $settings_json->settings->slider->slide->transition_speed = $transition_speed;

                    if( !empty( $swipe ) ){
                        $settings_json->settings->slider->slide->swipe = true;
                    }else{
                        $settings_json->settings->slider->slide->swipe = false;
                    }

                    $settings = json_encode( $settings_json );

                }
                
            // If we update ranking settings    
            }elseif( isset( $post['smr-form-update-settings-ranking-page'] ) ){

                $settings_json = json_decode( $this->get_option() );

                $page                   = htmlspecialchars( $post['smr-form-update-settings-ranking-page'] );

                $display_ranking        = htmlspecialchars( $post['smr-setting-ranking-display-ranking'] );
                $background_color       = htmlspecialchars( $post['smr-setting-ranking-background-color'] );
                $text_color             = htmlspecialchars( $post['smr-setting-ranking-text-color'] );
                $team_id                = intval( htmlspecialchars( $post['smr-setting-ranking-team'] ) );
                $background_color_team  = htmlspecialchars( $post['smr-setting-ranking-background-color-team'] );
                $text_color_team        = htmlspecialchars( $post['smr-setting-ranking-text-color-team'] );
                $display_border         = htmlspecialchars( $post['smr-setting-ranking-display-border'] );
                $border_width           = htmlspecialchars( $post['smr-setting-ranking-border-width'] );
                $border_style           = htmlspecialchars( $post['smr-setting-ranking-border-style'] );
                $border_color           = htmlspecialchars( $post['smr-setting-ranking-border-color'] );
                $nb_teams               = intval( htmlspecialchars( $post['smr-setting-ranking-nb-teams'] ) );
                $nb_teams_above         = intval( htmlspecialchars( $post['smr-setting-ranking-nb-teams-above'] ) );
                $nb_teams_below         = intval( htmlspecialchars( $post['smr-setting-ranking-nb-teams-below'] ) );

                if( !empty( $display_ranking ) ){
                    
                    $settings_json->settings->ranking->display_ranking  = true;
                    $settings_json->settings->ranking->background_color = $background_color;
                    $settings_json->settings->ranking->text_color       = $text_color;
                    $settings_json->settings->ranking->team_id          = $team_id;

                    if( $team_id != 0 ){
                        $settings_json->settings->ranking->background_color_team = $background_color_team;
                        $settings_json->settings->ranking->text_color_team       = $text_color_team;
                    }

                    if( !empty( $display_border ) ){
                        $settings_json->settings->ranking->display_border = true;
                        $settings_json->settings->ranking->border_width   = $border_width;
                        $settings_json->settings->ranking->border_style   = $border_style;
                        $settings_json->settings->ranking->border_color   = $border_color;
                    }else{
                        $settings_json->settings->ranking->display_border  = false;
                    }
                    
                    $settings_json->settings->ranking->team_id = $team_id;

                    if( $team_id == 0 ){
                        $settings_json->settings->ranking->nb_teams       = $nb_teams;
                    }else{
                        $settings_json->settings->ranking->nb_teams_above = $nb_teams_above;
                        $settings_json->settings->ranking->nb_teams_below = $nb_teams_below;
                    }
                    
                }else{
                    $settings_json->settings->ranking->display_ranking = false;
                }

                $settings = json_encode( $settings_json );
                
            }elseif( isset( $post['smr-form-update-settings-teams-page'] ) ){
                $page           = htmlspecialchars( $post['smr-form-update-settings-teams-page'] );
                $order_by       = intval( htmlspecialchars( $post['smr-setting-teams-order-by']) );
                $nb_elements    = intval( htmlspecialchars( $post['smr-setting-teams-nb-elements']) );
                $display_logo   = htmlspecialchars( $post['smr-setting-teams-display-logo'] );

                $settings_json = json_decode( $this->get_option() );

                $settings_json->settings->teams->order_by    = $order_by;
                $settings_json->settings->teams->nb_elements = $nb_elements;

                if( !empty( $display_logo ) ){
                    $settings_json->settings->teams->display_logo = true;
                }else{
                    $settings_json->settings->teams->display_logo = false;
                }

                $settings = json_encode( $settings_json );
            }elseif( isset( $post['smr-form-update-settings-matches-page'] ) ){
                $page           = htmlspecialchars( $post['smr-form-update-settings-matches-page'] );
                $order_by       = intval( htmlspecialchars( $post['smr-setting-matches-order-by']) );
                $nb_elements    = intval( htmlspecialchars( $post['smr-setting-matches-nb-elements']) );

                $settings_json = json_decode( $this->get_option() );

                $settings_json->settings->matches->order_by    = $order_by;
                $settings_json->settings->matches->nb_elements = $nb_elements;

                $settings = json_encode( $settings_json );
            }

            if( isset( $settings ) ){
                update_option( $this->get_option_name(), $settings );
            }
            $this->set_state_active( 'update_success' );

            return $page;

        // If we update slider specific
        }elseif( isset( $post['smr-form-update-slider'] ) ){

            $id                             = intval( htmlspecialchars( $post['smr-update-slider-id'] ) );
            
            $slider_json = json_decode( $this->get_slider( $id ) );

            $name                           = htmlspecialchars( $post['smr-update-slider-name'] );
            $header_date_text_color         = htmlspecialchars( $post['smr-update-slider-header-date-text-color'] );
            $header_date_background_color   = htmlspecialchars( $post['smr-update-slider-header-date-background-color'] );
            $header_title_text_color        = htmlspecialchars( $post['smr-update-slider-header-title-text-color'] );
            $header_title_background_color  = htmlspecialchars( $post['smr-update-slider-header-title-background-color'] );
            $content_text_color             = htmlspecialchars( $post['smr-update-slider-content-text-color'] );
            $content_background_color       = htmlspecialchars( $post['smr-update-slider-content-background-color'] );
            $content_max_width_logo         = htmlspecialchars( $post['smr-update-slider-content-max-width-logo'] );
            $footer_display_footer          = htmlspecialchars( $post['smr-update-slider-footer-display-footer'] );
            $footer_text_color              = htmlspecialchars( $post['smr-update-slider-footer-text-color'] );
            $footer_background_color        = htmlspecialchars( $post['smr-update-slider-footer-background-color'] );
            $infinite                       = htmlspecialchars( $post['smr-update-slider-slide-infinite'] );
            $dots                           = htmlspecialchars( $post['smr-update-slider-slide-dots'] );
            $dots_color                     = htmlspecialchars( $post['smr-update-slider-slide-dots-color'] );
            $autoplay                       = htmlspecialchars( $post['smr-update-slider-slide-autoplay'] );
            $autoplay_speed                 = intval( htmlspecialchars( $post['smr-update-slider-slide-autoplay-speed'] ) );
            $arrows                         = htmlspecialchars( $post['smr-update-slider-slide-arrows'] );
            $arrows_color                   = htmlspecialchars( $post['smr-update-slider-slide-arrows-color'] );
            $arrows_in                      = htmlspecialchars( $post['smr-update-slider-slide-arrows-in'] );
            $fade                           = htmlspecialchars( $post['smr-update-slider-slide-fade'] );
            $transition_type                = htmlspecialchars( $post['smr-update-slider-slide-transition-type'] );
            $transition_speed               = intval( htmlspecialchars( $post['smr-update-slider-slide-transition-speed'] ) );
            $swipe                          = htmlspecialchars( $post['smr-update-slider-slide-swipe'] );

            $slider_json->name = $name;

            $slider_json->settings->slider->header->date_text_color         = $header_date_text_color;
            $slider_json->settings->slider->header->date_background_color   = $header_date_background_color;
            $slider_json->settings->slider->header->title_text_color        = $header_title_text_color;
            $slider_json->settings->slider->header->title_background_color  = $header_title_background_color;
            $slider_json->settings->slider->content->text_color             = $content_text_color;
            $slider_json->settings->slider->content->background_color       = $content_background_color;
            $slider_json->settings->slider->content->max_width_logo         = $content_max_width_logo;

            if( !empty( $footer_display_footer ) ){
                $slider_json->settings->slider->footer->display_footer     = true;
                $slider_json->settings->slider->footer->text_color         = $footer_text_color;
                $slider_json->settings->slider->footer->background_color   = $footer_background_color;
            }else{
                $slider_json->settings->slider->footer->display_footer     = false;
            }

            if( !empty( $infinite ) ){
                $slider_json->settings->slider->slide->infinite = true;
            }else{
                $slider_json->settings->slider->slide->infinite = false;
            }

            if( !empty( $dots ) ){
                $slider_json->settings->slider->slide->dots       = true;
                $slider_json->settings->slider->slide->dots_color = $dots_color;
            }else{
                $slider_json->settings->slider->slide->dots = false;
            }

            if( !empty( $autoplay ) ){
                $slider_json->settings->slider->slide->autoplay = true;
            }else{
                $slider_json->settings->slider->slide->autoplay = false;
            }

            if( !empty( $autoplay_speed ) ){
                $slider_json->settings->slider->slide->autoplay_speed = $autoplay_speed;
            }

            if( !empty( $arrows ) ){
                $slider_json->settings->slider->slide->arrows       = true;
                $slider_json->settings->slider->slide->arrows_color = $arrows_color;

                if( !empty( $arrows_in ) ){
                    $slider_json->settings->slider->slide->arrows_in = true;
                }else{
                    $slider_json->settings->slider->slide->arrows_in = false;
                }

            }else{
                $slider_json->settings->slider->slide->arrows = false;
            }

            if( !empty( $fade ) ){
                $slider_json->settings->slider->slide->fade = true;
            }else{
                $slider_json->settings->slider->slide->fade = false;
            }

            $slider_json->settings->slider->slide->transition_type  = $transition_type;

            $slider_json->settings->slider->slide->transition_speed = $transition_speed;

            if( !empty( $swipe ) ){
                $slider_json->settings->slider->slide->swipe = true;
            }else{
                $slider_json->settings->slider->slide->swipe = false;
            }

            $this->set_slider( $id, json_encode( $slider_json ) );
            $this->set_state_active( 'update_success' );
        }
    }

    /**
     * Create option (WP option)
     *
     * @since 1.0.0
     * 
     */
    public function create_option( $post ){
        // If we create slider
        if( isset( $post['smr-form-create-slider'] ) ){

            $settings_json = json_decode( $this->get_option() );

            $id                             = intval( htmlspecialchars( $post['smr-create-slider-id'] ) );
            $name                           = htmlspecialchars( $post['smr-create-slider-name'] );
            $header_date_text_color         = htmlspecialchars( $post['smr-create-slider-header-date-text-color'] );
            $header_date_background_color   = htmlspecialchars( $post['smr-create-slider-header-date-background-color'] );
            $header_title_text_color        = htmlspecialchars( $post['smr-create-slider-header-title-text-color'] );
            $header_title_background_color  = htmlspecialchars( $post['smr-create-slider-header-title-background-color'] );
            $content_text_color             = htmlspecialchars( $post['smr-create-slider-content-text-color'] );
            $content_background_color       = htmlspecialchars( $post['smr-create-slider-content-background-color'] );
            $content_max_width_logo         = htmlspecialchars( $post['smr-create-slider-content-max-width-logo'] );
            $footer_display_footer          = htmlspecialchars( $post['smr-create-slider-footer-display-footer'] );
            $footer_text_color              = htmlspecialchars( $post['smr-create-slider-footer-text-color'] );
            $footer_background_color        = htmlspecialchars( $post['smr-create-slider-footer-background-color'] );
            $infinite                       = htmlspecialchars( $post['smr-create-slider-slide-infinite'] );
            $dots                           = htmlspecialchars( $post['smr-create-slider-slide-dots'] );
            $autoplay                       = htmlspecialchars( $post['smr-create-slider-slide-autoplay'] );
            $autoplay_speed                 = intval( htmlspecialchars($post['smr-create-slider-slide-autoplay-speed'] ) );
            $arrows                         = htmlspecialchars( $post['smr-create-slider-slide-arrows'] );
            $arrows_in                      = htmlspecialchars( $post['smr-create-slider-slide-arrows-in'] );
            $fade                           = htmlspecialchars( $post['smr-create-slider-slide-fade'] );
            $transition_type                = htmlspecialchars( $post['smr-create-slider-slide-transition-type'] );
            $transition_speed               = intval( htmlspecialchars( $post['smr-create-slider-slide-transition-speed'] ) );
            $swipe                          = htmlspecialchars( $post['smr-create-slider-slide-swipe'] );


            $settings_json->settings->slider->header->date_text_color         = $header_date_text_color;
            $settings_json->settings->slider->header->date_background_color   = $header_date_background_color;
            $settings_json->settings->slider->header->title_text_color        = $header_title_text_color;
            $settings_json->settings->slider->header->title_background_color  = $header_title_background_color;
            $settings_json->settings->slider->content->text_color             = $content_text_color;
            $settings_json->settings->slider->content->background_color       = $content_background_color;
            $settings_json->settings->slider->content->max_width_logo         = $content_max_width_logo;

            if( !empty( $footer_display_footer ) ){
                $settings_json->settings->slider->footer->display_footer     = true;
                $settings_json->settings->slider->footer->text_color         = $footer_text_color;
                $settings_json->settings->slider->footer->background_color   = $footer_background_color;
            }else{
                $settings_json->settings->slider->footer->display_footer = false;
            }

            if( !empty( $infinite ) ){
                $settings_json->settings->slider->slide->infinite = true;
            }else{
                $settings_json->settings->slider->slide->infinite = false;
            }

            if( !empty( $dots ) ){
                $settings_json->settings->slider->slide->dots = true;
            }else{
                $settings_json->settings->slider->slide->dots = false;
            }

            if( !empty( $autoplay ) ){
                $settings_json->settings->slider->slide->autoplay = true;
            }else{
                $settings_json->settings->slider->slide->autoplay = false;
            }

            if( !empty( $autoplay_speed ) ){
                $settings_json->settings->slider->slide->autoplay_speed = $autoplay_speed;
            }

            if( !empty( $arrows ) ){
                $settings_json->settings->slider->slide->arrows = true;
            }else{
                $settings_json->settings->slider->slide->arrows = false;
            }

            if( !empty( $arrows_in ) ){
                $settings_json->settings->slider->slide->arrows_in = true;
            }else{
                $settings_json->settings->slider->slide->arrows_in = false;
            }

            if( !empty( $fade ) ){
                $settings_json->settings->slider->slide->fade = true;
            }else{
                $settings_json->settings->slider->slide->fade = false;
            }

            $settings_json->settings->slider->slide->transition_type  = $transition_type;

            $settings_json->settings->slider->slide->transition_speed = $transition_speed;

            if( !empty( $swipe ) ){
                $settings_json->settings->slider->slide->swipe = true;
            }else{
                $settings_json->settings->slider->slide->swipe = false;
            }


            $slider = '{"id":'.$id.',"name":"'.$name.'",';
                
            $slider .= substr( json_encode( $settings_json ), 1 );

            return add_option( $this->get_option_name_slider().$id, $slider );
        }
        return false;
    }

    /**
     * Shortcode for generate the slider 
     *
     * @since 1.0.0
     * 
     * @return (string)  
     * 
     */    
    public function generate_smr_slider( $atts ){

        // Val par défaut
        $atts = shortcode_atts( array(
            'id' 		=> null
        ), $atts );

        extract( $atts );

        $slider_json = $this->get_slider( $id );
        if( !is_admin() && $slider_json ){

            require_once plugin_dir_path( __FILE__ ).'inc/class/slider.php';
            require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_header.php';
            require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_content.php';
            require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_footer.php';
            require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_slide.php';
            require_once plugin_dir_path( __FILE__ ).'inc/additional/smr_css.php';

            $language = $this->get_language();

            // We add the different script & style
            wp_enqueue_style( 'smr_slick_style', plugins_url( 'assets/css/slick.css', __FILE__ ) );
            wp_enqueue_style( 'smr_slick2_style', plugins_url( 'assets/css/slick-theme.css', __FILE__ ) );
            wp_enqueue_script( 'slick_script', plugins_url( 'assets/js/slick.min.js', __FILE__ ) );
                    
            $slider_json   = json_decode( $slider_json );

            $slider        = new Slider( $slider_json->id, $slider_json->name );

            $settings_json = $slider_json->settings;

            $settings_slider_header_json  = $settings_json->slider->header;

            $settings_slider_header       = new Settings_Slider_Header( $settings_slider_header_json->date_text_color, $settings_slider_header_json->date_background_color, $settings_slider_header_json->title_text_color, $settings_slider_header_json->title_background_color );

            $settings_slider_content_json = $settings_json->slider->content;

            $settings_slider_content      = new Settings_Slider_Content( $settings_slider_content_json->text_color, $settings_slider_content_json->background_color, $settings_slider_content_json->max_width_logo );

            $settings_slider_footer_json  = $settings_json->slider->footer;

            $settings_slider_footer       = new Settings_Slider_Footer( $settings_slider_footer_json->display_footer, $settings_slider_footer_json->text_color, $settings_slider_footer_json->background_color );

            $settings_slide_json          = $settings_json->slider->slide;

            $settings_slide               = new Settings_Slider_Slide( $settings_slide_json->infinite, $settings_slide_json->dots, $settings_slide_json->dots_color, $settings_slide_json->autoplay, $settings_slide_json->autoplay_speed, $settings_slide_json->arrows, $settings_slide_json->arrows_color,$settings_slide_json->arrows_in, $settings_slide_json->fade, $settings_slide_json->transition_type, $settings_slide_json->transition_speed, $settings_slide_json->swipe );

            $slider_html_class = 'smr_slider_'.$slider->get_id();

            // We add the specific script for the sliders
            wp_enqueue_script( 'smr_script', plugins_url( 'assets/js/smr.js', __FILE__ ) );
            $sliders = $this->get_sliders();
            wp_localize_script( 'smr_script', 'smr_sliders', $this->get_sliders_script( $sliders ) );

            // We generate & create style for this specific slider
            wp_enqueue_style( 'smr_style', plugins_url( 'assets/css/smr.css', __FILE__ ) );
            wp_add_inline_style( 'smr_style', smr_slider_create_css( $slider_html_class, $settings_slider_header, $settings_slider_content, $settings_slider_footer, $settings_slide ) );

            require_once plugin_dir_path( __FILE__ ).'inc/class/team.php';
            require_once plugin_dir_path( __FILE__ ).'inc/class/match.php';
            require_once plugin_dir_path( __FILE__ ).'inc/additional/matches.php';

            // Teams
            $teams = [];
            $teams = $this->get_teams();

            // Matches
            $matches = [];
            $matches = $this->get_matches_order_by_date();

            $nb_matches_before = 1;
            $nb_matches_next   = 2;

            if( all_matches_have_date( $matches ) ){
                $matches = $this->get_matches_for_slider( $matches, $nb_matches_before, $nb_matches_next );
            }

            // We create the slider HTML
            $slider_html = '<div class="'.$slider_html_class.'">';

            foreach( $matches as $match ){
                $slide_html = '';

                $slide_html .= '<div class="smr-slider">';
                
                $header_date_day        = $match->get_date_slide_header_date_day( $language );
                $header_date_month      = $match->get_date_slide_header_date_month( $language );

                $header_content         = $match->get_slide_header_content( $language );

                $header = '<div class="smr-slider-header">';

                if ( !empty( $header_date_day ) && !empty( $header_date_month ) ){
                    $header .=
                    '<div class="smr-slider-header-date">
                        <p>'.$header_date_day.'</p>
                        <p>'.$header_date_month.'</p>
                    </div>';
                }

                if ( !empty( $header_content ) ) {
                $header .=
                    '<div class="smr-slider-header-content">
                        <p>'.$header_content.'</p>
                    </div>';
                }

                $header .= '</div>';

                $home_team         = get_team( $teams, $match->get_home_team_id() );
                $outside_team      = get_team( $teams, $match->get_outside_team_id() );

                $home_team_name    = stripslashes( $home_team->get_name() );
                $home_team_logo    = $home_team->get_logo();

                $outside_team_name = stripslashes( $outside_team->get_name() );
                $outside_team_logo = $outside_team->get_logo();

                $content = 
                '<div class="smr-slider-content">
                    <div class="smr-slider-content-home-team">
                        <img src="'.$home_team_logo.'" alt="'.$home_team_name.'-logo" />
                    </div>
                    <div class="smr-slider-content-score">
                        <p>'.$match->get_score().'</p>
                    </div>
                    <div class="smr-slider-content-home-team">
                        <img src="'.$outside_team_logo.'" alt="'.$outside_team_name.'-logo" />
                    </div>
                </div>';

                $footer =         
                '<div class="smr-slider-footer">
                    <p> '.$home_team_name.' - '.$outside_team_name.'</p>
                </div>';

                $slide_html  .= $header.$content.$footer; 
                $slide_html  .= '</div>';
                $slider_html .= $slide_html;

            }

            $slider_html  .= '</div>';

            return $slider_html;
        }
    }

    /**
     * Shortcode for generate the ranking
     *
     * @since 1.0.0
     * 
     * @return (string)  
     * 
     */
    public function generate_smr_ranking( $atts ){

        // Val par défaut
        $atts = shortcode_atts( array(
        ), $atts );

        extract( $atts );

        if( !is_admin() ){

            require_once plugin_dir_path( __FILE__ ).'inc/class/settings_ranking.php';
            require_once plugin_dir_path( __FILE__ ).'inc/additional/smr_css.php';

            $language = $this->get_language();
                    
            $settings_json = json_decode( $this->get_option() );

            // RANKING
            $settings_ranking_json = $settings_json->settings->ranking;

            $settings_ranking      = new Settings_Ranking( $settings_ranking_json->display_ranking, $settings_ranking_json->background_color, $settings_ranking_json->text_color, $settings_ranking_json->team_id, $settings_ranking_json->background_color_team, $settings_ranking_json->text_color_team, $settings_ranking_json->display_border, $settings_ranking_json->border_width, $settings_ranking_json->border_style, $settings_ranking_json->border_color, $settings_ranking_json->nb_teams, $settings_ranking_json->nb_teams_above, $settings_ranking_json->nb_teams_below );

            if( !$settings_ranking->get_display_ranking() ){
                return '';
            }

            // We generate & create style for this specific ranking
            wp_enqueue_style( 'smr_style', plugins_url( 'assets/css/smr.css', __FILE__ ) );
            wp_add_inline_style( 'smr_style', smr_ranking_create_css( $settings_ranking ) );

            require_once plugin_dir_path( __FILE__ ).'inc/class/team.php';

            // Teams
            $teams = [];

            $teams = $this->get_teams_ranking( $settings_ranking->get_team_id(), $settings_ranking->get_nb_teams(), $settings_ranking->get_nb_teams_above(), $settings_ranking->get_nb_teams_below() );

            $slider_html = '<table class="smr-ranking">';

            foreach($teams as $team){
                if( $settings_ranking->get_team_id() == $team->get_id() ){
                    $slider_html .= '<tr class="smr_ranking_active_team smr-ranking-team">';
                }else{
                    $slider_html .= '<tr class="smr-ranking-team">';
                }
                $slider_html .= '<td class="smr-ranking-team-position">';
                $slider_html .= $team->get_position();
                $slider_html .= '</td>';
                $slider_html .= '<td class="smr-ranking-team-name">';
                $slider_html .= stripslashes( $team->get_name() );
                $slider_html .= '</td>';
                $slider_html .= '<td class="smr-ranking-team-points">';
                $slider_html .= $team->get_points();
                $slider_html .= '</td>';
                $slider_html .= '</tr>';
            }

            $slider_html  .= '</table>';

            return $slider_html;
        }
    }

    /**
     * Page sliders - admin
     *
     * @since 1.0.0
     * 
     */
    public function slider_index(){
        require_once plugin_dir_path( __FILE__ ).'inc/class/slider.php';

        $sliders = [];
        $sliders = $this->get_sliders();

        require_once plugin_dir_path( __FILE__ ).'templates/sliders.php';
    }

    /**
     * Page create sliders - admin
     *
     * @since 1.0.0
     * 
     */
    public function create_slider_index(){
        require_once plugin_dir_path( __FILE__ ).'inc/additional/settings.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/slider.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_header.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_content.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_footer.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_slide.php';

        $state_active = $this->get_state_active();

        $sliders = [];
        $sliders = $this->get_sliders();

        $nb_slider = count( $sliders );
        if( $nb_slider == 0 ){
            $slider = new Slider(1,'');
        }else{
            $slider = new Slider( $sliders[$nb_slider-1]->get_id() + 1,'' );
        }

        $settings_json = json_decode( $this->get_option() );

        // SLIDER
        $settings_slider_header_json  = $settings_json->settings->slider->header;

        $settings_slider_header       = new Settings_Slider_Header( $settings_slider_header_json->date_text_color, $settings_slider_header_json->date_background_color, $settings_slider_header_json->title_text_color, $settings_slider_header_json->title_background_color );

        $settings_slider_content_json = $settings_json->settings->slider->content;

        $settings_slider_content      = new Settings_Slider_Content( $settings_slider_content_json->text_color, $settings_slider_content_json->background_color, $settings_slider_content_json->max_width_logo );

        $settings_slider_footer_json  = $settings_json->settings->slider->footer;

        $settings_slider_footer       = new Settings_Slider_Footer( $settings_slider_footer_json->display_footer, $settings_slider_footer_json->text_color, $settings_slider_footer_json->background_color );

        $settings_slide_json          = $settings_json->settings->slider->slide;

        $settings_slide               = new Settings_Slider_Slide($settings_slide_json->infinite, $settings_slide_json->dots, $settings_slide_json->dots_color, $settings_slide_json->autoplay, $settings_slide_json->autoplay_speed, $settings_slide_json->arrows, $settings_slide_json->arrows_color,$settings_slide_json->arrows_in, $settings_slide_json->fade, $settings_slide_json->transition_type, $settings_slide_json->transition_speed, $settings_slide_json->swipe );


        require_once plugin_dir_path( __FILE__ ).'templates/create_slider.php';

        if( $state_active != 'create_select' ){
            $this->set_state_active( 'create_select' );
        }
    }

    /**
     * Page update sliders - admin
     *
     * @since 1.0.0
     * 
     */
    public function update_slider_index(){
        require_once plugin_dir_path( __FILE__ ).'inc/additional/settings.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/slider.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_header.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_content.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_footer.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_slide.php';

        $slider_id   = $_GET['id'];

        $this->update_option( $_POST );

        $state_active = $this->get_state_active();

        
        $slider_json   = json_decode( $this->get_slider( $slider_id ) );

        $slider        = new Slider( $slider_json->id,$slider_json->name );

        $settings_json = $slider_json->settings;

        // SLIDER
        $settings_slider_header_json  = $settings_json->slider->header;

        $settings_slider_header       = new Settings_Slider_Header( $settings_slider_header_json->date_text_color, $settings_slider_header_json->date_background_color, $settings_slider_header_json->title_text_color, $settings_slider_header_json->title_background_color );

        $settings_slider_content_json = $settings_json->slider->content;

        $settings_slider_content      = new Settings_Slider_Content( $settings_slider_content_json->text_color, $settings_slider_content_json->background_color, $settings_slider_content_json->max_width_logo );

        $settings_slider_footer_json  = $settings_json->slider->footer;

        $settings_slider_footer       = new Settings_Slider_Footer( $settings_slider_footer_json->display_footer, $settings_slider_footer_json->text_color, $settings_slider_footer_json->background_color );

        $settings_slide_json          = $settings_json->slider->slide;

        $settings_slide               = new Settings_Slider_Slide( $settings_slide_json->infinite, $settings_slide_json->dots, $settings_slide_json->dots_color, $settings_slide_json->autoplay, $settings_slide_json->autoplay_speed, $settings_slide_json->arrows, $settings_slide_json->arrows_color,$settings_slide_json->arrows_in, $settings_slide_json->fade, $settings_slide_json->transition_type, $settings_slide_json->transition_speed, $settings_slide_json->swipe );


        require_once plugin_dir_path( __FILE__ ).'templates/update_slider.php';

        $this->set_state_active( 'update_select' );
    }

    /**
     * Page teams - admin
     *
     * @since 1.0.0
     * 
     */
    public function teams_index(){

        require_once plugin_dir_path( __FILE__ ).'inc/class/team.php';

        $settings_teams_json = $this->get_option_settings_teams();

        $display_logo = $settings_teams_json->display_logo;

        $teams = [];
        $teams = $this->get_teams();

        require_once plugin_dir_path( __FILE__ ).'templates/teams.php';
    }

    /**
     * Page matches - admin
     *
     * @since 1.0.0
     * 
     */
    public function matches_index(){
        require_once plugin_dir_path( __FILE__ ).'inc/class/team.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/match.php';
        require_once plugin_dir_path( __FILE__ ).'inc/additional/matches.php';

        $language = $this->get_language();

        // Teams
        $teams = [];
        $teams = $this->get_teams();

        // Matches
        $matches = [];
        $matches = $this->get_matches();
        

        require_once plugin_dir_path( __FILE__ ).'templates/matches.php';
    }

    /**
     * Page settings - admin
     *
     * @since 1.0.0
     * 
     */
    public function settings_index(){

        require_once plugin_dir_path( __FILE__ ).'inc/additional/settings.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_header.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_content.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_footer.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_slider_slide.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_ranking.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_teams.php';
        require_once plugin_dir_path( __FILE__ ).'inc/class/settings_matches.php';

        require_once plugin_dir_path( __FILE__ ).'inc/class/team.php';
        require_once plugin_dir_path( __FILE__ ).'inc/additional/matches.php';

        
        $page_active  = $this->update_option( $_POST );

        $state_active = $this->get_state_active();

        $subpage_active = null;
        if( $page_active == 'slider' ){    
            $subpage_active = htmlspecialchars( $_POST['smr-form-update-settings-slider-subpage'] );
        }

        $teams = [];
        $teams = $this->get_teams();

        $settings_json = json_decode( $this->get_option() );

        // SLIDER
        $settings_slider_header_json  = $settings_json->settings->slider->header;

        $settings_slider_header       = new Settings_Slider_Header( $settings_slider_header_json->date_text_color, $settings_slider_header_json->date_background_color, $settings_slider_header_json->title_text_color, $settings_slider_header_json->title_background_color );

        $settings_slider_content_json = $settings_json->settings->slider->content;

        $settings_slider_content      = new Settings_Slider_Content( $settings_slider_content_json->text_color, $settings_slider_content_json->background_color, $settings_slider_content_json->max_width_logo );

        $settings_slider_footer_json  = $settings_json->settings->slider->footer;

        $settings_slider_footer       = new Settings_Slider_Footer( $settings_slider_footer_json->display_footer, $settings_slider_footer_json->text_color, $settings_slider_footer_json->background_color );

        $settings_slide_json          = $settings_json->settings->slider->slide;

        $settings_slide               = new Settings_Slider_Slide( $settings_slide_json->infinite, $settings_slide_json->dots, $settings_slide_json->dots_color, $settings_slide_json->autoplay, $settings_slide_json->autoplay_speed, $settings_slide_json->arrows, $settings_slide_json->arrows_color,$settings_slide_json->arrows_in, $settings_slide_json->fade, $settings_slide_json->transition_type, $settings_slide_json->transition_speed, $settings_slide_json->swipe );

        // RANKING
        $settings_ranking_json = $settings_json->settings->ranking;

        $settings_ranking      = new Settings_Ranking( $settings_ranking_json->display_ranking, $settings_ranking_json->background_color, $settings_ranking_json->text_color, $settings_ranking_json->team_id, $settings_ranking_json->background_color_team, $settings_ranking_json->text_color_team, $settings_ranking_json->display_border, $settings_ranking_json->border_width, $settings_ranking_json->border_style, $settings_ranking_json->border_color, $settings_ranking_json->nb_teams, $settings_ranking_json->nb_teams_above, $settings_ranking_json->nb_teams_below );

        // TEAMS
        $settings_teams_json = $settings_json->settings->teams;

        $settings_teams      = new Settings_Teams($settings_teams_json->order_by, $settings_teams_json->nb_elements, $settings_teams_json->display_logo );

        // MATCHES
        $settings_matches_json = $settings_json->settings->matches;

        $settings_matches      = new Settings_Matches( $settings_matches_json->order_by, $settings_matches_json->nb_elements );        

        require_once plugin_dir_path( __FILE__ ).'templates/settings.php';

        $this->set_state_active( 'update_select' );
    }

}

if( class_exists( 'Slider_Matches_Results' ) ){
    $slider_matches_results = new Slider_Matches_Results();
    if( is_admin() ){
        $slider_matches_results->register_admin();
        $slider_matches_results->ajax_admin();
    }else{
        $slider_matches_results->register();
    }
}

// activation plugin
register_activation_hook( __FILE__, array( $slider_matches_results, 'activate_plugin' ) );

// desactivation plugin
register_activation_hook( __FILE__, array( $slider_matches_results, 'desactivate_plugin' ) );
