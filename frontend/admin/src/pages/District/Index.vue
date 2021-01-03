<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Districts</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">District List</h3>
          <div class="card-tools">
           <router-link to="/district/create" class="btn btn-outline-success btn-sm btn-flat">
            <i class="fas fa-plus"></i> New </router-link>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-striped projects">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>City</th>
                <th style="width: 120px">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="district in districts.data" :key="district.id">
                <td>{{ district.id }}</td>
                <td>{{ district.name }}</td>
                <td>{{ district.city.name }}</td>
                <td>
                  <router-link style="margin-right: 11px"  :to="{name: 'DistrictDetails', params: { id: district.id }}"  class="btn btn-outline-primary btn-xs btn-flat"><i class="fas fa-info-circle"></i></router-link>

                  <router-link style="margin-right: 11px"  :to="{name: 'EditDistrict', params: { id: district.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>

                  <button class="btn btn-outline-danger btn-xs btn-flat" @click.prevent="deleteDistrictConfirm(district.id)">
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
            <pagination class="float-right" :data="districts" @pagination-change-page="getDistricts"></pagination>
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
    ...mapGetters("district", ["districts"])
  },
  created() {
    this.getDistricts();
  },
  methods: {
    ...mapActions("district", ["getDistricts","deleteDistrict"]),

    deleteDistrictConfirm(id){
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
          this.deleteDistrictConfirmed(id)
        }
      });
    },
    deleteDistrictConfirmed: function(id) {
      this.deleteDistrict(id).then(() => {
        this.myToast('success','District has been deleted.');
      });
    }
  }
}
</script>
