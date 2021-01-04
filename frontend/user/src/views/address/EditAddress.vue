<template>
  <div class="profile-page">

    <section class="section-profile-cover section-shaped my-0">
      <div class="shape shape-style-1 shape-primary shape-skew alpha-4">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </section>
    <section class="section section-lg pt-lg-0 section-contact-us">
      <div class="container">
        <div class="row justify-content-center mt--300">
          <div class="col-lg-8 mt--150">
            <card gradient="secondary" shadow body-classes="p-lg-5">
              <h3 class="h4 text-success font-weight-bold mb-4">Edit Address</h3>

              <span class="text-danger" v-if="errors.city"> {{ errors.city[0] }}</span>
              <select class="form-control" v-model="address.city_id" :placeholder="$t('select.selectCity')" v-on:change="getThisCityDistricts">
                <option v-for="city in cities" :value="city.id">{{ city.name }}</option>
              </select>

              <span class="text-danger" v-if="errors.district"> {{ errors.district[0] }}</span>
              <select class="form-control" style="margin: 15px 0px 15px 0px;" v-model="address.district_id" :placeholder="$t('select.selectDistrict')">
                <option v-for="district in cityDistricts" v-bind:value="district.id">{{ district.name }}</option>
              </select>


              <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
              <base-input alternative
              class="mb-3"
              :placeholder="$t('addressName')"
              v-model="address.name"
              addon-left-icon="ni ni-ruler-pencil">
            </base-input>

            <span class="text-danger" v-if="errors.description"> {{ errors.description[0] }}</span>
            <base-input alternative
            class="mb-3"
            :placeholder="$t('allAddress')"
            v-model="address.description"
            addon-left-icon="ni ni-pin-3">
          </base-input>

          <select class="form-control" v-model="address.default">
            <option value="0">{{ $t('notDefault') }}</option>
            <option value="1">{{ $t('default') }}</option>
          </select>

          <div class="text-center">
            <base-button type="primary" @click="updateThisAddress()" class="my-4">Update</base-button>
            <router-link to="/address" class="btn btn-neutral">
              {{ $t('cancel') }}
            </router-link>
          </div>
        </card>
      </div>
    </div>
  </div>
</section>
</div>
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
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit('district/setCityDistricts', []);
    this.$store.commit('address/setAddress', {});
  },
  created() {
    this.getAddress(this.$route.params.id).then(() => {
      this.getCities();
      this.getThisCityDistricts(this.address.city_id)
    });
  },
  methods: {
    ...mapActions("address", ["updateAddress","getAddress"]),
    ...mapActions("city", ["getCities"]),
    ...mapActions("district", ["getCityDistricts"]),

    getThisCityDistricts: function() {
      this.getCityDistricts(this.address.city_id).then(() => {
      });
    },
    updateThisAddress: function() {
      this.address.user=this.address.user_id;
      this.address.city=this.address.city_id;
      this.address.district=this.address.district_id;
      this.updateAddress(this.address).then(() => {
        this.myToast('success',this.$t('addressUpdated'));
        this.$router.push({ name: "address" });
      });
    }
  }
}
</script>
