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
                <router-link :to="{name: 'IndexTask'}" class="btn btn-outline-info btn-sm btn-flat">Tasks</router-link>
                <router-link :to="{name: 'ReceivedTask'}" class="btn btn-outline-info btn-sm btn-flat">Received Tasks</router-link>
              </div> <h3 class="h4 text-success font-weight-bold mb-4">Sent Tasks</h3>

              <!-- Button styles -->
              <div class="row py-3 align-items-left">
               <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                <th>{{ $t('form.receiverName') }}</th>
                <th>{{ $t('form.price') }}</th>
                <th>{{ $t('form.createdAt') }}</th>
                <th>{{ $t('form.status') }}</th>
                <th style="width: 110px">{{ $t('actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="task in sentTasks.data" :key="task.id">
                    <td>{{ task.id }}</td>
                <td>{{ task.receiver.name }}</td>
                <td>{{ task.price }} {{currency}}</td>
                <td>{{ task.created_at | moment("MMMM Do YYYY") }}</td>
                <td>
                 <task-status v-show="!task.deleted_at" :status=task.status />
                 <span v-show="task.deleted_at" class="badge badge-danger">{{ $t('form.deleted') }}</span>
               </td>
                    <td><div>
                      <router-link style="margin-right: 11px"  :to="{name: 'EditTask', params: { id: task.id }}" class="btn btn-outline-info btn-sm btn-flat">Edit</router-link>
                      <!--
                      <base-button size="sm" class="btn btn-outline-danger btn-xs btn-flat" @click.prevent="deleteTaskConfirm(task.id)">Delete
                    </base-button> -->
                  </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <ul class="pagination pagination-sm m-0 float-right">
            <pagination class="float-right" :data="sentTasks" @pagination-change-page="getSentTasks"></pagination>
          </ul>
        </card>
      </div>
    </div>
  </div>
</section>
</div>
</template>
<script>
 import TaskStatus from '../../components/TaskStatus.vue'
 import { mapGetters, mapActions } from "vuex";
 import Swal from 'sweetalert2'
 window.Swal = Swal

 export default {
  data() {
    return {
    }
  },
  components: {
    TaskStatus
  },
  computed: {
    ...mapGetters(["currency"]),
    ...mapGetters("task", ["sentTasks"])
  },
  created() {
    this.getSentTasks();
  },
  methods: {
    ...mapActions("task", ["getSentTasks","deleteTask"]),
    deleteTaskConfirm(id){
      Swal.fire({
        title: this.$t('areYouSure'),
        text: this.$t('noRevert'),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: this.$t('yesDelete')
      }).then((result) => {
        if (result.value) {
          this.deleteTaskConfirmed(id)
        }
      });
    },
    deleteTaskConfirmed: function(id) {
      this.deleteTask(id).then(() => {
        this.myToast('success',this.$t('task.deletedTask'));
      });
    }
  }
}
</script>
