.PHONY: help
help: ## Show this message
	@cat $(MAKEFILE_LIST) | grep -e "^[a-zA-Z_\-]*: *.*## *" | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: start
start: ## Run containers
	docker-compose up --build -d

.PHONY: stop
stop: ## Stop containers
	docker-compose down

.PHONY: ps
ps: ## List containers
	docker-compose ps

.PHONY: ssh
ssh: ## Run ssh in the php container
	docker-compose exec php bash -i

.PHONY: composer
composer: ## Run composer in the php container
	docker-compose exec php COMPOSER_MEMORY_LIMIT=-1 composer $(filter-out $@,$(MAKECMDGOALS))

.PHONY: art
art: ## Run artisan in the php container
	docker-compose exec php php artisan $(filter-out $@,$(MAKECMDGOALS))

.PHONY: test
test: ## Run all tests
	docker-compose exec php vendor/bin/phpunit --coverage-html ./storage/coverage/  --coverage-text

.PHONY: test-unit
test-unit: ## Run only unit tests
	docker-compose exec php vendor/bin/phpunit --testsuite=Unit --coverage-html ./storage/coverage/ --coverage-text

.PHONY: test-feature
test-feature: ## Run only feature tests
	docker-compose exec php vendor/bin/phpunit --testsuite=Feature --coverage-html ./storage/coverage/ --coverage-text

%:#Dyrty hack for replace original behavior with goals
	@:
