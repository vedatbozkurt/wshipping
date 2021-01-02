<template>
  <div id="app" class="wrapper">
    <router-view></router-view>
  </div>
</template>

<script>
  window.$ = window.jQuery = require('jquery');
  require('admin-lte/dist/js/adminlte.min.js');
  require('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js');
  require('admin-lte/dist/css/adminlte.min.css');
  require('admin-lte/plugins/fontawesome-free/css/all.min.css');

  export default {
    name: 'App',
    components: {
    },
  }
</script>

<style>
</style>
