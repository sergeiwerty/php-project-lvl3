start:
	php artisan serve --host 0.0.0.0

start-frontend:
	npm run dev

setup:
	make install
	cp -n .env.example .env
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate
	npm ci
	npm run build

install:
	composer install

validate:
	composer validate

lint:
	composer exec phpcs -- --standard=PSR12 app

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src tests

test:
	php artisan test

test-coverage:
	XDEBUG_MODE=coverage php artisan test --coverage-clover build/logs/clover.xml
