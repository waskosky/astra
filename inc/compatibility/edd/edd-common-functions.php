<?php
/**
 * Custom functions that used for Easy Digital Downloads compatibility.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2018, Astra
 * @link        https://wpastra.com/
 * @since       Astra x.x.x
 */

/**
 * Current Page is EDD page
 */
if ( ! function_exists( 'astra_is_edd_page' ) ) :

	/**
	 * Check current page is an EDD page
	 *
	 *
	 * @since x.x.x
	 * @return bool true | false
	 */
	function astra_is_edd_page() {
		if (
			is_singular( 'download' ) ||
			is_post_type_archive( 'download' ) ||
			is_tax( 'download_category' ) ||
			is_tax( 'download_tag' ) ||
			edd_is_checkout() ||
			edd_is_success_page() ||
			edd_is_failed_transaction_page() ||
			edd_is_purchase_history_page()
		) {
			return true;
		}
		return false;
	}

endif;

/**
 * Current Page is EDD single page
 */
if ( ! function_exists( 'astra_is_edd_single_page' ) ) :

	/**
	 * Check current page is an EDD single page
	 *
	 *
	 * @since x.x.x
	 * @return bool true | false
	 */
	function astra_is_edd_single_page() {
		if (
			is_singular( 'download' ) ||
			edd_is_checkout() ||
			edd_is_success_page() ||
			edd_is_failed_transaction_page() ||
			edd_is_purchase_history_page()
		) {
			return true;
		}
		return false;
	}

endif;

/**
 * Current Page is EDD archive page
 */
if ( ! function_exists( 'astra_is_edd_archive_page' ) ) :

	/**
	 * Check current page is an EDD archive page
	 *
	 *
	 * @since x.x.x
	 * @return bool true | false
	 */
	function astra_is_edd_archive_page() {
		if (
			is_post_type_archive( 'download' ) ||
			is_tax( 'download_category' ) ||
			is_tax( 'download_tag' )
		) {
			return true;
		}
		return false;
	}

endif;


/**
 * Current Page is EDD single Product page
 */
if ( ! function_exists( 'astra_is_edd_single_product_page' ) ) :

	/**
	 * Check current page is an EDD single product page
	 *
	 *
	 * @since x.x.x
	 * @return bool true | false
	 */
	function astra_is_edd_single_product_page() {
		if ( is_singular( 'download' ) ) {
			return true;
		}
		return false;
	}

endif;

if ( ! function_exists( 'astra_edd_archive_product_content' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	function astra_edd_archive_product_content() {
		$edd_structure = apply_filters( 'astra_edd_archive_product_structure', astra_get_option( 'edd-archive-product-structure' ) );

		if ( is_array( $edd_structure ) && ! empty( $edd_structure ) ) {

			do_action( 'astra_edd_archive_before_block_wrap' );
			echo '<div class="ast-edd-archive-block-wrap">';
			do_action( 'astra_edd_archive_block_wrap_top' );

			foreach ( $edd_structure as $value ) {

				switch ( $value ) {
					case 'title':
						/**
						 * Add Product Title on edd page for all products.
						 */
						do_action( 'astra_edd_archive_title_before' );
						edd_get_template_part( 'shortcode', 'content-title' );
						do_action( 'astra_edd_archive_title_after' );
						break;
					case 'image':
						/**
						 * Add Product Title on edd page for all products.
						 */
						do_action( 'astra_edd_archive_image_before' );
						edd_get_template_part( 'shortcode', 'content-image' );
						do_action( 'astra_edd_archive_image_after' );
						break;
					case 'price':
						/**
						 * Add Product Price on edd page for all products.
						 */
						do_action( 'astra_edd_archive_price_before' );
						edd_get_template_part( 'shortcode', 'content-price' );
						do_action( 'astra_edd_archive_price_after' );
						break;
					case 'short_desc':\
						/**
						 * Add Product short description on edd page for all products.
						 */
						do_action( 'astra_edd_archive_short_description_before' );
						edd_get_template_part( 'shortcode', 'content-excerpt' );
						do_action( 'astra_edd_archive_short_description_after' );
						break;
					case 'add_cart':
						do_action( 'astra_edd_archive_add_to_cart_before' );
						edd_get_template_part( 'shortcode', 'content-cart-button' );
						do_action( 'astra_edd_archive_add_to_cart_after' );



						break;
					case 'category':
						/**
						 * Add and/or Remove Categories from edd archive page.
						 */
						do_action( 'astra_edd_archive_category_before' );
						echo astra_edd_terms_list( 'download_category' );
						do_action( 'astra_edd_archive_category_after' );
						break;
					default:
						break;
				}
			}

			do_action( 'astra_edd_archive_block_wrap_bottom' );
			echo '</div>';
			do_action( 'astra_edd_archive_after_block_wrap' );
		}
	}
}

/**
 * Returns list of Easy Digital Downloads Terms
 *
 */
if ( ! function_exists( 'astra_edd_terms_list' ) ) {
	
	function astra_edd_terms_list( $taxonomy_name ) { 
		$terms = get_terms( $taxonomy_name );
	?>
	<div class="ast-edd-download-categories">
		<?php foreach ( $terms as $term ) : ?>
			<a href="<?php echo esc_attr( get_term_link( $term, $taxonomy_name ) ); ?>" title="<?php echo $term->name; ?>"><?php echo $term->name; ?></a>
		<?php endforeach; ?>
	</div>
	<?php }

}