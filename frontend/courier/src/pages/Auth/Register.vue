<template>
  <div class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <b>{{ $t('courier.courier') }}</b> {{ $t('register') }}
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <form>

            <div class="input-group mb-3">
              <multiselect v-model="courier.city" :options="cities" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('select.selectCity')" label="name" track-by="name" :preselect-first="true"  @input='getCityDistricts'>
                </multiselect>
              <div class="invalid-feedback" v-if="errors.image">{{ errors.image[0] }}</div>
            </div>


            <div class="input-group mb-3">
               <multiselect v-model="courier.district" :options="citiesDistricts" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" :placeholder="$t('select.selectDistrict')" label="name" track-by="name" :preselect-first="true">
                </multiselect>
              <div class="invalid-feedback" v-if="errors.district">{{ errors.district[0] }}</div>
            </div>

            <div class="input-group mb-3">
              <input type="file" class="form-control" :class="{ 'is-invalid': errors.name }" v-on:change="onImageChange">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-image"></span>
                </div>
              </div>
              <div class="invalid-feedback" v-if="errors.image">{{ errors.image[0] }}</div>
            </div>

            <div class="input-group mb-3">
              <input type="text" class="form-control" :class="{ 'is-invalid': errors.name }" v-model="courier.name" :placeholder="$t('form.name')">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
              <div class="invalid-feedback" v-if="errors.name">{{ errors.name[0] }}</div>
            </div>
            <div class="input-group mb-3">
              <input type="email" class="form-control" :class="{ 'is-invalid': errors.email }" v-model="courier.email" :placeholder="$t('form.email')">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
              <div class="invalid-feedback" v-if="errors.email">{{ errors.email[0] }}</div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" :class="{ 'is-invalid': errors.password }" v-model="courier.password" :placeholder="$t('password')">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              <div class="invalid-feedback" v-if="errors.password">{{ errors.password[0] }}</div>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" :class="{ 'is-invalid': errors.phone }" v-model="courier.phone" :placeholder="$t('form.phone')">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-phone"></span>
                </div>
              </div>
              <div class="invalid-feedback" v-if="errors.vehicle">{{ errors.vehicle[0] }}</div>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" :class="{ 'is-invalid': errors.vehicle }" v-model="courier.vehicle" :placeholder="$t('form.vehicle')">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-biking"></span>
                </div>
              </div>
              <div class="invalid-feedback" v-if="errors.vehicle">{{ errors.phone[0] }}</div>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" :class="{ 'is-invalid': errors.plate }" v-model="courier.plate" :placeholder="$t('form.plate')">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-address-book"></span>
                </div>
              </div>
              <div class="invalid-feedback" v-if="errors.plate">{{ errors.plate[0] }}</div>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" :class="{ 'is-invalid': errors.color }" v-model="courier.color" :placeholder="$t('form.color')">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-paint-brush"></span>
                </div>
              </div>
              <div class="invalid-feedback" v-if="errors.color">{{ errors.color[0] }}</div>
            </div>
            <div class="row">
              <!-- /.col -->
              <div class="col-12">
                <button type="button" @click="register" class="btn btn-primary btn-block">{{ $t('register') }}</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
  </div>
</template>

<script>
  import { mapGetters, mapActions } from "vuex";

  export default {
    data: function() {
      return {
        courier: {
          name:'',
          email:'',
          phone:'',
          password:'',
          vehicle:'',
          plate:'',
          color:'',
          city:'',
          district:'',
        },
         result:''
      }
    },

    computed: {
      ...mapGetters(["errors"]),
      ...mapGetters("city", ["cities"]),
      ...mapGetters("district", ["citiesDistricts"]),
    },

    mounted() {
      this.$store.commit("setErrors", {});
      this.$store.commit('city/setCities', []);
      this.$store.commit('district/setCitiesDistricts', []);
    },
    created() {
      this.getCities();
    },
    methods: {
      ...mapActions("auth", ["sendRegisterRequest"]),
      ...mapActions("city", ["getCities"]),
      ...mapActions("district", ["getCitiesDistricts"]),
      onImageChange(e) {
        this.courier.image = e.target.files[0];
      },
      getCityDistricts: function() {
        this.result = this.courier.city.map(a => a.id);
        this.getCitiesDistricts(this.result).then(() => {
        });
      },
      register: function() {
        let formData = new FormData();
        formData.append('city', JSON.stringify(this.courier.city));
        formData.append('district', JSON.stringify(this.courier.district));
        formData.append('phone', this.courier.phone);
        formData.append('name', this.courier.name);
        formData.append('email', this.courier.email);
        formData.append('vehicle', this.courier.vehicle);
        formData.append('plate', this.courier.plate);
        formData.append('color', this.courier.color);
        formData.append('password', this.courier.password);
        formData.append('image', this.courier.image);
        this.sendRegisterRequest(formData).then(() => {
          this.myToast('success',this.$t('courier.registerCourier'));
          this.$router.push({ name: "Login" });
        });
      }
    }
  };
</script>
