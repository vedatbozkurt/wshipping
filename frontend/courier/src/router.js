/*
* @Author: @vedatbozkurt
* @Date:   2020-06-16 01:37:20
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-16 23:57:43
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
{ path: "/register", name: "Register", component: () => import("./pages/Auth/Register.vue") },
{
  path: '/',
  beforeEnter: auth,
  component: () => import("./pages/Main.vue"),
  children: [
  { path: '/', component: () => import("./pages/Dashboard"), name: 'Dashboard'},
  { path: 'profile', component: () => import("./pages/Profile"), name: 'Profile'},
   { path: 'task', component: () => import("./pages/Task/Index"),name: 'Tasks'}, //Task pages start
   { path: 'mytasks', component: () => import("./pages/Task/MyTasks"), name: 'MyTasks'},
   { path: 'task/:id', component: () => import("./pages/Task/Edit"), name: 'EditTask'},
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
