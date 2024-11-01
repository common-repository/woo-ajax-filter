<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$options = NWAF\helpers\factory::getInstance('helpers\options');
?>
<div class="nwaf-wrap">
	<div class="wrapper-inner">
		<form method="post" action="options.php">
		    <?php settings_fields(NWAF_OPTION_NAME); ?>
			<div class="page-header">
				<h1 class="page-title">WC Ajax Filter</h1>	
				<?php submit_button(); ?>
			</div>
			<div class="page-middle">
				<div class="page-left">
					<div class="page-left-inner">
						<textarea class="nwaf-layout" name="<?php echo $options->name('layout') ?>"><?php echo $options->get('layout', '') ?></textarea>
						<div class="note">Use this shortcode [nwaf]</div>
						
					</div>
				</div>
				<div class="page-right">
					<div class="page-right-inner">
						<h3 class="title"><?php esc_html_e('Element Setting', 'nwaf'); ?></h3>
						<div class="hint"></div>
						<div class="list">
							<?php do_action('nwaf_admin_element_form'); ?>	
						</div>
					</div>
				</div>
			</div>
			<div class="page-footer">
				<div class="copyright">
					<a href="#">Made by Coffee4Dev.com.</a>
					<a href="#">Document</a>
					<a href="#">Demo</a>
					<a href="#">Support</a>
					<a href="#">Forum</a>
				</div>
				<?php submit_button(); ?>
			</div>

		</form>
	</div>
</div>