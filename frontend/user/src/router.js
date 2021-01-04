import Vue from "vue";
import Router from "vue-router";
import AppHeader from "./layout/AppHeader";
import AppFooter from "./layout/AppFooter";
import Components from "./views/Components.vue";
import Landing from "./views/Landing.vue";
import Login from "./views/Login.vue";
import Register from "./views/Register.vue";
import Profile from "./views/profile/Profile.vue";
import EditProfile from "./views/profile/EditProfile.vue";
import Home from "./views/Home.vue";
import NotFound from "./views/NotFound.vue";
import Address from "./views/address/Address.vue";
import CreateAddress from "./views/address/CreateAddress.vue";
import EditAddress from "./views/address/EditAddress.vue";
import IndexTask from "./views/task/Index.vue";
import SentTask from "./views/task/Sent.vue";
import ReceivedTask from "./views/task/Received.vue";
import EditTask from "./views/task/Edit.vue";
import CreateTask from "./views/task/Create.vue";

Vue.use(Router);
const auth = (to, from, next) => {
  if (localStorage.getItem("authToken")) {
    return next();
  } else {
    return next("/login");
  }
};

export default new Router({
  linkExactActiveClass: "active",
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
  {
    path: "/",
    name: "home",
    components: {
      header: AppHeader,
      default: Home,
      footer: AppFooter
    }
  },
  {
    path: "/landing",
    name: "landing",
    components: {
      header: AppHeader,
      default: Landing,
      footer: AppFooter
    }
  },
  {
    path: "/components",
    name: "components",
    components: {
      header: AppHeader,
      default: Components,
      footer: AppFooter
    }
  },
  {
    path: "/login",
    name: "login",
    components: {
      header: AppHeader,
      default: Login,
      footer: AppFooter
    }
  },
  {
    path: "/register",
    name: "register",
    components: {
      header: AppHeader,
      default: Register,
      footer: AppFooter
    }
  },
  {
    path: "/profile",
    name: "profile",
    beforeEnter: auth,
    components: {
      header: AppHeader,
      default: Profile,
      footer: AppFooter
    }
  },
  {
    path: "/profile/edit",
    name: "editprofile",
    beforeEnter: auth,
    components: {
      header: AppHeader,
      default: EditProfile,
      footer: AppFooter
    }
  },
  {
    path: "/address",
    name: "address",
    beforeEnter: auth,
    components: {
      header: AppHeader,
      default: Address,
      footer: AppFooter
    }
  },
  {
    path: "/address/create",
    name: "addressCreate",
    beforeEnter: auth,
    components: {
      header: AppHeader,
      default: CreateAddress,
      footer: AppFooter
    }
  },
  {
    path: "/address/:id",
    name: "addressEdit",
    beforeEnter: auth,
    components: {
      header: AppHeader,
      default: EditAddress,
      footer: AppFooter
    }
  },
  {
    path: "/task",
    name: "IndexTask",
    beforeEnter: auth,
    components: {
      header: AppHeader,
      default: IndexTask,
      footer: AppFooter
    }
  },
  {
    path: "/task/sent",
    name: "SentTask",
    beforeEnter: auth,
    components: {
      header: AppHeader,
      default: SentTask,
      footer: AppFooter
    }
  },
  {
    path: "/task/received",
    name: "ReceivedTask",
    beforeEnter: auth,
    components: {
      header: AppHeader,
      default: ReceivedTask,
      footer: AppFooter
    }
  },
  {
    path: "/task/create",
    name: "CreateTask",
    beforeEnter: auth,
    components: {
      header: AppHeader,
      default: CreateTask,
      footer: AppFooter
    }
  },
  {
    path: "/task/:id",
    name: "EditTask",
    beforeEnter: auth,
    components: {
      header: AppHeader,
      default: EditTask,
      footer: AppFooter
    }
  },
  { path: '*',
  name: 'NotFound',
  components: {
    default: NotFound,
  }
}
],
scrollBehavior: to => {
  if (to.hash) {
    return { selector: to.hash };
  } else {
    return { x: 0, y: 0 };
  }
}
});
