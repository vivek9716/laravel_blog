/*
 
 
 require('./bootstrap');
 
 window.Vue = require('vue');
 
 
 Vue.component('posts', require('./components/posts.vue'));
 //Vue.component('comments', require('./components/comments.vue'));
 
 let url = window.location.href;
 let pageNumber = url.split('=')[1];
 
 const app = new Vue({
 el: '#app',
 data: {
 blog: {}
 },
 mounted() {
 if ($('#app').length) {
 axios.post('/getPosts', {
 'page': pageNumber
 }).then(response => {
 this.blog = response.data.data
 }).catch(function (error) {
 console.log(error);
 });
 }
 }
 });*/


import App from './components/admin/App.vue';
import Vue from 'vue';
import router from './router';
export default new Vue({
    router,
    render: h => h(App)
});