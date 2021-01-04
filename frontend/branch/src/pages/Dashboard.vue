<template>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>{{ $t('dashboard') }}</h1>
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
              <span class="info-box-text">{{ $t('city.cities') }}</span>
              <span class="info-box-number">{{cities}}</span>
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
              <span class="info-box-text">{{ $t('courier.couriers') }}</span>
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
              <span class="info-box-text">{{ $t('users') }}</span>
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
              <span class="info-box-text">{{ $t('tasks') }}</span>
              <span class="info-box-number">{{tasks}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
  import { mapGetters, mapActions } from "vuex";

  export default {
    data() {
      return {
      }
    },
    mounted() {

    },
    computed: {
      ...mapGetters("dashboard", ["cities","couriers","users","tasks"])
    },
    created() {
     this.getDashboard();
   },
   methods: {
    ...mapActions("dashboard", ["getDashboard"]),
  }
}
</script>
