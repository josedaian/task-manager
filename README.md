# Tasks Manager Docker
### Services
- Nginx
- PHP 8.1
- MYSQL 8.0
- Laravel 9.6
- Redis 6.2.6

## How to install
After cloning the repository and being inside the project folder, run the following commands:
```sh
cp .env.example .env
docker-compose up -d
# database migrations
docker exec -it api-tasks php artisan migrate
# To activate the queue worker
docker exec -it api-tasks php artisan queue:work --queue=default
```

### Optional Step
In .env file you can set custom ports for services:
- API (default: 8000)
- UI (default: 8009)
- Redis (default: 6379)

## License

MIT
