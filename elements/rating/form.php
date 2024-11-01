<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$options = NWAF\helpers\factory::getInstance('helpers\options');
$defaultTexts = array(
	5 => esc_html__('Exellent', 'nwaf'),
	4 => esc_html__('Good', 'nwaf'),
	3 => esc_html__('Average', 'nwaf'),
	2 => esc_html__('Fair', 'nwaf'),
	1 => esc_html__('Poor', 'nwaf')
);
?>
<div class="taxonomy-block">
	<h3 class="title">Rating: <span class="shortcode">[nwaf_rating]</span></h3>
	<div class="block-options">
		
		<?php for ($rating = 5; $rating > 0; $rating--): ?>
			<div class="row">
				<?php echo $rating; ?>.
				<input name="<?php echo $options->names('[rating][text]['.$rating.']'); ?>" 
					value="<?php echo $options->get('rating.text'.$rating, $defaultTexts[$rating], true); ?>"/>
			</div>
		<?php endfor; ?>
		
	</div>
</div>