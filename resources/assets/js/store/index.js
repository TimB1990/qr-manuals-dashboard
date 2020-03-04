// store/index.js

import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex);

const url = "/products";

export default new Vuex.Store({

    state: {
        loadingStatus: 'notloading',
        products: [],
        errors: []
    },

    mutations: {
        SET_LOADING_STATUS(state, payload){
            state.loadingStatus = payload;
        },

        SET_PRODUCTS(state, payload){
            state.products = payload;
        },

        CLEAR_PRODUCTS(state){
            state.products = [];
        },

        ADD_ERROR(state, payload){
            state.errors = [...state.errors, payload];
        }
    },

    actions: {
        fetchProducts(context){
            // set loading status
            context.commit('SET_LOADING_STATUS','loading');
            // make HTTP request
            axios.get(url).then(result => {
                context.commit('SET_LOADING_STATUS','notloading');
                context.commit('SET_PRODUCTS', result.data);
            }).catch(err => {
                context.commit('SET_LOADING_STATUS', 'notloading');
                context.commit('SET_COUNTRIES', []);
                context.commit('ADD_ERROR', err);

            })
        },

        clearProducts(context){
            context.commit('CLEAR_PRODUCTS');
        }
    }

})