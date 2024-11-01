<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	$orderby                 = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
	$show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
	$catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
		'menu_order' => __( 'Default sorting', 'woocommerce' ),
		'popularity' => __( 'Sort by popularity', 'woocommerce' ),
		'rating'     => __( 'Sort by average rating', 'woocommerce' ),
		'date'       => __( 'Sort by newness', 'woocommerce' ),
		'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
		'price-desc' => __( 'Sort by price: high to low', 'woocommerce' )
	) );

	if ( ! $show_default_orderby ) {
		unset( $catalog_orderby_options['menu_order'] );
	}

	if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
		unset( $catalog_orderby_options['rating'] );
	}
?>
<form class="nwaf-filter-form nwaf-element-soft" method="get">
	<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
		<div class="order nwaf-filter-element">
			<?php echo esc_html( $name ); ?>
			<input disabled type="hidden" name="orderby" value="<?php echo $id; ?>">
		</div>
	<?php endforeach; ?>
</form>