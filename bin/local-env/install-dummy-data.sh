#!/bin/bash

# Exit if any command fails.
set -e

# Common variables.
DOCKER_COMPOSE_FILE_OPTIONS="-f $(dirname "$0")/docker-compose.yml"


# Import the file, then delete it.
docker-compose $DOCKER_COMPOSE_FILE_OPTIONS run --rm -u 33 $CLI plugin install wordpress-importer 
docker-compose $DOCKER_COMPOSE_FILE_OPTIONS run --rm -u 33 $CLI plugin activate wordpress-importer 
docker-compose $DOCKER_COMPOSE_FILE_OPTIONS run --rm -u 33 $CLI import data/a11y-theme-unit-test-data.xml --authors=create