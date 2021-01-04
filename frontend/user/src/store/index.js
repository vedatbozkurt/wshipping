import axios from "axios";
import Vue from 'vue';
import Vuex from 'vuex';
import auth from './modules/auth';
import profile from './modules/profile';
import dashboard from './modules/dashboard';
import address from './modules/address';
import city from './modules/city';
import district from './modules/district';
import task from './modules/task';

// Load Vuex
Vue.use(Vuex);

// Create store
export default new Vuex.Store({
  state: {
    errors: [],
    loader: false,
    loggedData: null,
    currencyData: null,
    companyLogoData: null,
    companyNameData: null,
    companyPhoneData: null,
    companyAddressData: null,
    companyEmailData: null,
    companyDescriptionData: null,

  },
  getters: {
    errors: state => state.errors,
    loader: state => state.loader,
    logged: state => state.loggedData,
    currency: state => state.currencyData,
    companyLogo: state => state.companyLogoData,
    companyName: state => state.companyNameData,
    companyPhone: state => state.companyPhoneData,
    companyAddress: state => state.companyAddressData,
    companyEmail: state => state.companyEmailData,
    companyDescription: state => state.companyDescriptionData,
  },

  actions: {
    async getInitialData({ commit }) {
      commit("setErrors", {}, { root: true });
      await axios.get(process.env.VUE_APP_API_URL + "initialdata")
      .then(response => {
        commit("setCompanyLogo", response.data.logo);
        commit("setCurrency", response.data.currency);
        commit("setCompanyName", response.data.company_name);
        commit("setCompanyPhone", response.data.phone);
        commit("setCompanyAddress", response.data.address);
        commit("setCompanyEmail", response.data.email);
        commit("setCompanyDescription", response.data.description);
      });
    },
  },

  mutations: {
    setErrors(state, errors) { state.errors = errors; },
    setLoader(state, loader) { state.loader = loader; },
    setLoggedData(state, data) { state.loggedData = data; },
    setCurrency(state, data) { state.currencyData = data; },
    setCompanyLogo(state, data) { state.companyLogoData = data; },
    setCompanyName(state, data) { state.companyNameData = data; },
    setCompanyPhone(state, data) { state.companyPhoneData = data; },
    setCompanyAddress(state, data) { state.companyAddressData = data; },
    setCompanyEmail(state, data) { state.companyEmailData = data; },
    setCompanyDescription(state, data) { state.companyDescriptionData = data; },
  },

  modules: {
    auth,
    profile,
    dashboard,
    address,
    city,
    district,
    task,
  }
});
