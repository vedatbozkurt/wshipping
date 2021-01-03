<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Courier City Branches</h3>
      <div class=" float-right col-sm-6" >
        <multiselect v-model="courier.city" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Şube İli Seçin" :options="courierCity" :searchable="false" :allow-empty="false" @input='getCityBranches'>
          <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> ilindeki şubeler<strong>  {{ option.language }}</strong></template>
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
         <tr v-for="branch in courierCityBranches.data" :key="branch.id">
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
     <small v-show="empty"><center>Select a city to view branches</center></small>
     <small v-show="!empty && courierCityBranches == ''"><center>Not Found.</center></small>
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
    ...mapGetters("courier", ["courier","courierCity","courierCityBranches"]),
  },
  created() {
    this.$store.commit("courier/setCourierCityBranches", {});
    this.$store.commit("courier/setCourier", {}); //bu olmazsa detailsden birden fazla city id gelir city task hata verir
    this.getCourierCities();
  },
  methods: {
    ...mapActions("courier", ["getCourierCity","getCourierCityBranches"]),
    getCourierCities: function() {
      this.getCourierCity(this.$route.params.id).then(() => {

      });
    },
    getCityBranches: function() {
      this.getCourierCityBranches(this.courier.city.id).then(() => {
        this.empty = false;
      });
    },
  }
}
</script>
