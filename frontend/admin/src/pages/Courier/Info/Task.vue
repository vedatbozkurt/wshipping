<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Courier Tasks</h3>
    </div>
    <!-- /.card-header -->
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped projects">
        <thead>
          <tr>
            <th style="width: 10px">#ID</th>
            <th>Sender Name</th>
            <th>Sender Phone</th>
            <th>Receiver Name</th>
            <th>Receiver Phone</th>
            <th>Price</th>
            <th>Created At</th>
            <th>Status</th>
            <th style="width: 70px">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="task in courierTasks.data" :key="task.id">
            <td>{{ task.id }}</td>
            <td>{{ task.sender.name}}</td>
            <td>{{ task.sender.phone}}</td>
            <td>{{ task.receiver.name}}</td>
            <td>{{ task.receiver.phone}}</td>
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
      <small v-show="courierTasks == ''"><center>Not Found.</center></small>
     <pagination class="float-right" :data="courierTasks" @pagination-change-page="getCourierTask"></pagination>
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
    ...mapGetters("courier", ["courierTasks"]),
  },
  created() {
    this.$store.commit('courier/setCourierID', this.$route.params.id);
    this.getCourierTask();
  },
  methods: {
    ...mapActions("courier", ["getCourierTask"]),
  }
}
</script>
