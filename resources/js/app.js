// app.js
import('./bootstrap');
import {createApp} from 'vue/dist/vue.esm-bundler'
//import Vue from 'vue';

//window.Vue = require('vue');
//window.axios = require('axios');


//Vue components

// import cardList from "./components/card-list.vue";

import CardList from './CardList.vue'
const cardList = createApp({});
cardList.component('cardList', CardList);
cardList.mount('#app');

//createApp(CardList).mount("#card-list1");
//createApp(CardList).mount("#card-list2");




//const app = createApp({});

//Register components
//app.component('card-list', cardList);

//Mount the app
//app.mount("#app");


