<template>
  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/">Home</router-link>
                <li class="breadcrumb-item"><router-link to="/user">Users</router-link>
                  <li class="breadcrumb-item active">Edit User</li>
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
              <h3 class="card-title">Edit User Form</h3>
              <div class="card-tools">
                <button v-if="user.deleted_at" @click="restoreThisUser" class="btn btn-outline-warning btn-sm btn-flat">
                <i class="fas fa-recycle"></i> Restore
              </button>
            </div>
          </div>
          <!-- form start -->
          <form>

            <div :class="{'loader': loader}"></div>
            <div class="card-body">
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Photo</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="user.image" v-bind:class="{ 'is-invalid':errors.image }">
                <span class="text-danger" v-if="errors.image"> {{ errors.image[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="user.name" v-bind:class="{ 'is-invalid':errors.name }">
                <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Phone</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" v-model="user.phone" v-bind:class="{ 'is-invalid': errors.phone }">
                <span class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" v-model="user.email" v-bind:class="{ 'is-invalid': errors.email }">
                <span class="text-danger" v-if="errors.email"> {{ errors.email[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" v-model="user.password" v-bind:class="{ 'is-invalid': errors.password }">
                <span class="text-danger" v-if="errors.password"> {{ errors.password[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                <select class="form-control" v-bind:class="{ 'is-invalid': errors.status }" v-model="user.status">
                  <option value="0">Inactive</option>
                  <option value="1">Active</option>
                </select>
                <span class="text-danger" v-if="errors.status"> {{ errors.status[0] }}</span>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
            <div class="card-footer">
              <button type="button" @click="updateThisUser" class="btn btn-info">Save</button>
              <router-link to="/user" class="btn btn-default float-right">
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
      ...mapGetters("user", ["user"]),

    },
    mounted() {
      this.$store.commit("setErrors", {});
    },
    created() {
      this.getUser(this.$route.params.id);
    },
    methods: {
      ...mapActions("user", ["updateUser","getUser","restoreUser"]),

      restoreThisUser: function() {
        this.restoreUser(this.user.id).then(() => {
          this.myToast('success','User has been restored.');
          this.$router.push({ name: "Users" });
        });
      },
      updateThisUser: function() {
        this.updateUser(this.user).then(() => {
          this.myToast('success','User has been updated.');
          this.$router.push({ name: "Users" });
        });
      }
    }
  }
</script>
