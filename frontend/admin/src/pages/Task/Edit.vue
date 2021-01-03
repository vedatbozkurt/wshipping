<template>
  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Task</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/">Home</router-link>
                <li class="breadcrumb-item"><router-link to="/task">Tasks</router-link>
                  <li class="breadcrumb-item active">Edit Task</li>
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
              <h3 class="card-title">Edit Task Form</h3>
              <div class="card-tools">
                <button v-if="task.deleted_at" @click="restoreThisTask" class="btn btn-outline-warning btn-sm btn-flat">
                <i class="fas fa-recycle"></i> Restore
              </button>
            </div>
          </div>
          <!-- form start -->
          <form>

            <div :class="{'loader': loader}"></div>
            <div class="card-body">
             <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Sender</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="task.sender_id" v-bind:class="{ 'is-invalid':errors.sender_id }">
                <span class="text-danger" v-if="errors.sender_id"> {{ errors.sender_id[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Sender Address</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="task.sender_address_id" v-bind:class="{ 'is-invalid':errors.sender_address_id }">
                <span class="text-danger" v-if="errors.sender_address_id"> {{ errors.sender_address_id[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Receiver</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="task.receiver_id" v-bind:class="{ 'is-invalid':errors.receiver_id }">
                <span class="text-danger" v-if="errors.receiver_id"> {{ errors.receiver_id[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Receiver Address</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="task.receiver_address_id" v-bind:class="{ 'is-invalid':errors.receiver_address_id }">
                <span class="text-danger" v-if="errors.receiver_address_id"> {{ errors.receiver_address_id[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Courier</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="task.courier_id" v-bind:class="{ 'is-invalid':errors.courier_id }">
                <span class="text-danger" v-if="errors.courier_id"> {{ errors.courier_id[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Price</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="task.price" v-bind:class="{ 'is-invalid':errors.price }">
                <span class="text-danger" v-if="errors.price"> {{ errors.price[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="task.description" v-bind:class="{ 'is-invalid':errors.description }">
                <span class="text-danger" v-if="errors.description"> {{ errors.description[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                <select class="form-control" v-bind:class="{ 'is-invalid': errors.status }" v-model="task.status">
                  <option value="0">Inactive</option>
                  <option value="1">Active</option>
                </select>
                <span class="text-danger" v-if="errors.status"> {{ errors.status[0] }}</span>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
            <div class="card-footer">
              <button type="button" @click="updateThisTask" class="btn btn-info">Save</button>
              <router-link to="/task" class="btn btn-default float-right">
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
      ...mapGetters("task", ["task"]),

    },
    mounted() {
      this.$store.commit("setErrors", {});
    },
    created() {
      this.getTask(this.$route.params.id);
    },
    methods: {
      ...mapActions("task", ["updateTask","getTask","restoreTask"]),

      restoreThisTask: function() {
        this.restoreTask(this.task.id).then(() => {
          this.myToast('success','Task has been restored.');
          this.$router.push({ name: "Tasks" });
        });
      },
      updateThisTask: function() {
        this.updateTask(this.task).then(() => {
          this.myToast('success','Task has been updated.');
          this.$router.push({ name: "Tasks" });
        });
      }
    }
  }
</script>
