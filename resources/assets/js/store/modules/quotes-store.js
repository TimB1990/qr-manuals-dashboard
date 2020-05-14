// quotes-store.js - vuex store module for quote information

import axios from "axios";
import createPersistedState from "vuex-persistedstate";

export default {
    namespaced: true,
    plugins: [createPersistedState()],

    state: {},
    mutations: {},
    actions: {},
    getters: {}
};
