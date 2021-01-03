<template>
  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit City</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/">Home</router-link>
                <li class="breadcrumb-item"><router-link to="/city">Cities</router-link>
                  <li class="breadcrumb-item active">Edit City</li>
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
              <h3 class="card-title">Edit City Form</h3>
            </div>
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" v-model="city.name" v-bind:class="{ 'is-invalid':errors.name }">
                    <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="button" @click="updateThisCity" class="btn btn-info">Save</button>
                <router-link to="/city" class="btn btn-default float-right">
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
        ...mapGetters("city", ["city"]),
      },
      mounted() {
        this.$store.commit("setErrors", {});
      },
      created() {
        this.getCity(this.$route.params.id);
      },
      methods: {
        ...mapActions("city", ["updateCity","getCity"]),

        updateThisCity: function() {
          this.updateCity(this.city).then(() => {
            this.myToast('success','City has been updated.');
            this.$router.push({ name: "Cities" });
          });
        }
      }
    }
  </script>
