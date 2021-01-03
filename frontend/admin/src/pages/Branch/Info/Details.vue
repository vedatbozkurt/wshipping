<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">{{ $t('branch.editBranch') }}</h3>
    </div>
    <!-- /.card-header -->
    <form>
      <div class="card-body">
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.city') }}</label>
          <div class="col-sm-10">
            <multiselect v-model="branch.city" :options="cities" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('select.selectCity')" label="name" track-by="name" :preselect-first="true"  @input='getCityDistricts'>
            </multiselect>

            <span class="text-danger" v-if="errors.city"> {{ errors.city[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.district') }}</label>
          <div class="col-sm-10">
            <multiselect v-model="branch.district" :options="citiesDistricts" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('select.selectDistrict')" label="name" track-by="name" :preselect-first="true">
            </multiselect>
            <span class="text-danger" v-if="errors.district"> {{ errors.district[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.name') }}</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" v-model="branch.name" v-bind:class="{ 'is-invalid':errors.name }">
            <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.phone') }}</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" v-model="branch.phone" v-bind:class="{ 'is-invalid': errors.phone }">
            <span class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.email') }}</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" v-model="branch.email" v-bind:class="{ 'is-invalid': errors.email }">
            <span class="text-danger" v-if="errors.email"> {{ errors.email[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.password') }}</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" v-model="branch.password" v-bind:class="{ 'is-invalid': errors.password }">
            <span class="text-danger" v-if="errors.password"> {{ errors.password[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.status') }}</label>
          <div class="col-sm-10">
            <select class="form-control" v-bind:class="{ 'is-invalid': errors.status }" v-model="branch.status">
              <option value="0">{{ $t('form.inactive') }}</option>
              <option value="1">{{ $t('form.active') }}</option>
            </select>
            <span class="text-danger" v-if="errors.status"> {{ errors.status[0] }}</span>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="button" @click="updateThisBranch" class="btn btn-info">{{ $t('save') }}</button>
        <button type="button" @click="deleteBranchConfirm(branch.id)" class="btn btn-danger float-right">{{ $t('delete') }}</button>

      </div>
    </form>
  </div>
  <!-- /.card -->
</template>
<script>
 import { mapGetters, mapActions } from "vuex";
 import Swal from 'sweetalert2'
 window.Swal = Swal
 export default {
  data() {
    return {
    }
  },

  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("branch", ["branch"]),
    ...mapGetters("city", ["cities"]),
    ...mapGetters("district", ["citiesDistricts"]),
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit('district/setCitiesDistricts', []);
  },
  created() {
    this.getBranch(this.$route.params.id);
    this.getCities();
  },
  methods: {
    ...mapActions("branch", ["updateBranch","getBranch","deleteBranchFromEdit"]),
    ...mapActions("city", ["getCities"]),
    ...mapActions("district", ["getCitiesDistricts"]),

    getCityDistricts: function() {
      this.getCitiesDistricts(this.branch.city).then(() => {
        // this.myToast('success','Districts has been called.');
      });
    },
    updateThisBranch: function() {
      this.updateBranch(this.branch).then(() => {
        this.myToast('success',this.$t('branch.updatedBranch'));
      });
    },
    deleteBranchConfirm(id){
      Swal.fire({
        title: this.$t('areYouSure'),
        text: this.$t('noRevert'),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: this.$t('yesDelete')
      }).then((result) => {
        if (result.value) {
          this.deleteBranchConfirmed(id)
        }
      });
    },
    deleteBranchConfirmed: function(id) {
      this.deleteBranchFromEdit(id).then(() => {
        this.myToast('success',this.$t('branch.deletedBranch'));
        this.$router.push({ name: "Branches" });
      });
    }
  }
}
</script>
