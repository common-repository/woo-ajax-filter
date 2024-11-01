<?php 
namespace NeoLibs\libs\helpers;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class options {
	protected $optionsName = '';
	protected $options;
	private static $instance;

	public static function getInstance() {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

	public function __construct() {
		$this->options = get_option($this->optionsName);
	}

	public function name($name) {
		return $this->optionsName . '['.$name.']';
	}
	
	public function names($name) {
		return $this->optionsName .$name;
	}

	public function get($name, $default = false, $resc = false) {
		if ($resc) {
			$names = explode('.', $name);
			$options = $this->options;
			foreach ($names as $key => $value) {
				if (isset($options[$value])) {
					$options = $options[$value];	
				} else {
					return $default;
				}
			}
			return $options;
		} else {
			if (isset($this->options[$name])) {
				return $this->options[$name];
			} 	
		}
		
		return $default;
	}
}
?>