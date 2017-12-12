<?php
/**
 * Custom functions that used for Woocommerce compatibility.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2017, Astra
 * @link        http://wpastra.com/
 * @since       Astra 1.1.0
 */

/**
 * Shop page - Products Title markup updated
 */
if ( ! function_exists( 'astra_woocommerce_shop_products_title' ) ) :

	/**
	 * Shop Page product titles with anchor 
	 *
	 *
	 * @hooked woocommerce_after_shop_loop_item - 10
	 *
	 * @since 1.0.0
	 */
	function astra_woocommerce_shop_products_title(){
		echo '<a href="' . esc_url( get_the_permalink() ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';

		echo '<h2 class="woocommerce-loop-product__title">' . get_the_title() . '</h2>';

		echo '</a>';
	}

endif;

/**
 * Shop page - Parent Category
 */
if ( ! function_exists( 'astra_shop_loop_category' ) ) :
	/**
 	 * Add and/or Remove Categories from shop archive page.
	 *
	 * @hooked woocommerce_after_shop_loop_item - 9
	 *
	 * @since 1.0.0
	 */
	function astra_shop_loop_category(){
		if ( apply_filters( 'astra_woo_product_box_category', true ) ) : ?>
			<span class="ast-woo-product-category">
				<?php
				global $product;
				$product_categories = function_exists( 'wc_get_product_category_list' ) ? wc_get_product_category_list( get_the_ID(), ',', '', '' ) : $product->get_categories( ',', '', '' );

				$product_categories = strip_tags( $product_categories );
				if ( $product_categories ) {
					list( $parent_cat ) = explode( ',', $product_categories );
					echo esc_html( $parent_cat );
				}
				?>
			</span> <?php
		endif;
	}

endif;

/**
 * Shop page - Out of Stock
 */
if ( ! function_exists( 'astra_shop_out_of_stock' ) ) :
	/**
 	 * Add Out of Stock to the Shop page
	 *
	 * @hooked woocommerce_shop_loop_item_title - 8
	 *
	 * @since 1.0.0
	 */
	function astra_shop_out_of_stock(){
		$out_of_stock = get_post_meta( get_the_ID(), '_stock_status', true );
		if( 'outofstock' === $out_of_stock ) { ?>
			<span class="ast-shop-product-out-of-stock"><?php esc_html_e( 'Out of stock', 'astra' ); ?></span>
		<?php }
	}

endif;