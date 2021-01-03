<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">District Couriers</h3>
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
            <th>Created At</th>
            <th>Status</th>
            <th style="width: 70px">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="courier in districtCouriers.data" :key="courier.id">
            <td>{{ courier.id }}</td>
            <td><img alt="Avatar" class="table-avatar" src="https://adminlte.io/themes/dev/AdminLTE/dist/img/avatar.png"></td>
            <td>{{ courier.name }}</td>
            <td>{{ courier.phone }}</td>
            <td>{{ courier.email }}</td>
            <td>{{ courier.created_at | moment("MMMM Do YYYY") }}</td>
            <td><span class="badge " :class="courier.status == 1 ? 'badge-success' : 'badge-warning'" >{{ courier.status == 1 ? 'active' : 'inactive'}}</span></td>
            <td>
              <router-link style="margin-right: 11px"  :to="{name: 'EditCourier', params: { id: courier.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
     <small v-show="districtCouriers == ''"><center>Not Found.</center></small>
     <pagination class="float-right" :data="districtCouriers" @pagination-change-page="getDistrictCouriers"></pagination>
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
    ...mapGetters("district", ["districtCouriers"]),
  },
  mounted() {
    // this.$store.commit('city/setcityTasks', {});
  },
  created() {
    // this.getDistrictCouriers(this.$route.params.id);
    this.$store.commit('district/setDistrictID', this.$route.params.id);
    this.getDistrictCouriers();
  },
  methods: {
    ...mapActions("district", ["getDistrictCouriers"]),
  }
}
</script>
