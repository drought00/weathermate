<template>
    <div class="forecast row">
        <div class="container">
            <div class="col l2 m3 s4" v-for="item in list" v-bind:key="item.id">
                <div class="card">
                    <div class="card-date">{{ item.dt_txt }}</div>
                    <div class="card-image">
                        <img :src="'http://openweathermap.org/img/wn/' + item.weather[0].icon + '@2x.png'">
                    </div>
                    <div class="card-content">
                        <span class="card-title">{{ item.main.temp }}°</span>
                        <p>{{ item.weather[0].description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</template>
<script>
    let vue; 
    import { EventBus } from '../eventbus.js';
    EventBus.$on('_getWeather', location => {
        this.country_code = location[0]
        this.city = location[1]
    });
    export default {
        data() {
            return {
                list: [{
                    main: {
                        temp: '',
                        temp_min: '',
                        temp_max: ''
                    },
                    weather: [{
                        description: '',
                        icon: ''
                    }]
                }],
                city: "Osaka",
                country_code: "JP"
            }
        },
        created() {
            vue = this;
            this.fetchForecast(this.city,this.country_code);
        },
        methods: {
            fetchForecast(city,country_code) {
                const proxy_server = "https://cors-anywhere.herokuapp.com/";
                const weather_api_url = "https://api.openweathermap.org/"
                const url = proxy_server + weather_api_url + "data/2.5/forecast";
                axios.get(url, {
                    params: {
                        q: city + "," + country_code,
                        appid: "3f3a8cab0e562cee2cbaecb6bba20f5a",
                        units: "metric"
                    }
                }).then(res => { 
                    this.list = res.data.list
                    this.city = res.data.city
                });
            }
        }
    }
    EventBus.$on('getWeather', location => {
        vue.fetchForecast(location[0],location[1])
    });
</script>