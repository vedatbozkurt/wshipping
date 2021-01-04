/*
* @Author: @vedatbozkurt
* @Date:   2020-06-16 01:37:20
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-12 01:32:25
*/
import Vue from "vue";
import VueRouter from 'vue-router'
Vue.use(VueRouter);

/*const guest = (to, from, next) => {
  if (!localStorage.getItem("authToken")) {
    return next();
  } else {
    return next("/");
  }
};*/
const auth = (to, from, next) => {
  if (localStorage.getItem("authToken")) {
    return next();
  } else {
    return next("/login");
  }
};

// Routes
const routes = [
{ path: "/login", name: "Login", component: () => import("./pages/Auth/Login.vue") },
{
  path: '/',
  beforeEnter: auth,
  component: () => import("./pages/Main.vue"),
  children: [
  { path: '/', component: () => import("./pages/Dashboard"), name: 'Dashboard'},
  { path: 'profile', component: () => import("./pages/Profile"), name: 'Profile'},
  { path: 'courier', component: () => import("./pages/Courier/Index"),name: 'Couriers'}, //courier pages start
  { path: 'courier/create', component: () => import("./pages/Courier/Create"), name: 'CreateCourier'},
  { path: 'courier/:id', component: () => import("./pages/Courier/Edit"), name: 'EditCourier'},
  { path: 'courier/:id', component: () => import("./pages/Courier/Info"),
  children: [
  { path: 'task', component: () => import("./pages/Courier/Info/Task"), name: 'CourierTask'},
  ]},//courier pages end
  ]
},
/*{path: "/register", name: "Register", beforeEnter: guest, component: () => import("./pages/Auth/Register.vue") },*/
{ path: '*', name: 'NotFound', component: () => import("./pages/NotFound.vue") },

]
const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
})
export default router
