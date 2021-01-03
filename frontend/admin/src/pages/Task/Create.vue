<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Task</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/">Home</router-link>
                <li class="breadcrumb-item"><router-link to="/task">Tasks</router-link>
                  <li class="breadcrumb-item active">Create Task</li>
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
              <h3 class="card-title">New Task Form</h3>

              <div class="card-tools">
           <!--  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button> -->
          </div>
        </div>
        <!-- form start -->
        <form>
          <div class="card-body">
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Sender
              </label>
              <div class="col-sm-10">
                <div class="row">
                  <div class="col-sm-10">
                    <multiselect v-model="task.sender_id" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Gönderici" :disabled="isSenderDisabled" :options="allUsers" :searchable="false" :allow-empty="false" @input='getSenderUserAddress'>
                      <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> gönderici olarak seçildi<strong>  {{ option.language }}</strong></template>
                    </multiselect>
                  </div>
                  <div class="col-sm-2">
                    <a @click="showNewSender(newSenderArea)" class="btn btn-block btn-outline-success btn-flat">+ New</a>
                  </div>
                  <span class="text-danger" v-if="errors.sender_id"> {{ errors.sender_id[0] }}</span>
                </div>
              </div>
            </div>

            <div v-show="newSenderArea">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">New Sender</label>
                <div class=" row col-sm-10">
                  <div class="col-sm-4">
                    <input type="text" class="form-control" v-model="newsender.name" v-bind:class="{ 'is-invalid':errors.courier_id }" placeholder="Sender Name">
                    <!-- <span class="text-danger" v-if="errors.courier_id"> {{ errors.courier_id[0] }}</span> -->
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" v-model="newsender.phone" v-bind:class="{ 'is-invalid':errors.courier_id }" placeholder="Sender Phone">
                    <!-- <span class="text-danger" v-if="errors.courier_id"> {{ errors.courier_id[0] }}</span> -->
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" v-model="newsender.email" v-bind:class="{ 'is-invalid':errors.courier_id }" placeholder="Sender Email">
                    <!-- <span class="text-danger" v-if="errors.courier_id"> {{ errors.courier_id[0] }}</span> -->
                  </div>
                </div>
              </div>
            </div>

            <!-- yeni sender eklenecekse bu alana gerek yok, kapanır -->
            <div class="form-group row" v-show="!newSenderArea">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Sender Address</label>
              <div class="col-sm-10">
                <multiselect v-model="task.sender_address_id" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Gönderici Adresi" :options="userSenderAddress" :searchable="false" :allow-empty="false" noOptions="Select Sender">
                  <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> gönderici adresi olarak seçildi<strong>  {{ option.language }}</strong></template>
                </multiselect>
                <span class="text-danger" v-if="errors.sender_address_id"> {{ errors.sender_address_id[0] }}</span>
              </div>
            </div>
            <!-- yeni sender varsa yeni adres alanı için burayı göster -->
            <div v-show="newSenderArea">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">New Address</label>
                <div class=" row col-sm-10">
                  <div class="col-sm-4">
                    <input type="text" class="form-control" v-model="newSenderAddress.city" v-bind:class="{ 'is-invalid':errors.courier_id }" placeholder="New Sender Address City">
                    <!-- <span class="text-danger" v-if="errors.courier_id"> {{ errors.courier_id[0] }}</span> -->
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" v-model="newSenderAddress.district" v-bind:class="{ 'is-invalid':errors.courier_id }" placeholder="New Sender District">
                    <!-- <span class="text-danger" v-if="errors.courier_id"> {{ errors.courier_id[0] }}</span> -->
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" v-model="newSenderAddress.name" v-bind:class="{ 'is-invalid':errors.courier_id }" placeholder="New Sender Address Name">
                    <!-- <span class="text-danger" v-if="errors.courier_id"> {{ errors.courier_id[0] }}</span> -->
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" v-model="newSenderAddress.description" v-bind:class="{ 'is-invalid':errors.courier_id }" placeholder="New Sender Address Description">
                  <!-- <span class="text-danger" v-if="errors.courier_id"> {{ errors.courier_id[0] }}</span> -->
                </div>
              </div>
            </div>


















            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Receiver</label>
              <div class="col-sm-10">
                <div class="row">
                  <div class="col-sm-10">
                    <multiselect v-model="task.receiver_id" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Alıcı" :options="allUsers" :searchable="false" :allow-empty="false" @input='getReceiverUserAddress' :disabled="isReceiverDisabled">
                      <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> alıcı olarak seçildi<strong>  {{ option.language }}</strong></template>
                    </multiselect>
                  </div>
                  <div class="col-sm-2">
                    <a @click="showNewReceiver(newReceiverArea)" class="btn btn-block btn-outline-success btn-flat">+ New </a>
                  </div>
                  <span class="text-danger" v-if="errors.receiver_id"> {{ errors.receiver_id[0] }}</span>
                </div>
              </div>
            </div>

            <div v-show="newReceiverArea">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">New Receiver</label>
                <div class=" row col-sm-10">
                  <div class="col-sm-4">
                    <input type="text" class="form-control" v-model="newreceiver.name" v-bind:class="{ 'is-invalid':errors.name }" placeholder="Receiver Name">
                    <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" v-model="newreceiver.phone" v-bind:class="{ 'is-invalid':errors.phone }" placeholder="Receiver Phone">
                    <span class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }}</span>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" v-model="newreceiver.email" v-bind:class="{ 'is-invalid':errors.email }" placeholder="Receiver Email">
                    <span class="text-danger" v-if="errors.email"> {{ errors.email[0] }}</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row" v-show="!newReceiverArea">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Receiver Address</label>
              <div class="col-sm-10">
                <multiselect v-model="task.receiver_address_id" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Alıcı Adresi" :options="userReceiverAddress" :searchable="false" :allow-empty="false">
                  <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> alıcı adresi olarak seçildi<strong>  {{ option.language }}</strong></template>
                </multiselect>
                <span class="text-danger" v-if="errors.receiver_address_id"> {{ errors.receiver_address_id[0] }}</span>
              </div>
            </div>


            <!-- yeni receiver varsa yeni adres alanı için burayı göster -->
            <div v-show="newReceiverArea">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">New Address</label>
                <div class=" row col-sm-10">
                  <div class="col-sm-4">
                    <input type="text" class="form-control" v-model="newReceiverAddress.city" v-bind:class="{ 'is-invalid':errors.courier_id }" placeholder="New Receiver Address City">
                    <!-- <span class="text-danger" v-if="errors.courier_id"> {{ errors.courier_id[0] }}</span> -->
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" v-model="newReceiverAddress.district" v-bind:class="{ 'is-invalid':errors.courier_id }" placeholder="New Receiver District">
                    <!-- <span class="text-danger" v-if="errors.courier_id"> {{ errors.courier_id[0] }}</span> -->
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" v-model="newReceiverAddress.name" v-bind:class="{ 'is-invalid':errors.courier_id }" placeholder="New Receiver Address Name">
                    <!-- <span class="text-danger" v-if="errors.courier_id"> {{ errors.courier_id[0] }}</span> -->
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" v-model="newReceiverAddress.description" v-bind:class="{ 'is-invalid':errors.courier_id }" placeholder="New Receiver Address Description">
                  <!-- <span class="text-danger" v-if="errors.courier_id"> {{ errors.courier_id[0] }}</span> -->
                </div>
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
            <button type="button" @click="addTask()" class="btn btn-info">Save</button>
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
      newSenderArea: false,
      isSenderDisabled: false,
      newReceiverArea: false,
      isReceiverDisabled: false,
    }
  },

  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("task", ["task","newsender","newreceiver","newSenderAddress","newReceiverAddress"]),
    ...mapGetters("user", ["allUsers","userSenderAddress","userReceiverAddress"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit('task/setTask', {});
    this.getAllUsers();
  },
  created() {
  },
  methods: {
    ...mapActions("task", ["createTask"]),
    ...mapActions("user", ["getAllUsers","getUserSenderAddress","getUserReceiverAddress"]),

    getSenderUserAddress: function() {
      this.getUserSenderAddress(this.task.sender_id.id).then(() => { //sender addresses
      });
    },
    getReceiverUserAddress: function() {
      this.getUserReceiverAddress(this.task.receiver_id.id).then(() => { //receiver addresses

      });
    },
    addTask: function() {
      this.createTask(this.task).then(() => {
        this.myToast('success','Task has been created.');
        this.$router.push({ name: "Tasks" });
      });
    },
    showNewSender(value){
      this.newSenderArea = !value;
      this.isSenderDisabled =  !value;
    },
    showNewReceiver(value){
      this.newReceiverArea = !value;
      this.isReceiverDisabled =  !value;
    },
  }
}
</script>
