import Vue from 'vue';
import Vuex from 'vuex';
import auth from './modules/auth';
import profile from './modules/profile';
import dashboard from './modules/dashboard';
import city from './modules/city';
import district from './modules/district';

// Load Vuex
Vue.use(Vuex);

// Create store
export default new Vuex.Store({
  state: {
    errors: [],
    loader: false,
    searchData: null,
  },

  getters: {
    errors: state => state.errors,
    loader: state => state.loader,
    search: state => state.searchData,
  },

  actions: {
  },

  mutations: {
    setErrors(state, errors) { state.errors = errors; },
    setLoader(state, loader) { state.loader = loader; },
    setSearch(state, data) { state.searchData = data; },
  },

  modules: {
    auth,
    profile,
    dashboard,
    city,
    district,
  }
});
