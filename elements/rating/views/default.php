<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$options = NWAF\helpers\factory::getInstance('helpers\options');
$rating = $options->get('rating.text', array(), true);

?>
<div class="nwaf-element-rating">
	<ul>
	<?php foreach ( $rating as $rate => $text ) : ?>
		<li>
			<a 
				data-filter-key="rating_"
				data-filter-term="filter"
				data-filter-value=<?php echo $rate; ?>
			>
				<span class="checkbox"><i class="fa fa-check"></i></span>
				<span class="rating rate-<?php echo $rate; ?>">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
				</span>
				<span class="text"><?php echo $text; ?></span>
			</a>	
		</li>
	<?php endforeach; ?>
	</ul>
</div>