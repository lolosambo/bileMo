DOCKER = docker

ENV_PHP = $(DOCKER) exec bileMo_php-fpm
ENV_COMPOSER = $(ENV_PHP) composer
ENV_BLACKFIRE = $(DOCKER) exec bileMo_blackfire

## SYMFONY commandes
console:
	    $(ENV_PHP) ./bin/console $(COMMAND)

## ENV commandes
cache-clear: var/cache
	    $(ENV_PHP) rm -rf var/cache/*

router: ##debug router
	    $(ENV_PHP) ./bin/console debug:router

container: ##debug container
	    $(ENV_PHP) ./bin/console debug:container

## DOCTRINE commands
create-database: #create postrgesql database
	    $(ENV_PHP) ./bin/console doctrine:database:create

schema-validate: config/doctrine
	    $(ENV_PHP) ./bin/console doctrine:schema:validate 

schema-update: config/doctrine
	    $(ENV_PHP) ./bin/console doctrine:schema:update --force

doctrine-cache-clear: ## make the doctrine cache empty
	    $(ENV_PHP) ./bin/console doctrine:cache:clear-metadata

fixtures: ## load fixtures in the database
	    $(ENV_PHP) ./bin/console doctrine:fixtures:load

drop-database: ##cancel full database
	    $(ENV_PHP) ./bin/console doctrine:database:drop --force


## PHPUNIT commands
all-tests: tests
	    $(ENV_PHP) ./bin/phpunit -v

unit-tests: tests
	    $(ENV_PHP) ./bin/phpunit -v --group unit

functional-tests: tests
	    $(ENV_PHP) ./bin/phpunit -v --group functional

blackfire-tests: tests
	    $(ENV_PHP) ./bin/phpunit -v --group Blackfire

coverage: tests
	    $(ENV_PHP) ./bin/phpunit --coverage-text

## COMPOSER commands
require: composer.json
	    $(ENV_COMPOSER) require $(PACKAGE)

require-dev: composer.json
	    $(ENV_COMPOSER) require $(PACKAGE) --dev

composer-update: composer.lock
	    $(ENV_COMPOSER) update

composer-install: composer.lock
	    $(ENV_COMPOSER) install

autoload: composer.json
	    $(ENV_COMPOSER) dump-autoload -o

## BLACKFIRE commands
profile: ##profile a route with Blackfire
	    $(ENV_BLACKFIRE) blackfire curl http://172.22.0.1:8085$(URL) --samples $(SAMPLES)

blackfire-config: ##Blackfire config
	    $(ENV_BLACKFIRE) blackfire config



