/*
* @Author: @vedatbozkurt
* @Date:   2020-06-16 01:37:20
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-01 15:27:45
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
  { path: 'branch', component: () => import("./pages/Branch/Index"),name: 'Branches'}, //branch pages start
  { path: 'branch/create', component: () => import("./pages/Branch/Create"), name: 'CreateBranch'},
  { path: 'branch/:id', component: () => import("./pages/Branch/Edit"), name: 'EditBranch'},
  // { path: 'branch/:id/details', component: () => import("./pages/Branch/Details"), name: 'DetailsBranch'},
  { path: 'branch/:id', component: () => import("./pages/Branch/Info"),
  children: [
  { path: 'info', component: () => import("./pages/Branch/Info/Details"), name: 'BranchDetails'},
  { path: 'courier', component: () => import("./pages/Branch/Info/Courier"), name: 'BranchCourier'},
  { path: 'citycourier', component: () => import("./pages/Branch/Info/CityCourier"), name: 'BranchCityCourier'},
  { path: 'districtcourier', component: () => import("./pages/Branch/Info/DistrictCourier"), name: 'BranchDistrictCourier'},
  { path: 'user', component: () => import("./pages/Branch/Info/User"), name: 'BranchUser'},
  { path: 'cityuser', component: () => import("./pages/Branch/Info/CityUser"), name: 'BranchCityUser'},
  { path: 'districtuser', component: () => import("./pages/Branch/Info/DistrictUser"), name: 'BranchDistrictUser'},
  { path: 'task', component: () => import("./pages/Branch/Info/Task"), name: 'BranchTask'},
  { path: 'citytask', component: () => import("./pages/Branch/Info/CityTask"), name: 'BranchCityTask'},
  { path: 'districttask', component: () => import("./pages/Branch/Info/DistrictTask"), name: 'BranchDistrictTask'},
  ]},//branch pages end
  { path: 'courier', component: () => import("./pages/Courier/Index"),name: 'Couriers'}, //courier pages start
  { path: 'courier/create', component: () => import("./pages/Courier/Create"), name: 'CreateCourier'},
  { path: 'courier/:id', component: () => import("./pages/Courier/Edit"), name: 'EditCourier'},
  { path: 'courier/:id', component: () => import("./pages/Courier/Info"),
  children: [
  { path: 'info', component: () => import("./pages/Courier/Info/Details"), name: 'CourierDetails'},
  { path: 'task', component: () => import("./pages/Courier/Info/Task"), name: 'CourierTask'},
  { path: 'citybranch', component: () => import("./pages/Courier/Info/CityBranch"), name: 'CourierCityBranch'},
  { path: 'districtbranch', component: () => import("./pages/Courier/Info/DistrictBranch"), name: 'CourierDistrictBranch'},
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

  { path: 'setting', component: () => import("./pages/Setting"), name: 'Setting'},
  { path: 'profile', component: () => import("./pages/Profile"), name: 'Profile'},
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
