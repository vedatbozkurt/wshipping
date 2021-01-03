<template>
  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $t('district.editDistrict') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/">{{ $t('home') }}</router-link>
                <li class="breadcrumb-item"><router-link to="/district">{{ $t('district.districts') }}</router-link>
                  <li class="breadcrumb-item active">{{ $t('district.editDistrict') }}</li>
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
              <h3 class="card-title">{{ $t('district.editDistrictForm') }}</h3>
            </div>
            <!-- form start -->
            <form>
              <div class="card-body">
               <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.city') }}</label>
                <div class="col-sm-10">
                  <multiselect v-model="district.city" :deselect-label="$t('select.cantRemove')" track-by="name" label="name" :placeholder="$t('select.selectCity')" :options="cities" :searchable="true" :allow-empty="false">
                    <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> {{ $t('select.selected') }}<strong>  {{ option.language }}</strong></template>
                  </multiselect>
                  <span class="text-danger" v-if="errors.city"> {{ errors.city[0] }}</span>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.name') }}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" v-model="district.name" v-bind:class="{ 'is-invalid':errors.name }">
                  <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="button" @click="updateThisDistrict" class="btn btn-info">{{ $t('save') }}</button>
              <router-link to="/district" class="btn btn-default float-right">
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
      }
    },

    computed: {
      ...mapGetters(["errors"]),
      ...mapGetters("city", ["cities"]),
      ...mapGetters("district", ["district"]),
    },
    mounted() {
      this.$store.commit("setErrors", {});
    },
    created() {
      this.getDistrict(this.$route.params.id);
      this.getCities();
    },
    methods: {
      ...mapActions("city", ["getCities"]),
      ...mapActions("district", ["updateDistrict","getDistrict"]),

      updateThisDistrict: function() {
        this.updateDistrict(this.district).then(() => {
          this.myToast('success',this.$t('district.updatedDistrict'));
          this.$router.push({ name: "Districts" });
        });
      }
    }
  }
</script>
