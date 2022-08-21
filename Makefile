
install:
	composer install

validate:
	composer validate

lint:
	composer exec phpcs -- --standard=PSR12 app

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src tests

test:
	composer exec --verbose phpunit tests

test-coverage:
	composer exec --verbose XDEBUG_MODE=coverage phpunit tests -- --coverage-clover build/logs/clover.xml