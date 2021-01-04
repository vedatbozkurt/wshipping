<template>
    <div id="app">
        <router-view name="header"></router-view>
        <main>
            <fade-transition origin="center" mode="out-in" :duration="250">
                <router-view/>
            </fade-transition>
        </main>
        <router-view name="footer"></router-view>
    </div>
</template>
<script>
import { FadeTransition } from "vue2-transitions";

export default {
  components: {
    FadeTransition
  },
   mounted() {
    if (localStorage.getItem("authToken")) {this.$store.commit("setLoggedData", true)}
  },
  created() {

  },
};
</script>
<style>
    .onaybekliyor { background-color:#fcd314; }
.kuryeatamasiyapildi { background-color:#99eaff; }
.kuryekabuledilmebekleniyor { background-color:#c6e2ff; }
.kuryekabuletti { background-color:#97e010 ; }
.kuryeyolda { background-color:#7fffbf ; }
.kuryehedefevardi { background-color:#dacdf7 ; }
.teslimedildi { background-color:#10e060 ; }
.kuryeiptaletti { background-color:#e0102f ; }
.kuryegonderiyialdi { background-color:#b87afa ; }
</style>
