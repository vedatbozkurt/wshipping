
import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import Argon from "./plugins/argon-kit";
import './registerServiceWorker'
import store from './store';
import axios from "axios";
import i18n from "./i18n";
import './mixins/sweetAlerts'
import Multiselect from 'vue-multiselect'
Vue.component('multiselect', Multiselect)
Vue.use(require('vue-moment'));


Vue.component('pagination', require('laravel-vue-pagination'));

Vue.config.productionTip = false;

axios.interceptors.response.use(
  response => response,
  error => {
    if (error.response.status === 422) {
      store.commit("setErrors", error.response.data.errors);
    } else if (error.response.status === 401) {
      store.commit("auth/setUserData", null);
      localStorage.removeItem("authToken");
      router.push({ name: "Login" });
    } else if (error.response.status === 403) {
      store.commit("auth/setUserData", null);
      localStorage.removeItem("authToken");
      router.push({ name: "Login" });
    } else {
      return Promise.reject(error);
    }
  }
  );

axios.interceptors.request.use(function(config) {
  config.headers.common = {
    "Authorization": `Bearer ${localStorage.getItem("authToken")}`,
    "Content-Type": "application/json",
    "Accept": "application/json",
  };
  return config;
});

Vue.use(Argon);
new Vue({
  router,
  store,
  i18n,
  render: h => h(App)
}).$mount("#app");
