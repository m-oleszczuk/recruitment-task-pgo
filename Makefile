# https://clarkgrubb.com/makefile-style-guide#phony-targets

DOCKER_BUILD_VARS := COMPOSE_DOCKER_CLI_BUILD=1 DOCKER_BUILDKIT=1
DOCKER_BUILD := ${DOCKER_BUILD_VARS} docker build

COMPOSE := $(DOCKER_BUILD_VARS) docker-compose

setup:
	${COMPOSE} pull --ignore-pull-failures --include-deps
	${COMPOSE} build
	${COMPOSE} run --rm php composer install

start:
	${COMPOSE} up -d

stop:
	${COMPOSE} down

destroy: stop
	${COMPOSE} rm --force --stop -v

run-tests:
	${COMPOSE} run --rm php php vendor/bin/phpunit

bash:
	${COMPOSE} run php bash

