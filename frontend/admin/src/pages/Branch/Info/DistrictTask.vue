<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Branch District Tasks</h3>
      <div class=" float-right col-sm-6" >
        <multiselect v-model="branch.district" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Şube İlçesi Seçin" :options="branchDistrict" :searchable="false" :allow-empty="false" @input='getDistrictTasks'>
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
            <th>Description</th>
            <th>Price</th>
            <th>Created At</th>
            <th>Status</th>
            <th style="width: 70px">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="task in branchDistrictTasks" :key="task.id">
            <td>{{ task.id }}</td>
            <td>{{ task.description}}</td>
            <td>{{ task.price}}</td>
            <td>{{ task.created_at | moment("MMMM Do YYYY") }}</td>
            <td><span class="badge " :class="task.status == 1 ? 'badge-success' : 'badge-warning'" >{{ task.status == 1 ? 'active' : 'inactive'}}</span></td>
            <td>
              <router-link style="margin-right: 11px"  :to="{name: 'EditTask', params: { id: task.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
     <small v-show="empty"><center>Select a district to view tasks</center></small>
     <small v-show="!empty && branchDistrictTasks == ''"><center>Not Found.</center></small>
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
    ...mapGetters("branch", ["branch","branchDistrict","branchDistrictTasks"]),
  },
  created() {
    this.$store.commit("branch/setBranch", {}); //bu olmazsa detailsden birden fazla district id gelir district task hata verir
    this.getBranchDistricts();
  },
  methods: {
    ...mapActions("branch", ["getBranchDistrict","getBranchDistrictTasks"]),
    getBranchDistricts: function() {
      this.getBranchDistrict(this.$route.params.id).then(() => {
      });
    },
    getDistrictTasks: function() {
      this.getBranchDistrictTasks(this.branch.district.id).then(() => {
        this.empty = false;
      });
    },
  }
}
</script>
