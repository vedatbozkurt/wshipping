<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Branch</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/">Home</router-link>
                <li class="breadcrumb-item"><router-link to="/branch">Branches</router-link>
                  <li class="breadcrumb-item active">Create Branch</li>
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
              <h3 class="card-title">New Branch Form</h3>

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
                <multiselect v-model="branch.city" :options="cities" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name" track-by="name" :preselect-first="true"  @input='getCitiesDistricts'>
                </multiselect>
                <span class="text-danger" v-if="errors.city"> {{ errors.city[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">District</label>
              <div class="col-sm-10">
                <multiselect v-model="branch.district" :options="citiesDistricts" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name" track-by="name" :preselect-first="true">
                </multiselect>

                <span class="text-danger" v-if="errors.district"> {{ errors.district[0] }}</span>
              </div>
            </div>


            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="branch.name" v-bind:class="{ 'is-invalid':errors.name }">
                <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Phone</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" v-model="branch.phone" v-bind:class="{ 'is-invalid': errors.phone }">
                <span class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" v-model="branch.email" v-bind:class="{ 'is-invalid': errors.email }">
                <span class="text-danger" v-if="errors.email"> {{ errors.email[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" v-model="branch.password" v-bind:class="{ 'is-invalid': errors.password }">
                <span class="text-danger" v-if="errors.password"> {{ errors.password[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                <select class="form-control" v-bind:class="{ 'is-invalid': errors.status }" v-model="branch.status">
                  <option value="0">Inactive</option>
                  <option value="1">Active</option>
                </select>
                <span class="text-danger" v-if="errors.status"> {{ errors.status[0] }}</span>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="button" @click="addBranch()" class="btn btn-info">Save</button>
            <router-link to="/branch" class="btn btn-default float-right">
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
    ...mapGetters("branch", ["branch"]),
    ...mapGetters("city", ["cities"]),
    ...mapGetters("district", ["citiesDistricts"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit('branch/setBranch', {});
  },
  created() {
    this.getCities();
  },
  methods: {
    ...mapActions("branch", ["createBranch"]),
    ...mapActions("city", ["getCities"]),
    ...mapActions("district", ["getCitiesDistricts"]),

    getCityDistricts: function() {
      this.getCitiesDistricts(this.branch.city).then(() => {
      });
    },
    addBranch: function() {
      this.createBranch(this.branch).then(() => {
        this.myToast('success','Branch has been created.');
        this.$router.push({ name: "Branches" });
      });
    }
  }
}
</script>
