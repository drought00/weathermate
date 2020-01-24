<template>
    <div class="current">
        <div class="sub">Current Weather</div>
        <div class="temp">{{ main.temp }}° </div>
        <div class="sub">{{ main.temp_max }}° / {{ main.temp_min }}°</div>
        <div class="sub">{{ weather[0].description }}</div>
        <div class="location">{{ name }}</div>
    </div>
</template>
<script>
    let vue; 
    import { EventBus } from '../eventbus.js';
    export default {
        data() {
            return {
                city: "Osaka",
                country_code: "JP",
                main: {
                    temp: '',
                    temp_min: '',
                    temp_max: ''
                },
                weather: [{
                    description: ''
                }],
                name: ''
            }
        },
        created() {
            vue = this;
            this.fetchCurrent(this.city,this.country_code);
        },
        methods: {
            fetchCurrent(city,country_code) {
                const proxy_server = "https://cors-anywhere.herokuapp.com/";
                const weather_api_url = "https://api.openweathermap.org/"
                const url = proxy_server + weather_api_url + "data/2.5/weather";
                axios.get(url, {
                    params: {
                        q: city + "," + country_code,
                        appid: "3f3a8cab0e562cee2cbaecb6bba20f5a",
                        units: "metric"
                    }
                }).then(res => { 
                    this.main = res.data.main
                    this.weather = res.data.weather
                    this.name = res.data.name
                });
            }
        }
    }
    EventBus.$on('getWeather', location => {
        vue.fetchCurrent(location[0],location[1])
    });
</script>