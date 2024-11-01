<?php 
namespace NWAF\elements\tags;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class tags extends \NWAF\classes\element {
	public $atts = array();
	public function __construct() {
		// shortcode
		add_shortcode('nwaf_tags', array($this, 'shortcode'));

		add_action( 'wp_enqueue_scripts', array($this, 'frontsite_script') );
	}

	public function shortcode($atts) {
		
		$html = '';
		
		ob_start();
		include $this->view(dirname(__FILE__) . '/views/tags.php');
		$html .= ob_get_contents();
		ob_end_clean();
	
		return $html;
	}

	public function frontsite_script () {
		if (!is_admin()) {
			wp_enqueue_script( 'nwaf-tag-js', plugins_url( 'assets/frontsite.js', __FILE__ ), array( 'jquery' ), false, true ); 
			wp_enqueue_style( 'nwaf-tag-css', plugins_url( 'assets/default.css', __FILE__ )); 
		}
	}
}
?>