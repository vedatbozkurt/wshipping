<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Sent Tasks by User</h3>

      <div class="card-tools">
        <div class="input-group input-group-sm">
          <input type="text" class="form-control" placeholder="Search Task">
          <div class="input-group-append">
            <div class="btn btn-primary">
              <i class="fas fa-search"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped projects">
        <thead>
          <tr>
            <th style="width: 10px">#ID</th>
            <th>Courier Name</th>
            <th>Courier Phone</th>
            <th>Receiver Name</th>
            <th>Receiver Phone</th>
            <th>Price</th>
            <th>Created At</th>
            <th>Status</th>
            <th style="width: 70px">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="task in userSenderTask.data" :key="task.id">
            <td>{{ task.id }}</td>
            <td>{{ task.courier ? task.courier.name : 'No Courier'}}</td>
            <td>{{ task.courier ? task.courier.phone : 'No Courier'}}</td>
            <td>{{ task.receiver.name}}</td>
            <td>{{ task.receiver.phone}}</td>
            <td>{{ task.price}}</td>
            <td>{{ task.created_at | moment("MMMM Do YYYY") }}</td>
            <td>
              <task-status v-show="!task.deleted_at" :status=task.status />
              <span v-show="task.deleted_at" class="badge badge-danger">Deleted</span>
            </td>
            <td>
              <router-link style="margin-right: 11px"  :to="{name: 'EditTask', params: { id: task.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <small v-show="userSenderTask == ''"><center>Not Found.</center></small>
      <pagination class="float-right" :data="userSenderTask" @pagination-change-page="getUserSenderTasks"></pagination>
    </div>
  </div>
  <!-- /.card -->
</template>
<script>
 import TaskStatus from '../../../components/TaskStatus.vue'
 import { mapGetters, mapActions} from "vuex";
 export default {
  data() {
    return {
    }
  },
  components: {
    TaskStatus
  },
  computed: {
    ...mapGetters("user", ["userSenderTask"]),
  },
  created() {
    this.$store.commit('user/setUserID', this.$route.params.id);
    // this.$store.commit("user/setUser", {}); //bu olmazsa detailsden birden fazla district id gelir district task hata verir
    this.getUserSenderTasks();
  },
  methods: {
    ...mapActions("user", ["getUserSenderTasks"]),
  }
}
</script>
