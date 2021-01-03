<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">{{ $t('city.cityCouriers') }}</h3>
    </div>
    <!-- /.card-header -->
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped projects">
        <thead>
          <tr>
            <th style="width: 10px">#ID</th>
            <th>{{ $t('form.photo') }}</th>
            <th>{{ $t('form.name') }}</th>
            <th>{{ $t('form.phone') }}</th>
            <th>{{ $t('form.email') }}</th>
            <th>{{ $t('form.createdAt') }}</th>
            <th>{{ $t('form.status') }}</th>
            <th style="width: 70px">{{ $t('actions') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="courier in cityCouriers.data" :key="courier.id">
            <td>{{ courier.id }}</td>
            <td><img alt="Avatar" class="table-avatar" :src="getPhoto('courier',courier.image)"></td>
            <td>{{ courier.name }}</td>
            <td>{{ courier.phone }}</td>
            <td>{{ courier.email }}</td>
            <td>{{ courier.created_at | moment("MMMM Do YYYY") }}</td>
            <td><span class="badge " :class="courier.status == 1 ? 'badge-success' : 'badge-warning'" >{{ courier.status == 1 ? $t('form.active') : $t('form.inactive')}}</span></td>
            <td>
              <router-link style="margin-right: 11px"  :to="{name: 'EditCourier', params: { id: courier.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
     <small v-show="cityCouriers == ''"><center>{{ $t('notFound') }}</center></small>
     <pagination class="float-right" :data="cityCouriers" @pagination-change-page="getCityCouriers"></pagination>
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
    ...mapGetters("city", ["cityCouriers"]),
  },
  mounted() {
    // this.$store.commit('city/setcityTasks', {});
  },
  created() {
    this.$store.commit('city/setCityID', this.$route.params.id);
    this.getCityCouriers();
  },
  methods: {
    ...mapActions("city", ["getCityCouriers"]),
    getPhoto: (owner,image) => { return process.env.VUE_APP_URL+"images/"+ owner+"/"+image }
  }
}
</script>
