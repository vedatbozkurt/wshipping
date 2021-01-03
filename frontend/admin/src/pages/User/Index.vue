<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-9">
            <h1>{{ $t('users') }}</h1>
          </div>
          <div class="col-sm-3">
            <div class="input-group input-group-sm float-sm-right">
              <input type="text" class="form-control" v-model="search" :placeholder="$t('user.searchUser')">
              <div class="input-group-append">
                <a class="btn btn-primary" @click.prevent="searchThis()">
                  <i class="fas fa-search"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $t('user.userList') }}</h3>
          <div class="card-tools">
           <router-link to="/user/create" class="btn btn-outline-success btn-sm btn-flat">
            <i class="fas fa-plus"></i> {{ $t('new') }} </router-link>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-striped projects">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>{{ $t('form.photo') }}</th>
                <th>{{ $t('form.name') }}</th>
                <th>{{ $t('form.phone') }}</th>
                <th>{{ $t('form.email') }}</th>
                <th>{{ $t('form.status') }}</th>
                <th style="width: 120px">{{ $t('actions') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in users.data" :key="user.id">
                <td>{{ user.id }}</td>
                <td><img alt="Avatar" class="table-avatar" :src="getPhoto('user',user.image)"></td>
                <td>{{ user.name }}</td>
                <td>{{ user.phone }}</td>
                <td>{{ user.email }}</td>
                <td><span v-show="!user.deleted_at"  class="badge " :class="user.status == 1 ? 'badge-success' : 'badge-warning'" >{{ user.status == 1 ? $t('form.active') : $t('form.inactive')}}</span>
                  <span v-show="user.deleted_at" class="badge badge-danger">Deleted</span>
                </td>
                <td>
                  <router-link style="margin-right: 11px"  :to="{name: 'UserDetails', params: { id: user.id, user: { user } }}"  class="btn btn-outline-primary btn-xs btn-flat"><i class="fas fa-info-circle"></i></router-link>

                  <router-link style="margin-right: 11px"  :to="{name: 'EditUser', params: { id: user.id }}" class="btn btn-outline-info btn-xs btn-flat"><i class="fas fa-edit"></i></router-link>

                  <button class="btn btn-outline-danger btn-xs btn-flat" @click.prevent="deleteUserConfirm(user.id)">
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
            <pagination class="float-right" :data="users" @pagination-change-page="getUsers"></pagination>
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
    ...mapGetters("user", ["users"])
  },
  created() {
    this.$store.commit("setSearch", null);
    this.getUsers();
  },
  methods: {
    ...mapActions("user", ["getUsers","deleteUser"]),
    searchThis: function() {
      this.$store.commit('setSearch', this.search);
      this.getUsers();
    },
    deleteUserConfirm(id){
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
          this.deleteUserConfirmed(id)
        }
      });
    },
    deleteUserConfirmed: function(id) {
      this.deleteUser(id).then(() => {
        this.myToast('success',this.$t('user.deletedUser'));
      });
    },
    getPhoto: (owner,image) => { return process.env.VUE_APP_URL+"images/"+ owner+"/"+image }
  }
}
</script>
