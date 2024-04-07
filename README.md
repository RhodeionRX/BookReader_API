# BookReader API

## Deployment
###### Copy and rename `.env.example` file into `.env`
```bash
cp .env.example .env
```
Configure the database connection if needed in the `.env` file. 

**Notice**: The application is configured to use PostgreSQL as its Database Management System(**DBMS**). Using other **DBMS**s could potentically cause errors.

###### Run the container:
```bash
docker compose up (-d)
```
###### Run enter the container running PHP-server:
```bash
docker exec -it bookreader_backend-app-1 bash
```
###### Install dependencies: 
```bash
composer install
```

###### Run the migrations:
```bash
php artisan migrate
```

###### Generate app key:
```bash
php artisan key:generate
```
**Notice**: If the application is still asking to generate key, you should restart the container:
```bash
docker compose down
docker compose up (-d)
```
###### Clean cache
 ```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```
