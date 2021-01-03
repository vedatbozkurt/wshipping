<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Couriers</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Couriers List</h3>
          <div class="card-tools">
           <router-link to="/courier/create" class="btn btn-outline-success btn-sm btn-flat">
            <i class="fas fa-plus"></i> New </router-link>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-striped projects">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Status</th>
                <th style="width: 120px">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="courier in couriers.data" :key="courier.id">
                <td>{{ courier.id }}</td>
                <td><img alt="Avatar" class="table-avatar" src="https://adminlte.io/themes/dev/AdminLTE/dist/img/avatar.png"></td>
                <td>{{ courier.name }}</td>
                <td>{{ courier.phone }}</td>
                <td>{{ courier.email }}</td>
                <td><span v-show="!courier.deleted_at"  class="badge " :class="courier.status == 1 ? 'badge-success' : 'badge-warning'" >{{ courier.status == 1 ? 'Active' : 'Inactive'}}</span>
                <span v-show="courier.deleted_at" class="badge badge-danger">Deleted</span>
                </td>
                <td>
                  <router-link style="margin-right: 11px"  :to="{name: 'CourierDetails', params: { id: courier.id, courier: { courier } }}"  class="btn btn-outline-primary btn-xs btn-flat"><i class="fas fa-info-circle"></i></router-link>

                  <router-link style="margin-right: 11px"  :to="{name: 'EditCourier', params: { id: courier.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>

                  <button class="btn btn-outline-danger btn-xs btn-flat" @click.prevent="deleteCourierConfirm(courier.id)">
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
            <pagination class="float-right" :data="couriers" @pagination-change-page="getCouriers"></pagination>
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
    ...mapGetters("courier", ["couriers"])
  },
  created() {
    this.getCouriers();
  },
  methods: {
    ...mapActions("courier", ["getCouriers","deleteCourier"]),

    deleteCourierConfirm(id){
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
          this.deleteCourierConfirmed(id)
        }
      });
    },
    deleteCourierConfirmed: function(id) {
      this.deleteCourier(id).then(() => {
        this.myToast('success','Courier has been deleted.');
      });
    }
  }
}
</script>
