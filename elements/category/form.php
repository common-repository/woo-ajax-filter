<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$options = NWAF\helpers\factory::getInstance('helpers\options');
?>
<div class="taxonomy-block">
	<h3 class="title"><?php esc_html_e('Category', 'nwaf'); ?></h3>
	<div class="block-options">
		<div class="row">
			<label class="neo-wc-label"><?php esc_html_e('Parent Category ID', 'nwaf'); ?></label>
			<div>
				<input class="neo-wc-input" type="text" 
					name="<?php echo $options->names('[category][parent_id]'); ?>" 
					value="<?php echo $options->get('category.parent_id', '', true); ?>"/> 				
			</div>
		</div>
	</div>
</div>
	
