<?php
/**
 * Database Background Process
 *
 * @package Astra
 * @since x.x.x
 */

if ( class_exists( 'WP_Background_Process' ) ) :

	/**
	 * Database Background Process
	 *
	 * @since x.x.x
	 */
	class WP_Background_Process_Astra_Theme extends WP_Background_Process {

		/**
		 * Database Process
		 *
		 * @var string
		 */
		protected $action = 'database_migration';

		/**
		 * Really long running process
		 *
		 * @return int
		 */
		public function really_long_running_task() {
			return sleep( 1 );
		}

		/**
		 * Task
		 *
		 * Override this method to perform any actions required on each
		 * queue item. Return the modified item for further processing
		 * in the next pass through. Or, return false to remove the
		 * item from the queue.
		 *
		 * @since x.x.x
		 *
		 * @param object $process Queue item object.
		 * @return mixed
		 */
		protected function task( $group ) {

			// $this->really_long_running_task();

			$new_data = Astra_Theme_Update::new_function( $group );

			Astra_Theme_Update::v_2_0_0_update( $new_data );

			return false;
		}

		/**
		 * Complete
		 *
		 * Override if applicable, but ensure that the below actions are
		 * performed, or, call parent::complete().
		 *
		 * @since x.x.x
		 */
		protected function complete() {

			error_log( 'Batch Process Complete!' );

			do_action( 'astra_database_migration_complete' );

			parent::complete();

		}

	}

endif;
