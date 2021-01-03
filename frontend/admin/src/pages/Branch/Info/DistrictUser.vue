<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">{{ $t('branch.branchDistrictUsers') }}</h3>
      <div class=" float-right col-sm-6" >
        <multiselect v-model="branch.district" :deselect-label="$t('select.cantRemove')" track-by="name" label="name" :placeholder="$t('select.selectDistrict')" :options="branchDistrict" :searchable="true" :allow-empty="false" @input='getDistrictUsers'>
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
            <th>{{ $t('form.photo') }}</th>
            <th>{{ $t('form.name') }}</th>
            <th>{{ $t('form.phone') }}</th>
            <th>{{ $t('form.email') }}</th>
            <th>{{ $t('form.status') }}</th>
            <th style="width: 70px">{{ $t('actions') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in branchDistrictUsers.data" :key="user.id">
            <td>{{ user.id }}</td>
            <td><img alt="Avatar" class="table-avatar" :src="getPhoto('user',user.image)"></td>
            <td>
              {{ user.name}}<br/>
              <small>
                {{ user.created_at | moment("MMMM Do YYYY") }}
              </small>
            </td>
            <td>{{ user.phone}}</td>
            <td>{{ user.email}}</td>
            <td><span class="badge " :class="user.status == 1 ? 'badge-success' : 'badge-warning'" >{{ user.status == 1 ? $t('form.active') : $t('form.inactive')}}</span></td>
            <td>
              <router-link style="margin-right: 11px"  :to="{name: 'EditUser', params: { id: user.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
     <small v-show="empty"><center>{{ $t('select.selectDistrict') }}</center></small>
     <small v-show="!empty && branchDistrictUsers == ''"><center>{{ $t('notFound') }}</center></small>
     <ul class="pagination pagination-sm m-0 float-right">
      <pagination class="float-right" :data="branchDistrictUsers" @pagination-change-page="getBranchDistrictUsers"></pagination>
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
      empty: true,
    }
  },

  computed: {
    ...mapGetters("branch", ["branch","branchDistrict","branchDistrictUsers"]),
  },
  created() {
    this.$store.commit("branch/setBranchDistrictUsers", {});
    this.$store.commit("branch/setBranch", {}); //bu olmazsa detailsden birden fazla district id gelir district user hata verir
    this.getBranchDistricts();
  },
  methods: {
    ...mapActions("branch", ["getBranchDistrict","getBranchDistrictUsers"]),
    getBranchDistricts: function() {
      this.getBranchDistrict(this.$route.params.id).then(() => {
      });
    },
    getDistrictUsers: function() {
      this.$store.commit("branch/setBranchDistrictID", this.branch.district.id);
      this.getBranchDistrictUsers().then(() => {
        this.empty = false;
      });
    },
    getPhoto: (owner,image) => { return process.env.VUE_APP_URL+"images/"+ owner+"/"+image }
  }
}
</script>
