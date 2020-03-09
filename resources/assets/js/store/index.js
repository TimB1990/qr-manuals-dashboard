// store/index.js

import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex);

export default new Vuex.Store({

    state: {
        loadingStatus: 'notloading',
        feedbackData: {},
        products: {},
        errors: [],
        productManuals: [],
        productDetails: []
    },

    mutations: {

        SET_LOADING_STATUS(state, payload) {
            state.loadingStatus = payload;
        },

        SET_PRODUCTS(state, { data, page }) {
            state.page = page;
            state.products = data;
        },

        CLEAR_PRODUCTS(state) {
            state.products = {};
        },

        CLEAR_MANUALS(state){
            state.productManuals = {};
        },

        DELETE_MANUAL(state, { manual_id }){
            index = state.productManuals.findIndex(manual => manual.id == manual_id)
            state.productManuals.splice(index, 1);
        },

        UPLOAD_MANUAL(state, {formData}){
            state.productManuals.push(formData);
        },

        ADD_ERROR(state, payload) {
            state.errors = [...state.errors, payload];
        },

        // confirmation
        SET_FEEDBACK_DATA(state, payload){
            state.feedbackMsg = payload;
        },

        SET_PAGE_URL(state, payload) {
            state.page_url = payload;
        },

        SET_PRODUCT_DETAILS(state, payload) {
            state.productDetails = payload;
        },

        SET_PRODUCT_MANUALS(state,payload){
            state.productManuals = payload;
        }
    },

    actions: {
        // for context.commit, and page parameter
        fetchProducts({ commit }, { page }) {
            commit('SET_LOADING_STATUS', 'loading');
            axios.get(`api/products?page=${page}`).then(result => {
                commit('SET_LOADING_STATUS', 'notloading');
                commit('SET_PRODUCTS', result);
            }).catch(err => {
                commit('SET_LOADING_STATUS', 'notloading');
                commit('SET_PRODUCTS', []);
                commit('ADD_ERROR', err);
            })
        },

        clearProducts({ commit }) {
            commit('CLEAR_PRODUCTS');
        },

        clearManuals({ commit }){
            commit('CLEAR_MANUALS');
        },

        fetchDetails({ commit }, { id }) {
            commit('SET_LOADING_STATUS', 'loading');
            axios.get(`api/products/${id}/details`).then(result => {
                commit('SET_LOADING_STATUS', 'notloading');
                commit('SET_PRODUCT_DETAILS', result);

            }).catch(err => {
                console.log(err);
                commit('SET_LOADING_STATUS', 'notloading');
                commit('SET_PRODUCT_DETAILS', []);
            });
        },

        fetchManuals({commit},{id}){
            commit('SET_LOADING_STATUS','loading');
            axios.get(`api/products/${id}/manuals`).then(result => {
                commit('SET_LOADING_STATUS','notloading');
                commit('SET_PRODUCT_MANUALS', result);

            }).catch(err => {
                commit('SET_LOADING_STATUS','notloading');
                commit('SET_PRODUCT_MANUALS',[]);
            });
            
        },

        deleteManual({ commit, dispatch },{ id, manual_id }){
            axios.delete(`api/products/${id}/manuals/${manual_id}`)
            .then(() => {
                commit('DELETE_MANUAL', manual_id)
            }).catch(err => console.log(err));

            dispatch('fetchManuals',{id:id});
        },

        uploadManual({ commit, dispatch}, {id,formData}){
            axios.post(`api/products/${id}/manuals`, formData, {
                headers:{
                    "Content-Type": "multipart/form-data"
                }
            }).then(response => {
                let feedbackData = {
                    show: true,
                    message: response.statusText,
                    iconClass: "fa fa-check has-text-success"
                };

                dispatch();


            }).catch(err => {

            });

        },

        setFeedbackData({commit},{ feedbackData: feedbackData }){
            commit('SET_FEEDBACK_DATA', feedbackData);
        }

    },
})