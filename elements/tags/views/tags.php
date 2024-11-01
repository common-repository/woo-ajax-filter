<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$terms = get_terms( 'product_tag' );
?>
<div class="nwaf-element-tags tagcloud">
	<?php foreach ($terms as $key => $term): ?>
		<a 
		data-filter-key="product_"
		data-filter-term="tag"
		data-filter-value=<?php echo $term->slug; ?>
	><?php echo $term->name; ?></a>		
	<?php endforeach; ?>	
</div>