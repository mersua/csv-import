### Run project:

```php
cp .env.test .env
docker-compose up --build -d
cd app
cp .env.test .env
docker exec -it <php-cli-container_name> bash
composer install
```

### Run any docker container:

```php
docker exec -it <container_name> bash
```

### List all running docker containers:

```php
docker ps
```

### Containers logs:

```php
docker logs <container_name>
```
### Run csv import inside php-cli docker container (create folder var/data and move importing csv file into that folder):

```php
mkdir var/data
bin/console app:import-csv <csv_file_name> [--test]
```