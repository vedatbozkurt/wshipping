<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Branch Users</h3>

      <div class="card-tools">
        <div class="input-group input-group-sm">
          <input type="text" class="form-control" placeholder="Search User">
          <div class="input-group-append">
            <div class="btn btn-primary">
              <i class="fas fa-search"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-tools -->
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
          <tr v-for="user in branchUser" :key="user.id">
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
            <td><span class="badge " :class="user.status ? 'badge-success' : 'badge-warning'" >{{ user.status === 1 ? 'active' : 'inactive'}}</span></td>
            <td>
              <button style="margin-right: 11px" class="btn btn-outline-info btn-xs btn-flat">
                <i class="fas fa-edit"></i>
              </button>
              <button class="btn btn-outline-danger btn-xs btn-flat">
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
     <small v-show="branchUser == ''"><center>Not Found.</center></small>
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
    this.getBranchUser(this.$route.params.id);
  },
  methods: {
    ...mapActions("branch", ["getBranchUser"]),
  }
}
</script>
