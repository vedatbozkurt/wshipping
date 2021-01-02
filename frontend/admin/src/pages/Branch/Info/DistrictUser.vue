<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Branch District Users</h3>
      <div class=" float-right col-sm-6" >
        <multiselect v-model="branch.district" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Şube İlçesi Seçin" :options="branchDistrict" :searchable="false" :allow-empty="false" @input='getDistrictUsers'>
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
          <tr v-for="user in branchDistrictUsers" :key="user.id">
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
     <small v-show="empty"><center>Select a district to view users</center></small>
     <small v-show="!empty && branchDistrictUsers == ''"><center>Not Found.</center></small>
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
      empty: true,
    }
  },

  computed: {
    ...mapGetters("branch", ["branch","branchDistrict","branchDistrictUsers"]),
  },
  created() {
    this.$store.commit("branch/setBranch", {}); //bu olmazsa detailsden birden fazla district id gelir district user hata verir
    this.getBranchDistricts();
  },
  methods: {
    ...mapActions("branch", ["getBranchDistrict","getBranchDistrictUsers"]),
    getBranchDistricts: function() {
      this.getBranchDistrict(this.$route.params.id).then(() => {
      });
    },
    getDistrictUsers: function() {
      this.getBranchDistrictUsers(this.branch.district.id).then(() => {
        this.empty = false;
      });
    },
  }
}
</script>
