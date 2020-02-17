import VueRouter from 'vue-router';
import Home from './views/Home';
import Contact from './views/Contact';
import Manuals from './views/Manuals';
import Uploads from './views/Uploads';

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
    },
    {
        path: '/uploads',
        component: Uploads
    }
];

export default new VueRouter({

    routes: routes,

    linkActiveClass: 'is-active'

});
