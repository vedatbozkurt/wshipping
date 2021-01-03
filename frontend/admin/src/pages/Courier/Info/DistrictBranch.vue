<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Courier District Branches</h3>
      <div class=" float-right col-sm-6" >
        <multiselect v-model="courier.district" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Şube İlçesi Seçin" :options="courierDistrict" :searchable="false" :allow-empty="false" @input='getDistrictBranches'>
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
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th style="width: 70px">Actions</th>
          </tr>
        </thead>
        <tbody>
         <tr v-for="branch in courierDistrictBranches.data" :key="branch.id">
            <td>{{ branch.id }}</td>
            <td>{{ branch.name}}</td>
            <td>{{ branch.phone }}</td>
            <td>{{ branch.email }}</td>
            <td>
              <router-link style="margin-right: 11px"  :to="{name: 'EditBranch', params: { id: branch.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
     <small v-show="empty"><center>Select a district to view branches</center></small>
     <small v-show="!empty && courierDistrictBranches == ''"><center>Not Found.</center></small>
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
    ...mapGetters("courier", ["courier","courierDistrict","courierDistrictBranches"]),
  },
  created() {
    this.$store.commit("courier/setCourier", {}); //bu olmazsa detailsden birden fazla district id gelir district task hata verir
    this.getCourierDistricts();
  },
  methods: {
    ...mapActions("courier", ["getCourierDistrict","getCourierDistrictBranches"]),
    getCourierDistricts: function() {
      this.getCourierDistrict(this.$route.params.id).then(() => {
      });
    },
    getDistrictBranches: function() {
      this.getCourierDistrictBranches(this.courier.district.id).then(() => {
        this.empty = false;
      });
    },
  }
}
</script>
