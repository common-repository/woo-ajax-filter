<?php 
namespace NWAF\elements\category;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class category extends \NWAF\classes\element {
	public function __construct() {
		// shortcode
		parent::__construct();
		
		add_filter('woocommerce_product_categories_widget_args', array($this, 'widget'));

		add_action('wp_enqueue_scripts', array($this, 'frontsite_script') );
	}

	public function widget($params) {
		require_once dirname(__FILE__). '/walker.php';
		if (class_exists('wc_categories_widget_walker_category')) {
			$params['walker'] = new \wc_categories_widget_walker_category();
		}
		$options = \NWAF\helpers\factory::getInstance('helpers\options');
		$parentId = $options->get('category.parent_id', '', true);
		if ($parentId !== '') {
			$params['child_of'] = $parentId;
		}
		
		return $params;
	}

	public function frontsite_script () {
		if (!is_admin()) {
			wp_enqueue_script( 'nwaf-category-js', plugins_url( 'assets/frontsite.js', __FILE__ ), array( 'jquery' ), false, true ); 
			wp_enqueue_style( 'nwaf-category-css', plugins_url( 'assets/default.css', __FILE__ )); 
		}
	}
}
?>