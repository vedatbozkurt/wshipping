<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Courier Tasks</h3>

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
            <td>{{ task.price}}</td>
            <td>{{ task.created_at | moment("MMMM Do YYYY") }}</td>
            <td><span class="badge " :class="task.status == 1 ? 'badge-success' : 'badge-warning'" >{{ task.status == 1 ? 'active' : 'inactive'}}</span></td>
            <td>
              <router-link style="margin-right: 11px"  :to="{name: 'EditTask', params: { id: task.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <small v-show="courierTasks == ''"><center>Not Found.</center></small>
    </div>
  </div>
  <!-- /.card -->
</template>
<script>
 import { mapGetters, mapActions} from "vuex";
 export default {
  data() {
    return {
    }
  },

  computed: {
    ...mapGetters("courier", ["courierTasks"]),
  },
  created() {
    this.getCourierTask(this.$route.params.id);
  },
  methods: {
    ...mapActions("courier", ["getCourierTask"]),
  }
}
</script>
