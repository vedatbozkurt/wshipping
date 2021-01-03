<template>
  <div class="wrapper">
    <Navbar />
    <Sidebar />
    <router-view></router-view>
    <Footer />
    <RightSidebar />
  </div>
</template>

<script>
  import { mapActions } from "vuex";
  import Navbar from '../layouts/Navbar.vue'
  import Footer from '../layouts/Footer.vue'
  import RightSidebar from '../layouts/RightSidebar.vue'
  import Sidebar from '../layouts/Sidebar.vue'

  export default {
    components: {
      Navbar,
      Footer,
      RightSidebar,
      Sidebar,
    },
    created() {
      this.getInitialData();
    },
    methods: {
      ...mapActions(["getInitialData"]),
    }
  }
</script>

