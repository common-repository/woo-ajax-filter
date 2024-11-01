<?php 
namespace NWAF\elements\rating;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class rating extends \NWAF\classes\element {
	public $atts = array();
	public function __construct() {
		// shortcode
		add_shortcode('nwaf_rating', array($this, 'shortcode'));

		add_action('nwaf_admin_element_form', array($this, 'form'), 5);

		add_action('wp_enqueue_scripts', array($this, 'frontsite_script') );

		add_filter('woocommerce_product_query_meta_query', array($this, 'filter'));
	}

	public function filter($params) {
		if (isset($params['rating_filter']) && isset($_GET['rating_filter']) && $_GET['rating_filter'] !== '') {
			$params['rating_filter'] = array(
				'key'           => '_wc_average_rating',
				'value'         => wc_clean($_GET['rating_filter']),
				'compare'       => '>=',
				'type'          => 'DECIMAL',
				'rating_filter' => true,
			);	
		}
		return $params;
	}

	public function form() {
		require_once dirname(__FILE__). '/form.php';
	}

	public function shortcode($atts) {
		
		$html = '';
		
		ob_start();
		include $this->view(dirname(__FILE__) . '/views/default.php');
		$html .= ob_get_contents();
		ob_end_clean();
	
		return $html;
	}

	public function frontsite_script () {
		if (!is_admin()) {
			wp_enqueue_script( 'nwaf-rating-js', plugins_url( 'assets/frontsite.js', __FILE__ ), array( 'jquery' ), false, true ); 
			wp_enqueue_style( 'nwaf-rating-css', plugins_url( 'assets/default.css', __FILE__ )); 
		}
	}
}
?>