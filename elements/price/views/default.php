<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$prices = 5;
$step = 50;
$symbol = '$';
?>
<form method="GET" action="#" class="nwaf-filter-form nwaf-element-price">
	<?php for ($i = 1; $i <= $prices; $i++): ?>
		<div class="price nwaf-filter-element">
			<?php 
				$min = number_format($step * ($i-1), 2);
				$max = number_format($step * $i, 2);
			?>
			<?php echo $symbol . $min . '-' . $max; ?> 
			<input disabled type="hidden" name="min_price" value="<?php echo $min; ?>">
			<input disabled type="hidden" name="max_price" value="<?php echo $max; ?>">
		</div>
	<?php endfor; ?>
	<div class="price nwaf-filter-element">
		<?php 
			$max = number_format($step * $prices, 2);
		?>
		<?php echo $symbol . $max . '+'; ?> 
		<input disabled type="hidden" name="min_price" value="<?php echo $min; ?>">
	</div>
</form>