<?php
/*
 * Plugin Name: C4D Woocommerce Ajax Filter
 * Plugin URI: https://coffee4dev.com
 * Description: Turn Woocommerce into ajax functions
 * Version: 1.0.0
 * Author: Coffee4dev
 * Author URI: http://coffee4dev.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// define
require_once (plugin_dir_path(__FILE__). '/define.php');


//auto load 
require_once (NWAF_DIR. 'autoload.php');


// admin
new NWAF\admin\admin();


// front site
new NWAF\frontsite\frontsite();

// custom hook 
add_filter( 'plugin_row_meta', 'c4d_nwaf_plugin_row_meta', 10, 2 );

function c4d_nwaf_plugin_row_meta( $links, $file ) {
    if ( strpos( $file, basename(__FILE__) ) !== false ) {
        $new_links = array(
            'visit' => '<a href="http://coffee4dev.com">Visit Plugin Site</<a>',
            'forum' => '<a href="http://coffee4dev.com/forums/">Forum</<a>',
            'premium' => '<a href="http://coffee4dev.com">Premium Support</<a>'
        );
        
        $links = array_merge( $links, $new_links );
    }
    
    return $links;
}

add_action('c4d-plugin-manager-section', 'c4d_nwaf_section_options');
function c4d_nwaf_section_options(){
	$opt_name = 'c4d_plugin_manager';
	Redux::setSection( $opt_name, array(
        'title'            => __( 'Woo Ajax Filter', 'c4d-woo-ajax-filter' ),
        'id'               => 'section-c4d-woo-ajax-filter',
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'el el-home',
        'fields'           => array(
            array(
                'id'       => 'c4d-woo-ajax-filter-load-style',
                'type'     => 'button_set',
                'title'    => __( 'Load Style', 'c4d-woo-ajax-filter' ),
                'subtitle' => __( 'You can switch from page nav to scroll load or load more button', 'c4d-woo-ajax-filter' ),
                'options'  => array(
                    false => 'Page Nav',
                    'loadmore' => 'Load More Button',
                    'scroll' => 'Scroll Load'
                ),
                'default'  => false
            )
        )
    ));
}
// end code.
