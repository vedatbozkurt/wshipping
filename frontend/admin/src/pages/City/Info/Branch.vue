<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">{{ $t('city.cityBranches') }}</h3>
    </div>
    <!-- /.card-header -->
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped projects">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
           <th>{{ $t('form.name') }}</th>
            <th>{{ $t('form.phone') }}</th>
            <th>{{ $t('form.email') }}</th>
            <th>{{ $t('form.createdAt') }}</th>
            <th>{{ $t('form.status') }}</th>
            <th style="width: 70px">{{ $t('actions') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="branch in cityBranches.data" :key="branch.id">
            <td>{{ branch.id }}</td>
            <td>{{ branch.name}}</td>
            <td>{{ branch.phone}}</td>
            <td>{{ branch.email}}</td>
            <td>{{ branch.created_at | moment("MMMM Do YYYY") }}</td>
            <td><span class="badge " :class="branch.status == 1 ? 'badge-success' : 'badge-warning'" >{{ branch.status == 1 ? $t('form.active') : $t('form.inactive')}}</span></td>
            <td>
             <router-link style="margin-right: 11px"  :to="{name: 'EditBranch', params: { id: branch.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
     <small v-show="cityBranches == ''"><center>{{ $t('notFound') }}</center></small>
     <pagination class="float-right" :data="cityBranches" @pagination-change-page="getCityBranches"></pagination>
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
    ...mapGetters("city", ["cityBranches"]),
  },
  mounted() {
    // this.$store.commit('city/setcityTasks', {});
  },
  created() {
    this.$store.commit('city/setCityID', this.$route.params.id);
    this.getCityBranches();
  },
  methods: {
    ...mapActions("city", ["getCityBranches"]),
  }
}
</script>
