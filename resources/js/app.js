require('./bootstrap');
window.Vue = require('vue');




//made today
Vue.componenet('example-component', require('./components/ExampleComponent.vue').default);


const app = new Vue({
    el: '#app'
});
