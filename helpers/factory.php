<?php 
namespace NWAF\helpers;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class factory {
	private static $instance = array();

	public static function getInstance($name = '', $namespace = 'NWAF') {
		if ($name == '') return false;
		$class = $namespace.'\\'.$name;
		if (!isset(static::$instance[$class])) {
			static::$instance[$class] = new $class;
		}
        
        return static::$instance[$class];
    }
}
?>