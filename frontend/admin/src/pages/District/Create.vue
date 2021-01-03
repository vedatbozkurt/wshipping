<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create District</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/">Home</router-link>
                <li class="breadcrumb-item"><router-link to="/district">Districts</router-link>
                  <li class="breadcrumb-item active">Create District</li>
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
              <h3 class="card-title">New District Form</h3>

              <div class="card-tools">
           <!--  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button> -->
          </div>
        </div>
        <!-- form start -->
        <form>
          <div class="card-body">
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">City</label>
              <div class="col-sm-10">

                <multiselect v-model="district.city" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="İl Seçin" :options="cities" :searchable="true" :allow-empty="false">
                  <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> il olarak seçildi<strong>  {{ option.language }}</strong></template>
                </multiselect>

                <span class="text-danger" v-if="errors.city_id"> {{ errors.city_id[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="district.name" v-bind:class="{ 'is-invalid':errors.name }">
                <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="button" @click="addDistrict()" class="btn btn-info">Save</button>
            <router-link to="/district" class="btn btn-default float-right">
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
    ...mapGetters("city", ["cities"]),
    ...mapGetters("district", ["district"]),
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit("district/setDistrict", {});
  },
  created() {
    this.getCities();
  },
  methods: {
    ...mapActions("city", ["getCities"]),
    ...mapActions("district", ["createDistrict"]),

    addDistrict: function() {
      this.createDistrict(this.district).then(() => {
        this.myToast('success','District has been created.');
        this.$router.push({ name: "Districts" });
      });
    }
  }
}
</script>
