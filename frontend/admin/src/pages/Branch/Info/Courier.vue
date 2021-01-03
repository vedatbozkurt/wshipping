<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Branch Courier</h3>

      <div class="card-tools">
        <div class="input-group input-group-sm">
          <input type="text" class="form-control" placeholder="Search Courier">
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
          <tr v-for="courier in branchCourier" :key="courier.id">
            <td>{{ courier.id }}</td>
            <td><img alt="Avatar" class="table-avatar" src="https://adminlte.io/themes/dev/AdminLTE/dist/img/avatar.png"></td>
            <td>
              {{ courier.name}}<br/>
              <small>
                Kayıt: {{ courier.created_at | moment("MMMM Do YYYY") }}
              </small>
            </td>
            <td>{{ courier.phone}}</td>
            <td>{{ courier.email}}</td>
            <td><span class="badge " :class="courier.status == 1 ? 'badge-success' : 'badge-warning'" >{{ courier.status === 1 ? 'active' : 'inactive'}}</span></td>
            <td>
              <router-link style="margin-right: 11px"  :to="{name: 'EditCourier', params: { id: courier.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
     <small v-show="branchCourier == ''"><center>Not Found.</center></small>
      <ul class="pagination pagination-sm m-0 float-right">
       <!--  <pagination class="float-right" :data="branchCourier" @pagination-change-page="getBranchCourier"></pagination> -->
      </ul>
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
    ...mapGetters("branch", ["branchCourier"]),
  },
  created() {
    this.getBranchCourier(this.$route.params.id);
  },
  methods: {
    ...mapActions("branch", ["getBranchCourier"]),
  }
}
</script>
