<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">{{ $t('user.editUser') }}</h3>
      <div class="card-tools">
        <button v-if="user.deleted_at" @click="restoreThisUser" class="btn btn-outline-warning btn-sm btn-flat">
                <i class="fas fa-recycle"></i> {{ $t('restore') }}
              </button>
      </div>
    </div>
    <!-- /.card-header -->
    <form>
      <div class="card-body">
       <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.photo') }}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="user.image" v-bind:class="{ 'is-invalid':errors.image }">
                <span class="text-danger" v-if="errors.image"> {{ errors.image[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.name') }}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="user.name" v-bind:class="{ 'is-invalid':errors.name }">
                <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.phone') }}</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" v-model="user.phone" v-bind:class="{ 'is-invalid': errors.phone }">
                <span class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.email') }}</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" v-model="user.email" v-bind:class="{ 'is-invalid': errors.email }">
                <span class="text-danger" v-if="errors.email"> {{ errors.email[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.password') }}</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" v-model="user.password" v-bind:class="{ 'is-invalid': errors.password }">
                <span class="text-danger" v-if="errors.password"> {{ errors.password[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.status') }}</label>
              <div class="col-sm-10">
                <select class="form-control" v-bind:class="{ 'is-invalid': errors.status }" v-model="user.status">
                  <option value="0">{{ $t('form.inactive') }}</option>
                  <option value="1">{{ $t('form.active') }}</option>
                </select>
                <span class="text-danger" v-if="errors.status"> {{ errors.status[0] }}</span>
              </div>
            </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="button" @click="updateThisUser" class="btn btn-info">{{ $t('save') }}</button>
        <button type="button" @click="deleteUserConfirm(user.id)" class="btn btn-danger float-right">{{ $t('delete') }}</button>

      </div>
    </form>
  </div>
  <!-- /.card -->
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
    ...mapGetters(["errors"]),
    ...mapGetters("user", ["user"]),

  },
  mounted() {
    this.$store.commit("setErrors", {});
  },
  created() {
    this.getUser(this.$route.params.id);
  },
  methods: {
    ...mapActions("user", ["updateUser","getUser","deleteUserFromEdit","restoreUser"]),

    updateThisUser: function() {
      this.updateUser(this.user).then(() => {
        this.myToast('success',this.$t('user.updatedUser'));
      });
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
      this.deleteUserFromEdit(id).then(() => {
        this.myToast('success',this.$t('user.deletedUser'));
        this.$router.push({ name: "Users" });
      });
    },
    restoreThisUser: function() {
      this.restoreUser(this.user.id).then(() => {
        this.myToast('success',this.$t('user.restoredUser'));
        this.$router.push({ name: "Users" });
      });
    },
  }
}
</script>
