<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Received Tasks by User</h3>
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
            <th>Sender Name</th>
            <th>Sender Phone</th>
            <th>Price</th>
            <th>Created At</th>
            <th>Status</th>
            <th style="width: 70px">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="task in userReceiverTask.data" :key="task.id">
            <td>{{ task.id }}</td>
            <td>{{ task.courier ? task.courier.name : 'No Courier'}}</td>
            <td>{{ task.courier ? task.courier.phone : 'No Courier'}}</td>
            <td>{{ task.sender.name}}</td>
            <td>{{ task.sender.phone}}</td>
            <td>{{ task.price}} {{currency}}</td>
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
      <small v-show="userReceiverTask == ''"><center>Not Found.</center></small>
      <pagination class="float-right" :data="userReceiverTask" @pagination-change-page="getUserReceiverTasks"></pagination>
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
    ...mapGetters(["currency"]),
    ...mapGetters("user", ["userReceiverTask"]),
  },
  created() {
    this.$store.commit('user/setUserID', this.$route.params.id);
    this.getUserReceiverTasks();
  },
  methods: {
    ...mapActions("user", ["getUserReceiverTasks"]),
  }
}
</script>
