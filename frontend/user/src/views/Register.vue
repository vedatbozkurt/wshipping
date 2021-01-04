<template>
  <section class="section section-shaped section-lg my-0">
    <div class="shape shape-style-1 bg-gradient-default">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div class="container pt-lg-md">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <card type="secondary" shadow
          header-classes="bg-white pb-5"
          body-classes="px-lg-5 py-lg-5"
          class="border-0">
          <template>
            <form >
              <span class="text-danger" v-if="errors.image"> {{ errors.image[0] }}</span>
              <base-input alternative
              type="file"
              class="mb-3"
              :placeholder="$t('form.photo')"
              v-on:change="onImageChange"
              addon-left-icon="ni ni-image">
            </base-input>

            <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
            <base-input alternative
            class="mb-3"
            :placeholder="$t('form.name')"
            v-model="user.name"
            addon-left-icon="ni ni-circle-08">
          </base-input>

          <span class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }}</span>
          <base-input alternative
          class="mb-3"
          :placeholder="$t('form.phone')"
          v-model="user.phone"
          addon-left-icon="ni ni-mobile-button">
        </base-input>

        <span class="text-danger" v-if="errors.email"> {{ errors.email[0] }}</span>
        <base-input alternative
        :placeholder="$t('form.email')"
        v-model="user.email"
        addon-left-icon="ni ni-email-83">
      </base-input>

      <span class="text-danger" v-if="errors.password"> {{ errors.password[0] }}</span>
      <base-input alternative
      type="password"
      :placeholder="$t('form.password')"
      v-model="user.password"
      addon-left-icon="ni ni-lock-circle-open">
    </base-input>

    <span class="text-danger" v-if="addresserrors.city"> {{ addresserrors.city }}</span>
    <select class="form-control" v-model="user.city" :placeholder="$t('select.selectCity')" v-on:change="getThisCityDistricts">
      <option v-for="city in cities" v-bind:value="city.id">{{ city.name }}</option>
    </select>

    <span class="text-danger" v-if="addresserrors.district"> {{ addresserrors.district }}</span>
    <select class="form-control" style="margin: 15px 0px 15px 0px;" v-model="user.district" :placeholder="$t('select.selectDistrict')">
      <option v-for="district in cityDistricts" v-bind:value="district.id">{{ district.name }}</option>
    </select>


    <span class="text-danger" v-if="addresserrors.addressname"> {{ addresserrors.addressname }}</span>
    <base-input alternative
    class="mb-3"
    :placeholder="$t('addressName')"
    v-model="user.addressname"
    addon-left-icon="ni ni-ruler-pencil">
  </base-input>

  <span class="text-danger" v-if="addresserrors.description"> {{ addresserrors.description }}</span>
  <base-input alternative
  class="mb-3"
  :placeholder="$t('allAddress')"
  v-model="user.description"
  addon-left-icon="ni ni-pin-3">
</base-input>


<div class="text-center">
  <base-button type="primary" @click="addUser()" class="my-4">{{ $t('save') }}</base-button>
</div>
</form>

</template>
</card>
</div>
</div>
</div>
</section>
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
    this.$store.commit('auth/setUserData', {});
    this.$store.commit('district/setCityDistricts', []);
  },
  created() {
    this.getCities();
  },
  methods: {
    ...mapActions("auth", ["sendRegisterRequest"]),
    ...mapActions("city", ["getCities"]),
    ...mapActions("district", ["getCityDistricts"]),
    getThisCityDistricts: function() {
      this.getCityDistricts(this.user.city).then(() => {
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
      if (!this.user.addressname) {
        this.addresserrors.addressname = 'Addres Name required.';
        return ;
      }
      if (!this.user.description) {
        this.addresserrors.description = 'Description required.';
        return ;
      }

      let formData = new FormData();
      formData.append('image', this.user.image);
      formData.append('name', this.user.name);
      formData.append('phone', this.user.phone);
      formData.append('email', this.user.email);
      formData.append('status', this.user.status);
      formData.append('city', this.user.city);
      formData.append('district', this.user.district);
      formData.append('addressname', this.user.addressname);
      formData.append('description', this.user.description);
      formData.append('default', this.user.default);
      formData.append('password', this.user.password);
      this.sendRegisterRequest(formData).then(() => {
        this.myToast('success',$t('courier.registerCourier'));
        this.$router.push({ name: "login" });
      });
    }
  }
}
</script>
