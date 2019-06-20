/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
var Editor = require('@tinymce/tinymce-vue').default;
require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('edit-tesista', require('./components/tesistaEdit.vue').default);
Vue.component('edit-sinodal', require('./components/sinodalEdit.vue').default);
Vue.component('create-sinodal', require('./components/sinodalCreate.vue').default);
Vue.component('create-tesista', require('./components/tesistaCreate.vue').default);

Vue.component('create-tesis', require('./components/tesisCreate.vue').default);
Vue.component('create-tesina', require('./components/tesinaCreate.vue').default);
Vue.component('create-ensayo', require('./components/ensayoCreate.vue').default);
Vue.component('create-articulo', require('./components/articuloCreate.vue').default);
Vue.component('create-mem-exp', require('./components/memExpCreate.vue').default);
Vue.component('create-app-con', require('./components/appConCreate.vue').default);
Vue.component('create-rep-out', require('./components/repOutCreate.vue').default);
Vue.component('create-rep-res', require('./components/repResCreate.vue').default);
Vue.component('head-prot', require('./components/encabezado.vue').default);
Vue.component('edit-folio', require('./components/editFolio.vue').default);

Vue.component('rep-art', require('./components/repArticulo.vue').default);
Vue.component('rep-ensayo', require('./components/repEnsayo.vue').default);
Vue.component('rep-exp', require('./components/repMemExp.vue').default);
Vue.component('rep-con', require('./components/repApCon.vue').default);
Vue.component('rep-aut', require('./components/repAut.vue').default);
Vue.component('rep-inv', require('./components/repResIn.vue').default);
Vue.component('rep-tesina', require('./components/repTesina.vue').default);
Vue.component('rep-tesis', require('./components/repTesis.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
