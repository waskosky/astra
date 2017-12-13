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
if ( ! function_exists( 'astra_woo_shop_products_title' ) ) :

	/**
	 * Shop Page product titles with anchor 
	 *
	 *
	 * @hooked woocommerce_after_shop_loop_item - 10
	 *
	 * @since 1.1.0
	 */
	function astra_woo_shop_products_title(){
		echo '<a href="' . esc_url( get_the_permalink() ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';

		echo '<h2 class="woocommerce-loop-product__title">' . get_the_title() . '</h2>';

		echo '</a>';
	}

endif;

/**
 * Shop page - Parent Category
 */
if ( ! function_exists( 'astra_woo_shop_parent_category' ) ) :
	/**
 	 * Add and/or Remove Categories from shop archive page.
	 *
	 * @hooked woocommerce_after_shop_loop_item - 9
	 *
	 * @since 1.1.0
	 */
	function astra_woo_shop_parent_category(){
		if ( apply_filters( 'astra_woo_shop_parent_category', true ) ) : ?>
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
if ( ! function_exists( 'astra_woo_shop_out_of_stock' ) ) :
	/**
 	 * Add Out of Stock to the Shop page
	 *
	 * @hooked woocommerce_shop_loop_item_title - 8
	 *
	 * @since 1.1.0
	 */
	function astra_woo_shop_out_of_stock(){
		$out_of_stock        = get_post_meta( get_the_ID(), '_stock_status', true );
		$out_of_stock_string = apply_filters( 'astra_woo_shop_out_of_stock_string', __( 'Out of stock', 'astra' ) );
		if( 'outofstock' === $out_of_stock ) { ?>
			<span class="ast-shop-product-out-of-stock"><?php echo esc_html( $out_of_stock_string ); ?></span>
		<?php }
	}

endif;

/**
 * Shop page - Short Description
 */
if ( ! function_exists( 'astra_woo_shop_product_short_description' ) ) :
	/**
	 * Product short description
	 *
	 * @hooked woocommerce_after_shop_loop_item
	 *
	 * @since 1.1.0
	 */
	function astra_woo_shop_product_short_description() {
	?>
	<?php if ( has_excerpt() ) { ?>
		<div class="ast-woo-shop-product-description">
			<?php the_excerpt(); ?>
		</div>
	<?php } ?>
	<?php
	}
endif;
/**
 * Product page - Availability: in stock
 */
if ( ! function_exists( 'astra_woo_product_in_stock' ) ) :
	/**
	 * Availability: in stock string updated
	 *
	 * @since 1.1.0
	 */
	function astra_woo_product_in_stock( $markup, $product ) {

		if ( is_product() ) {
			$product_avail = $product->get_availability();
			$stock_quantity = $product->get_stock_quantity();
			$availability = $product_avail['availability'];
			if ( ! empty( $availability ) && $stock_quantity ) {
				ob_start(); ?>
				<p class="stock in-stock">
					<?php /* translators: 1: in stock string */
					printf( __( '<span class="ast-stock-avail">Availability:</span> %s', 'astra' ), $availability ); ?>
				</p>
				<?php $markup = ob_get_clean();
			}
		}
		
		return $markup;
	}
endif;

/**
 * Cart Page - Return to Shopping button
 */
if ( ! function_exists( 'astra_woo_return_to_shopping' ) ) :
	
	/**
	 * Add return to shopping button.
	 *
	 * @since 1.1.0
	 */
	function astra_woo_return_to_shopping() { ?>
		<p class="ast-return-to-shop return-to-shop">
			<a class="button wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
				<?php _e( 'Return to shop', 'woocommerce' ) ?>
			</a>
		</p>
	<?php }
endif;