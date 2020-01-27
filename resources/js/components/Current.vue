<template>
    <div class="current">
        <div class="date">Current Weather</div>
        <div class="temp">{{ weather.temperature }}° </div>
        <div class="sub">{{ weather.temperature_max }}° / {{ weather.temperature_min }}°</div>
        <div class="sub">{{ weather.description }}</div>
        <div class="location">{{ weather.location }}</div>
    </div>
</template>
<script>
    export default {
        props : ['weather']
    }
</script>