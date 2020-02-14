import VueRouter from 'vue-router';
import Home from './views/Home';
import Contact from './views/Contact';

let routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/contact',
        component: Contact
    },
];

export default new VueRouter({

    routes: routes,

    linkActiveClass: 'is-active'

});
