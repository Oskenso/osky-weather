# ARCHIVED
This was originally written rapidly one night before an interview

# Osky Weather

Display local user's weather information as quickly as possible

## Running application

`cd src`https://www.opendatasoft.com/?hsLang=en
`composer install && npm install`

Make sure to copy .env.example to .env and provide
the DARKSKY_SECRET key you can obtain from [darksky.net](https://darksky.net/)


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


MIT License

Copyright © 2020 Oskenso Kashi <contact@oskenso.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.


----------------------------------------------------------------------
US Zip Code Latitude and Longitude dataset is provided by
[opendatasoft](https://public.opendatasoft.com/explore/dataset/us-zip-code-latitude-and-longitude/export/)
and is licensed under the Creative Commons Attribution Share-Alike (cc-by-sa)
