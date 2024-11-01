<?php 
defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!');

/**
 * Ajax - Create Team.
 *
 * @since 1.0
 *
 */ 
add_action( 'wp_ajax_smr_create_team', 'smr_create_team' );
function smr_create_team() {
    
    global $wpdb;

    $name     = htmlspecialchars( $_POST['name'] );
    $position = htmlspecialchars( $_POST['position'] );
    $points   = htmlspecialchars( $_POST['points'] );
    $logo     = htmlspecialchars( $_POST['logo'] );

    if( !empty( $name ) ){
        $sql = "INSERT INTO ".$wpdb->prefix."smr_teams(name,position,points,logo) VALUES (%s,%d,%d,%s)";
        $wpdb->get_results( $wpdb->prepare( $sql,array( $name, $position, $points, $logo ) ) );

        echo $wpdb->insert_id;
    }

	wp_die();
}

/**
 * Ajax - Update Team.
 *
 * @since 1.0
 *
 */ 
add_action( 'wp_ajax_smr_update_team', 'smr_update_team' );
function smr_update_team() {
    
    global $wpdb;
    
    $id       = htmlspecialchars( $_POST['id'] );
    $name     = htmlspecialchars( $_POST['name'] );
    $position = htmlspecialchars( $_POST['position'] );
    $points   = htmlspecialchars( $_POST['points'] );
    $logo     = htmlspecialchars( $_POST['logo'] );

    if( !empty( $id ) && !empty( $name ) ){
        $sql = "UPDATE ".$wpdb->prefix."smr_teams SET name = %s, position = %d, points = %d, logo = %s WHERE id = %d";
        $wpdb->get_results( $wpdb->prepare( $sql,array( $name, $position, $points, $logo, $id ) ) );
    }

	wp_die();
}

/**
 * Ajax - Update Team.
 *
 * @since 1.0.3
 *
 */ 
add_action( 'wp_ajax_smr_update_teams', 'smr_update_teams' );
function smr_update_teams() {
    
    global $wpdb;
    
    $t_id       = $_POST['idArray'];
    $t_position = $_POST['positionArray'];
    $t_points   = $_POST['pointsArray'];

    for($index = 0; $index < count( $t_id ); $index++) {
        if( !empty( $t_id[$index] ) ){
            $sql = "UPDATE ".$wpdb->prefix."smr_teams SET position = %d, points = %d WHERE id = %d";
            $wpdb->get_results( $wpdb->prepare( $sql,array( $t_position[$index], $t_points[$index], $t_id[$index] ) ) );
        }
    }
    
	wp_die();
}

/**
 * Ajax - Delete Team.
 *
 * @since 1.0
 *
 */ 
add_action( 'wp_ajax_smr_delete_team', 'smr_delete_team' );
function smr_delete_team() {
    
    global $wpdb;

    $id = intval( htmlspecialchars( $_POST['id'] ) );

    if( $id != 0 ){
        $sql = "DELETE FROM ".$wpdb->prefix."smr_teams WHERE id = %d";
        $wpdb->get_results( $wpdb->prepare( $sql,array( $id ) ) );

        $sql = "DELETE FROM ".$wpdb->prefix."smr_matches WHERE home_team_id = %d OR outside_team_id = %d";
        $wpdb->get_results( $wpdb->prepare( $sql,array( $id, $id ) ) );
    }

	wp_die();
}

/**
 * Ajax - Delete Teams.
 *
 * @since 1.0
 *
 */ 
add_action( 'wp_ajax_smr_delete_teams', 'smr_delete_teams' );
function smr_delete_teams() {
    
    global $wpdb;

    $ids    = $_REQUEST['id'];

    $sql    = "DELETE FROM ".$wpdb->prefix."smr_teams WHERE id IN (";

    $sql2_a = "DELETE FROM ".$wpdb->prefix."smr_matches WHERE home_team_id IN (";
    $sql2_b = ") OR outside_team_id IN (";

    $home_team_id    = '';
    $outside_team_id = '';

    foreach ( $ids as $id ) {
        $id = intval( $id );
        if( $id == 0 ){
            wp_die();
        }
        $sql              .= $id.',';
        $home_team_id     .= $id.',';
        $outside_team_id  .= $id.',';

    }

    $sql = substr( $sql, 0, count( $sql ) - 2 ).')';

    $sql2 = $sql2_a.substr( $home_team_id, 0, count( $home_team_id ) - 2 ).$sql2_b.substr( $outside_team_id, 0, count( $outside_team_id ) - 2 ).')';

    $wpdb->get_results( $wpdb->prepare( $sql,array( ) ) );
    $wpdb->get_results( $wpdb->prepare( $sql2,array( ) ) );

	wp_die();
}

?>