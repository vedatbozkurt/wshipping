<template>
 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <router-link to="/" class="nav-link">
              <p>{{ $t('home') }}</p>
            </router-link>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
       <!-- Language Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-language pink"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right p-0">
          <a href="#" @click="setLocale('en')" class="dropdown-item">
            English
          </a>
          <a href="#" @click="setLocale('tr')" class="dropdown-item">
             Türkçe
          </a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  </template>
<script>
  export default {
    computed: {
    },

    mounted() {
    },

    methods: {
      setLocale(locale) {
      console.log(locale)
      this.$i18n.locale = locale
      localStorage.setItem('userlocale', locale);
    },
    }
  };
</script>
<style scoped>
.pink { color:#ba76ad ; font-size: 1.65rem; }
</style>
