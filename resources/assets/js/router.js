import VueRouter from 'vue-router';

import Root from './views/dashboard/Root'
import Home from './views/dashboard/main/Home';
import MainProductDetails from './views/dashboard/main/components/MainProductDetails';
import MainQrConfigPanel from './views/dashboard/main/components/MainQrConfigPanel';
import NotFound from './views/util/NotFound';

export default new VueRouter({

    /*mode: 'history',*/
    routes: [
        {
            path: '*',
            component: NotFound 
        },
        {
        path: '/dashboard',
        name: 'home',
        component: Home
        },
        {
            path: '/dashboard/products/:id/details',
            name: 'product-details',
            component: MainProductDetails
        },
        {
            path: '/dashboard/sheets',
            name: 'qr-config-panel',
            component: MainQrConfigPanel
        }],

    linkActiveClass: 'is-active'
});
