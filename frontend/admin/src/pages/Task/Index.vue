<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Tasks</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Task List</h3>
          <div class="card-tools">
           <router-link to="/task/create" class="btn btn-outline-success btn-sm btn-flat">
            <i class="fas fa-plus"></i> New </router-link>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-striped projects">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Sender Name</th>
                <th>Sender Phone</th>
                <th>Receiver Name</th>
                <th>Receiver Phone</th>
                <th>Courier Name</th>
                <th>Courier Phone</th>
                <th>Price</th>
                <th>Created At</th>
                <th>Status</th>
                <th style="width: 120px">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="task in tasks.data" :key="task.id">
                <td>{{ task.id }}</td>
                <td>{{ task.sender.name }}</td>
                <td>{{ task.sender.phone }}</td>
                <td>{{ task.receiver.name }}</td>
                <td>{{ task.receiver.phone }}</td>
                <td>{{ task.courier ? task.courier.name : 'No Courier'}}</td>
                <td>{{ task.courier ? task.courier.phone : 'No Courier'}}</td>
                <td>{{ task.price }}</td>
                <td>{{ task.created_at | moment("MMMM Do YYYY") }}</td>
                <td><span v-show="!task.deleted_at"  class="badge " :class="task.status == 1 ? 'badge-success' : 'badge-warning'" >{{ task.status == 1 ? 'Active' : 'Inactive'}}</span>
                  <span v-show="task.deleted_at" class="badge badge-danger">Deleted</span>
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
 import { mapGetters, mapActions } from "vuex";
 import Swal from 'sweetalert2'
 window.Swal = Swal

 export default {
  data() {
    return {
    }
  },

  computed: {
    ...mapGetters("task", ["tasks"])
  },
  created() {
    this.getTasks();
  },
  methods: {
    ...mapActions("task", ["getTasks","deleteTask"]),

    deleteTaskConfirm(id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          this.deleteTaskConfirmed(id)
        }
      });
    },
    deleteTaskConfirmed: function(id) {
      this.deleteTask(id).then(() => {
        this.myToast('success','Task has been deleted.');
      });
    }
  }
}
</script>
