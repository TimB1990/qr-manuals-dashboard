import VueRouter from 'vue-router';

import Home from './views/main/Home';
import MainProductDetails from './views/main/components/MainProductDetails'

let routes = [
    {
        path: '/',
        component: Home
    },

    {
        path: '/products/:id/details',
        name: 'product_details',
        component: MainProductDetails
    }
];

export default new VueRouter({

    /*mode: 'history',*/
    routes: routes,

    linkActiveClass: 'is-active'

});
