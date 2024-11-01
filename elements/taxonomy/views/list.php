<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	$colors = $tax['color'];
	$lalbels = $tax['label'];
?>
<form class="nwaf-filter-form nwaf-term-<?php echo $term; ?> nwaf-show-type-list">
	<input type="hidden" name="query_type_<?php echo $term; ?>" value="<?php echo strtolower($tax['query_type']); ?>">
	<?php foreach ($colors as $key => $color): ?>
		<a style="color:<?php echo esc_attr($color); ?>;" 
			data-color="<?php echo $color; ?>"
			data-filter-key="filter_"
			data-filter-term=<?php echo $term; ?>
			data-filter-value=<?php echo $key; ?>
		>
			<span 
				style="color: <?php echo $color; ?>; border-color: <?php echo $color; ?>; background-color: <?php echo $color; ?>" 
				class="checkbox">
				<span style="background-color: <?php echo $color; ?>" class="checked"><i class="fa fa-check"></i></span>
			</span>
			<span class="text"><?php echo $lalbels[$key] ?></span>
		</a>		
	<?php endforeach; ?>	
</form>


