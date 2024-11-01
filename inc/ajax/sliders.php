<?php 
defined('ABSPATH') or die('Hey, What are you doing here? You stilly human!');

/**
 * Ajax - Delete Slider.
 *
 * @since 1.0
 *
 */ 
add_action( 'wp_ajax_smr_delete_slider', 'smr_delete_slider' );
function smr_delete_slider() {
    
    global $wpdb;

    $id = intval( htmlspecialchars( $_POST['id'] ) );

    if($id != 0){
        echo delete_option( 'smr_slider_'.$id );
    }

	wp_die();
}

/**
 * Ajax - Delete Sliders.
 *
 * @since 1.0
 *
 */ 
add_action( 'wp_ajax_smr_delete_sliders', 'smr_delete_sliders' );
function smr_delete_sliders() {
    
    global $wpdb;

    $ids = $_REQUEST['id'];

    foreach ( $ids as $id ) {
        $id = intval( $id );
        if( $id == 0 ){
            wp_die();
        }
        delete_option( 'smr_slider_'.$id );
    }

	wp_die();
}

?>