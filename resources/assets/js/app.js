import './bootstrap'
import store from './store'
import router from './router'
import Root from './views/dashboard/Root'
import ProductPage from './views/productpage/ProductPage'

Vue.component('root', Root);
Vue.component('productpage', ProductPage);

Vue.component(
    'passport-clients',
    require('./views/authentication/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./views/authentication/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./views/authentication/passport/PersonalAccessTokens.vue').default
);

const app = new Vue({
    el: '#app',
    router: router,
    store: store
});
