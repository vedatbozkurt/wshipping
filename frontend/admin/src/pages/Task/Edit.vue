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
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Sender
                  </label>
                  <div class="col-sm-10">
                    <multiselect v-model="task.sender" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Gönderici" :options="allUsers" :searchable="false" :allow-empty="false" @input='getSenderUserAddress'>
                      <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> gönderici olarak seçildi<strong>  {{ option.language }}</strong></template>
                    </multiselect>
                    <span class="text-danger" v-if="errors.sender"> {{ errors.sender[0] }}</span>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Sender Address</label>
                  <div class="col-sm-10">
                    <multiselect v-model="task.senderaddress" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Gönderici Adresi" :options="userSenderAddress" :searchable="false" :allow-empty="false" noOptions="Select Sender">
                      <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> gönderici adresi olarak seçildi<strong>  {{ option.language }}</strong></template>
                    </multiselect>
                    <span class="text-danger" v-if="errors.senderaddress"> {{ errors.senderaddress[0] }}</span>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Receiver</label>
                  <div class="col-sm-10">
                    <multiselect v-model="task.receiver" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Alıcı" :options="allUsers" :searchable="false" :allow-empty="false" @input='getReceiverUserAddress'>
                      <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> alıcı olarak seçildi<strong>  {{ option.language }}</strong></template>
                    </multiselect>
                    <span class="text-danger" v-if="errors.receiver"> {{ errors.receiver[0] }}</span>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Receiver Address</label>
                  <div class="col-sm-10">
                    <multiselect v-model="task.receiveraddress" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Alıcı Adresi" :options="allAddresses" :searchable="false" :allow-empty="false">
                      <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> alıcı adresi olarak seçildi<strong>  {{ option.language }}</strong></template>
                    </multiselect>
                    <span class="text-danger" v-if="errors.receiveraddress"> {{ errors.receiveraddress[0] }}</span>
                  </div>
                </div>


                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Courier</label>
                  <div class="row col-sm-10">
                    <div class="col-sm-6">
                      <multiselect v-model="branch.id" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Select Courier Branch" :options="allBranches" :searchable="false" :allow-empty="false" @input='getBranchCouriers'>
                        <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> seçildi<strong>  {{ option.language }}</strong></template>
                      </multiselect>
                      <!-- <span class="text-danger" v-if="errors.courier_id"> {{ errors.courier_id[0] }}</span> -->
                    </div>
                    <div class="col-sm-6">
                      <multiselect v-model="task.courier" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Select Courier Branch" :options="branchCourier" :searchable="false" :allow-empty="false">
                        <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> kurye olarak seçildi<strong>  {{ option.language }}</strong></template>
                      </multiselect>
                    </div>
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
          allAddresses: []
        }
      },

      computed: {
        ...mapGetters(["errors","loader"]),
        ...mapGetters("task", ["task"]),
        ...mapGetters("branch", ["branch","allBranches","branchCourier"]),
        ...mapGetters("user", ["allUsers","userSenderAddress","userReceiverAddress"])

      },
      mounted() {
        this.$store.commit("setErrors", {});
        this.$store.commit('user/setUserSenderAddress', []);
        this.$store.commit('user/setUserReceiverAddress', []);
        this.$store.commit('branch/setBranchCourier', []);
        this.$store.commit('task/setTask', {});
        this.$store.commit('branch/setBranch', {});
        this.getAllUsers();
        this.getAllBranches();
      },
      created() {
        this.getTask(this.$route.params.id);
      },
      methods: {
        ...mapActions("task", ["updateTask","getTask","restoreTask"]),
        ...mapActions("branch", ["getAllBranches","getBranchCourier"]),
        ...mapActions("user", ["getAllUsers","getUserSenderAddress","getUserReceiverAddress"]),

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
        },
        getSenderUserAddress: function() {
      this.getUserSenderAddress(this.task.sender.id).then(() => { //sender addresses
      });
    },
    getReceiverUserAddress: function() {
      this.getUserReceiverAddress(this.task.receiver.id).then(() => { //receiver addresses
        this.allAddresses = this.userReceiverAddress.concat(this.userSenderAddress); //receiver için sender + receiver adresleri birleştirildi
      });
    },
    getBranchCouriers: function() {
      this.getBranchCourier(this.branch.id.id);
    },
  }
}
</script>
