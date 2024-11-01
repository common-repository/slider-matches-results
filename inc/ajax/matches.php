<?php 
defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!');


/**
 * Ajax - Create Match.
 *
 * @since 1.0
 *
 */

add_action( 'wp_ajax_smr_create_match', 'smr_create_match' );
function smr_create_match() {
    
    global $wpdb;

    $home_team_id        = htmlspecialchars($_POST['homeTeamId']);
    $outside_team_id     = htmlspecialchars($_POST['outsideTeamId']);
    $week                = htmlspecialchars($_POST['week']);
    $date                = htmlspecialchars($_POST['date']);
    $championship        = htmlspecialchars($_POST['championship']);
    $score               = htmlspecialchars($_POST['score']);
    
    if( !empty( $home_team_id ) && !empty( $outside_team_id ) && $home_team_id != $outside_team_id ){

        if( empty( $date ) ){
            $sql = "INSERT INTO ".$wpdb->prefix."smr_matches(home_team_id,outside_team_id,week,date,championship,score) VALUES (%d,%d,%s,NULL,%s,%s)";
        }else{
            $date = new DateTime( $date );
            $date = $date->format( 'Y-m-d H:i:s' );

            $sql = "INSERT INTO ".$wpdb->prefix."smr_matches(home_team_id,outside_team_id,week,date,championship,score) VALUES (%d,%d,%s,'$date',%s,%s)";
        }
        
        $wpdb->get_results( $wpdb->prepare( $sql, array( $home_team_id, $outside_team_id, $week, $championship, $score ) ) );
 
        echo $wpdb->insert_id;
    }

	wp_die();
}

/**
 * Ajax - Update Match.
 *
 * @since 1.0
 *
 */
add_action( 'wp_ajax_smr_update_match', 'smr_update_match' );
function smr_update_match() {
    
    global $wpdb;
    
    $id                  = htmlspecialchars($_POST['id']);
    $home_team_id        = htmlspecialchars($_POST['homeTeamId']);
    $outside_team_id     = htmlspecialchars($_POST['outsideTeamId']);
    $week                = htmlspecialchars($_POST['week']);
    $date                = htmlspecialchars($_POST['date']);
    $championship        = htmlspecialchars($_POST['championship']);
    $score               = htmlspecialchars($_POST['score']);

    if( !empty( $id ) && !empty( $home_team_id ) && !empty($outside_team_id ) && $home_team_id != $outside_team_id ){

        if( empty( $date ) ){
            $sql = "UPDATE ".$wpdb->prefix."smr_matches SET home_team_id = %d, outside_team_id = %d, week = %s, date = NULL, championship = %s, score = %s WHERE id = %d";
        }else{
            $date = new DateTime( $date );
            $date = $date->format('Y-m-d H:i:s');

            $sql = "UPDATE ".$wpdb->prefix."smr_matches SET home_team_id = %d, outside_team_id = %d, week = %s, date = '$date', championship = %s, score = %s WHERE id = %d";
        }

        $wpdb->get_results( $wpdb->prepare( $sql, array( $home_team_id, $outside_team_id, $week, $championship, $score, $id ) ) );
    
    }

	wp_die();
}

/**
 * Ajax - Delete Matches.
 *
 * @since 1.0
 *
 */ 
add_action( 'wp_ajax_smr_delete_match', 'smr_delete_match' );
function smr_delete_match() {
    
    global $wpdb;

    $id = intval( htmlspecialchars( $_POST['id'] ) );

    if( $id != 0 ){
        $sql = "DELETE FROM ".$wpdb->prefix."smr_matches WHERE id = %d";
        $wpdb->get_results( $wpdb->prepare( $sql, array( $id ) ) );
    }

	wp_die();
}

/**
 * Ajax - Delete Matches.
 *
 * @since 1.0
 *
 */
add_action( 'wp_ajax_smr_delete_matches', 'smr_delete_matches' );
function smr_delete_matches() {
    
    global $wpdb;

    $ids = $_REQUEST['id'];

    $sql = "DELETE FROM ".$wpdb->prefix."smr_matches WHERE id in (";

    foreach ( $ids as $id ) {
        $id = intval( $id );
        if( $id == 0 ){
            wp_die();
        }
        $sql .= $id.',';
    }

    $sql = substr( $sql, 0, count( $sql )-2 ).')';

    $wpdb->get_results( $wpdb->prepare( $sql, array( ) ) );

	wp_die();
}

?>