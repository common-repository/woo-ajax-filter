<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$options = NWAF\helpers\factory::getInstance('helpers\options');
$html = NWAF\helpers\factory::getInstance('libs\helpers\html', '\NeoLibs');
// var_dump($html); die();
$taxs = wc_get_attribute_taxonomies();
$taxonomies = $options->get('taxonomies', '');
foreach ($taxs as $tax):
$namePrefix = '[taxonomies]['.$tax->attribute_name.']';
$terms = get_terms( wc_attribute_taxonomy_name($tax->attribute_name), 'orderby=name&hide_empty=0' );
?>
<div class="taxonomy-block">
	<h3 class="title"><?php echo $tax->attribute_label; ?> <span class="shortcode">[nwaf_taxonomy tax="<?php echo $tax->attribute_label; ?>"]</span></h3>
	<div class="block-options">
		<div class="row">
			<label class="neo-wc-label"><?php esc_html_e('Display Type', 'nwaf'); ?></label>
			<div>
				<?php echo $html->select(
					$options->names($namePrefix.'[type]'), 
					$options->get('taxonomies.'.$tax->attribute_name.'.type', 'list', true),
					array(
						array('text' => esc_html__('Color', 'nwaf'), 'value' => 'color'),
						array('text' => esc_html__('Dropdown', 'nwaf'), 'value' => 'dropdown'),
						array('text' => esc_html__('Label', 'nwaf'), 'value' => 'label'),
						array('text' => esc_html__('List', 'nwaf'), 'value' => 'list')
					)
				); ?>
			</div>
		</div>
		<div class="row">
			<label class="neo-wc-label"><?php esc_html_e('Query Type', 'nwaf'); ?></label>
			<div>
				<?php echo $html->select(
					$options->names($namePrefix.'[query_type]'), 
					$options->get('taxonomies.'.$tax->attribute_name.'.query_type', 'or', true),
					array(
						array('text' => esc_html__('And', 'nwaf'), 'value' => 'and'),
						array('text' => esc_html__('Or', 'nwaf'), 'value' => 'or')
					)
				); ?>
			</div>
		</div>
		<div class="row">
			<label class="neo-wc-label"><?php esc_html_e('Term', 'nwaf'); ?></label>
			<div class="terms">
				<?php foreach($terms as $term): ?>
					<div class="term">
						<span class="name"><?php echo $term->name; ?></span>
						<span class="values">
							<span class="label">
								<input class="neo-wc-input" type="text" placeholder="<?php esc_html_e('Custom Label', 'nwaf'); ?>"
										name="<?php echo $options->names($namePrefix.'[label]['.$term->slug.']'); ?>" 
										value="<?php echo $options->get('taxonomies.'.$tax->attribute_name.'.label.'.$term->slug, $term->name, true)?>">
							</span>
							<span class="color">
								<input class="neo-wc-input" type="text" 
										name="<?php echo $options->names($namePrefix.'[color]['.$term->slug.']'); ?>" 
										value="<?php echo $options->get('taxonomies.'.$tax->attribute_name.'.color.'.$term->slug, '', true)?>">
							</span>
						</span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>	
	</div>
</div>
<?php endforeach; ?>