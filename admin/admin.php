<?php 
namespace  NWAF\admin;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class admin {
	public function __construct() {
		// options page
		new classes\options();
	}
}
?>