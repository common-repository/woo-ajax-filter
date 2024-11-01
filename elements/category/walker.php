<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$file = dirname(NWAF_DIR).'/woocommerce/includes/walkers/class-product-cat-list-walker.php';
if (!file_exists($file)) return;
class wc_categories_widget_walker_category extends WC_Product_Cat_List_Walker {
	public function start_el( &$output, $cat, $depth = 0, $args = array(), $current_object_id = 0 ) {
		$output .= '<li class="cat-item cat-item-' . $cat->term_id;

		if ( $args['current_category'] == $cat->term_id ) {
			$output .= ' current-cat';
		}

		if ( $args['has_children'] && $args['hierarchical'] ) {
			$output .= ' cat-parent';
		}

		if ( $args['current_category_ancestors'] && $args['current_category'] && in_array( $cat->term_id, $args['current_category_ancestors'] ) ) {
			$output .= ' current-cat-parent';
		}

		$output .=  '"><a data-filter-key="product_" data-filter-term="cat" data-filter-value="'.$cat->slug.'" href="' . get_term_link( (int) $cat->term_id, $this->tree_type ) . '">' . _x( $cat->name, 'product category name', 'woocommerce' ) . '</a>';

		if ( $args['show_count'] ) {
			$output .= ' <span class="count">(' . $cat->count . ')</span>';
		}
	}
}
?>