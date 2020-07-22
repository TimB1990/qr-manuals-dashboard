import VueRouter from 'vue-router';
import store from './store/index';

// entry route imports
import Entry from './views/entry/Entry';
import ForgotPassword from './views/entry/components/ForgotPassword'

// actionbar route imports
import QuotesActionBar from './views/dashboard/actionbar/QuotesActionbar'
import SheetsActionbar from './views/dashboard/actionbar/SheetsActionbar'

// main route imports
import ProductPage from './views/productpage/ProductPage';
import Dashboard from './views/dashboard/Dashboard';

// side view route imports
import SideMenu from "./views/dashboard/side/SideMenu";
import SideQuotations from "./views/dashboard/side/SideQuotations";
import SideSheets from "./views/dashboard/side/SideSheets";
import SideSheetProducts from "./views/dashboard/side/SideSheetProducts";

// main view route imports
import MainProductDetails from './views/dashboard/main/components/MainProductDetails';
import MainQrConfigPanel from './views/dashboard/main/components/MainQrConfigPanel';
import MainQuotationDetails from './views/dashboard/main/components/MainQuotationDetails';
import MainQuotationSpecification from './views/dashboard/main/components/MainQuotationSpecification'
import MainPreviewSpec from './views/dashboard/main/components/MainPreviewSpec'
import SheetDetails from './views/dashboard/main/components/SheetDetails'

// customer route imports
import Scanner from './views/productpage/components/Scanner';
import ViewPanel from './views/productpage/components/ViewPanel';
import QuoteForm from './views/productpage/components/QuoteForm';

// feed imports
import QuoteFeeds from './views/dashboard/main/components/QuoteFeeds'
import SheetFeeds from "./views/dashboard/main/components/SheetFeeds";
import ProductFeeds from "./views/dashboard/main/components/ProductFeeds";

const routes = [
    {
        path: "/",
        name: "entry",
        component: Entry
    },

    {
        path: "/dashboard",
        name: "dashboard",
        component: Dashboard,
        children: [
            {
                path: "products",
                name: "products",
                components: {
                    side: SideMenu,
                    content: ProductFeeds,
                }
            },
            {
                path: "products/:id/details",
                name: "product_details",
                components: {
                    side: SideMenu,
                    content: MainProductDetails,
                }
            },
            {
                path: "sheets",
                name: "sheets",
                components: {
                    side: SideSheets,
                    content: SheetFeeds,
                    actionbar: SheetsActionbar
                }
            },
            {
                path: "sheets/create",
                name: "sheet-new",
                components: {
                    side: SideSheetProducts,
                    content: MainQrConfigPanel,
                    actionbar: SheetsActionbar
                }
            },

            {
                path: "sheets/:id/edit",
                name: "sheet-edit",
                components: {
                    side: SideSheetProducts,
                    content: MainQrConfigPanel,
                    actionbar: SheetsActionbar
                }
            },

            {
                path: "sheets/:id/details",
                name: "sheet-details",
                components: {
                    side: SideSheets,
                    actionbar: SheetsActionbar,
                    content: SheetDetails
                }
            },
            {
                path: "sheets/:id/preview",
                name: "sheet-preview",
                components: {
                    side: SideSheets,
                    content: MainQrConfigPanel,
                    actionbar: SheetsActionbar
                }
            },

            // quotations
            {
                path: "quotations",
                name: "quotations",
                components: {
                    side: SideQuotations,
                    actionbar: QuotesActionBar,
                    content: QuoteFeeds,
                }
            },
            {
                path: "quotations/:id/details",
                name: "quotation_details",
                components: {
                    side: SideQuotations,
                    content: MainQuotationDetails,
                    actionbar: QuotesActionBar
                }
            },
            {
                path: "quotations/:id/specification",
                name: "quotation_specification",
                components: {
                    side: SideQuotations,
                    content: MainQuotationSpecification
                }
            },
            {
                path: "quotations/:id/specification/preview",
                name: "quotation_specification_preview",
                components: {
                    content: MainPreviewSpec
                }
            }
        ],
        meta: { requiresAuth: true }
    },
    {
        path: "/productpage",
        name: "productpage",
        component: ProductPage,
        children: [
            {
                path: "scanner",
                name: "scanner",
                component: Scanner
            },
            {
                path: "view/:artnr",
                name: "view",
                component: ViewPanel
            },
            {
                path: "quote",
                name: "quote",
                component: QuoteForm
            }
        ]
    },
    {
        path: "/reset-password",
        name: "reset-password",
        component: ForgotPassword
    }
];

const router = new VueRouter({

    // mode: 'history',
    routes: routes,
    linkActiveClass: 'is-active',
    scrollBehavior (to, from, savedPosition){
        return {x: 0, y: 0}
    }
});

router.beforeEach((to, from, next) => {
    store.dispatch("clearSelected")
    const loggedin = localStorage.getItem('user')
    if (to.matched.some(record => record.meta.requiresAuth) && !loggedin) {
        next({ name: 'entry' })
    }
    next();
})

export default router;
