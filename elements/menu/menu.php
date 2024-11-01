<?php 
namespace NWAF\elements\menu;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class menu extends \NWAF\classes\element {
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array($this, 'frontsite_script') );
	}

	public function frontsite_script () {
		if (!is_admin()) {
			wp_enqueue_script( 'nwaf-menu-js', plugins_url( 'assets/default.js', __FILE__ ), array( 'jquery' ), false, true ); 
		}
	}
}