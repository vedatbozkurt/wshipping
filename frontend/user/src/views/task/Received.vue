<template>
  <div class="profile-page">

    <section class="section-profile-cover section-shaped my-0">
      <div class="shape shape-style-1 shape-primary shape-skew alpha-4">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </section>
    <section class="section section-lg pt-lg-0 section-contact-us">
      <div class="container">
        <div class="row justify-content-center mt--300">
          <div class="col-lg-12 mt--150">
            <card gradient="secondary" shadow body-classes="p-lg-5">
              <!-- Buttons -->
              <div class="float-right">
                <router-link :to="{name: 'CreateTask'}" class="btn btn-outline-info btn-sm btn-flat">New Task</router-link>
                <router-link :to="{name: 'SentTask'}" class="btn btn-outline-info btn-sm btn-flat">Sent Tasks</router-link>
                <router-link :to="{name: 'IndexTask'}" class="btn btn-outline-info btn-sm btn-flat">Tasks</router-link>
              </div>
              <h3 class="h4 text-success font-weight-bold mb-4">Received Tasks</h3>

              <!-- Button styles -->
              <div class="row py-3 align-items-left">
               <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>{{ $t('form.senderName') }}</th>
                    <th>{{ $t('form.price') }}</th>
                    <th>{{ $t('form.createdAt') }}</th>
                    <th>{{ $t('form.status') }}</th>
                    <th style="width: 110px">{{ $t('actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="task in receivedTasks.data" :key="task.id">
                    <td>{{ task.id }}</td>
                    <td>{{ task.sender.name }}</td>
                    <td>{{ task.price }} {{currency}}</td>
                    <td>{{ task.created_at | moment("MMMM Do YYYY") }}</td>
                    <td>
                     <task-status v-show="!task.deleted_at" :status=task.status />
                     <span v-show="task.deleted_at" class="badge badge-danger">{{ $t('form.deleted') }}</span>
                   </td>
                   <td>
                    <base-button
                    type="white"
                    class="btn btn-outline-info btn-sm btn-flat"
                    @click="getThisTaskDetails(task.id)">
                    Details
                  </base-button>

              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <modal :show.sync="modals.modal1">
                     <h6 slot="header" class="modal-title" id="modal-title-default">Task Details #{{taskid}}</h6>

                        <div class="row py-3 align-items-left">
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">{{ $t('form.senderName') }}:</small>
                            </div>
                            <div class="col-sm-8">
                                <p>{{mytask.sendername}}</p>
                            </div>
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">{{ $t('form.senderPhone') }}:</small>
                            </div>
                            <div class="col-sm-8">
                                <p>{{mytask.senderphone}}</p>
                            </div>
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">Sender Mail:</small>
                            </div>
                            <div class="col-sm-8">
                                <p>{{mytask.senderemail}}</p>
                            </div>
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">{{ $t('form.senderAddress') }}:</small>
                            </div>
                            <div class="col-sm-8">
                                <p>{{mytask.senderaddress}}</p>
                            </div>
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">{{ $t('form.receiverName') }}:</small>
                            </div>
                            <div class="col-sm-8">
                                <p>{{mytask.receivername}}</p>
                            </div>
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">{{ $t('form.receiverPhone') }}:</small>
                            </div>
                            <div class="col-sm-8">
                                <p>{{mytask.receiverphone}}</p>
                            </div>
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">receiver Mail:</small>
                            </div>
                            <div class="col-sm-8">
                                <p>{{mytask.receiveremail}}</p>
                            </div>
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">{{ $t('form.receiverAddress') }}:</small>
                            </div>
                            <div class="col-sm-8">
                                <p>{{mytask.receiveraddress}}</p>
                            </div>
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">{{ $t('courier.courier') }}:</small>
                            </div>
                            <div class="col-sm-8">
                                <p>{{mytask.courier}}</p>
                            </div>
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">{{ $t('form.price') }}:</small>
                            </div>
                            <div class="col-sm-8">
                                <p>{{task.price}} {{currency}}</p>
                            </div>
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">{{ $t('form.description') }}:</small>
                            </div>
                            <div class="col-sm-8">
                                <p>{{task.description}}</p>
                            </div>
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">{{ $t('form.status') }}:</small>
                            </div>
                            <div class="col-sm-8">
                                <p><span v-if="task.status==0">{{ $t('task.pendingApproval') }}</span>
                                  <span v-if="task.status==1">{{ $t('task.approvedAwaitingCourierAssignment') }}</span>
                                  <span v-if="task.status==2">{{ $t('task.courierAssignedAcceptanceExpected') }}</span>
                                  <span v-if="task.status==3">{{ $t('task.courierAccepted') }}</span>
                                  <span v-if="task.status==4">{{ $t('task.courierReceivedTask') }}</span>
                                  <span v-if="task.status==5">{{ $t('task.courierOnTheRoad') }}</span>
                                  <span v-if="task.status==6">{{ $t('task.courierArrivedAtDestination') }}</span>
                                  <span v-if="task.status==7">{{ $t('task.delivered') }}</span>
                                  <span v-if="task.status==8">{{ $t('task.couriercanceled') }}</span></p>
                              </div>
                          </div>

                    <template slot="footer">
                            <base-button type="link" class="ml-auto" @click="modals.modal1 = false">Close
                        </base-button>
                    </template>
                </modal>
      <ul class="pagination pagination-sm m-0 float-right">
        <pagination class="float-right" :data="receivedTasks" @pagination-change-page="getReceivedTasks"></pagination>
      </ul>
    </card>
  </div>
</div>
</div>
</section>
</div>
</template>
<script>
  import Modal from "@/components/Modal.vue";
  import TaskStatus from '../../components/TaskStatus.vue'
  import { mapGetters, mapActions } from "vuex";
  import Swal from 'sweetalert2'
  window.Swal = Swal

  export default {

    data() {
      return {
        mytask:{},
        taskid:null,
        modals: {
          modal1: false,
        },
      }
    },
    components: {
      TaskStatus,
      Modal
    },
    computed: {
      ...mapGetters(["currency"]),
      ...mapGetters("task", ["receivedTasks","task"])
    },
    mounted() {
      // this.$store.commit('task/setReceivedTasks', {});
    },
    created() {
      this.getReceivedTasks();
    },
    methods: {
      ...mapActions("task", ["getReceivedTasks","getTaskDetails"]),
      getThisTaskDetails(id) {
        // this.mytask = {};
        this.taskid = id;
        // console.log(this.taskid)
        this.getTaskDetails(this.taskid).then(() => {
          this.modals.modal1 = true
          this.mytask = this.task;
           this.mytask.sendername = this.task.sender.name;
           this.mytask.senderphone = this.task.sender.phone;
           this.mytask.senderemail = this.task.sender.email;
            this.mytask.receivername =this.task.receiver.name;
           this.mytask.receiverphone = this.task.receiver.phone;
           this.mytask.receiveremail = this.task.receiver.email;
            this.mytask.senderaddress =this.task.senderaddress.city.name+' / '+this.task.senderaddress.district.name;
            this.mytask.receiveraddress =this.task.receiveraddress.city.name+' / '+this.task.receiveraddress.district.name;
            this.task.courier ? this.mytask.courier = this.task.courier.name : this.mytask.courier = 'No Courier';
          });
      },
    }
  }
</script>
