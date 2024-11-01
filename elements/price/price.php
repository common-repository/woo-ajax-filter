<?php 
namespace NWAF\elements\price;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class price extends \NWAF\classes\element {
	public function __construct() {
		add_shortcode('nwaf_price', array($this, 'shortcode'));

		add_action( 'wp_enqueue_scripts', array($this, 'frontsite_script') );
	}

	public function shortcode($params) {
		ob_start();
		include $this->view(dirname(__FILE__) . '/views/default.php');
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	public function frontsite_script () {
		if (!is_admin()) {
			wp_enqueue_script( 'nwaf-price-js', plugins_url( 'assets/default.js', __FILE__ ), array( 'jquery' ), false, true ); 
			wp_enqueue_style( 'nwaf-price-css', plugins_url( 'assets/default.css', __FILE__ )); 
		}
	}
}