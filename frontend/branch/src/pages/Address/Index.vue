<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-9">
            <h1>{{ $t('addresses') }}</h1>
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
          <h3 class="card-title">{{ $t('addressList') }}</h3>
          <div class="card-tools">
           <router-link to="/address/create" class="btn btn-outline-success btn-sm btn-flat">
            <i class="fas fa-plus"></i> {{ $t('new') }} </router-link>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>{{ $t('form.name') }}</th>
                <th>{{ $t('addressOwner') }}</th>
                <th>{{ $t('form.city') }}</th>
                <th>{{ $t('form.district') }}</th>
                <th style="width: 120px">{{ $t('actions') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="address in addresses.data" :key="address.id">
                <td>{{ address.id }}</td>
                <td>{{ address.name }}</td>
                <td>{{ address.user.name }}</td>
                <td>{{ address.city.name }}</td>
                <td>{{ address.district.name }}</td>
                <td>
                  <router-link style="margin-right: 11px"  :to="{name: 'EditAddress', params: { id: address.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>

                  <button class="btn btn-outline-danger btn-xs btn-flat" @click.prevent="deleteAddressConfirm(address.id)">
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
            <pagination class="float-right" :data="addresses" @pagination-change-page="getAddresses"></pagination>
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
    ...mapGetters("address", ["addresses"])
  },
  created() {
    this.getAddresses();
  },
  methods: {
    ...mapActions("address", ["getAddresses","deleteAddress"]),

    deleteAddressConfirm(id){
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
          this.deleteAddressConfirmed(id)
        }
      });
    },
    deleteAddressConfirmed: function(id) {
      this.deleteAddress(id).then(() => {
        this.myToast('success',this.$t('addressDeleted'));
      });
    }
  }
}
</script>
