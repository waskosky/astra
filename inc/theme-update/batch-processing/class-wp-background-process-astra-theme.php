<?php
/**
 * Database Background Process
 *
 * @package Astra
 * @since 2.0.0
 */

if ( class_exists( 'WP_Background_Process' ) ) :

	/**
	 * Database Background Process
	 *
	 * @since 2.0.0
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
			return sleep( 5 );
		}

		/**
		 * Task
		 *
		 * Override this method to perform any actions required on each
		 * queue item. Return the modified item for further processing
		 * in the next pass through. Or, return false to remove the
		 * item from the queue.
		 *
		 * @since 2.0.0
		 *
		 * @param object $process Queue item object.
		 * @return mixed
		 */
		protected function task( $process ) {

			// Enable this function if we need to halt the process for few seconds between tasks.
			// $this->really_long_running_task(); .

			do_action( 'astra_batch_process_task'. '-' .$process , $process );

			if( method_exists('Astra_Theme_Update', $process) ) {
				call_user_func( array( 'Astra_Theme_Update', $process ) );
			}

			error_log( 'in task function' );

			return false;
		}

		/**
		 * Complete
		 *
		 * Override if applicable, but ensure that the below actions are
		 * performed, or, call parent::complete().
		 *
		 * @since 2.0.0
		 */
		protected function complete() {

			error_log( 'Batch Process Completed!' );

			do_action( 'astra_database_migration_complete' );

			parent::complete();

		}

	}

endif;
