<template>
    <div class="col l2 m3 s4">
        <div class="card">
            <div class="card-date date">{{ forecast.date }}</div>
            <div class="card-time">{{ forecast.time }}</div>
            <div class="card-image">
                <img :src="'http://openweathermap.org/img/wn/' + forecast.icon + '@2x.png'">
            </div>
            <div class="card-content">
                <span class="card-title">{{ forecast.temp }}°</span>
                <p>{{ forecast.description }}</p>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props : ['forecast']
    }
</script>