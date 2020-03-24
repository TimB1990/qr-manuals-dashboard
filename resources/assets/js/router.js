import VueRouter from 'vue-router';

import Root from './views/dashboard/Root'
import Home from './views/dashboard/main/Home';
import MainProductDetails from './views/dashboard/main/components/MainProductDetails';
import MainQrConfigPanel from './views/dashboard/main/components/MainQrConfigPanel';
import Auth from './views/authentication/Auth';
import NotFound from './views/util/NotFound';

export default new VueRouter({

    /*mode: 'history',*/
    routes: [
        {
            path: '*',
            component: NotFound 
        },
        {
            path: '/',
            name: 'authentication',
            component: Auth
        },
        {
        path: '/admin',
        component: Home
        },
        {
            path: '/admin/products/:id/details',
            name: 'product-details',
            component: MainProductDetails
        },
        {
            path: '/admin/sheets',
            name: 'qr-config-panel',
            component: MainQrConfigPanel
        }],

    linkActiveClass: 'is-active'
});
