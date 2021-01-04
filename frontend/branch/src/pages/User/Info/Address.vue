<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">{{ $t('user.userAddresses') }}</h3>
    </div>
    <!-- /.card-header -->
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped projects">
        <thead>
          <tr>
            <th style="width: 10px">#ID</th>
            <th>{{ $t('form.name') }}</th>
            <th>{{ $t('form.city') }}</th>
            <th>{{ $t('form.district') }}</th>
            <th>{{ $t('form.createdAt') }}</th>
            <th style="width: 70px">{{ $t('actions') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="address in userAddress.data" :key="address.id">
            <td>{{ address.id }}</td>
            <td>{{ address.name}}</td>
            <td>{{ address.city.name}}</td>
            <td>{{ address.district.name}}</td>
            <td>{{ address.created_at | moment("MMMM Do YYYY") }}</td>
             <td>
              <router-link style="margin-right: 11px"  :to="{name: 'EditAddress', params: { id: address.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
     <small v-show="userAddress == ''"><center>{{ $t('notFound') }}</center></small>
     <pagination class="float-right" :data="userAddress" @pagination-change-page="getUserAddress"></pagination>
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
    ...mapGetters("user", ["userAddress"]),
  },
  created() {
    this.$store.commit('user/setUserID', this.$route.params.id);
    this.getUserAddress();
  },
  methods: {
    ...mapActions("user", ["getUserAddress"]),
  }
}
</script>
