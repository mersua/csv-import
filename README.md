### Run project:

```php
cp .env.test .env
docker-compose up --build -d
cd app
cp .env.test .env
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

### Run phpunit tests:

```php

```