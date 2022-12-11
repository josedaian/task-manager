# Tasks Manager Docker
### Services
- Nginx
- PHP 8.1
- Laravel 9.6
- Redis 6.2.6

## How to install
After cloning the repository and being inside the project folder, run the following commands:
```sh
cp .env.example .env
docker-compose up
```

### Optional Step
In .env file you can set custom ports for services:
- Nginx (default: 8000)
- Redis (default: 6379)

## License

MIT
