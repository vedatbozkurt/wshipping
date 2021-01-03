<template>
  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit District</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/">Home</router-link>
                <li class="breadcrumb-item"><router-link to="/district">Districts</router-link>
                  <li class="breadcrumb-item active">Edit District</li>
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
              <h3 class="card-title">Edit District Form</h3>
            </div>
            <!-- form start -->
            <form>
              <div :class="{'loader': loader}"></div>
              <div class="card-body">
               <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">City</label>
                <div class="col-sm-10">
                  <multiselect v-model="district.city" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="İl Seçin" :options="cities" :searchable="false" :allow-empty="false">
                    <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> il olarak seçildi<strong>  {{ option.language }}</strong></template>
                  </multiselect>
                  <span class="text-danger" v-if="errors.city"> {{ errors.city[0] }}</span>
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
              <button type="button" @click="updateThisDistrict" class="btn btn-info">Save</button>
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
      ...mapGetters(["errors","loader"]),
      ...mapGetters("city", ["cities"]),
      ...mapGetters("district", ["district"]),
    },
    mounted() {
      this.$store.commit("setErrors", {});
    },
    created() {
      this.getDistrict(this.$route.params.id);
      this.getCities();
    },
    methods: {
      ...mapActions("city", ["getCities"]),
      ...mapActions("district", ["updateDistrict","getDistrict"]),

      updateThisDistrict: function() {
        this.updateDistrict(this.district).then(() => {
          this.myToast('success','District has been updated.');
          this.$router.push({ name: "Districts" });
        });
      }
    }
  }
</script>
