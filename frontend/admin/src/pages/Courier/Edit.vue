<template>
  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $t('courier.editCourier') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/">{{ $t('home') }}</router-link>
                <li class="breadcrumb-item"><router-link to="/courier">{{ $t('courier.couriers') }}</router-link>
                  <li class="breadcrumb-item active">{{ $t('courier.editCourier') }}</li>
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
              <h3 class="card-title">{{ $t('courier.editCourierForm') }}</h3>
              <div class="card-tools">
                <button v-if="courier.deleted_at" @click="restoreThisCourier" class="btn btn-outline-warning btn-sm btn-flat">
                  <i class="fas fa-recycle"></i> {{ $t('restore') }}
                </button>
              </div>
            </div>
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.city') }}</label>
                  <div class="col-sm-10">
                    <multiselect v-model="editedCourier.city" :options="cities" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('select.selectCity')" label="name" track-by="name" :preselect-first="true"  @input='getCitiesDistricts'>
                    </multiselect>

                    <span class="text-danger" v-if="errors.city"> {{ errors.city[0] }}</span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.district') }}</label>
                  <div class="col-sm-10">
                    <multiselect v-model="editedCourier.district" :options="citiesDistricts" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('select.selectDistrict')" label="name" track-by="name" :preselect-first="true">
                    </multiselect>
                    <span class="text-danger" v-if="errors.district"> {{ errors.district[0] }}</span>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.photo') }}</label>
                  <div class="col-sm-10">
                   <img width="150" :src="getProfilePhoto()">
                   <input type="file" class="form-control" v-on:change="onImageChanger">
                   <span class="text-danger" v-if="errors.image"> {{ errors.image[0] }}</span>
                 </div>
               </div>

               <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.name') }}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" v-model="editedCourier.name" v-bind:class="{ 'is-invalid':errors.name }">
                  <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.phone') }}</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" v-model="editedCourier.phone" v-bind:class="{ 'is-invalid': errors.phone }">
                  <span class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }}</span>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.email') }}</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" v-model="editedCourier.email" v-bind:class="{ 'is-invalid': errors.email }">
                  <span class="text-danger" v-if="errors.email"> {{ errors.email[0] }}</span>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.password') }}</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" v-model="editedCourier.password" v-bind:class="{ 'is-invalid': errors.password }">
                  <span class="text-danger" v-if="errors.password"> {{ errors.password[0] }}</span>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.vehicle') }}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" v-model="editedCourier.vehicle" v-bind:class="{ 'is-invalid':errors.vehicle }">
                  <span class="text-danger" v-if="errors.vehicle"> {{ errors.vehicle[0] }}</span>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.plate') }}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" v-model="editedCourier.plate" v-bind:class="{ 'is-invalid':errors.plate }">
                  <span class="text-danger" v-if="errors.plate"> {{ errors.plate[0] }}</span>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.color') }}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" v-model="editedCourier.color" v-bind:class="{ 'is-invalid':errors.color }">
                  <span class="text-danger" v-if="errors.color"> {{ errors.color[0] }}</span>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.status') }}</label>
                <div class="col-sm-10">
                  <select class="form-control" v-bind:class="{ 'is-invalid': errors.status }" v-model="editedCourier.status">
                    <option value="0">{{ $t('form.inactive') }}</option>
                    <option value="1">{{ $t('form.active') }}</option>
                  </select>
                  <span class="text-danger" v-if="errors.status"> {{ errors.status[0] }}</span>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="button" @click="updateThisCourier" class="btn btn-info">{{ $t('save') }}</button>
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
        previous_image:'no-image.png',
        editedCourier: {
          image:'no-image.png',
          password:''
        }
      }
    },

    computed: {
      ...mapGetters(["errors","loader"]),
      ...mapGetters("courier", ["courier"]),
      ...mapGetters("city", ["cities"]),
      ...mapGetters("district", ["citiesDistricts"]),

    },
    mounted() {
      this.$store.commit("setErrors", {});
      this.$store.commit('district/setCitiesDistricts', []);
      this.getCourier(this.$route.params.id).then(() => {
        if (this.courier.image == "") { this.courier.image = 'no-image.png';}
        this.previous_image = this.courier.image;
        this.editedCourier = this.courier;
      });
    },
    created() {
      this.getCities();

    },
    methods: {
      ...mapActions("courier", ["updateCourier","getCourier","restoreCourier"]),
      ...mapActions("city", ["getCities"]),
      ...mapActions("district", ["getCitiesDistricts"]),
      getProfilePhoto(){
        if (this.courier.image) {
          return process.env.VUE_APP_URL+"images/courier/" + this.previous_image;
        }else{
          return process.env.VUE_APP_URL+"images/courier/"+ this.editedCourier.image;
        }
      },
      onImageChanger(e) {
        this.courier.image = e.target.files[0];
      },
      getCityDistricts: function() {
        this.getCitiesDistricts(this.courier.city).then(() => {
        // this.myToast('success','Districts has been called.');
      });
      },
      restoreThisCourier: function() {
        this.restoreCourier(this.courier.id).then(() => {
          this.myToast('success',this.$t('courier.restoredCourier'));
          this.$router.push({ name: "Couriers" });
        });
      },
      updateThisCourier: function() {
       let formData = new FormData();
       formData.append('id', this.editedCourier.id);
       formData.append('previous_image', this.previous_image);
       formData.append('city', JSON.stringify(this.editedCourier.city));
       formData.append('district', JSON.stringify(this.editedCourier.district));
       formData.append('phone', this.editedCourier.phone);
       formData.append('name', this.editedCourier.name);
       formData.append('email', this.editedCourier.email);
       formData.append('vehicle', this.editedCourier.vehicle);
       formData.append('plate', this.editedCourier.plate);
       formData.append('color', this.editedCourier.color);
       formData.append('password', this.editedCourier.password);
       formData.append('image', this.editedCourier.image);
       formData.append('status', this.editedCourier.status);
       formData.append("_method", "put");
       this.updateCourier(formData).then(() => {
        this.myToast('success',this.$t('courier.updatedCourier'));
        this.$router.push({ name: "Couriers" });
      });
     }
   }
 }
</script>
