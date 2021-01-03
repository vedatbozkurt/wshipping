<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">{{ $t('branch.branchCityCouriers') }}</h3>
      <div class=" float-right col-sm-6" >
        <multiselect v-model="branch.city" :deselect-label="$t('select.cantRemove')" track-by="name" label="name" :placeholder="$t('select.selectCity')" :options="branchCity" :searchable="true" :allow-empty="false" @input='getCityCouriers'>
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
          <tr v-for="courier in branchCityCouriers.data" :key="courier.id">
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
     <small v-show="empty"><center>{{ $t('select.selectCity') }}</center></small>
     <small v-show="!empty && branchCityCouriers == ''"><center>{{ $t('notFound') }}</center></small>
     <ul class="pagination pagination-sm m-0 float-right">
      <pagination class="float-right" :data="branchCityCouriers" @pagination-change-page="getBranchCityCouriers"></pagination>
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
    ...mapGetters("branch", ["branch","branchCity","branchCityCouriers"]),
  },
  created() {
    this.$store.commit("branch/setBranchCityCouriers", {});
    this.$store.commit("branch/setBranch", {}); //bu olmazsa detailsden birden fazla city id gelir city courier hata verir
    this.getBranchCities();
  },
  methods: {
    ...mapActions("branch", ["getBranchCity","getBranchCityCouriers"]),
    getBranchCities: function() {
      this.getBranchCity(this.$route.params.id).then(() => {

      });
    },
    getCityCouriers: function() {
      this.$store.commit("branch/setBranchCityID", this.branch.city.id);
      this.getBranchCityCouriers().then(() => {
        this.empty = false;
      });
    },
    getPhoto: (owner,image) => { return process.env.VUE_APP_URL+"images/"+ owner+"/"+image }
  }
}
</script>
