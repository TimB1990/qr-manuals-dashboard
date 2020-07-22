// store/index.js

import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);

export default new Vuex.Store({
    // plugins: [createPersistedState()],

    state: {
        user: null,
        loadingStatus: "",
        feedbackData: {},
        product: {},
        products: {},
        productMenu: true,
        errors: [],
        productManuals: [],
        productDetails: [],
        selectedProducts: [],
        quotes: {},
        quoteDetails: {},
        quoteProducts: {},
        quoteCustomer: {},
        qrsheets: {},
        qrsheet: {},
        storedItemCopies: 0,
        quotesStatus: null,
        feedMessages: {}
    },

    mutations: {
        SET_QRSHEETS(state, payload) {
            state.qrsheets = payload;
        },

        TOGGLE_SIDE_MENU(state, show) {
            if (!show) {
                state.productMenu = !state.productMenu;
            } else {
                state.productMenu = show;
            }
        },

        CLEAR_QR_SHEET(state) {
            state.qrsheet = null;
        },

        SET_SINGLE_QRSHEET(state, payload) {
            state.qrsheet = payload;
        },

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

        CLEAR_MANUALS(state) {
            state.productManuals = [];
        },

        DELETE_MANUAL(state, { manual_id }) {
            let index = state.productManuals.findIndex(manual_id);
            state.productManuals.splice(index, 1);
        },

        DELETE_QRSHEET(state, { id }) {
            let index = state.qrsheets.findIndex(id);
            state.qrsheets.splice(index, 1);
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

        SET_QUOTE_PRODUCTS(state, payload) {
            state.quoteProducts = payload;
        },

        SET_QUOTE_CUSTOMER(state, payload) {
            state.quoteCustomer = payload;
        },

        SET_PRODUCT_MANUALS(state, payload) {
            state.productManuals = payload;
        },

        ADD_SELECTED_PRODUCT(state, data) {
            // ...state.selected, ...data => array.push(data.push(data))
            state.selectedProducts = [...state.selectedProducts, ...data];
        },

        SET_SELECTION_MODE(state, mode) {
            state.selectionMode = mode;
        },

        SET_ITEM_COPIES(state, value) {
            state.storedItemCopies = value;
        },

        REMOVE_SELECTED_PRODUCT(state, id) {
            state.selectedProducts = state.selectedProducts.filter(
                selectedProduct => selectedProduct.id != id
            );
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

        // sets up auth header
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
        },

        SET_FEED_MESSAGES(state, payload) {
            state.feedMessages = payload;
        },

        SET_QUOTES_STATUS(state, status) {
            state.quotesStatus = status;
        }
    },

    actions: {
        setUser({ commit }, { data }) {
            commit("SET_USER_DATA", data);
        },

        login({ commit }, credentials) {
            return axios.post("/api/login", credentials).then(({ data }) => {
                commit("SET_USER_DATA", {
                    email: credentials.email,
                    token: data.success.token
                });
            });
        },

        setLoadingStatus({ commit }, { loading }) {
            commit("SET_LOADING_STATUS", loading);
        },

        // feeds
        fetchFeedMessages({ commit }, { subject, page }) {
            axios
                .get(`api/feeds/${subject}?page=${page}`)
                .then(result => {
                    commit("SET_FEED_MESSAGES", result.data);
                })
                .catch(err => {
                    console.log(err.response.data.message);
                });
        },

        toggleSideMenu({ commit }, { show }) {
            if (!show) {
                commit("TOGGLE_SIDE_MENU", null);
            } else {
                commit("TOGGLE_SIDE_MENU", show);
            }
        },

        // users

        logoutUser({ commit }) {
            commit("CLEAR_USER_DATA");
        },

        // selection

        addSelectedProduct({ commit }, { data }) {
            commit("ADD_SELECTED_PRODUCT", data);
        },

        removeSelectedProduct({ commit }, { id }) {
            commit("REMOVE_SELECTED_PRODUCT", id);
        },

        clearSelected({ commit }) {
            commit("CLEAR_SELECTED");
        },

        // product

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

        // qrsheet

        clearQrSheet({ commit }) {
            commit("CLEAR_QR_SHEET");
        },

        fetchQrSheets({ commit, dispatch }, { page, query }) {
            commit("SET_LOADING_STATUS", "loading");
            axios
                .get(`api/qrsheets?page=${page}&q=${query}`)
                .then(result => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_QRSHEETS", result.data);
                    dispatch("fetchFeedMessages", {
                        subject: "qrsheets",
                        page: page
                    });
                })
                .catch(err => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_QRSHEETS", {});
                    console.log(err.response.data.error);
                });
        },

        fetchQrSheet({ commit }, { sheet_id }) {
            commit("SET_LOADING_STATUS", "loading");
            axios
                .get(`api/qrsheets/${sheet_id}`)
                .then(result => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_SINGLE_QRSHEET", result.data);
                    result.data.items.forEach(item => {
                        // dispatch('addSelectProduct', {data})
                        let data = {
                            id: item.id,
                            artnr: item.artnr,
                            kind: item.kind
                        };
                    });
                })
                .catch(err => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_SINGLE_QRSHEET", {});
                    console.log(err.response.data.error);
                });
        },

        // for context.commit, and page parameter
        fetchProducts({ commit, dispatch }, { page, query, feed }) {
            console.log("feed", feed);
            commit("SET_LOADING_STATUS", "loading");
            axios
                .get(`api/products?page=${page}&q=${query}`)
                .then(result => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_PRODUCTS", result);

                    if (feed) {
                        dispatch("fetchFeedMessages", {
                            subject: "manuals",
                            page: page
                        });
                    }
                })
                .catch(err => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_PRODUCTS", {});
                    console.log(err.response.data.error);
                });
        },

        clearManuals({ commit }) {
            commit("CLEAR_MANUALS");
        },

        // quotations

        fetchQuotes({ state, commit, dispatch }, { page, query }) {
            commit("SET_LOADING_STATUS", "loading");
            axios
                .get(
                    `api/quotations?status=${state.quotesStatus}&page=${page}&q=${query}`
                )
                .then(result => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_QUOTES", result.data);

                    dispatch("fetchFeedMessages", {
                        subject: "quotes",
                        page: page
                    });
                })
                .catch(err => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_QUOTES", {});
                    commit("ADD_ERROR", err);
                });
        },

        fetchQuoteDetails({ commit }, { quote_id }) {
            commit("SET_LOADING_STATUS", "loading");
            axios
                .get(`api/quotations/${quote_id}?details=1`)
                .then(result => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_QUOTE_DETAILS", result.data);
                })
                .catch(() => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_QUOTE_DETAILS", {});
                });
        },

        fetchQuoteProductsOnly({ commit }, { quote_id }) {
            commit("SET_LOADING_STATUS", "loading");
            axios
                .get(`api/quotations/${quote_id}`)
                .then(result => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_QUOTE_PRODUCTS", result.data);
                })
                .catch(error => console.log(error));
        },

        fetchQuoteCustomerOnly({ commit }, { quote_id }) {
            commit("SET_LOADING_STATUS", "loading");
            axios
                .get(`api/quotations/${quote_id}?customer=1`)
                .then(result => {
                    commit("SET_LOADING_STATUS", "notloading");
                    commit("SET_QUOTE_CUSTOMER", result.data);
                })
                .catch(error => console.log(error));
        },

        // products

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

        deleteSheet({ commit, dispatch, getters }, { id }) {
            axios
                .delete(`api/qrsheets/${id}`, {
                    headers: {
                        Authorization: "Bearer " + getters.getUserToken
                    }
                })
                .then(() => {
                    dispatch("fetchQrSheets");
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

        // ??

        setQuotesStatus({ commit, dispatch }, { status, page, query }) {
            commit("SET_QUOTES_STATUS", status);
            dispatch("fetchQuotes", { page, query });
        },

        updateQuoteStatus({ dispatch, getters }, { quote_id, status }) {
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
                    // dispatch setQuoteStatus
                    dispatch("setQuotesStatus", {
                        page: 1,
                        status: status,
                        query: ""
                    });
                });
        },

        //

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

        getQuotesStatus: state => {
            return state.quotesStatus;
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

        getSelection: state => {
            return state.selectedProducts;
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

        // paginatedReplicas??
    }
});
