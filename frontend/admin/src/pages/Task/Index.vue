<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-9">
            <h1>{{ $t('task.tasks') }}</h1>
          </div>
          <div class="col-sm-3">
            <div class="input-group input-group-sm float-sm-right">
              <input type="text" class="form-control" v-model="search" :placeholder="$t('task.taskSearch')">
              <div class="input-group-append">
                <a class="btn btn-primary" @click.prevent="searchThis()">
                  <i class="fas fa-search"></i>
                </a>
              </div>
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
          <div class="card-tools">
           <router-link to="/task/create" class="btn btn-outline-success btn-sm btn-flat">
            <i class="fas fa-plus"></i> {{ $t('new') }} </router-link>
          </div>
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
                <th>{{ $t('form.courierName') }}</th>
                <th>{{ $t('form.courierPhone') }}</th>
                <th>{{ $t('form.price') }}</th>
                <th>{{ $t('form.createdAt') }}</th>
                <th>{{ $t('form.status') }}</th>
                <th style="width: 120px">{{ $t('actions') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="task in tasks.data" :key="task.id">
                <td>{{ task.id }}</td>
                <td>{{ task.sender.name }}</td>
                <td>{{ task.sender.phone }}</td>
                <td>{{ task.receiver.name }}</td>
                <td>{{ task.receiver.phone }}</td>
                <td>{{ task.courier ? task.courier.name : $t('form.noCourier')}}</td>
                <td>{{ task.courier ? task.courier.phone : $t('form.noCourier')}}</td>
                <td>{{ task.price }} {{currency}}</td>
                <td>{{ task.created_at | moment("MMMM Do YYYY") }}</td>
                <td>
                 <task-status v-show="!task.deleted_at" :status=task.status />
                 <span v-show="task.deleted_at" class="badge badge-danger">{{ $t('form.deleted') }}</span>
               </td>
               <td>
                <router-link style="margin-right: 11px"  :to="{name: 'EditTask', params: { id: task.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
                <button class="btn btn-outline-danger btn-xs btn-flat" @click.prevent="deleteTaskConfirm(task.id)">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
          <pagination class="float-right" :data="tasks" @pagination-change-page="getTasks"></pagination>
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
      search: null,
    }
  },
  components: {
    TaskStatus
  },
  computed: {
    ...mapGetters(["currency"]),
    ...mapGetters("task", ["tasks"])
  },
  created() {
    this.$store.commit("setSearch", null);
    this.getTasks();
  },
  methods: {
    ...mapActions("task", ["getTasks","deleteTask"]),
    searchThis: function() {
      this.$store.commit('setSearch', this.search);
      this.getTasks();
    },
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
