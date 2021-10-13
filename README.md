## clone repository
```
git clone git@github.com:danielwitas/users.git
cd users/
```
## Init docker setup
```
sh install.sh
```
## Build
```
docker-compose up
```
### Webpage
See [http://localhost:8080](http://localhost:8080)
### Troubleshooting
```
If for some reason automatic setup installation fails
here are some handy commands to run:

To run composer install manually:
docker-compose run --rm php74-service composer install

To create database manually:
docker-compose run --rm php74-service php bin/console doctrine:database:create

To create database schema manually:
docker-compose run --rm php74-service php bin/console doctrine:schema:update --force

To load application fixtures manually:
docker-compose run --rm php74-service php bin/console doctrine:fixtures:load -q

If all fails. You can try to remove all unused containers, networks,
images (both dangling and unreferenced), and optionally, volumes. Run:
docker system prune
And try again... or just go and watch some netflix :).
```
