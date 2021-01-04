<template>
  <div id="app" class="wrapper">
    <div :class="{'loader': loader}"></div>
    <router-view></router-view>
  </div>
</template>

<script>
  window.$ = window.jQuery = require('jquery');
  require('admin-lte/dist/js/adminlte.min.js');
  require('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js');
  require('admin-lte/dist/css/adminlte.min.css');
  require('admin-lte/plugins/fontawesome-free/css/all.min.css');
  import { mapGetters } from "vuex";


  export default {
    name: 'App',
    components: {
    },
    computed: {
      ...mapGetters(["loader"]),
    },
  }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style>
.loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
  background-color: rgba(255,255,255,0.7);
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}


@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 }
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom {
  from{ bottom:-100px; opacity:0 }
  to{ bottom:0; opacity:1 }
}
</style>
