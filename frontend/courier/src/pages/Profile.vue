<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>{{ $t('profile') }}</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $t('editProfile') }}</h3>
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
      }
    }
  },

  computed: {
    ...mapGetters(["errors","loader"]),
    ...mapGetters("profile", ["courier"]),
    ...mapGetters("city", ["cities"]),
    ...mapGetters("district", ["citiesDistricts"]),

  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit('district/setCitiesDistricts', []);
    this.getCourierData(this.$route.params.id).then(() => {
      if (this.courier.image == "") { this.courier.image = 'no-image.png';}
      this.previous_image = this.courier.image;
      this.editedCourier = this.courier;
      this.editedCourier.password = '';
    });
  },
  created() {
    this.getCities();
  },
  methods: {
    ...mapActions("profile", ["getCourierData","uploadCourierData"]),
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
     formData.append('image', this.editedCourier.image);
     formData.append('status', this.editedCourier.status);
     if(this.editedCourier.password !== ''){ formData.append('password', this.editedCourier.password); }
     formData.append("_method", "put");
     this.uploadCourierData(formData).then(() => {
      this.myToast('success',this.$t('updatedProfile'));
      this.$router.push({ name: "Dashboard" });
    });
   }
 }
}
</script>
