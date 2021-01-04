<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $t('task.createTask') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/">{{ $t('home') }}</router-link>
                <li class="breadcrumb-item"><router-link to="/task">{{ $t('task.tasks') }}</router-link>
                  <li class="breadcrumb-item active">{{ $t('task.createTask') }}</li>
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
              <h3 class="card-title">{{ $t('task.newTaskForm') }}</h3>

              <div class="card-tools">
           <!--  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button> -->
          </div>
        </div>
        <!-- form start -->
        <form>
          <div class="card-body">
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.senderName') }}
              </label>
              <div class="col-sm-10">
                <multiselect v-model="task.sender" :deselect-label="$t('select.cantRemove')" track-by="name" label="name" :placeholder="$t('form.senderName')" :options="allUsers" :searchable="true" :allow-empty="false" @input='getSenderUserAddress'>
                  <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> {{ $t('select.selected') }}<strong>  {{ option.language }}</strong></template>
                </multiselect>
                <span class="text-danger" v-if="errors.sender"> {{ errors.sender[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.senderAddress') }}</label>
              <div class="col-sm-10">
                <multiselect v-model="task.senderaddress" :deselect-label="$t('select.cantRemove')" track-by="name" label="name" :placeholder="$t('form.senderAddress')" :options="userSenderAddress" :searchable="true" :allow-empty="false" noOptions="Select Sender">
                  <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> {{ $t('select.selected') }}<strong>  {{ option.language }}</strong></template>
                </multiselect>
                <span class="text-danger" v-if="errors.senderaddress"> {{ errors.senderaddress[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.receiverName') }}</label>
              <div class="col-sm-10">
                <multiselect v-model="task.receiver" :deselect-label="$t('select.cantRemove')" track-by="name" label="name" :placeholder="$t('form.receiverName')" :options="allUsers" :searchable="true" :allow-empty="false" @input='getReceiverUserAddress'>
                  <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> {{ $t('select.selected') }}<strong>  {{ option.language }}</strong></template>
                </multiselect>
                <span class="text-danger" v-if="errors.receiver"> {{ errors.receiver[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.receiverAddress') }}</label>
              <div class="col-sm-10">
                <multiselect v-model="task.receiveraddress" :deselect-label="$t('select.cantRemove')" track-by="name" label="name" :placeholder="$t('form.receiverAddress')" :options="allAddresses" :searchable="true" :allow-empty="false">
                  <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> {{ $t('select.selected') }}<strong>  {{ option.language }}</strong></template>
                </multiselect>
                <span class="text-danger" v-if="errors.receiveraddress"> {{ errors.receiveraddress[0] }}</span>
              </div>
            </div>


            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('courier.courier') }}</label>
              <div class="col-sm-10">
                  <multiselect v-model="task.courier" :deselect-label="$t('select.cantRemove')" track-by="name" label="name" :placeholder="$t('courier.courier')" :options="allCouriers" :searchable="true" :allow-empty="false">
                    <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> {{ $t('select.selected') }}<strong>  {{ option.language }}</strong></template>
                  </multiselect>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.price') }}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="task.price" v-bind:class="{ 'is-invalid':errors.price }">
                <span class="text-danger" v-if="errors.price"> {{ errors.price[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.description') }}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="task.description" v-bind:class="{ 'is-invalid':errors.description }">
                <span class="text-danger" v-if="errors.description"> {{ errors.description[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.status') }}</label>
              <div class="col-sm-10">
                <select class="form-control" v-bind:class="{ 'is-invalid': errors.status }" v-model="task.status">
                  <option value="0">{{ $t('task.pendingApproval') }}</option>
                     <option value="0">{{ $t('task.pendingApproval') }}</option>
                      <option value="1">{{ $t('task.approvedAwaitingCourierAssignment') }}</option>
                      <option value="2">{{ $t('task.courierAssignedAcceptanceExpected') }}</option>
                      <option value="3">{{ $t('task.courierAccepted') }}</option>
                      <option value="4">{{ $t('task.courierReceivedTask') }}</option>
                      <option value="5">{{ $t('task.courierOnTheRoad') }}</option>
                      <option value="6">{{ $t('task.courierArrivedAtDestination') }}</option>
                      <option value="7">{{ $t('task.delivered') }}</option>
                      <option value="8">{{ $t('task.couriercanceled') }}</option>
                      <option value="9">{{ $t('task.canceled') }}</option>
                </select>
                <span class="text-danger" v-if="errors.status"> {{ errors.status[0] }}</span>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="button" @click="addTask()" class="btn btn-info">{{ $t('save') }}</button>
            <router-link to="/task" class="btn btn-default float-right">
              {{ $t('cancel') }}
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
    ...mapGetters(["errors"]),
    ...mapGetters("task", ["task"]),
    ...mapGetters("courier", ["allCouriers"]),
    ...mapGetters("user", ["allUsers","userSenderAddress","userReceiverAddress"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit('user/setUserSenderAddress', []);
    this.$store.commit('user/setUserReceiverAddress', []);
    this.$store.commit('task/setTask', {});
    this.$store.commit('courier/setAllCouriers', []);
  },
  created() {
    this.getAllUsers();
    this.getAllCouriers();
  },
  methods: {
    ...mapActions("task", ["createTask"]),
    ...mapActions("courier", ["getAllCouriers"]),
    ...mapActions("user", ["getAllUsers","getUserSenderAddress","getUserReceiverAddress"]),

    getSenderUserAddress: function() {
      this.getUserSenderAddress(this.task.sender.id).then(() => { //sender addresses
      });
    },
    getReceiverUserAddress: function() {
      this.getUserReceiverAddress(this.task.receiver.id).then(() => { //receiver addresses
        this.allAddresses = this.userReceiverAddress.concat(this.userSenderAddress); //receiver için sender + receiver adresleri birleştirildi
      });
    },
    addTask: function() {
      this.createTask(this.task).then(() => {
        this.myToast('success',this.$t('task.createdTask'));
        this.$router.push({ name: "Tasks" });
      });
    },
  }
}
</script>
