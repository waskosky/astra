const dotenv = require( 'dotenv' );
const { execSync } = require( 'child_process' );
dotenv.config();

// Execute any docker-compose command passed to this script.
execSync( 'docker-compose -f bin/local-env/docker-compose.yml ' + process.argv.slice( 2 ).join( ' ' ), { stdio: 'inherit' } );
