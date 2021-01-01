/*
* @Author: @vedatbozkurt
* @Date:   2020-06-16 01:37:20
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-06-26 15:21:27
*/
import Vue from "vue";
import VueRouter from 'vue-router'
Vue.use(VueRouter);

const guest = (to, from, next) => {
  if (!localStorage.getItem("authToken")) {
    return next();
  } else {
    return next("/");
  }
};
const auth = (to, from, next) => {
  if (localStorage.getItem("authToken")) {
    return next();
  } else {
    return next("/login");
  }
};

// Routes
const routes = [
{
    path: '/',
    name: 'dashboard',
    beforeEnter: auth,
    component: () => import(/* webpackChunkName: "home" */ "./pages/Dashboard.vue") },
{
    path: "/login",
    name: "Login",
    beforeEnter: guest,
    component: () => import(/* webpackChunkName: "home" */ "./pages/Auth/Login.vue")
  },
  {
    path: "/register",
    name: "Register",
    beforeEnter: guest,
    component: () => import(/* webpackChunkName: "home" */ "./pages/Auth/Register.vue")
  },
{ path: '*', name: 'notfound', component: () => import(/* webpackChunkName: "home" */ "./pages/NotFound.vue") },

  ]
  const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes,
  })
  export default router
