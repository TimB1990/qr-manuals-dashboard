import VueRouter from 'vue-router';
import store from './store/index';

import Entry from './views/entry/Entry';
import ProductPage from './views/productpage/ProductPage';
import Dashboard from './views/dashboard/Dashboard';

import Home from './views/dashboard/main/Home';
import MainProductDetails from './views/dashboard/main/components/MainProductDetails';
import MainQrConfigPanel from './views/dashboard/main/components/MainQrConfigPanel';

const routes = [
    {
        path: '/',
        name: 'entry',
        component: Entry
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        children: [
            {
                path: '',
                name: 'home',
                component: Home
            },
            {
                path: '/products/:id/details',
                name: 'product-details',
                component: MainProductDetails
            },
            {
                path: '/sheets',
                name: 'qr-config-panel',
                component: MainQrConfigPanel
            }
        ],
        meta: { requiresAuth : true }
    },
    {
        path: '/scan',
        name: 'scan',
        component: ProductPage
    }
];

const router =  new VueRouter({

    /*mode: 'history',*/
    routes: routes,
    linkActiveClass: 'is-active'
});

router.beforeEach((to,from,next) => {
    if(to.matched.some(record => record.meta.requiresAuth)){

        console.log('user from router: ', store.state.user);

        if(!store.state.user.token) next({name: 'entry'});
        else next();
    }
    else{
        next();
    }
});

export default router;
