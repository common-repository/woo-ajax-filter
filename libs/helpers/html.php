<?php 
namespace NeoLibs\libs\helpers;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class html {
	private static $instance;

	public static function getInstance() {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

	public function __construct() {
		
	}

	public function select($name, $default, $options = array()) {
		$html = '<select name="'.$name.'">';
		foreach ($options as $option) {
			$select = ($option['value'] == strtolower($default)) ? 'selected' : '';
			$html .= '<option '.$select.' name="'.$option['value'].'">'.$option['text'].'</option>';
		}
		$html .= '</select>';
		return $html;
	}
}
?>