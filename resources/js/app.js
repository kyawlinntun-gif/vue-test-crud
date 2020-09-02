require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'

Vue.use(VueRouter)

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const UserHome = require('./components/UserHome.vue').default;
const UserCreate = require('./components/UserCreate.vue').default;
const UserEdit = require('./components/UserEdit.vue').default;

const routes = [
    {
        path: '/',
        component: UserHome 
    },
    {
        path: '/user/create',
        component: UserCreate
    },
    {
        path: '/user/show/:id',
        component: UserEdit
    } 
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

import { Form, HasError, AlertError } from 'vform'

window.Form = Form

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import VueProgressBar from 'vue-progressbar'

const options = {
    color: '#bffaf3',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'left',
    inverse: false
}

Vue.use(VueProgressBar, options)

const Swal = require('sweetalert2')

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

window.Toast = Toast

// Emitter
// window.emitter = new Vue();
Vue.prototype.$eventBus = new Vue(); // Global event bus

const app = new Vue({
    el: '#app',
    router,
    computed: {
        currentPage() {
            return this.$route.path;
        }
    },
});
