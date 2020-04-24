import './bootstrap'
import store from './store'
import router from './router'
import Root from './views/Root'
import axios from 'axios'

Vue.component('root', Root);

const app = new Vue({
    el: '#app',
    router: router,
    store: store,
    created(){
        const userString = localStorage.getItem('user')
        if(userString){
            const userData = JSON.parse(userString)
            this.$store.commit('SET_USER_DATA', userData)
        }
        axios.interceptors.response.use(response => response, error => {
            if(error.response.status === 401){
                this.$store.dispatch('logoutUser')
            }
            return Promise.reject(error)
        })

    }
});
