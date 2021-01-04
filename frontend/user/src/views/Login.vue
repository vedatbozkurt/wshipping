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
            <div class="text-center text-muted mb-4">
              <small>Sign in with credentials</small>
            </div>
            <form role="form">
              <span class="text-danger" v-if="errors.email"> {{ errors.email[0] }}</span>
              <base-input alternative
              class="mb-3"
              placeholder="Email"
              v-model="details.email"
              addon-left-icon="ni ni-email-83">
            </base-input>

            <span class="text-danger" v-if="errors.password"> {{ errors.password[0] }}</span>
            <base-input alternative
            type="password"
            v-model="details.password"
            placeholder="Password"
            addon-left-icon="ni ni-lock-circle-open">
          </base-input>
          <span class="text-danger" v-if="errors.notapproved"> {{ errors.notapproved[0] }}</span>
          <div class="text-center">
            <base-button  @click="login" type="primary" class="my-4">{{ $t('signin') }}</base-button>
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
    name: "Login",
    data: function() {
      return {
        details: {
          email: null,
          password: null
        }
      };
    },
    computed: {
      ...mapGetters(["errors"])
    },
    mounted() {
      this.$store.commit("setErrors", {});
    },

    methods: {
      ...mapActions("auth", ["sendLoginRequest"]),

      login: function() {
        this.sendLoginRequest(this.details).then(() => {
          this.$router.push({ name: "profile" });
        });
      }
    }
  };
</script>
