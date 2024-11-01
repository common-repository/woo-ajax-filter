<?php 
namespace NWAF\elements\taxonomy;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class taxonomy extends \NWAF\classes\element {
	public $atts = array();
	public function __construct() {
		// shortcode
		add_shortcode('nwaf_taxonomy', array($this, 'shortcode'));

		add_action('nwaf_admin_element_form', array($this, 'form'), 5);

		add_action( 'admin_enqueue_scripts', array($this, 'admin_script') );

		add_action( 'wp_enqueue_scripts', array($this, 'frontsite_script') );
	}

	public function shortcode($atts) {
		$options = \NWAF\helpers\factory::getInstance('helpers\options');
		// die();
		$this->atts = shortcode_atts( array(
	        'tax' => '',
	        'view' => '',
	    ), $atts );

		$taxs = $options->get('taxonomies', array(), true);
		$html = '';
		
		if (isset($this->atts['tax']) && $this->atts['tax'] != '' && isset($taxs[$this->atts['tax']])) {
			$taxs = array($this->atts['tax'] => $taxs[$this->atts['tax']]);
		}
		if (is_array($taxs)) {
			foreach ($taxs as $term => $tax) {
				$showType = strtolower(trim($tax['type']));
				ob_start();
				include $this->view(dirname(__FILE__) . '/views/' . $showType . '.php');
				$html .= ob_get_contents();
				ob_end_clean();
			}	
		}
		
		return $html;
	}

	public function form() {
		require_once dirname(__FILE__). '/form.php';
	}

	public function admin_script () {

		if( is_admin() ) { 
	     	// Add the color picker css file       
	        wp_enqueue_style( 'wp-color-picker' ); 
	         
	        // Include our custom jQuery file with WordPress Color Picker dependency
	        wp_enqueue_script( 'nwaf-picker-color', plugins_url( 'assets/default.js', __FILE__ ), array( 'wp-color-picker' ), false, true ); 
	    }
	}

	public function frontsite_script () {
		if (!is_admin()) {
			wp_enqueue_script( 'nwaf-taxonomy-js', plugins_url( 'assets/frontsite.js', __FILE__ ), array( 'jquery' ), false, true ); 
			wp_enqueue_style( 'nwaf-taxonomy-css', plugins_url( 'assets/default.css', __FILE__ )); 
		}
	}
}
?>