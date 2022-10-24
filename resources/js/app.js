import('./bootstrap');
import {createApp} from 'vue/dist/vue.esm-bundler';


//Vue components
import CardList from './CardList.vue'

const cardList = createApp({});

// Register components
cardList.component('cardList', CardList);

//Mount the app
cardList.mount('#app');



