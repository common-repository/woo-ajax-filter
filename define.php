<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
define( 'NWAF_NAMESPACE', 'NWAF' );
define( 'NWAF_OPTION_NAME', 'nwaf_filter_options' );
define( 'NWAF_THEME_PATH', get_template_directory());
define( 'NWAF_URL', plugin_dir_url( __FILE__ ) );
define( 'NWAF_DIR', plugin_dir_path( __FILE__ ) );	
define( 'NWAF_ELEMENTS_DIR', NWAF_DIR. 'elements/' );
define( 'NWAF_ADMIN_DIR', plugin_dir_path( __FILE__ ). 'admin/' );	
define( 'NWAF_FRONTSITE_DIR', plugin_dir_path( __FILE__ ) . 'frontsite/' );	