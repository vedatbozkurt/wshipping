<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Dashboard</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-code-branch"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Branches</span>
              <span class="info-box-number">{{branches}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-biking"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Couriers</span>
              <span class="info-box-number">{{couriers}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Users</span>
              <span class="info-box-number">{{users}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tasks"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tasks</span>
              <span class="info-box-number">{{tasks}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Montly Tasks</h3>
              <div class="card-tools">
               <router-link to="/task/create" class="btn btn-outline-success btn-sm btn-flat">
                <i class="fas fa-plus"></i> New </router-link>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <MontlyTasks :data=tasksMonth />
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-12 col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Couriers and Users</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <MontlyCourierUser :user=usersMonth :courier=couriersMonth />
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
  import { mapGetters, mapActions } from "vuex";
  import MontlyTasks from '../components/MontlyTasks'
  import MontlyCourierUser from '../components/MontlyCourierUser'

  export default {
    components: { MontlyTasks,MontlyCourierUser },
    data() {
      return {
        search: null,
      }
    },
    mounted() {

    },
    computed: {
      ...mapGetters("dashboard", ["branches","couriers","users","tasks","tasksMonth","usersMonth","couriersMonth"])
    },
    created() {
     this.getDashboard();
   },
   methods: {
    ...mapActions("dashboard", ["getDashboard"]),
  }
}
</script>
