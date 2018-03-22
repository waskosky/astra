<?php
/**
 * Astra Loop
 *
 * @package Astra
 * @since 1.0.0
 */

if( ! class_exists( 'Astra_Loop' ) ) :

	/**
	 * Astra_Loop
	 *
	 * @since 1.0.0
	 */
	class Astra_Loop {

		/**
		 * Instance
		 *
		 * @since 1.0.0
		 *
		 * @access private
		 * @var object Class object.
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.0.0
		 *
		 * @return object initialized object of class.
		 */
		public static function get_instance(){
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct()
		{
			add_action('astra_content_loop', array( $this, 'loop_markup' ) );			
			add_action('astra_template_parts_content', array( $this, 'template_parts' ) );			
			add_action('astra_template_parts_content_none', array( $this, 'template_parts_none' ) );			
		}

		/**
		 * Content Loop
		 * @since 1.0.0
		 */
		function template_parts_none() {
			if( is_archive() ) {
				get_template_part( 'template-parts/content', 'none' );
			}
		}

		function template_parts() {
			if( is_single( ) ) {
				get_template_part( 'template-parts/content', 'single' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			} else {

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', astra_get_post_format() );
			}
		}

		function loop_markup() {
			?>

			<!-- single.php -->
			<main id="main" class="site-main" role="main">

				<?php if ( have_posts() ) : ?>

					<?php if( is_archive() ) : astra_content_while_before(); endif; ?>

					<div class="ast-row">
					<?php
					while ( have_posts() ) :
						the_post();

						do_action( 'astra_template_parts_content' );
						?>

					<?php endwhile; ?>
					</div>

					<?php if( is_archive() ) : astra_content_while_after(); endif; ?>

				<?php else : ?>

					<?php do_action( 'astra_template_parts_content_none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->
			<?php
		}

	}

	/**
	 * Initialize class object with 'get_instance()' method
	 */
	Astra_Loop::get_instance();

endif;