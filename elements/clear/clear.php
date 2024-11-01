<?php 
namespace NWAF\elements\clear;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class clear extends \NWAF\classes\element {
	public $atts = array();
	public function __construct() {
		// shortcode
		add_shortcode('nwaf_clear', array($this, 'clear_button'));
		add_shortcode('nwaf_active_filter', array($this, 'active_filter_bar'));

		add_action('nwaf_admin_element_form', array($this, 'form'), 5);
	}

	public function clear_button($atts) {
		$options = \NWAF\helpers\factory::getInstance('helpers\options');
		
		return '<div class="nwaf-clear-filter-block" data-count="0"><div class="nwaf-active-filter"></div><a href="#" class="nwaf-clear-filter">'.$options->get('clear.text', esc_html__('Clear All', 'nwaf'), true).'</a></div>';
	}

	public function active_filter_bar($atts) {
		return '<div class="nwaf-active-filter"></div>';
	}

	public function form() {
		require_once dirname(__FILE__). '/form.php';
	}
}
?>