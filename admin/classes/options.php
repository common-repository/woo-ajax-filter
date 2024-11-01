<?php
namespace NWAF\admin\classes;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class options {
	
	private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_init', array( $this, 'page_init' ) );
    	add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_enqueue_scripts', array($this, 'safely_add_stylesheet_to_admin'));
    }

	/**
     * Add stylesheet to the page
     */
    function safely_add_stylesheet_to_admin( $page ) {
    	wp_enqueue_style( 'nwaf-admin-style', NWAF_URL . '/admin/assets/css/admin.css' );
        wp_enqueue_script( 'nwaf-admin-js', NWAF_URL . '/admin/assets/js/default.js', array( 'jquery' ), false, true ); 
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_menu_page(
            'C4D Woo Ajax Filter', 
            'C4D Woo Ajax Filter', 
            'manage_options', 
            'neo-wc-ajax-filter-options', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
    	// Set class property
        $this->options = get_option( NWAF_OPTION_NAME );
        require NWAF_DIR . 'admin/views/options.php';
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
    	register_setting(
            NWAF_OPTION_NAME, // Option group
            NWAF_OPTION_NAME, // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
	}

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
    	return $input;
        $new_input = array();

        if( isset( $input['id_number'] ) )
            $new_input['id_number'] = absint( $input['id_number'] );

        if( isset( $input['title'] ) )
            $new_input['title'] = sanitize_text_field( $input['title'] );

        return $new_input;
    }
}