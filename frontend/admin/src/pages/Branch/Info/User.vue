<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Branch Users</h3>
    </div>
    <!-- /.card-header -->
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped projects">
        <thead>
          <tr>
            <th style="width: 10px">#ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Status</th>
            <th style="width: 70px">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in branchUser.data" :key="user.id">
            <td>{{ user.id }}</td>
            <td><img alt="Avatar" class="table-avatar" src="https://adminlte.io/themes/dev/AdminLTE/dist/img/avatar.png"></td>
            <td>
              {{ user.name}}<br/>
              <small>
                Kayıt: {{ user.created_at | moment("MMMM Do YYYY") }}
              </small>
            </td>
            <td>{{ user.phone}}</td>
            <td>{{ user.email}}</td>
            <td><span class="badge " :class="user.status == 1 ? 'badge-success' : 'badge-warning'" >{{ user.status == 1 ? 'active' : 'inactive'}}</span></td>
            <td>
              <router-link style="margin-right: 11px"  :to="{name: 'EditUser', params: { id: user.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
     <small v-show="branchUser == ''"><center>Not Found.</center></small>
     <pagination class="float-right" :data="branchUser" @pagination-change-page="getBranchUser"></pagination>
    </div>
  </div>
  <!-- /.card -->
</template>
<script>
 import { mapGetters, mapActions} from "vuex";
 export default {
  data() {
    return {
    }
  },

  computed: {
    ...mapGetters("branch", ["branchUser"]),
  },
  created() {
    this.$store.commit('branch/setBranchID', this.$route.params.id);
    this.getBranchUser();
  },
  methods: {
    ...mapActions("branch", ["getBranchUser"]),
  }
}
</script>
