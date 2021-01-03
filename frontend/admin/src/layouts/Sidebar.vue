  <template>
   <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="/" class="brand-link">
      <img src="../assets/wlogo.png"
      alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3"
      style="opacity: .8">
      <span class="brand-text font-weight-light">wshipping V1</span>
    </router-link>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-1 d-flex">
        <div class="image">
          <img src="../assets/logo.png" class="img-circle elevation-2" alt="User Image">
        </div><!--
        <div class="info">
          <router-link to="/profile" class="d-block">{{ user.name }}</router-link>
        </div> -->
        <div class="info">
          <a href="#" class="d-block"> {{ admin.name }}</a>

        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

           <li class="nav-item">
            <router-link to="/" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt red"></i>
              <p>Dashboard</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/branch" class="nav-link">
              <i class="nav-icon fas fa-code-branch blue"></i>
              <p>Branches</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/courier" class="nav-link">
              <i class="nav-icon fas fa-biking yellow"></i>
              <p>Couriers</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/user" class="nav-link">
              <i class="nav-icon fas fa-users acikpink"></i>
              <p>Users</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/task" class="nav-link">
              <i class="nav-icon fas fa-tasks green"></i>
              <p>Tasks</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/address" class="nav-link">
              <i class="nav-icon fas fa-address-card pink"></i>
              <p>Addresses</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/city" class="nav-link">
              <i class="nav-icon far fa-dot-circle bordo"></i>
              <p>Cities</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/district" class="nav-link">
              <i class="nav-icon fas fa-bullseye green2"></i>
              <p>Districts</p>
            </router-link>
          </li>
          <li class="nav-header">CUSTOMIZATION</li>
          <li class="nav-item">
           <router-link to="/profile" class="nav-link">
            <i class="nav-icon fas fa-user blue"></i>
            <p>Profile</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/setting" class="nav-link">
            <i class="nav-icon fas fa-cog green"></i>
            <p>Settings</p>
          </router-link>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link" @click="logout">
            <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
            <p class="text">Logout</p>
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
      ...mapGetters("profile", ["admin"])
    },

    mounted() {
      this.getAdminData();
    },

    methods: {
      ...mapActions("auth", ["sendLogoutRequest"]),
      ...mapActions("profile", ["getAdminData"]),

      logout() {
        this.sendLogoutRequest();
        this.$router.push({name: 'Login'});
      }
    }
  };
</script>
<style scoped>
.red { color:#ff0000; }
.blue { color:#99eaff; }
.blue2 { color:#c6e2ff; }
.green { color:#93e993 ; }
.green2 { color:#7fffbf ; }
.pink { color:#ba76ad ; }
.acikpink { color:#dacdf7 ; }
.yellow { color:#fcd314 ; }
.bordo { color:#b60095 ; }
</style>
