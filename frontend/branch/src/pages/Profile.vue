<template>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $t('profile') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
              <router-link to="/">
              {{ $t('home') }}
            </router-link></li>
              <li class="breadcrumb-item active">{{ $t('branch.editBranch') }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $t('branch.editBranch') }}</h3>
        </div>
       <form>
          <div class="card-body">
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.name') }}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="profile.name" v-bind:class="{ 'is-invalid':errors.name }">
                <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.phone') }}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="profile.phone" v-bind:class="{ 'is-invalid':errors.phone }">
                <span class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.email') }}</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" v-model="profile.email" v-bind:class="{ 'is-invalid': errors.email }">
                <span class="text-danger" v-if="errors.email"> {{ errors.email[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('password') }}</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" v-model="profile.password" v-bind:class="{ 'is-invalid':errors.password }">
                <span class="text-danger" v-if="errors.password"> {{ errors.password[0] }}</span>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="button" @click="updateProfile" class="btn btn-info">{{ $t('save') }}</button>
            <router-link to="/" class="btn btn-default float-right">
              {{ $t('cancel') }}
            </router-link>
          </div>
          <!-- /.card-footer -->
        </form>
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
      profile:{}
    }
  },

  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("profile", ["branch"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
  },
  created() {
    this.getBranchData().then(() => {
         this.profile = this.branch
        });
  },
  methods: {
    ...mapActions("profile", ["getBranchData","uploadBranchData"]),

    updateProfile: function() {
      this.uploadBranchData(this.profile).then(() => {
        this.myToast('success',this.$t('updatedProfile'));
      });
    }
  }
}
</script>
