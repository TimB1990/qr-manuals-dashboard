import VueRouter from 'vue-router';

import Home from './views/main/Home';
import MainProductDetails from './views/main/components/MainProductDetails'
import MainQrConfigPanel from './views/main/components/MainQrConfigPanel'
import ViewPanel from './views/productpage/components/ViewPanel'

let routes = [
    {
        path: '/',
        component: Home
    },

    {
        path: '/products/:id/details',
        name: 'product_details',
        component: MainProductDetails
    },
    {
        path: '/sheets',
        name: 'qr-config-panel',
        component: MainQrConfigPanel
        // params to pass: amount => QR-codes/product * selected

    }
];

export default new VueRouter({

    /*mode: 'history',*/
    routes: routes,

    linkActiveClass: 'is-active'

});
