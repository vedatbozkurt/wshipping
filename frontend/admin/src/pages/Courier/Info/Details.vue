<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Edit Courier</h3>
      <div class="card-tools">
        <button v-if="courier.deleted_at" @click="restoreThisCourier" class="btn btn-outline-warning btn-sm btn-flat">
          <i class="fas fa-recycle"></i> Restore
        </button>
      </div>
    </div>
    <!-- /.card-header -->
    <form>
      <div :class="{'loader': loader}"></div>
      <div class="card-body">
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">City</label>
          <div class="col-sm-10">
            <multiselect v-model="courier.city" :options="cities" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name" track-by="name" :preselect-first="true"  @input='getCitiesDistricts'>
            </multiselect>

            <span class="text-danger" v-if="errors.city"> {{ errors.city[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">District</label>
          <div class="col-sm-10">
            <multiselect v-model="courier.district" :options="citiesDistricts" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name" track-by="name" :preselect-first="true">
            </multiselect>
            <span class="text-danger" v-if="errors.district"> {{ errors.district[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" v-model="courier.name" v-bind:class="{ 'is-invalid':errors.name }">
            <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Phone</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" v-model="courier.phone" v-bind:class="{ 'is-invalid': errors.phone }">
            <span class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" v-model="courier.email" v-bind:class="{ 'is-invalid': errors.email }">
            <span class="text-danger" v-if="errors.email"> {{ errors.email[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" v-model="courier.password" v-bind:class="{ 'is-invalid': errors.password }">
            <span class="text-danger" v-if="errors.password"> {{ errors.password[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Vehicle</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" v-model="courier.vehicle" v-bind:class="{ 'is-invalid':errors.vehicle }">
            <span class="text-danger" v-if="errors.vehicle"> {{ errors.vehicle[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Plate</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" v-model="courier.plate" v-bind:class="{ 'is-invalid':errors.plate }">
            <span class="text-danger" v-if="errors.plate"> {{ errors.plate[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Color</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" v-model="courier.color" v-bind:class="{ 'is-invalid':errors.color }">
            <span class="text-danger" v-if="errors.color"> {{ errors.color[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
          <div class="col-sm-10">
            <select class="form-control" v-bind:class="{ 'is-invalid': errors.status }" v-model="courier.status">
              <option value="0">Inactive</option>
              <option value="1">Active</option>
            </select>
            <span class="text-danger" v-if="errors.status"> {{ errors.status[0] }}</span>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="button" @click="updateThisCourier" class="btn btn-info">Save</button>
        <button type="button" @click="deleteCourierConfirm(courier.id)" class="btn btn-danger float-right">Delete</button>

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
    ...mapGetters(["errors","loader"]),
    ...mapGetters("courier", ["courier"]),
    ...mapGetters("city", ["cities"]),
    ...mapGetters("district", ["citiesDistricts"]),

  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit('district/setCitiesDistricts', []);
  },
  created() {
    this.getCourier(this.$route.params.id);
    this.getCities();
  },
  methods: {
    ...mapActions("courier", ["updateCourier","getCourier","deleteCourierFromEdit","restoreCourier"]),
    ...mapActions("city", ["getCities"]),
    ...mapActions("district", ["getCitiesDistricts"]),

    getCityDistricts: function() {
      this.getCitiesDistricts(this.courier.city).then(() => {
        // this.myToast('success','Districts has been called.');
      });
    },
    updateThisCourier: function() {
      this.updateCourier(this.courier).then(() => {
        this.myToast('success','Courier has been updated.');
      });
    },
    deleteCourierConfirm(id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          this.deleteCourierConfirmed(id)
        }
      });
    },
    deleteCourierConfirmed: function(id) {
      this.deleteCourierFromEdit(id).then(() => {
        this.myToast('success','Courier has been deleted.');
        this.$router.push({ name: "Couriers" });
      });
    },
    restoreThisCourier: function() {
      this.restoreCourier(this.courier.id).then(() => {
        this.myToast('success','Courier has been restored.');
        this.$router.push({ name: "Couriers" });
      });
    },
  }
}
</script>
