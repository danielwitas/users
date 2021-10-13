#!/bin/bash
docker-compose build
docker-compose run --rm php74-service composer install
docker-compose run --rm php74-service php bin/console doctrine:database:create
docker-compose run --rm php74-service php bin/console doctrine:schema:update --force
docker-compose run --rm php74-service php bin/console doctrine:fixtures:load -q

