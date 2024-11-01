<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function nwaf_autoload($className)
{
	$nameSpaces = array('NWAF', 'NeoLibs');
	foreach($nameSpaces as $value) {
		if (strrpos($className, $value) === false) {
			continue;
		}
		
		$fileName = NWAF_DIR . str_replace($value.'\\', '', $className);
		$fileName = str_replace('\\', DIRECTORY_SEPARATOR, $fileName) . '.php';
		
		require_once $fileName;	
	}
}
spl_autoload_register('nwaf_autoload');
?>