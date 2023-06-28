# variable for ./vendor/bin/sail
SAIL=./vendor/bin/sail
#variable to run sail up
SAIL_UP=$(SAIL) up -d
#variable to run sail down
SAIL_DOWN=$(SAIL) down
#variable to run sail artisan
SAIL_ARTISAN=$(SAIL) artisan
#variable to run sail composer
SAIL_COMPOSER=$(SAIL) composer
#variable to run sail npm
SAIL_NPM=$(SAIL) npm
#variable to run sail npm run dev
SAIL_NPM_RUN_DEV=$(SAIL) npm run dev
#command to run sail up
up:
	$(SAIL_UP)
#command to run sail down
down:
	$(SAIL_DOWN)
#command for sail and arguments
sail:
	$(SAIL) $(filter-out $@,$(MAKECMDGOALS))
#command to run sail artisan with arguments
sail_artisan:
	$(SAIL_ARTISAN) $(filter-out $@,$(MAKECMDGOALS))
#command to run sail composer
composer:
	$(SAIL_COMPOSER) $(filter-out $@,$(MAKECMDGOALS))
#command to run sail npm
npm:
	$(SAIL_NPM) $(filter-out $@,$(MAKECMDGOALS))
#command to run sail npm run dev
npm-run-dev:
	$(SAIL_NPM_RUN_DEV) $(filter-out $@,$(MAKECMDGOALS))
#command to run sail npm run watch
npm-run-watch:
	$(SAIL_NPM_RUN_WATCH) $(filter-out $@,$(MAKECMDGOALS))


