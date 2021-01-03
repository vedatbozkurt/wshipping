<template>
  <div class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="/"><b>Admin</b> {{ $t('login') }}</a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">{{ $t('signinStart') }}</p>

          <form>
            <div class="input-group mb-3">
              <input
              type="email"
              class="form-control"
              :class="{ 'is-invalid': errors.email }"
              v-model="details.email"
              :placeholder="$t('form.email')">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
              <div class="invalid-feedback" v-if="errors.email">
                {{ errors.email[0] }}
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password"
              class="form-control"
              :class="{ 'is-invalid': errors.password }"
              v-model="details.password"
              :placeholder="$t('password')">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              <div class="invalid-feedback" v-if="errors.password">
                {{ errors.password[0] }}
              </div>
            </div>
            <div class="row">
              <!-- /.col -->
              <div class="col-12">
                <button type="button" @click="login" class="btn btn-primary btn-block">{{ $t('signin') }}</button>
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
      ...mapActions(["getCurrency"]),

      login: function() {
        this.sendLoginRequest(this.details).then(() => {
          this.getCurrency();
          this.$router.push({ name: "Dashboard" });
        });
      }
    }
  };
</script>
