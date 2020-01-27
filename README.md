## Change Note

* More PHP Laravel implementation
* Improved UI/UX

** IMPORTANT: Make sure to update your .env file according to .env.example for the API keys

## About WeatherMate

WeatherMate is a simple weather application for tourists in Japan. It fetches the current weather and the weather every three(3) hours. WeatherMate is best viewed in mobile since travellers are always looking at their phone for updates. Simply search for the location that you want to check the weather. 

I implemented 3 apis for this. One for the location, another for the weather EVERY THREE HOURS and lastly for the CURRENT weather. The Current weather is not the api to be used listed in the email but decided to use it for the benefit of the customer.

WeatherMate is developed using Vue for frontend and Laravel for the backend.

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
- API Keys and API Urls should be in my .env file. Still looking for a way for VUE to read them directly in .env.
- Encountered problem in CORS when accessing api. Tried curl and postman and they were all working fine. The reason might be because this is running in localhost that's why the api server does not allow access. To resolve this, I used a proxy server.

