const dotenv = require( 'dotenv' );
const wait_on = require( 'wait-on' );
const { execSync } = require( 'child_process' );

dotenv.config();

// Once the site is available, install WordPress!
wait_on( { resources: [ `tcp:localhost:8890`] } )
	.then( () => {
		wp_cli( 'db reset --yes' );
        wp_cli( `core install --title="Astra" --admin_user=admin --admin_password=password --admin_email=test@test.com --skip-email --url=http://localhost:8890` );
        wp_cli( 'theme activate astra' );
        wp_cli( 'plugin activate astra-e2e-plugins' );
	} );

/**
 * Runs WP-CLI commands in the Docker environment.
 *
 * @param {string} cmd The WP-CLI command to run.
 */
function wp_cli( cmd ) {
	execSync( `docker-compose -f bin/local-env/docker-compose.yml run --rm cli ${cmd}`, { stdio: 'inherit' } );
}
