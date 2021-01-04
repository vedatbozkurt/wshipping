<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-9">
            <h1>{{ $t('city.cities') }}</h1>
          </div>
          <div class="col-sm-3">
            <div class="input-group input-group-sm float-sm-right">

            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $t('city.cityList') }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-striped projects">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>{{ $t('form.name') }}</th>
                <th style="width: 40px">{{ $t('actions') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="city in citiesPage.data" :key="city.id">
                <td>{{ city.id }}</td>
                <td>{{ city.name }}</td>
                <td>
                  <router-link style="margin-left: 15px"  :to="{name: 'CityDetails', params: { id: city.id }}"  class="btn btn-outline-primary btn-xs btn-flat"><i class="fas fa-info-circle"></i></router-link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            <pagination class="float-right" :data="citiesPage" @pagination-change-page="getCitiesPage"></pagination>
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

 export default {
  data() {
    return {
    }
  },

  computed: {
    ...mapGetters("city", ["citiesPage"]),
  },
  created() {
    this.getCitiesPage();
  },
  methods: {
    ...mapActions("city", ["getCitiesPage"]),

  }
}
</script>
