import './bootstrap'
import store from './store'
import router from './router'
import Root from './views/Root'

Vue.component('root', Root);

const app = new Vue({
    el: '#app',
    router: router,
    store: store
});
