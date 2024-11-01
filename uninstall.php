<?php
/**
 * Trigger this file on plugin uninstall
 * 
 * 
 */

if( !defined( 'WP_UNINSTALL_PLUGIN' ) ){
    die;
}

global $wpdb;

$table_name_teams        = $wpdb->prefix."smr_teams";
$table_name_matches      = $wpdb->prefix."smr_matches";
$table_wp_options        = $wpdb->prefix."options";
$option_settings         = 'smr_options_settings';
$option_settings_sliders = 'smr_slider_';
$option_state_active     = 'smr_state_active';

$wpdb->query( "DELETE FROM $table_name_teams" );
$wpdb->query( "DROP TABLE IF EXISTS $table_name_teams" );

$wpdb->query( "DELETE FROM $table_name_matches" );
$wpdb->query( "DROP TABLE IF EXISTS $table_name_matches" );

$wpdb->query( "DELETE FROM $table_wp_options WHERE option_name LIKE '$option_settings_sliders%'" );    

delete_option( "smr_db_version" );
delete_option( $option_settings );
delete_option( $option_state_active );

?>