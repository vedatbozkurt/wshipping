<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Dash Page</h1>
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
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Bordered Table</h3>
          <div class="card-tools">
           <button class="btn btn-outline-success btn-sm btn-flat">
            <i class="fas fa-plus"></i> New
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Status</th>
              <th style="width: 70px">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1.</td>
              <td>Update software</td>
              <td>Update software</td>
              <td>Update software</td>
              <td>Update software</td>
              <td>
                <button style="margin-right: 11px" class="btn btn-outline-info btn-xs btn-flat">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="btn btn-outline-danger btn-xs btn-flat">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        l
        <ul class="pagination pagination-sm m-0 float-right">
          r
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
      search: null,
    }
  },

  computed: {
    ...mapGetters("dashboard", ["branches","couriers","users","tasks",])
  },
  created() {
    this.getDashboard();
  },
  methods: {
    ...mapActions("dashboard", ["getDashboard"]),
  }
}
</script>
