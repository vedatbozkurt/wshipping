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
  },

  getters: {
    errors: state => state.errors,
    loader: state => state.loader,
    logged: state => state.loggedData,
  },

  actions: {
  },

  mutations: {
    setErrors(state, errors) { state.errors = errors; },
    setLoader(state, loader) { state.loader = loader; },
    setLoggedData(state, data) { state.loggedData = data; },
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
