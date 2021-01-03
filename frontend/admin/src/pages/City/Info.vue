<template>
   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>City Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/">Home</router-link>
                <li class="breadcrumb-item"><router-link to="/city">Cities</router-link>
                  <li class="breadcrumb-item active">City Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
          <Sidebar />
        <!-- /.col -->
        <div class="col-md-9">
          <router-view></router-view>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>

<script>
  import Sidebar from '../../layouts/city/Sidebar.vue'

  export default {
    components: {
      Sidebar,
    },
  }
</script>
