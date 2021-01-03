  <template>
   <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="https://adminlte.io/themes/dev/AdminLTE/dist/img/AdminLTELogo.png"
      alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3"
      style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://adminlte.io/themes/dev/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div><!--
        <div class="info">
          <router-link to="/profile" class="d-block">{{ user.name }}</router-link>
        </div> -->
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-primary"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../index.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
            </ul>
          </li>
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
              <i class="nav-icon fas fa-biking olive"></i>
              <p>Couriers</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/user" class="nav-link">
              <i class="nav-icon fas fa-users pink"></i>
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
              <i class="nav-icon fas fa-tasks red"></i>
              <p>Addresses</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/city" class="nav-link">
              <i class="nav-icon fas fa-tasks red"></i>
              <p>Cities</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/district" class="nav-link">
              <i class="nav-icon fas fa-tasks red"></i>
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
            <i class="nav-icon far fa-circle text-danger"></i>
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
  import { mapGetters, mapActions } from "vuex";
  export default {
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
        this.$router.push({name: 'Login'});
      }
    }
  };
</script>
<style scoped>
.red { color:#ff0000; }
.blue { color:#99eaff; }
.green { color:#93e993 ; }
.green { color:#93e993 ; }
.olive { color:#808000 ; }
.pink { color:#ba76ad ; }

</style>
