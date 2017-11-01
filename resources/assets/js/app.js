
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('cropper', require('./components/Cropper.vue'));
Vue.component('uploader', require('./components/Uploader.vue'));
Vue.component('random', require('./components/Random.vue'));
Vue.component('default', require('./components/Default.vue'));
Vue.component('tags', require('./components/Tags.vue'));
Vue.component('catalogue', require('./components/Catalogue.vue'));
Vue.component('featured', require('./components/Featured.vue'));

const app = new Vue({
    el: '#app'
});
