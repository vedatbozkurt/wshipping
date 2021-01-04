<template>
  <header class="header-global">
    <base-nav class="navbar-main" transparent type="" effect="light" expand>
    <router-link slot="brand" class="navbar-brand mr-lg-5" to="/">
      <img v-if="companyLogo" :src="getLogo()" alt="logo">
    </router-link>

    <ul class="navbar-nav align-items-lg-center ml-lg-auto">
<ul class="navbar-nav navbar-nav-hover align-items-lg-center">
          <base-dropdown tag="li" class="nav-item">
          <a slot="title" href="#" class="nav-link" data-toggle="dropdown" role="button">
            <i class="ni ni-collection d-lg-none"></i>
            <span class="nav-link-inner--text"><i class="fa fa-language"></i></span>
          </a>
          <a href="#" @click="setLocale('en')" class="dropdown-item">English</a>
          <a href="#" @click="setLocale('tr')" class="dropdown-item">Türkçe</a>
        </base-dropdown>
      </ul>
      <li v-if="!logged" class="nav-item d-none d-lg-block ml-lg-4">
        <router-link to="/login"
        class="btn btn-neutral btn-icon">
        <span class="btn-inner--icon">
          <i class="fa fa-sign-in mr-2"></i>
        </span>
        <span class="nav-link-inner--text">{{$t('login')}}</span>
      </router-link>
    </li>
    <li v-if="!logged" class="nav-item d-none d-lg-block ml-lg-4">
      <router-link to="/register"
      class="btn btn-neutral btn-icon">
      <span class="btn-inner--icon">
        <i class="fa fa-user mr-2"></i>
      </span>
      <span class="nav-link-inner--text">{{$t('register')}}</span>
    </router-link>
  </li>
  <li v-if="logged" class="nav-item d-none d-lg-block ml-lg-4">
   <router-link to="/profile"
   class="btn btn-neutral btn-icon">
   <span class="btn-inner--icon">
    <i class="fa fa-user mr-2"></i>
  </span>
  <span class="nav-link-inner--text">{{ $t('profile') }}</span>
</router-link>
</li>
<li v-if="logged" class="nav-item d-none d-lg-block ml-lg-4">
  <a href="#"  @click="logout"
  class="btn btn-neutral btn-icon">
  <span class="btn-inner--icon">
    <i class="fa fa-sign-out mr-2"></i>
  </span>
  <span class="nav-link-inner--text">{{ $t('logout') }}</span>
</a>
</li>
</ul>
</base-nav>
</header>
</template>
<script>
  import { mapGetters,mapActions} from "vuex";
  import BaseNav from "@/components/BaseNav";
  import BaseDropdown from "@/components/BaseDropdown";
  import CloseButton from "@/components/CloseButton";

  export default {
    components: {
      BaseNav,
      CloseButton,
      BaseDropdown
    },
    data: function() {
      return {
      }
    },
    computed: {
      ...mapGetters(["logged","companyLogo"]),
    },
    mounted() {

    },
    created() {
     this.getInitialData().then(() => {
    });
   },
   methods: {
    ...mapActions("auth", ["sendLogoutRequest"]),
    ...mapActions(["getInitialData"]),
    setLocale(locale) {
      this.$i18n.locale = locale
      localStorage.setItem('userlocale', locale);
    },
    logout() {
      this.sendLogoutRequest();
      this.$router.push({name: 'login'});
    },
    getLogo(){
      return process.env.VUE_APP_URL+"images/" + this.companyLogo;
    }
  }
}
</script>
<style>
</style>
