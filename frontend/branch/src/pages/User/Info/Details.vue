<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">{{ $t('user.editUser') }}</h3>
    </div>
    <!-- /.card-header -->
    <form>
      <div class="card-body">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.photo') }}</label>
          <div class="col-sm-10">
            <img width="150" :src="getProfilePhoto()" alt="User Image">
            <input type="file" class="form-control" v-on:change="onImageChanger">
            <span class="text-danger" v-if="errors.image"> {{ errors.image[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.name') }}</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" v-model="editedUser.name" v-bind:class="{ 'is-invalid':errors.name }">
            <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.phone') }}</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" v-model="editedUser.phone" v-bind:class="{ 'is-invalid': errors.phone }">
            <span class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.email') }}</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" v-model="editedUser.email" v-bind:class="{ 'is-invalid': errors.email }">
            <span class="text-danger" v-if="errors.email"> {{ errors.email[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.password') }}</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" v-model="editedUser.password" v-bind:class="{ 'is-invalid': errors.password }">
            <span class="text-danger" v-if="errors.password"> {{ errors.password[0] }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.status') }}</label>
          <div class="col-sm-10">
            <select class="form-control" v-bind:class="{ 'is-invalid': errors.status }" v-model="editedUser.status">
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
      previous_image:'no-image.png',
      editedUser: {
        image:'no-image.png',
      }
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
    this.getUser(this.$route.params.id).then(() => {
      if (this.user.image == "") { this.user.image = 'no-image.png';}
      this.previous_image = this.user.image;
      this.editedUser = this.user;
      this.editedUser.password = '';
    });
  },
  methods: {
    ...mapActions("user", ["updateUser","getUser","deleteUserFromEdit"]),
    getProfilePhoto(){
      if (this.editedUser.image) {
        return process.env.VUE_APP_URL+"images/user/" + this.previous_image;
      }else{
        return process.env.VUE_APP_URL+"images/user/"+ this.editedUser.image;
      }
    },
    onImageChanger(e) {
      this.editedUser.image = e.target.files[0];
    },
    updateThisUser: function() {
      let formData2 = new FormData();
      formData2.append('id', this.editedUser.id);
      formData2.append('previous_image', this.previous_image);
      formData2.append('image', this.editedUser.image);
      formData2.append('name', this.editedUser.name);
      formData2.append('phone', this.editedUser.phone);
      formData2.append('email', this.editedUser.email);
      formData2.append('status', this.editedUser.status);
      if(this.editedUser.password !== ''){ formData2.append('password', this.editedUser.password); }
      formData2.append("_method", "put");
      this.updateUser(formData2).then(() => {
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
  }
}
</script>
