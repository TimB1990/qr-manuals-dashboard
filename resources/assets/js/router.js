import VueRouter from 'vue-router';

import Home from './views/main/Home';
import Uploads from './views/Uploads';

let routes = [
    {
        path: '/',
        component: Home
    },

    /*{
        path: '/uploads',
        component: Uploads
    }*/
];

export default new VueRouter({

    // mode: 'history',
    routes: routes,

    linkActiveClass: 'is-active'

});
