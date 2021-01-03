<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">{{ $t('branch.branchCouriers') }}</h3>
    </div>
    <!-- /.card-header -->
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped projects">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>{{ $t('form.photo') }}</th>
            <th>{{ $t('form.name') }}</th>
            <th>{{ $t('form.phone') }}</th>
            <th>{{ $t('form.email') }}</th>
            <th>{{ $t('form.status') }}</th>
            <th style="width: 70px">{{ $t('actions') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="courier in branchCourier.data" :key="courier.id">
            <td>{{ courier.id }}</td>
            <td><img alt="Avatar" class="table-avatar" :src="getPhoto('courier',courier.image)"></td>
            <td>
              {{ courier.name}}<br/>
              <small>
                {{ courier.created_at | moment("MMMM Do YYYY") }}
              </small>
            </td>
            <td>{{ courier.phone}}</td>
            <td>{{ courier.email}}</td>
            <td><span class="badge " :class="courier.status == 1 ? 'badge-success' : 'badge-warning'" >{{ courier.status === 1 ? $t('form.active') : $t('form.inactive')}}</span></td>
            <td>
              <router-link style="margin-right: 11px"  :to="{name: 'EditCourier', params: { id: courier.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
     <small v-show="branchCourier == ''"><center>{{ $t('notFound') }}</center></small>
     <ul class="pagination pagination-sm m-0 float-right">
       <pagination class="float-right" :data="branchCourier" @pagination-change-page="getBranchCourier"></pagination>
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
    }
  },

  computed: {
    ...mapGetters("branch", ["branchCourier"]),
  },
  created() {
    this.$store.commit('branch/setBranchID', this.$route.params.id);
    this.getBranchCourier();
  },
  methods: {
    ...mapActions("branch", ["getBranchCourier"]),
    getPhoto: (owner,image) => { return process.env.VUE_APP_URL+"images/"+ owner+"/"+image } //show image
  }
}
</script>
