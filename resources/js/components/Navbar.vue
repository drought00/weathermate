<template>
    <div class="container navbar row">
        <div class="col s12 l4 logo">
            <span class="txtblue">Weather</span>Mate
        </div>
        <div class="col s12 l8 search-container">
            <input v-on:click="toggleSearchResult()" v-model="location" type="text" class="search" placeholder="Search Location">
            <button v-on:click="search" v-bind:class="[{disabled: !location}]" class="btn waves-effect waves-light" type="submit">Search</button>
            <div class="search-result" v-show="isShow">
                <div class="select" v-for="item in locations" v-bind:key="item.id" v-on:click="getWeather(item.location.cc,item.location.city,item.name)">
                    <span class="name">{{ item.name }}</span>
                    <div class="details">
                        {{ item.location.formattedAddress }}
                         <span v-for="address in item.location.formattedAddress" v-bind:key="address.id">{{ address }} </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { EventBus } from '../eventbus.js';

    export default {
        data() {
            return {
                isShow: false,
                locations: [],
                location: '',
                selected: '',
                cc: ''
            }
        },
        methods: {
            search() {
                const proxy_server = "https://cors-anywhere.herokuapp.com/";
                const location_api_url = "https://api.foursquare.com/"
                const url = proxy_server + location_api_url + "v2/venues/search";
                const cliend_id = "P5UFRKPM1CEBVTOALQL2XYAKQCWDIY10BDEUU4GMDZ0SHDGT";
                const client_secret = "2J4K32VPWYY2H1T5FMZDR4SPWVXFF3OW2CY4SAAMGJ3ZYFFV";
                const version = "20200101"
                axios.get(url, {
                    params: {
                        near: this.location,
                        client_id: cliend_id,
                        client_secret: client_secret,
                        v: version
                    }
                }).then(res => {
                    this.locations=res.data.response.venues
                    this.isShow = true
                }).catch(error => {
                    alert("No Results Found")
                });
            },
            toggleSearchResult(){
                this.isShow = this.isShow ? false : true
            },
            getWeather(cc,city,name){
                this.location = name
                this.isShow = false
                EventBus.$emit('getWeather',[city,cc])
            }
        }
    }
</script>