<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Branch City Tasks</h3>
      <div class=" float-right col-sm-6" >
        <multiselect v-model="branch.city" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Şube İli Seçin" :options="branchCity" :searchable="false" :allow-empty="false" @input='getCityTasks'>
          <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> ilindeki kuryeler<strong>  {{ option.language }}</strong></template>
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
            <th>Description</th>
            <th>Price</th>
            <th>Created At</th>
            <th>Status</th>
            <th style="width: 70px">Actions</th>
          </tr>
        </thead>
        <tbody>
         <tr v-for="task in branchCityTasks" :key="task.id">
            <td>{{ task.id }}</td>
            <td>{{ task.description}}</td>
            <td>{{ task.price}}</td>
            <td>{{ task.created_at | moment("MMMM Do YYYY") }}</td>
            <td><span class="badge " :class="task.status ? 'badge-success' : 'badge-warning'" >{{ task.status == 1 ? 'active' : 'inactive'}}</span></td>
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
     <small v-show="empty"><center>Select a city to view tasks</center></small>
     <small v-show="!empty && branchCityTasks == ''"><center>Not Found.</center></small>
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
    ...mapGetters("branch", ["branch","branchCity","branchCityTasks"]),
  },
  created() {
    this.$store.commit("branch/setBranch", {}); //bu olmazsa detailsden birden fazla city id gelir city task hata verir
    this.getBranchCities();
  },
  methods: {
    ...mapActions("branch", ["getBranchCity","getBranchCityTasks"]),
    getBranchCities: function() {
      this.getBranchCity(this.$route.params.id).then(() => {

      });
    },
    getCityTasks: function() {
      this.getBranchCityTasks(this.branch.city.id).then(() => {
        this.empty = false;
      });
    },
  }
}
</script>
