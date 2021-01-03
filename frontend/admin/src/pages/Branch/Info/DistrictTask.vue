<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">{{ $t('branch.branchDistrictTasks') }}</h3>
      <div class=" float-right col-sm-6" >
        <multiselect v-model="branch.district" :deselect-label="$t('select.cantRemove')" track-by="name" label="name" :placeholder="$t('select.selectDistrict')" :options="branchDistrict" :searchable="true" :allow-empty="false" @input='getDistrictTasks'>
          <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> {{ $t('select.selected') }}<strong>  {{ option.language }}</strong></template>
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
            <th style="width: 10px">#</th>
            <th>{{ $t('form.description') }}</th>
            <th>{{ $t('form.price') }}</th>
            <th>{{ $t('form.createdAt') }}</th>
            <th>{{ $t('form.status') }}</th>
            <th style="width: 70px">{{ $t('actions') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="task in branchDistrictTasks.data" :key="task.id">
            <td>{{ task.id }}</td>
            <td>{{ task.description}}</td>
            <td>{{ task.price}} {{currency}}</td>
            <td>{{ task.created_at | moment("MMMM Do YYYY") }}</td>
            <td>
                 <task-status v-show="!task.deleted_at" :status=task.status />
              <span v-show="task.deleted_at" class="badge badge-danger">{{ $t('form.deleted') }}</span>
            </td>
            <td>
              <router-link style="margin-right: 11px"  :to="{name: 'EditTask', params: { id: task.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
     <small v-show="empty"><center>{{ $t('select.selectDistrict') }}</center></small>
     <small v-show="!empty && branchDistrictTasks == ''"><center>{{ $t('notFound') }}</center></small>
      <pagination class="float-right" :data="branchDistrictTasks" @pagination-change-page="getBranchDistrictTasks"></pagination>
   </div>
 </div>
 <!-- /.card -->
</template>
<script>
 import TaskStatus from '../../../components/TaskStatus.vue'
 import { mapGetters, mapActions} from "vuex";
 export default {
  data() {
    return {
      empty: true,
    }
  },
  components: {
    TaskStatus
  },
  computed: {
    ...mapGetters(["currency"]),
    ...mapGetters("branch", ["branch","branchDistrict","branchDistrictTasks"]),
  },
  created() {
    this.$store.commit("branch/setBranchDistrictTasks", {});
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
      this.$store.commit("branch/setBranchDistrictID", this.branch.district.id);
      this.getBranchDistrictTasks().then(() => {
        this.empty = false;
      });
    },
  }
}
</script>
