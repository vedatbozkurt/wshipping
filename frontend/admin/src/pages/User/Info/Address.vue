<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">User Addresses</h3>

      <div class="card-tools">
        <div class="input-group input-group-sm">
          <input type="text" class="form-control" placeholder="Search Address">
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
            <th>Name</th>
            <th>City</th>
            <th>District</th>
            <th>Created At</th>
            <th style="width: 70px">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="address in userAddress.data" :key="address.id">
            <td>{{ address.id }}</td>
            <td>{{ address.name}}</td>
            <td>{{ address.city.name}}</td>
            <td>{{ address.district.name}}</td>
            <td>{{ address.created_at | moment("MMMM Do YYYY") }}</td>
             <td>
              <router-link style="margin-right: 11px"  :to="{name: 'EditAddress', params: { id: address.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
     <small v-show="userAddress == ''"><center>Not Found.</center></small>
     <pagination class="float-right" :data="userAddress" @pagination-change-page="getUserAddress"></pagination>
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
    ...mapGetters("user", ["userAddress"]),
  },
  created() {
    this.$store.commit('user/setUserID', this.$route.params.id);
    this.getUserAddress();
  },
  methods: {
    ...mapActions("user", ["getUserAddress"]),
  }
}
</script>
