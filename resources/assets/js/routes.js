import VueRouter from 'vue-router';
import Home from './views/Home';
import Contact from './views/Contact';
import Manuals from './views/Manuals';

let routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/contact',
        component: Contact
    },
    {
        path: '/manuals',
        component: Manuals
    }
];

export default new VueRouter({

    routes: routes,

    linkActiveClass: 'is-active'

});
