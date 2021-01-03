<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">District Branches</h3>

      <div class="card-tools">
        <div class="input-group input-group-sm">
          <input type="text" class="form-control" placeholder="Search Branch">
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
            <th>Phone</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Status</th>
            <th style="width: 70px">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="branch in districtBranches.data" :key="branch.id">
            <td>{{ branch.id }}</td>
            <td>{{ branch.name}}</td>
            <td>{{ branch.phone}}</td>
            <td>{{ branch.email}}</td>
            <td>{{ branch.created_at | moment("MMMM Do YYYY") }}</td>
            <td><span class="badge " :class="branch.status == 1 ? 'badge-success' : 'badge-warning'" >{{ branch.status == 1 ? 'active' : 'inactive'}}</span></td>
            <td>
              <router-link style="margin-right: 11px"  :to="{name: 'EditBranch', params: { id: branch.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
     <small v-show="districtBranches == ''"><center>Not Found.</center></small>
     <pagination class="float-right" :data="districtBranches" @pagination-change-page="getDistrictBranches"></pagination>
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
    ...mapGetters("district", ["districtBranches"]),
  },
  mounted() {
    // this.$store.commit('city/setcityTasks', {});
  },
  created() {
    this.$store.commit('district/setDistrictID', this.$route.params.id);
    this.getDistrictBranches();
  },
  methods: {
    ...mapActions("district", ["getDistrictBranches"]),
  }
}
</script>
