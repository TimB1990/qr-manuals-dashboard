import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueQrcodeReader from "vue-qrcode-reader";
import vueCrypt from 'vue-crypt'

window.Vue = Vue;
Vue.use(VueRouter);

window.VueQrcodeReader = VueQrcodeReader;
Vue.use(VueQrcodeReader);

window.vueCrypt = vueCrypt;
Vue.use(vueCrypt)

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


