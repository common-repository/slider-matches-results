<?php

defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!');

/**
 * Return the name of the team who as a specific id.
 *
 * @since 1.0
 * 
 * @return (string) 
 *
 */
function get_team_name( $teams, $id ){

    $i    = 0;
    $team_name = NULL;
    while ( $i < count( $teams ) && !isset( $team_name ) ) {
        if( $teams[$i]->get_id() == $id ){
            $team_name = $teams[$i]->get_name();
        }
        $i++;
    }
    return $team_name;
}

/**
 * Return the team who as a specific id.
 *
 * @since 1.0
 * 
 * @return (Team) 
 *
 */
function get_team( $teams, $id ){

    $i    = 0;
    $team = NULL;
    while ( $i < count( $teams ) && !isset( $team ) ) {
        if( $teams[$i]->get_id() == $id ){
            $team = $teams[$i];
        }
        $i++;
    }
    return $team;
}

/**
 * Return the local date.
 *
 * @since 1.0
 * @update 1.0.5
 * 
 * @return (string) 
 *
 */
function get_date_local( $local, $date ){

    if( !empty( $date ) ){
        $date_local = new DateTime( $date );

        switch ( $local ) {
            case 'fr':
                # Fr
                $date_local->setTimezone(new DateTimeZone('Europe/Paris'));
                $date_local = $date_local->format( 'd/m/Y H:i' );
                break;
            
            default:
                # Us
                $date_local = $date_local->format( 'm/d/Y h:i A' );
                break;
        }
        return $date_local;
    }
}

/**
 * Return true if all matches have date.
 *
 * @since 1.0
 * 
 * @return (boolean) 
 *
 */
function all_matches_have_date( $matches ){
    $is_ok = true;
    $i     = 0;

    while( $i < count( $matches ) && $is_ok ){
        if( !$matches[$i]->get_date() ){
            $is_ok = false;
        }
        $i++;
    }

    return $is_ok;
}


?>