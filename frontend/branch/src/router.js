/*
* @Author: @vedatbozkurt
* @Date:   2020-06-16 01:37:20
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-15 02:27:09
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
  { path: 'user', component: () => import("./pages/User/Index"),name: 'Users'}, //user pages start
  { path: 'user/create', component: () => import("./pages/User/Create"), name: 'CreateUser'},
  { path: 'user/:id', component: () => import("./pages/User/Edit"), name: 'EditUser'},
  { path: 'user/:id', component: () => import("./pages/User/Info"),
  children: [
  { path: 'info', component: () => import("./pages/User/Info/Details"), name: 'UserDetails'},
  { path: 'sendertasks', component: () => import("./pages/User/Info/SenderTask"), name: 'UserSenderTask'},
  { path: 'receivertasks', component: () => import("./pages/User/Info/ReceiverTask"), name: 'UserReceiverTask'},
  { path: 'addresses', component: () => import("./pages/User/Info/Address"), name: 'UserAddress'},
  ]},//User pages end
   { path: 'task', component: () => import("./pages/Task/Index"),name: 'Tasks'}, //Task pages start
   { path: 'task/create', component: () => import("./pages/Task/Create"), name: 'CreateTask'},
   { path: 'task/:id', component: () => import("./pages/Task/Edit"), name: 'EditTask'},
    { path: 'address', component: () => import("./pages/Address/Index"),name: 'Addresses'}, //Address pages start
    { path: 'address/create', component: () => import("./pages/Address/Create"), name: 'CreateAddress'},
    { path: 'address/:id', component: () => import("./pages/Address/Edit"), name: 'EditAddress'},
{ path: 'city', component: () => import("./pages/City/Index"),name: 'Cities'}, //City pages start
{ path: 'city/:id', component: () => import("./pages/City/Info"),
children: [
{ path: 'info', component: () => import("./pages/City/Info/Details"), name: 'CityDetails'},
{ path: 'couriers', component: () => import("./pages/City/Info/Courier"), name: 'CityCourier'},
{ path: 'users', component: () => import("./pages/City/Info/User"), name: 'CityUser'},
{ path: 'tasks', component: () => import("./pages/City/Info/Task"), name: 'CityTask'},
]},
{ path: 'district', component: () => import("./pages/District/Index"),name: 'Districts'}, //District pages start
 { path: 'district/:id', component: () => import("./pages/District/Info"),
 children: [
 { path: 'info', component: () => import("./pages/District/Info/Details"), name: 'DistrictDetails'},
 { path: 'couriers', component: () => import("./pages/District/Info/Courier"), name: 'DistrictCourier'},
 { path: 'users', component: () => import("./pages/District/Info/User"), name: 'DistrictUser'},
 { path: 'tasks', component: () => import("./pages/District/Info/Task"), name: 'DistrictTask'},
 ]}, //District pages END
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
