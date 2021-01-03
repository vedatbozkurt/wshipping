<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">{{ $t('city.cityDistricts') }}</h3>
    </div>
    <!-- /.card-header -->
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped projects">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>{{ $t('form.name') }}</th>
            <th style="width: 70px">{{ $t('actions') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="district in cityDistricts.data" :key="district.id">
            <td>{{ district.id }}</td>
            <td>{{ district.name}}</td>
            <td>
              <router-link style="margin-right: 11px"  :to="{name: 'EditDistrict', params: { id: district.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
     <small v-show="cityDistricts == ''"><center>{{ $t('notFound') }}</center></small>
     <pagination class="float-right" :data="cityDistricts" @pagination-change-page="getCityDistricts"></pagination>
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
    ...mapGetters("city", ["cityDistricts"]),
  },
  mounted() {
    // this.$store.commit('city/setcityTasks', {});
  },
  created() {
    this.$store.commit('city/setCityID', this.$route.params.id);
    this.getCityDistricts();
  },
  methods: {
    ...mapActions("city", ["getCityDistricts"]),
  }
}
</script>
