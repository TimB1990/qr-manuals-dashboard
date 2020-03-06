// store/index.js

import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex);

const url = "/products";

export default new Vuex.Store({

    state: {
        loadingStatus: 'notloading',
        products: {},
        errors: []
    },

    mutations: {

        SET_LOADING_STATUS(state, payload){
            state.loadingStatus = payload;
        },

        SET_PRODUCTS(state, { data, page }){
            state.page = page;
            state.products = data;
        },

        CLEAR_PRODUCTS(state){
            state.products = {};
        },

        ADD_ERROR(state, payload){
            state.errors = [...state.errors, payload];
        },

        SET_PAGE_URL(state, payload){
            state.page_url = payload;
        }
    },

    //TODO  You need to dispatch with a payload object containing your parameters.

    actions: { 
        // for context.commit, and page parameter
        fetchProducts({ commit },{page}){ 
            commit('SET_LOADING_STATUS','loading');
            axios.get(`/products?page=${page}`).then(result => {
                commit('SET_LOADING_STATUS','notloading');
                commit('SET_PRODUCTS', result );
            }).catch(err => {
                commit('SET_LOADING_STATUS', 'notloading');
                commit('SET_PRODUCTS', []);
                commit('ADD_ERROR', err);

            })
        },

        clearProducts({ commit }){
            commit('CLEAR_PRODUCTS');
        }
    }

})