<template>
  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $t('task.editTask') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/">{{ $t('home') }}</router-link>
                <li class="breadcrumb-item"><router-link to="/mytasks">{{ $t('task.myTasks') }}</router-link>
                  <li class="breadcrumb-item active">{{ $t('task.editTask') }}</li>
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
              <h3 class="card-title">{{ $t('task.editTaskForm') }}</h3>
            </div>
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.senderName') }}
                  </label>
                  <div class="col-sm-10">
                    {{mytask.sendername}}
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.senderAddress') }}</label>
                  <div class="col-sm-10">
                    {{mytask.senderaddress}}
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.receiverName') }}</label>
                  <div class="col-sm-10">
                    {{mytask.receivername}}
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.receiverAddress') }}</label>
                  <div class="col-sm-10">
                    {{mytask.receiveraddress}}
                  </div>
                </div>


                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('courier.courier') }}</label>
                  <div class="row col-sm-10">
                    {{mytask.courier}}
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.price') }}</label>
                  <div class="col-sm-10">
                    {{task.price}} {{currency}}
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.description') }}</label>
                  <div class="col-sm-10">
                   {{task.description}}
                 </div>
               </div>
               <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.status') }}</label>
                <div class="col-sm-10">
              <span v-if="task.status==0">{{ $t('task.pendingApproval') }}</span>
              <span v-if="task.status==1">{{ $t('task.approvedAwaitingCourierAssignment') }}</span>
              <span v-if="task.status==2">{{ $t('task.courierAssignedAcceptanceExpected') }}</span>
               <span v-if="task.status==3">{{ $t('task.courierAccepted') }}</span>
               <span v-if="task.status==4">{{ $t('task.courierReceivedTask') }}</span>
               <span v-if="task.status==5">{{ $t('task.courierOnTheRoad') }}</span>
               <span v-if="task.status==6">{{ $t('task.courierArrivedAtDestination') }}</span>
               <span v-if="task.status==7">{{ $t('task.delivered') }}</span>
               <span v-if="task.status==8">{{ $t('task.couriercanceled') }}</span>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button v-if="task.status!=7 && task.status!=1" type="button" @click="updateThisTask" class="btn btn-info">
               <span v-if="task.status==2">{{ $t('task.accepttask') }}</span>
               <span v-if="task.status==3">{{ $t('task.receivedtask') }}</span>
               <span v-if="task.status==4">{{ $t('task.onroad') }}</span>
               <span v-if="task.status==5">{{ $t('task.arrived') }}</span>
               <span v-if="task.status==6">{{ $t('task.deliveredtask') }}</span>
              </button>
              <router-link to="/mytasks" class="btn btn-default float-right">
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
        mytask:{
          sendername:'',
          senderaddress:'',
          receivername:'',
          receiveraddress:'',
          courier:'',
        }
      }
    },
    computed: {
      ...mapGetters(["errors"]),
      ...mapGetters("task", ["task"]),
      ...mapGetters(["currency"]),
    },
    mounted() {
      this.$store.commit("setErrors", {});
      this.$store.commit('task/setTask', {});
    },
    created() {
      this.getTask(this.$route.params.id).then(() => {
        this.mytask.sendername = this.task.sender.name;
        this.mytask.senderaddress =this.task.senderaddress.description;
        this.mytask.receivername =this.task.receiver.name;
        this.mytask.receiveraddress =this.task.receiveraddress.description;
        this.mytask.courier =this.task.courier.name;
      });
    },

// {{task.senderaddress.district.name}} / {{task.senderaddress.city.name}}

methods: {
  ...mapActions("task", ["updateTask","getTask"]),

  updateThisTask: function() {
    this.updateTask(this.$route.params.id).then(() => {
      this.myToast('success',this.$t('task.updatedTask'));
      this.$router.push({ name: "MyTasks" });
    });
  },
}
}
</script>
