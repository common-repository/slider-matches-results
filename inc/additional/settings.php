<?php

defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!');

/**
 * Give the names of the various parameters present in the administration page.
 *
 * @since 1.0
 * 
 * @return (table) 
 *
 */
function get_settings_order_by( $page ){
    switch ( $page ) {

        case 'teams':

            return ['id','name','position'];

            break;

        case 'matches':
    
            return ['id', 'home team', 'outside team', 'week', 'date', 'championship', 'score'];

            break;
        
        default:
            # code...
            break;
    }
}

/**
 * Give the different transitions (CSS).
 *
 * @since 1.0
 * 
 * @return (table) 
 *
 */
function get_settings_transition_type(){
    return ['linear', 'ease', 'ease-in', 'ease-out', 'ease-in-out'];
}

/**
 * Give the numbers of elements to display in the administration pages (Table).
 *
 * @since 1.0
 * 
 * @return (table) 
 *
 */
function get_settings_nb_elements(){

    return [10,25,50,100];

}

/**
 * Return class CSS if the active page corresponding the tab .
 *
 * @since 1.0
 * 
 * @return (string) 
 *
 */
function get_settings_page_active( $page_active, $tab ){

    if( !isset( $page_active ) && $tab == 'slider' ){
        return 'active show';
    }elseif( is_settings_page_active( $page_active, $tab ) ){
        return 'active show';
    }

}

/**
 * Return true if the active page corresponding the tab .
 *
 * @since 1.0
 * 
 * @return (boolean) 
 *
 */
function is_settings_page_active( $page_active, $tab ){
    return $page_active == $tab;
}

/**
 * Return class CSS if the active subpage corresponding the tab .
 *
 * @since 1.0
 * 
 * @return (string) 
 *
 */
function get_settings_subpage_active( $subpage_active, $subpage ){

    if( !isset( $subpage_active ) && $subpage == 'header' ){
        return 'subpage-active';
    }elseif( $subpage_active == $subpage ){
        return 'subpage-active';
    }

}


?>