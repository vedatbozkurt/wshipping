<template>
    <footer class="footer has-cards">
        <div class="container">
            <hr>
            <div class="row align-items-center justify-content-md-between">
                <div class="col-md-6">
                    <div class="copyright">
                        &copy; {{year}}
                        {{companyName}} -  {{companyPhone}} - {{companyEmail}}
                    </div>
                </div>
                <div class="col-md-6">
                    <ul class="nav nav-footer justify-content-end">
                        <li class="nav-item">
                           {{companyAddress}}
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </footer>
</template>
<script>
  import { mapGetters} from "vuex";
export default {
  name: 'app-footer',
  data() {
    return {
      year: new Date().getFullYear()
    }
  },
    computed: {
      ...mapGetters(["companyName","companyPhone","companyAddress","companyEmail"]),
    },
};
</script>
<style>
</style>
