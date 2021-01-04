<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $t('user.createUser') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/">{{ $t('home') }}</router-link>
                <li class="breadcrumb-item"><router-link to="/user">{{ $t('users') }}</router-link>
                  <li class="breadcrumb-item active">{{ $t('user.createUser') }}</li>
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
              <h3 class="card-title">{{ $t('user.newUserForm') }}</h3>
              <div class="card-tools">
           <!--  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button> -->
          </div>
        </div>
        <!-- form start -->
        <form>
          <div class="card-body">
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.photo') }}</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" v-on:change="onImageChange">
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
            <hr>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t("form.city") }}</label>
              <div class="col-sm-10">
                <multiselect v-model="user.city" :deselect-label="$t('select.cantRemove')" track-by="name" label="name" :placeholder="$t('select.selectCity')" :options="cities" :searchable="true" :allow-empty="false" @input='getThisCityDistricts' required>
                  <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> {{ $t("select.selected") }}<strong>  {{ option.language }}</strong></template>
                </multiselect>

                <span class="text-danger" v-if="addresserrors.city"> {{ addresserrors.city }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t("form.district") }}</label>
              <div class="col-sm-10">

                <multiselect v-model="user.district" :deselect-label="$t('select.cantRemove')" track-by="name" label="name" :placeholder="$t('select.selectDistrict')" :options="cityDistricts" :searchable="true" :allow-empty="false">
                  <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> {{ $t("select.selected") }}<strong>  {{ option.language }}</strong></template>
                </multiselect>
                <span class="text-danger" v-if="addresserrors.district"> {{ addresserrors.district }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t("form.name") }}</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" v-model="user.addressname" v-bind:class="{ 'is-invalid': addresserrors.addressname }" :placeholder="$t('addressName')">
                <span class="text-danger" v-if="addresserrors.addressname"> {{ addresserrors.addressname }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.address') }}</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" v-model="user.description" v-bind:class="{ 'is-invalid': addresserrors.description }" :placeholder="$t('allAddress')" required="">
                <span class="text-danger" v-if="addresserrors.description"> {{ addresserrors.description }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.status') }}</label>
              <div class="col-sm-10">
                <select class="form-control"  v-model="user.default">
                  <option value="0">{{ $t('notDefault') }}</option>
                  <option value="1">{{ $t('default') }}</option>
                </select>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="button" @click="addUser()" class="btn btn-info">{{ $t('save') }}</button>
            <router-link to="/user" class="btn btn-default float-right">
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
      addresserrors: [],
      user: {
        image:'',
        name:'',
        phone:'',
        email:'',
        status:'',
        description:null,
        city:null,
        district:null,
        addressname:null,
        default:null,
        password:'',
      }
    }
  },

  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("address", ["address"]),
    ...mapGetters("city", ["cities"]),
    ...mapGetters("district", ["cityDistricts"]),
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit('user/setUser', {});
    this.$store.commit('district/setCityDistricts', []);
  },
  created() {
    this.getCities();
  },
  methods: {
    ...mapActions("user", ["createUser"]),
    ...mapActions("city", ["getCities"]),
    ...mapActions("district", ["getCityDistricts"]),
    getThisCityDistricts: function() {
      this.getCityDistricts(this.user.city.id).then(() => {
      });
    },

    onImageChange(e) {
      this.user.image = e.target.files[0];
    },
    addUser: function() {
      this.addresserrors = [];
      if (!this.user.city) {
        this.addresserrors.city = 'City required.';
        return ;
      }
      if (!this.user.district) {
        this.addresserrors.district = 'District required.';
        return ;
      }
      if (!this.user.description) {
        this.addresserrors.description = 'Description required.';
        return ;
      }
      if (!this.user.addressname) {
        this.addresserrors.addressname = 'Addres Name required.';
        return ;
      }

      let formData = new FormData();
      formData.append('image', this.user.image);
      formData.append('name', this.user.name);
      formData.append('phone', this.user.phone);
      formData.append('email', this.user.email);
      formData.append('status', this.user.status);
      formData.append('city', this.user.city.id);
      formData.append('district', this.user.district.id);
      formData.append('addressname', this.user.addressname);
      formData.append('description', this.user.description);
      formData.append('default', this.user.default);
      formData.append('password', this.user.password);
      this.createUser(formData).then(() => {
        this.myToast('success',this.$t('user.createdUser'));
        this.$router.push({ name: "Users" });
      });
    }
  }
}
</script>
