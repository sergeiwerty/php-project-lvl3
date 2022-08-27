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
	php artisan db:seed
	npm ci
	npm run build

install:
	composer install

validate:
	composer validate

lint:
	composer exec --verbose phpstan -- --level=8 analyse app routes tests database
	composer exec phpcs -- --standard=PSR12 app

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 app routes tests database lang

test:
	php artisan test

test-coverage:
	XDEBUG_MODE=coverage php artisan test --coverage-clover build/logs/clover.xml
