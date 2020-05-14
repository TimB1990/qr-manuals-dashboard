// products-store.js - vuex store module for product information

import axios from 'axios'
import createPersistedState from "vuex-persistedstate";

export default {
   namespaced: true,
   plugins: [createPersistedState()],

   state : {},
   mutations: {},
   actions: {},
   getters: {}
}