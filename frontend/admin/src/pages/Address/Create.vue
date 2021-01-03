<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Address</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/">Home</router-link>
                <li class="breadcrumb-item"><router-link to="/address">Addresses</router-link>
                  <li class="breadcrumb-item active">Create Address</li>
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
              <h3 class="card-title">New Address Form</h3>

              <div class="card-tools">
           <!--  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button> -->
          </div>
        </div>
        <!-- form start -->
        <form>
          <div class="card-body">
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">City</label>
              <div class="col-sm-10">
                <multiselect v-model="address.city" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="İl Seçin" :options="cities" :searchable="false" :allow-empty="false" @input='getThisCityDistricts'>
                  <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> il olarak seçildi<strong>  {{ option.language }}</strong></template>
                </multiselect>

                <span class="text-danger" v-if="errors.city"> {{ errors.city[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">District</label>
              <div class="col-sm-10">

                <multiselect v-model="address.district" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="İlçe Seçin" :options="cityDistricts" :searchable="false" :allow-empty="false">
                  <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> il olarak seçildi<strong>  {{ option.language }}</strong></template>
                </multiselect>
                <span class="text-danger" v-if="errors.district"> {{ errors.district[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">User</label>
              <div class="col-sm-10">

                <multiselect v-model="address.user" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Adres Sahibi" :options="allUsers" :searchable="false" :allow-empty="false">
                  <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> adres sahibi olarak seçildi<strong>  {{ option.language }}</strong></template>
                </multiselect>
                <span class="text-danger" v-if="errors.name"> {{ errors.user[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" v-model="address.name" v-bind:class="{ 'is-invalid': errors.name }" placeholder="Address Name">
                <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" v-model="address.description" v-bind:class="{ 'is-invalid': errors.description }" placeholder="All Address">
                <span class="text-danger" v-if="errors.description"> {{ errors.description[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                <select class="form-control" v-bind:class="{ 'is-invalid': errors.status }" v-model="address.default">
                  <option value="0">Not Default</option>
                  <option value="1">Default</option>
                </select>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="button" @click="addAddress()" class="btn btn-info">Save</button>
            <router-link to="/address" class="btn btn-default float-right">
              Cancel
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
    ...mapGetters("address", ["address"]),
    ...mapGetters("city", ["cities"]),
    ...mapGetters("district", ["cityDistricts"]),
    ...mapGetters("user", ["allUsers"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit('address/setAddress', {});
  },
  created() {
    this.getCities();
    this.getAllUsers();
  },
  methods: {
    ...mapActions("address", ["createAddress"]),
    ...mapActions("city", ["getCities"]),
    ...mapActions("district", ["getCityDistricts"]),
    ...mapActions("user", ["getAllUsers"]),

    getThisCityDistricts: function() {
      this.getCityDistricts(this.address.city.id).then(() => {
      });
    },
    addAddress: function() {
      this.createAddress(this.address).then(() => {
        this.myToast('success','Address has been created.');
        this.$router.push({ name: "Addresses" });
      });
    }
  }
}
</script>
