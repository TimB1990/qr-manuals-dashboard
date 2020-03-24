import './bootstrap'
import store from './store'
import router from './router'
import Root from './views/dashboard/Root'
import ProductPage from './views/productpage/ProductPage'
import Entry from './views/entry/Entry'

Vue.component('root', Root);
Vue.component('productpage', ProductPage);
Vue.component('entry', Entry)

const app = new Vue({
    el: '#app',
    router: router,
    store: store
});
