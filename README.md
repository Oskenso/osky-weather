# Osky Weather

Display local user's weather information as quickly as possible

## Running application

`cd src`
`composer install && npm install`

`cd ..`
`docker-compose build`
`docker-compose up -d`

Nagivate to http://localhost:9999/

## Development

First install dependencies 
`cat dependencies | xargs sudo apt-get install -y`

`cd src`
`composer install && npm install`
`npm run watch`

Nagivate to http://localhost:9999/

## Maintenance 
### Migration
`docker-compose exec weather-php php /var/www/artisan migrate`

