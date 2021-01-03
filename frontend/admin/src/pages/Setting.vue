<template>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Settings</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Settings</h3>
        </div>
         <!-- form start -->
        <form>
          <div class="card-body">
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Logo</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="setting.logo" v-bind:class="{ 'is-invalid':errors.logo }">
                <span class="text-danger" v-if="errors.logo"> {{ errors.logo[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Company Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="setting.company_name" v-bind:class="{ 'is-invalid':errors.company_name }">
                <span class="text-danger" v-if="errors.company_name"> {{ errors.company_name[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Phone</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="setting.phone" v-bind:class="{ 'is-invalid':errors.phone }">
                <span class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="setting.description" v-bind:class="{ 'is-invalid':errors.description }">
                <span class="text-danger" v-if="errors.description"> {{ errors.description[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Keywords</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="setting.keywords" v-bind:class="{ 'is-invalid':errors.keywords }">
                <span class="text-danger" v-if="errors.keywords"> {{ errors.keywords[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="setting.address" v-bind:class="{ 'is-invalid':errors.address }">
                <span class="text-danger" v-if="errors.address"> {{ errors.address[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" v-model="setting.email" v-bind:class="{ 'is-invalid':errors.email }">
                <span class="text-danger" v-if="errors.email"> {{ errors.email[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Currency</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="setting.currency" v-bind:class="{ 'is-invalid':errors.currency }">
                <span class="text-danger" v-if="errors.currency"> {{ errors.currency[0] }}</span>
              </div>
            </div>


          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="button" @click="updateSettings" class="btn btn-info">Save</button>
            <router-link to="/" class="btn btn-default float-right">
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
    ...mapGetters("setting", ["setting"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
  },
  created() {
    this.getSetting();
  },
  methods: {
    ...mapActions("setting", ["getSetting","updateSetting"]),

    updateSettings: function() {
      this.updateSetting(this.setting).then(() => {
        this.$store.commit("setCurrency", this.setting.currency);
        this.myToast('success','Setting has been updated.');
      });
    }
  }
}
</script>
