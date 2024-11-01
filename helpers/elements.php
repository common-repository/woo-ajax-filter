<?php 
namespace NWAF\helpers;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class elements {
	private static $instance;

	public static function getInstance() {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        
        return static::$instance;
    }

    public function list() {
    	$elements = array(
    		
		);
    }
}
?>