<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $t('courier.createCourier') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/">{{ $t('home') }}</router-link>
                <li class="breadcrumb-item"><router-link to="/courier">{{ $t('courier.couriers') }}</router-link>
                  <li class="breadcrumb-item active">{{ $t('courier.createCourier') }}</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{ $t('courier.newCourierForm') }}</h3>

              <div class="card-tools">
           <!--  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button> -->
          </div>
        </div>
        <!-- form start -->
        <form>
          <div class="card-body">
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.city') }}</label>
              <div class="col-sm-10">
                <multiselect v-model="courier.city" :options="cities" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('select.selectCity')" label="name" track-by="name" :preselect-first="true"  @input='getCitiesDistricts'>
                </multiselect>
                <span class="text-danger" v-if="errors.city"> {{ errors.city[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.district') }}</label>
              <div class="col-sm-10">
                <multiselect v-model="courier.district" :options="citiesDistricts" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('select.selectDistrict')" label="name" track-by="name" :preselect-first="true">
                </multiselect>

                <span class="text-danger" v-if="errors.district"> {{ errors.district[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.photo') }}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="courier.image" v-bind:class="{ 'is-invalid':errors.image }">
                <span class="text-danger" v-if="errors.image"> {{ errors.image[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.name') }}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="courier.name" v-bind:class="{ 'is-invalid':errors.name }">
                <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.phone') }}</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" v-model="courier.phone" v-bind:class="{ 'is-invalid': errors.phone }">
                <span class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.email') }}</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" v-model="courier.email" v-bind:class="{ 'is-invalid': errors.email }">
                <span class="text-danger" v-if="errors.email"> {{ errors.email[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.password') }}</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" v-model="courier.password" v-bind:class="{ 'is-invalid': errors.password }">
                <span class="text-danger" v-if="errors.password"> {{ errors.password[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.vehicle') }}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="courier.vehicle" v-bind:class="{ 'is-invalid':errors.vehicle }">
                <span class="text-danger" v-if="errors.vehicle"> {{ errors.vehicle[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.plate') }}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="courier.plate" v-bind:class="{ 'is-invalid':errors.plate }">
                <span class="text-danger" v-if="errors.plate"> {{ errors.plate[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.color') }}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="courier.color" v-bind:class="{ 'is-invalid':errors.color }">
                <span class="text-danger" v-if="errors.color"> {{ errors.color[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.status') }}</label>
              <div class="col-sm-10">
                <select class="form-control" v-bind:class="{ 'is-invalid': errors.status }" v-model="courier.status">
                  <option value="0">{{ $t('form.inactive') }}</option>
                  <option value="1">{{ $t('form.active') }}</option>
                </select>
                <span class="text-danger" v-if="errors.status"> {{ errors.status[0] }}</span>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="button" @click="addCourier()" class="btn btn-info">{{ $t('save') }}</button>
            <router-link to="/courier" class="btn btn-default float-right">
              {{ $t('cancel') }}
            </router-link>
          </div>
          <!-- /.card-footer -->
        </form>
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
 import { mapGetters, mapActions } from "vuex";



 export default {
  data() {
    return {
    }
  },

  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("courier", ["courier"]),
    ...mapGetters("city", ["cities"]),
    ...mapGetters("district", ["citiesDistricts"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit('courier/setCourier', {});
    this.$store.commit('district/setCitiesDistricts', []);
  },
  created() {
    this.getCities();
  },
  methods: {
    ...mapActions("courier", ["createCourier"]),
    ...mapActions("city", ["getCities"]),
    ...mapActions("district", ["getCitiesDistricts"]),

    getCityDistricts: function() {
      this.getCitiesDistricts(this.courier.city).then(() => {
      });
    },
    addCourier: function() {
      this.createCourier(this.courier).then(() => {
        this.myToast('success',this.$t('courier.createdCourier'));
        this.$router.push({ name: "Couriers" });
      });
    }
  }
}
</script>
