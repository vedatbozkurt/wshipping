<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>{{ $t('settings') }}</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $t('editSettings') }}</h3>
        </div>
        <!-- form start -->
        <form>
          <div class="card-body">
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.logo') }}</label>
              <div class="col-sm-10">
                <img width="150" :src="getPhoto()" alt="User Image">
                <input type="file" class="form-control" v-on:change="onImageChanger">
                <span class="text-danger" v-if="errors.logo"> {{ errors.logo[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('companyName') }}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="editedSetting.company_name" v-bind:class="{ 'is-invalid':errors.company_name }">
                <span class="text-danger" v-if="errors.company_name"> {{ errors.company_name[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.phone') }}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="editedSetting.phone" v-bind:class="{ 'is-invalid':errors.phone }">
                <span class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.description') }}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="editedSetting.description" v-bind:class="{ 'is-invalid':errors.description }">
                <span class="text-danger" v-if="errors.description"> {{ errors.description[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.keywords') }}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="editedSetting.keywords" v-bind:class="{ 'is-invalid':errors.keywords }">
                <span class="text-danger" v-if="errors.keywords"> {{ errors.keywords[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.address') }}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="editedSetting.address" v-bind:class="{ 'is-invalid':errors.address }">
                <span class="text-danger" v-if="errors.address"> {{ errors.address[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.email') }}</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" v-model="editedSetting.email" v-bind:class="{ 'is-invalid':errors.email }">
                <span class="text-danger" v-if="errors.email"> {{ errors.email[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('currency') }}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="editedSetting.currency" v-bind:class="{ 'is-invalid':errors.currency }">
                <span class="text-danger" v-if="errors.currency"> {{ errors.currency[0] }}</span>
              </div>
            </div>

          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="button" @click="updateSettings" class="btn btn-info">{{ $t('save') }}</button>
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
      editedSetting: {
        logo:'no-image.png',
      },
      previous_image:'no-image.png',

    }
  },

  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("setting", ["setting"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
  },
  created() {
    this.getSetting().then(() => {
      if (this.setting.logo == "") { this.setting.logo = 'no-image.png';}
      this.previous_image = this.setting.logo;
      this.editedSetting = this.setting;
    });
  },
  methods: {
    ...mapActions("setting", ["getSetting","updateSetting"]),
    getPhoto(){
      if (this.editedSetting.logo) {
        return process.env.VUE_APP_URL+"images/" + this.previous_image;
      }else{
        return process.env.VUE_APP_URL+"images/"+ this.editedSetting.logo;
      }
    },
    onImageChanger(e) {
      this.editedSetting.logo = e.target.files[0];
    },
    updateSettings: function() {
     let formData = new FormData();
     formData.append('previous_image', this.previous_image);
     formData.append('image', this.editedSetting.logo);
     formData.append('company_name', this.editedSetting.company_name);
     formData.append('phone', this.editedSetting.phone);
     formData.append('email', this.editedSetting.email);
     formData.append('description', this.editedSetting.description);
     formData.append('keywords', this.editedSetting.keywords);
     formData.append('address', this.editedSetting.address);
     formData.append('currency', this.editedSetting.currency);
     formData.append("_method", "put");
     this.updateSetting(formData).then(() => {
      this.$store.commit("setCurrency", this.setting.currency);
      this.myToast('success',this.$t('settingUpdated'));
    });
   }
 }
}
</script>
