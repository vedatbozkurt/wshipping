<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Branch District Couriers</h3>
      <div class=" float-right col-sm-6" >
        <multiselect v-model="branch.district" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Şube İlçesi Seçin" :options="branchDistrict" :searchable="true" :allow-empty="false" @input='getDistrictCouriers'>
          <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> ilçesindeki kuryeler<strong>  {{ option.language }}</strong></template>
        </multiselect>
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
          <tr v-for="courier in branchDistrictCouriers.data" :key="courier.id">
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
            <td><span class="badge " :class="courier.status == 1 ? 'badge-success' : 'badge-warning'" >{{ courier.status == 1 ? 'active' : 'inactive'}}</span></td>
            <td>
              <router-link style="margin-right: 11px"  :to="{name: 'EditCourier', params: { id: courier.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
     <small v-show="empty"><center>Select a district to view couriers</center></small>
     <small v-show="!empty && branchDistrictCouriers == ''"><center>Not Found.</center></small>
     <ul class="pagination pagination-sm m-0 float-right">
      <pagination class="float-right" :data="branchDistrictCouriers" @pagination-change-page="getBranchDistrictCouriers"></pagination>
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
      empty: true,
    }
  },

  computed: {
    ...mapGetters("branch", ["branch","branchDistrict","branchDistrictCouriers"]),
  },
  created() {
    this.$store.commit("branch/setBranchDistrictCouriers", {});
    this.$store.commit("branch/setBranch", {}); //bu olmazsa detailsden birden fazla district id gelir district courier hata verir
    this.getBranchDistricts();
  },
  methods: {
    ...mapActions("branch", ["getBranchDistrict","getBranchDistrictCouriers"]),
    getBranchDistricts: function() {
      this.getBranchDistrict(this.$route.params.id).then(() => {
      });
    },
    getDistrictCouriers: function() {
      this.$store.commit("branch/setBranchDistrictID", this.branch.district.id);
      this.getBranchDistrictCouriers().then(() => {
        this.empty = false;
      });
    },
  }
}
</script>
