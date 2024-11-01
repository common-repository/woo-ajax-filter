<?php 
namespace NWAF\classes;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class element {

	public function __construct() {
		add_action('nwaf_admin_element_form', array($this, 'form'), 5);
	}

	public function form() {
		$rc = new \ReflectionClass(get_class($this));
        $form = dirname($rc->getFileName()). '/form.php';
        if (file_exists($form)) {
			require_once $form;
		}
	}
	public function view($file) {

		$theme = NWAF_THEME_PATH.str_replace(dirname(NWAF_DIR), '', $file);
		
		if (file_exists($theme)) {
			return $theme;
		}

		if (file_exists($file)) {
			return $file;
		}

		return fasle;
	}


}
?>