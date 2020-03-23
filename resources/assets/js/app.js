import './bootstrap'
import store from './store'
import router from './router'
import Root from './views/dashboard/Root'
import ProductPage from './views/productpage/ProductPage'

Vue.component('root', Root);
Vue.component('productpage', ProductPage);

const app = new Vue({
    el: '#app',
    router: router,
    store: store
});
