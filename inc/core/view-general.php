<?php
/**
 * View General
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2018, Astra
 * @link        http://wpastra.com/
 * @since       Astra 1.0
 */

?>

<div class="wrap ast-clear">
	<div class="ast-theme-page-header">
		<div class="ast-container ast-flex">
			<div class="ast-theme-title">
				<span>
					<?php echo esc_html( $astra_theme_name ); ?>
				</span>
			</div>

	<?php
	if ( ! empty( $top_links ) ) :
		?>
		<div class="ast-top-links">
			<ul>
				<?php
				foreach ( (array) $top_links as $key => $link ) {
					echo '<li><a href="' . esc_url( $link['href'] ) . '" target="_blank" rel="noopener" >' . esc_html( $link['title'] ) . '</a></li>';
				}
				?>
			</ul>
		</div>
	<?php endif; ?>
		</div>
	</div>

	<div class="ast-container">
		<div id="poststuff">
			<div id="post-body" class="columns-2">
				<div id="post-body-content">
					<!-- All WordPress Notices below header -->
					<h1 class="screen-reader-text"> <?php esc_html_e( 'Astra', 'astra' ); ?> </h1>
						<?php do_action( 'astra_welcome_page_content_before' ); ?>

						<?php do_action( 'astra_welcome_page_content' ); ?>

						<?php do_action( 'astra_welcome_page_content_after' ); ?>
				</div>
				<div class="postbox-container" id="postbox-container-1">
					<div id="side-sortables">
						<?php do_action( 'astra_welcome_page_right_sidebar_before' ); ?>

						<?php do_action( 'astra_welcome_page_right_sidebar_content' ); ?>

						<?php do_action( 'astra_welcome_page_right_sidebar_after' ); ?>
					</div>
				</div>
			</div>
			<!-- /post-body -->
			<br class="clear">
		</div>


</div>
