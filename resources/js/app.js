require('./bootstrap');
import Vue from 'vue';


Vue.component('video-recorder', () => import('./components/VideoRecorder.vue'));
// Vue.component('family-tree', () => import('./components/familyTree.vue'));
Vue.component('family-tree1', () => import('./components/familyTree1.vue'));


const app = new Vue({
    el: '#app',
});
