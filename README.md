### Initial setup

```bash

# Create a copy of the example .env file
cp .env.example .env

#pull the images and run the containers
docker compose up -d

# Install dependencies ignore reqs since we use docker
composer install --ignore-platform-reqs 
npm install

# Generate an application key
php artisan key:generate

#DB_CONNECTION=mysql
#DB_HOST=192.168.1.130
#DB_PORT=3308
#DB_DATABASE=matthieu
#DB_USERNAME=pedro
#DB_PASSWORD=admin
#MYSQL_ROOT_PASSWORD=admin123
#MYSQL_ALLOW_EMPTY_PASSWORD=1
#where DB_HOST = local network ip adress

#from inside the docker container 
docker exec -it matthieu-cauchy-web-1 bash
php artisan migrate:fresh --seed

php artisan serve --port=8004

