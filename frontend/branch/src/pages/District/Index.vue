<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-9">
            <h1>{{ $t('district.districts') }}</h1>
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
          <h3 class="card-title">{{ $t('district.districtList') }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-striped projects">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>{{ $t('form.name') }}</th>
                <th>{{ $t('form.city') }}</th>
                <th style="width: 40px">{{ $t('actions') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="district in districts.data" :key="district.id">
                <td>{{ district.id }}</td>
                <td>{{ district.name }}</td>
                <td>{{ district.city.name }}</td>
                <td>
                  <router-link style="margin-left: 15px"  :to="{name: 'DistrictDetails', params: { id: district.id }}"  class="btn btn-outline-primary btn-xs btn-flat"><i class="fas fa-info-circle"></i></router-link>
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
      search: null,
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
        title: this.$t('areYouSure'),
        text: this.$t('noRevert'),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: this.$t('yesDelete')
      }).then((result) => {
        if (result.value) {
          this.deleteDistrictConfirmed(id)
        }
      });
    },
    deleteDistrictConfirmed: function(id) {
      this.deleteDistrict(id).then(() => {
        this.myToast('success',this.$t('district.deletedDistrict'));
      });
    }
  }
}
</script>
