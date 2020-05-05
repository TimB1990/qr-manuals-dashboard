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
import MainQuotationDetails from './views/dashboard/main/components/MainQuotationDetails';
import MainQuotationsHome from './views/dashboard/main/components/MainQuotationsHome'

import Scanner from './views/productpage/components/Scanner';
import ViewPanel from './views/productpage/components/ViewPanel';
import QuoteForm from './views/productpage/components/QuoteForm';

import SideMenu from './views/dashboard/side/SideMenu';
import SideQuotations from './views/dashboard/side/SideQuotations';


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
        children: [{
            path: 'products',
            name: 'products',
            components: {
                side: SideMenu,
                content: Home
            },
        }, {
            path: 'products/:id/details',
            name: 'product_details',
            components: {
                side: SideMenu,
                content: MainProductDetails
            }
        }, {
            path: 'products/qr-sheet',
            name: 'qr-config-panel',
            components: {
                side: SideMenu,
                content: MainQrConfigPanel
            }
        }, {
            path: 'quotations',
            name: 'quotations',
            components: {
                side: SideQuotations,
                content: MainQuotationsHome
            }

        }, {
            path: 'quotations/:id/details',
            name: 'quotation_details',
            components: {
                side: SideQuotations,
                content: MainQuotationDetails
            }
        }],
        meta: { requiresAuth: true }
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

const router = new VueRouter({

    routes: routes,
    linkActiveClass: 'is-active'
});

router.beforeEach((to, from, next) => {
    const loggedin = localStorage.getItem('user')
    if (to.matched.some(record => record.meta.requiresAuth) && !loggedin) {
        next({ name: 'entry' })
    }
    next();
})

export default router;
