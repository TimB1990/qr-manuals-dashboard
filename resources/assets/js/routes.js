import VueRouter from 'vue-router';
import Home from './views/Home';

let routes = [
    {
        path: '/',
        component: Home
    }
];

export default new VueRouter({

    routes: routes,

    linkActiveClass: 'is-active'

});