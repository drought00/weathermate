<template>
    <div class="container navbar row">
        <div class="col s12 l4 logo">
            <span class="txtblue">Weather</span>Mate
        </div>
        <div class="col s12 l8 search-container">
            <input v-on:click="toggleSearchResult()" v-model="location" v-on:input="debounceInput" type="text" class="search" placeholder="Search Location">
            <button v-on:click="submit " :disabled="!location" v-bind:class="[{disabled: isSearching}]" class="btn waves-effect waves-light" type="submit">Search</button>
            <div class="preloader-wrapper"  v-bind:class="[{active: isSearching}]">
                <div class="spinner-layer">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <div class="search-result" v-show="isShow" v-if="locations">
                <div class="select" v-for="item in locations" v-bind:key="item.id" v-on:click="getWeather(item.location.cc,item.location.city,item.name)">
                    <span class="name">{{ item.name }}</span>
                    <div class="details">
                        {{ item.location.formattedAddress }}
                        <span v-for="address in item.location.formattedAddress" v-bind:key="address.id">{{ address }} </span>
                    </div>
                </div>
            </div>
            <div class="search-result" v-show="isShow" v-else>
                <div class="select">
                    <span class="name">No Result Found</span>
                </div>
            </div>
            <form id="weather" action="search" method="POST">
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" name="country_code" v-model="country_code">
                <input type="hidden" name="city" v-model="city">
                <input type="hidden" name="name" v-model="name">
            </form>
        </div>
    </div>
</template>
<script>
    var debounce = require('debounce');
    export default {
        data() {
            return {
                isSearching: false,
                isShow: false,
                locations: [],
                location: '',
                country_code: '',
                city: '',
                name: '',
                item: [],
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        methods: {
            debounceInput: _.debounce(function () {
                this.search();
            }, 500),
            search() {
                const proxy_server = "https://cors-anywhere.herokuapp.com/";
                const location_api_url = "https://api.foursquare.com/"
                const url = proxy_server + location_api_url + "v2/venues/search";
                const cliend_id = "P5UFRKPM1CEBVTOALQL2XYAKQCWDIY10BDEUU4GMDZ0SHDGT";
                const client_secret = "2J4K32VPWYY2H1T5FMZDR4SPWVXFF3OW2CY4SAAMGJ3ZYFFV";
                const version = "20200101"
                this.isSearching=true
                axios.get(url, {
                    params: {
                        near: this.location,
                        client_id: cliend_id,
                        client_secret: client_secret,
                        v: version
                    }
                }).then(res => {
                    this.locations = res.data.response.venues
                    this.isShow = true
                    this.isSearching=false
                    this.country_code = this.locations[0].location.cc
                    this.city = this.locations[0].location.city       
                }).catch(error => {
                    this.locations = null
                    this.isShow = true
                    this.isSearching=false
                });
            },
            toggleSearchResult(){
                this.isShow = this.isShow ? false : true
            },
            getWeather(country_code,city,name){
                this.isShow = false
                this.location = this.name = name
                this.country_code = country_code
                this.city = city
            },
            submit() {
                document.getElementById("weather").submit();
            }
        }
    }
</script>