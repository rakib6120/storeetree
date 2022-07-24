require('./bootstrap');
import Vue from 'vue';


Vue.component('video-recorder', () => import('./components/VideoRecorder.vue'));


const app = new Vue({
    el: '#app',
});
