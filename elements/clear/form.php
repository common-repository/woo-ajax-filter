<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$options = NWAF\helpers\factory::getInstance('helpers\options');
?>
<div class="taxonomy-block">
	<h3 class="title"><?php esc_html_e('Clear Button', 'nwaf'); ?></h3>
	<div class="block-options">
		<div class="row">
			<label class="neo-wc-label"><?php esc_html_e('Clear Text', 'nwaf'); ?></label>
			<div>
				<input class="neo-wc-input" type="text" 
					name="<?php echo $options->names('[clear][text]'); ?>" 
					value="<?php echo $options->get('clear.text', esc_html__('Clear All', 'nwaf'), true); ?>"/> 				
			</div>
		</div>
	</div>
</div>
	
