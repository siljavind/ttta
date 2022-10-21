// app.js
import('./bootstrap');
import {createApp} from 'vue'
//import Vue from 'vue';


//window.Vue = require('vue');
//window.axios = require('axios');


//Vue components
import App from './App.vue'
import CardList from './CardList.vue'
//import cardList from "./components/card-list.vue";


createApp(App).mount("#app-app");
createApp(CardList).mount("#card-list");
//const app = createApp({});

//Register components
//app.component('card-list', cardList);

//Mount the app
//app.mount("#app");
