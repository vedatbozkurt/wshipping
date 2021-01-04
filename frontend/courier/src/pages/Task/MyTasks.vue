<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-9">
            <h1>{{ $t('task.myTasks') }}</h1>
          </div>
          <div class="col-sm-3">
            <div class="input-group input-group-sm float-sm-right">

            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $t('task.taskList') }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-striped projects">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>{{ $t('form.senderName') }}</th>
                <th>{{ $t('form.senderPhone') }}</th>
                <th>{{ $t('form.receiverName') }}</th>
                <th>{{ $t('form.receiverPhone') }}</th>
                <th>{{ $t('form.price') }}</th>
                <th>{{ $t('form.createdAt') }}</th>
                <th>{{ $t('form.status') }}</th>
                <th style="width: 120px">{{ $t('actions') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="task in myTasks.data" :key="task.id">
                <td>{{ task.id }}</td>
                <td>{{ task.sender.name }}</td>
                <td>{{ task.sender.phone }}</td>
                <td>{{ task.receiver.name }}</td>
                <td>{{ task.receiver.phone }}</td>
                <td>{{ task.price }} {{currency}}</td>
                <td>{{ task.created_at | moment("MMMM Do YYYY") }}</td>
                <td>
                 <task-status :status=task.status />
               </td>
               <td>
                <router-link style="margin-right: 11px"  :to="{name: 'EditTask', params: { id: task.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
                <button v-if="task.status!=7" class="btn btn-outline-danger btn-xs btn-flat" @click.prevent="cancelTaskConfirm(task.id)">
                  <i class="fas fa-ban"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
          <pagination class="float-right" :data="myTasks" @pagination-change-page="getMyTasks"></pagination>
        </ul>
      </div>
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
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
    ...mapGetters("task", ["myTasks"])
  },
  created() {
    this.getMyTasks();
  },
  methods: {
    ...mapActions("task", ["getMyTasks","cancelTask"]),
    cancelTaskConfirm(id){
      Swal.fire({
        title: this.$t('areYouSure'),
        text: this.$t('cancelTask'),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: this.$t('yesCancel')
      }).then((result) => {
        if (result.value) {
          this.cancelTaskConfirmed(id)
        }
      });
    },
    cancelTaskConfirmed: function(id) {
      this.cancelTask(id).then(() => {
        this.myToast('success',this.$t('task.canceledTask'));
      });
    }
  }
}
</script>
