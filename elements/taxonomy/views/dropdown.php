<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	$colors = $tax['color'];
	$lalbels = $tax['label'];
?>
<select class="neo-wc-ajax-filter-term-<?php echo $term; ?> nwaf-show-type-dropdown"
	data-filter-key="filter_"
	data-filter-term=<?php echo $term; ?>
	data-filter-value=<?php echo $key; ?>
>
	<?php foreach ($colors as $key => $color): ?>
		<option value="<?php echo $key; ?>"><?php echo $lalbels[$key]; ?></option>
	<?php endforeach; ?>
</select>

