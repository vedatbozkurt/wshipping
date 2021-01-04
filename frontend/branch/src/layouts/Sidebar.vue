  <template>
   <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="/" class="brand-link">
      <img src="../assets/wlogo.png"
      class="brand-image img-circle elevation-3"
      style="opacity: .8">
      <span class="brand-text font-weight-light">wshipping V1</span>
    </router-link>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-1 d-flex">
        <div class="image">
          <!-- <img v-if="logo" :src="getLogo()" style="width: 50px" class="elevation-2" alt="User Image"> -->
        </div><!--
        <div class="info">
          <router-link to="/profile" class="d-block">{{ user.name }}</router-link>
        </div> -->
        <div class="info">
          <a href="#" class="d-block"> Branch Adı: {{branch.name}} </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

           <li class="nav-item">
            <router-link to="/" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt yellowa"></i>
              <p>{{ $t('dashboard') }}</p>
            </router-link>
          </li>

          <li class="nav-header">{{ $t('customization') }}</li>
          <li class="nav-item">
           <router-link to="/profile" class="nav-link">
            <i class="nav-icon fas fa-user blue"></i>
            <p>{{ $t('profile') }}</p>
          </router-link>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link" @click="logout">
            <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
            <p class="text">{{ $t('logout') }}</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
</template>
<script>
  import { mapGetters,mapActions} from "vuex";
  export default {
    computed: {
      ...mapGetters("profile", ["branch"])
    },

    mounted() {
      this.getBranchData();
    },

    methods: {
      ...mapActions("auth", ["sendLogoutRequest"]),
      ...mapActions("profile", ["getBranchData"]),

      logout() {
        this.sendLogoutRequest();
        this.$router.push({name: 'Login'});
      },
    }
  }
</script>
<style scoped>
.yellowa { color:#F6F6A9; }
.blue { color:#99eaff; }
.blue2 { color:#c6e2ff; }
.green { color:#93e993 ; }
.green2 { color:#7fffbf ; }
.pink { color:#ba76ad ; }
.acikpink { color:#dacdf7 ; }
.yellow { color:#fcd314 ; }
.bordo { color:#b60095 ; }
.orange { color:#FD9646 ; }
</style>
