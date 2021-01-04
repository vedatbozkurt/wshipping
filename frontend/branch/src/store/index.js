import axios from "axios";
import Vue from 'vue';
import Vuex from 'vuex';
import auth from './modules/auth';
import profile from './modules/profile';
import dashboard from './modules/dashboard';
import courier from './modules/courier';
import city from './modules/city';
import district from './modules/district';
import user from './modules/user';
import task from './modules/task';
import address from './modules/address';

// Load Vuex
Vue.use(Vuex);

// Create store
export default new Vuex.Store({
  state: {
    errors: [],
    loader: false,
    currencyData: null,
    logoData: null,
  },

  getters: {
    errors: state => state.errors,
    loader: state => state.loader,
    currency: state => state.currencyData,
    logo: state => state.logoData
  },

  actions: {
    async getInitialData({ commit }) {
      commit("setErrors", {}, { root: true });
      await axios.get(process.env.VUE_APP_API_URL + "initialdata")
      .then(response => {
        commit("setCurrency", response.data.currency);
        commit("setLogo", response.data.logo);
      });
    },
  },

  mutations: {
    setErrors(state, errors) { state.errors = errors; },
    setLoader(state, loader) { state.loader = loader; },
    setCurrency(state, data) { state.currencyData = data; },
    setLogo(state, data) { state.logoData = data; }
  },

  modules: {
    auth,
    profile,
    dashboard,
    district,
    city,
    courier,
    user,
    task,
    address,
  }
});
