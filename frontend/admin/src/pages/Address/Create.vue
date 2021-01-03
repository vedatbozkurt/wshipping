<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $t("createAddress") }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/">{{ $t("home") }}</router-link>
                <li class="breadcrumb-item"><router-link to="/address">{{ $t("form.address") }}</router-link>
                  <li class="breadcrumb-item active">{{ $t("createAddress") }}</li>
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
              <h3 class="card-title">{{ $t("createAddress") }}</h3>

              <div class="card-tools">
           <!--  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button> -->
          </div>
        </div>
        <!-- form start -->
        <form>
          <div class="card-body">
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t("form.city") }}</label>
              <div class="col-sm-10">
                <multiselect v-model="address.city" :deselect-label="$t('select.cantRemove')" track-by="name" label="name" :placeholder="$t('select.selectCity')" :options="cities" :searchable="true" :allow-empty="false" @input='getThisCityDistricts'>
                  <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> {{ $t("select.selected") }}<strong>  {{ option.language }}</strong></template>
                </multiselect>

                <span class="text-danger" v-if="errors.city"> {{ errors.city[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t("form.district") }}</label>
              <div class="col-sm-10">

                <multiselect v-model="address.district" :deselect-label="$t('select.cantRemove')" track-by="name" label="name" :placeholder="$t('select.selectDistrict')" :options="cityDistricts" :searchable="true" :allow-empty="false">
                  <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> {{ $t("select.selected") }}<strong>  {{ option.language }}</strong></template>
                </multiselect>
                <span class="text-danger" v-if="errors.district"> {{ errors.district[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t("form.user") }}</label>
              <div class="col-sm-10">
                <multiselect v-model="address.user" :deselect-label="$t('select.cantRemove')" track-by="name" label="name" :placeholder="$t('addressOwner')" :options="allUsers" :searchable="true" :allow-empty="false">
                  <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> {{ $t("select.selected") }}<strong>  {{ option.language }}</strong></template>
                </multiselect>
                <span class="text-danger" v-if="errors.name"> {{ errors.user[0] }}</span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t("form.name") }}</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" v-model="address.name" v-bind:class="{ 'is-invalid': errors.name }" :placeholder="$t('addressName')">
                <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.address') }}</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" v-model="address.description" v-bind:class="{ 'is-invalid': errors.description }" :placeholder="$t('allAddress')">
                <span class="text-danger" v-if="errors.description"> {{ errors.description[0] }}</span>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-2 col-form-label">{{ $t('form.status') }}</label>
              <div class="col-sm-10">
                <select class="form-control" v-bind:class="{ 'is-invalid': errors.status }" v-model="address.default">
                  <option value="0">{{ $t('notDefault') }}</option>
                  <option value="1">{{ $t('default') }}</option>
                </select>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="button" @click="addAddress()" class="btn btn-info">{{ $t('save') }}</button>
            <router-link to="/address" class="btn btn-default float-right">{{ $t('cancel') }} </router-link>
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
    }
  },

  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("address", ["address"]),
    ...mapGetters("city", ["cities"]),
    ...mapGetters("district", ["cityDistricts"]),
    ...mapGetters("user", ["allUsers"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit('district/setCityDistricts', []);
    this.$store.commit('address/setAddress', {});
  },
  created() {
    this.getCities();
    this.getAllUsers();
  },
  methods: {
    ...mapActions("address", ["createAddress"]),
    ...mapActions("city", ["getCities"]),
    ...mapActions("district", ["getCityDistricts"]),
    ...mapActions("user", ["getAllUsers"]),

    getThisCityDistricts: function() {
      this.getCityDistricts(this.address.city.id).then(() => {
      });
    },
    addAddress: function() {
      this.createAddress(this.address).then(() => {
        this.myToast('success',this.$t('addressCreated'));
        this.$router.push({ name: "Addresses" });
      });
    }
  }
}
</script>
