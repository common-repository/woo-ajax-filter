<?php
namespace  NWAF\frontsite;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class frontsite {
	public function __construct() {
		// load css & js 
		add_action( 'wp_enqueue_scripts', array($this, 'safely_add_stylesheet_to_frontsite'));
		add_action( 'woocommerce_before_main_content', array($this, 'open_wrap'));
		add_action( 'woocommerce_after_main_content', array($this, 'close_wrap'));
		//load widget && elements
		\NWAF\helpers\factory::getInstance('elements\element');
	}

	public function safely_add_stylesheet_to_frontsite() {
		wp_enqueue_style( 'nwaf-frontsite-style', NWAF_URL . 'frontsite/assets/css/default.css' );
        wp_enqueue_script( 'nwaf-frontsite-js', NWAF_URL . 'frontsite/assets/js/default.js', array( 'jquery' ), false, true ); 
        wp_localize_script( 'nwaf-frontsite-js', 'NWAFg', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
	}

	public function open_wrap () {
		return '<div class="nwaf-wrapper-products">';
	}

	public function close_wrap () {
		return '</div>';
	}
}