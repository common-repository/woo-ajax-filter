<?php 
namespace NWAF\elements;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class element {
	public function __construct() {
		// load 
		$this->load();

		// widget
		add_shortcode('nwaf', array($this, 'shortcode'));
	}

	public function shortcode() {
		$options = \NWAF\helpers\factory::getInstance('helpers\options');
		$layout = $options->get('layout', '', true);
		if ($layout != '') {
			return do_shortcode($layout);
		}
		return '';
	}
	public function load() {
		$elements = glob(NWAF_ELEMENTS_DIR. '*/', GLOB_ONLYDIR);
		if (is_array($elements)) {
			foreach ($elements as $key => $value) {
				$className = 'elements\\'.basename($value).'\\'.basename($value);
				\NWAF\helpers\factory::getInstance($className);
			}
		}
	}
}
?>