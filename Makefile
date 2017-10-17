default: dev

dev: pull build run

pull:
	docker pull loreleiaurora/php-base:cli
	docker pull loreleiaurora/php-base:fpm
	docker pull nginx:mainline-alpine

build:
	docker build --no-cache -t howtoadhd/howtoadhd:app app
	docker build --no-cache -t howtoadhd/howtoadhd:php php
	docker build --no-cache -t howtoadhd/howtoadhd:nginx nginx

run:
	cd app; \
    composer install \
		--no-ansi \
		--dev \
		--no-interaction \
		--no-progress \
		--no-scripts

	cd .dev; \
	docker-compose \
		--project-name howtoadhd \
		up \
		--remove-orphans \
		--force-recreate