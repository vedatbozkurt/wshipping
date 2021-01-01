<template>
  <div id="app" class="wrapper">
    <Navbar />
    <Sidebar />
    <router-view></router-view>
    <Footer />
    <RightSidebar />
  </div>
</template>

<script>
  window.$ = window.jQuery = require('jquery');
  require('admin-lte/dist/js/adminlte.min.js');
  require('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js');
  require('admin-lte/dist/css/adminlte.min.css');
  require('admin-lte/plugins/fontawesome-free/css/all.min.css');

  import Navbar from './layouts/Navbar.vue'
  import Footer from './layouts/Footer.vue'
  import RightSidebar from './layouts/RightSidebar.vue'
  import Sidebar from './layouts/Sidebar.vue'
  import { mapGetters, mapActions } from "vuex";

  export default {
    name: 'App',
    components: {
      Navbar,
      Footer,
      RightSidebar,
      Sidebar,
    },
    computed: {
      ...mapGetters("auth", ["user"])
    },
    mounted() {
    if (localStorage.getItem("authToken")) {
      this.getUserData();
    }
  },

  methods: {
    ...mapActions("auth", ["sendLogoutRequest", "getUserData"]),

    logout() {
      this.sendLogoutRequest();
      this.$router.push("/");
    }
  }
  }
</script>

<style>
</style>
