## Getting started

### Pre-requisites
- docker
- docker-compose

### Check out this repository
`git clone git@github.com:wildalaskan/skeleton-app.git`

`cd skeleton-app`

### Run composer to kickstart laravel sail

```bash
docker run --rm \
    --pull=always \
    -v "$(pwd)":/opt \
    -w /opt \
    laravelsail/php82-composer:latest \
    bash -c "composer install"
```

### Run the application
`cp .env.example .env`

`./vendor/bin/sail up -d`

`./vendor/bin/sail artisan key:generate`

`./vendor/bin/sail artisan migrate`

### Kickstart the nuxt frontend
`./vendor/bin/sail npm install --prefix frontend`

### Run the frontend
`./vendor/bin/sail npm run dev --prefix frontend`

### Confirm your application
visit the frontend http://localhost:3000

visit the backend http://localhost:8888


### Connecting to your database from localhost
`docker exec -it laravel-mysql-1 bash -c "mysql -uroot -ppassword"`

Or use any database GUI and connect to 127.0.0.1 port 3333


### Other tips
`./vendor/bin/sail down` to bring down the stack

Sometimes it's necessary to restart the nuxt app when adding new routes. Simply `ctrl+c` on the npm command execute
`./vendor/bin/sail npm run dev --prefix frontend` again
