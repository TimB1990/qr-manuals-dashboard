// store/index.js

import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

export default new Vuex.Store({
    plugins: [createPersistedState()],

    state: {
        user: null,
        loadingStatus: "notloading",
        feedbackData: {},
        product: {},
        products: {},
        errors: [],
        productManuals: [],
        productDetails: [],
        selectedProducts: [],
        quotes: {},
        quoteDetails: {}
    },

    mutations: {
        SET_LOADING_STATUS(state, payload) {
            state.loadingStatus = payload;
        },

        SET_PRODUCTS(state, { data, page }) {
            state.page = page;
            state.products = data;
        },

        SET_QUOTES(state, payload) {
            state.quotes = payload;
        },

        CLEAR_PRODUCTS(state) {
            state.products = {};
        },

        CLEAR_MANUALS(state) {
            state.productManuals = [];
        },

        DELETE_MANUAL(state, { manual_id }) {
            let index = state.productManuals.findIndex(manual_id);
            state.productManuals.splice(index, 1);
        },

        ADD_ERROR(state, payload) {
            state.errors = [...state.errors, payload];
        },

        SET_FEEDBACK_DATA(state, payload) {
            state.feedbackMsg = payload;
        },

        SET_PAGE_URL(state, payload) {
            state.page_url = payload;
        },

        SET_PRODUCT_DETAILS(state, payload) {
            state.productDetails = payload;
        },

        SET_QUOTE_DETAILS(state, payload) {
            state.quoteDetails = payload;
        },

        SET_PRODUCT_MANUALS(state, payload) {
            state.productManuals = payload;
        },

        ADD_SELECTED_PRODUCT(state, data) {
            state.selectedProducts.push(data);
        },

        REMOVE_SELECTED_PRODUCT(state, id) {
            let index = state.selectedProducts.findIndex(
                index => index.id == id
            );
            state.selectedProducts.splice(index, 1);
        },

        CLEAR_SELECTED(state) {
            state.selectedProducts = [];
        },

        SET_PRODUCT(state, payload) {
            state.product = payload;
        },

        EMPTY_PRODUCT(state, id) {
            let index = state.product.findIndex(index => index.id == id);
            state.product.splice(index, 1);
        },

        SET_USER_DATA(state, data) {
            state.user = data;
            console.log("SET_USER_DATA: ", data);
            localStorage.setItem("user", JSON.stringify(data));
            axios.defaults.headers.common[
                "Authorization"
            ] = `Bearer ${data.token}`;
        },

        CLEAR_USER_DATA(state) {
            state.user = null;
            localStorage.removeItem("user");
            axios.defaults.headers.common["Authorization"] = null;
        }
    },

    actions: {
        setUser({ commit }, { data }) {
            commit("SET_USER_DATA", data);
        },

        login({ commit }, credentials) {
            console.log("credentials from login action store: ", credentials);
            return axios.post("/api/login", credentials).then(({ data }) => {
                commit("SET_USER_DATA", {
                    email: credentials.email,
                    token: data.success.token
                });
            });
        },

        logoutUser({ commit }) {
            commit("CLEAR_USER_DATA");
        },

        addSelectedProduct({ commit }, { data }) {
            commit("ADD_SELECTED_PRODUCT", data);
        },

        removeSelectedProduct({ commit }, { id }) {
            commit("REMOVE_SELECTED_PRODUCT", id);
        },

        clearSelected({ commit }) {
            commit("CLEAR_SELECTED");
        },

        emptyProduct({ commit }, { id }) {
            commit("EMPTY_PRODUCT", id);
        },

        setProduct({ commit }, { artnr }) {
            axios
                .get(`api/products/${artnr}`)
                .then(result => {
                    commit("SET_PRODUCT", result.data[0]);
                })
                .catch(err => {
                    commit("ADD_ERROR", err);
                });
        },

        // for context.commit, and page parameter
        fetchProducts({ commit }, { page, query }) {
            commit("SET_LOADING_STATUS", "loading");
            axios
                .get(`api/products?page=${page}&q=${query}`)
                .then(result => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_PRODUCTS", result);
                })
                .catch(err => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_PRODUCTS", []);
                    commit("ADD_ERROR", err);
                });
        },

        fetchQuotes({ commit }, {status}) {
            commit("SET_LOADING_STATUS", "loading");
            axios
                .get(`api/quotations?status=${status}`)
                .then(result => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_QUOTES", result.data);
                })
                .catch(err => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_QUOTES", {});
                    commit("ADD_ERROR", err);
                });
        },

        clearProducts({ commit }) {
            commit("CLEAR_PRODUCTS");
        },

        clearManuals({ commit }) {
            commit("CLEAR_MANUALS");
        },

        fetchQuoteDetails({ commit }, { quote_id }) {
            commit("SET_LOADING_STATUS", "loading");
            axios
                .get(`api/quotations/${quote_id}`)
                .then(result => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_QUOTE_DETAILS", result.data);
                })
                .catch(() => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_QUOTE_DETAILS", {});
                });
        },

        fetchDetails({ commit }, { id }) {
            commit("SET_LOADING_STATUS", "loading");
            axios
                .get(`api/products/${id}/details`)
                .then(result => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_PRODUCT_DETAILS", result);
                })
                .catch(err => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_PRODUCT_DETAILS", []);
                });
        },

        fetchManuals({ commit }, { id }) {
            commit("SET_LOADING_STATUS", "loading");
            axios
                .get(`api/products/${id}/manuals`)
                .then(result => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_PRODUCT_MANUALS", result);
                })
                .catch(err => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_PRODUCT_MANUALS", []);
                });
        },

        fetchManualsByArtnr({ commit }, { artnr }) {
            commit("SET_LOADING_STATUS", "loading");
            axios
                .get(`api/products/${artnr}/manuals`)
                .then(result => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_PRODUCT_MANUALS", result);
                })
                .catch(err => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_PRODUCT_MANUALS", []);
                });
        },

        deleteManual({ commit, dispatch, getters }, { id, manual_id }) {
            axios
                .delete(`api/products/${id}/manuals/${manual_id}`, {
                    headers: {
                        Authorization: "Bearer " + getters.getUserToken
                    }
                })
                .then(() => {
                    commit("DELETE_MANUAL", manual_id);
                })
                .catch(err => console.log(err));

            dispatch("fetchManuals", { id: id });
        },

        updateQuoteStatus({ dispatch, getters }, { quote_id, status }) {
            console.log("id from store: ", quote_id);
            console.log("id from store: ", status);

            axios
                .put(
                    `api/quotations/${quote_id}`,
                    { status: status },
                    {
                        headers: {
                            Authorization: "Bearer " + getters.getUserToken
                        }
                    }
                )
                .then(() => {
                    dispatch("fetchQuotes");
                    // dispatch("fetchQuoteDetails", { quote_id: quote_id });
                });
        },

        uploadManual({ commit, dispatch, getters }, { id, formData }) {
            axios
                .post(`api/products/${id}/manuals`, formData, {
                    headers: {
                        // also authorizaton header
                        Authorization: "Bearer " + getters.getUserToken,
                        "Content-Type": "multipart/form-data"
                    }
                })
                .then(response => {
                    dispatch("fetchManuals", { id: id });
                })
                .catch(err => {
                    // set feedbackData
                    feedbackData.message = `${error.response.data} ${err.message}`;
                    feedbackData.iconClass = "fa fa-times has-text-danger";

                    // commit feedbackData
                    commit("SET_FEEDBACK_DATA", feedbackData);

                    // reload manuals list
                    dispatch("fetchManuals", { id: id });
                });
        }
    },

    getters: {
        //quote detail getters
        getQuoteDetails: state => {
            return state.quoteDetails.quote;
        },

        getQuoteCustomerDetails: state => {
            return state.quoteDetails.customer;
        },
        getQuoteProductDetails: state => {
            return state.quoteDetails.products[0];
        },

        // other
        loggedIn: state => {
            return !!state.user;
        },

        getProductID: state => {
            return state.product.id;
        },

        getUserEmail: state => {
            return state.user.email;
        },

        getUserToken: state => {
            return state.user.token;
        },

        productIsSelected: state => id => {
            let selectedProducts = state.selectedProducts;

            for (var i = 0; i < selectedProducts.length; i += 1) {
                if (selectedProducts[i]["id"] === id) {
                    return true;
                }
            }
            return false;
        },

        selectedProductCount: state => {
            return state.selectedProducts.length;
        },

        paginatedSelection: state => (current_page, page_size) => {
            let selectedProducts = state.selectedProducts;
            let paginated = [];
            paginated.push({
                page: current_page,
                items: selectedProducts.slice(
                    (current_page - 1) * page_size,
                    current_page * page_size
                )
            });

            return paginated;
        }
    }
});
