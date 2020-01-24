## About WeatherMate

WeatherMate is a simple weather application for tourists in Japan. It fetches the current weather and the weather every three(3) hours. 

WeatherMate is developed using Vue for frontend and Laravel for the backbone.

This is not for commercial use. Created solely for the coding test in Bizmates.

# Getting Started

## Install Dependencies
- composer update

## Install Node Module Dependencies
- npm install

## Generate Encryption Key
- php artisan key:generate

## Notes

- Used VueJS for frontend. First time using it and had fun digging deeper in the concep t of the framework.

- Encountered problem in CORS when accessing api. The reason might be because this is running in localhost that's why the api server does not allow access. To resolve this, I used a proxy server.

