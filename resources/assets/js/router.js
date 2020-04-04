import VueRouter from 'vue-router';
import store from './store/index';

import Entry from './views/entry/Entry';
import ForgotPassword from './views/entry/components/ForgotPassword'
import ResetPasswordForm from './views/entry/components/ResetPasswordForm'

import ProductPage from './views/productpage/ProductPage';
import Dashboard from './views/dashboard/Dashboard';

import Home from './views/dashboard/main/Home';
import MainProductDetails from './views/dashboard/main/components/MainProductDetails';
import MainQrConfigPanel from './views/dashboard/main/components/MainQrConfigPanel';

import Scanner from './views/productpage/components/Scanner';
import ViewPanel from './views/productpage/components/ViewPanel';
import QuoteForm from './views/productpage/components/QuoteForm';

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
        path: '/productpage',
        name: 'productpage',
        component: ProductPage,
        children: [
            {
                path: '',
                name: 'scanner',
                component: Scanner 
            },
            {
                path: '/view/:artnr',
                name: 'view',
                component: ViewPanel,
            },
            {
                path: '/quote',
                name: 'quote',
                component: QuoteForm
            }
        ]
    },
    {
        path: '/reset-password',
        name: 'reset-password',
        component: ForgotPassword,
        children: [
            {
                path: '/:token',
                name: 'reset-password-form',
                component: ResetPasswordForm,
            }
        ],
    },
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
