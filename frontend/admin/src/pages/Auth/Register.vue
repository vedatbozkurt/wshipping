<template>
  <div class="login mt-5">
    <div class="card">
      <div class="card-header">
        {{ $t('register') }}
      </div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <label for="email">{{ $t('name') }}</label>
            <input
              type="text"
              class="form-control"
              :class="{ 'is-invalid': errors.name }"
              id="name"
              v-model="details.name"
              :placeholder="$t('form.enterName')"
            />
            <div class="invalid-feedback" v-if="errors.name">
              {{ errors.name[0] }}
            </div>
          </div>
          <div class="form-group">
            <label for="email">{{ $t('email') }}</label>
            <input
              type="email"
              class="form-control"
              :class="{ 'is-invalid': errors.email }"
              id="email"
              v-model="details.email"
              :placeholder="$t('form.enterEmail')"
            />
            <div class="invalid-feedback" v-if="errors.email">
              {{ errors.email[0] }}
            </div>
          </div>
          <div class="form-group">
            <label for="password">{{ $t('password') }}</label>
            <input
              type="password"
              class="form-control"
              :class="{ 'is-invalid': errors.password }"
              id="password"
              v-model="details.password"
              :placeholder="$t('form.enterPassword')"
            />
            <div class="invalid-feedback" v-if="errors.password">
              {{ errors.password[0] }}
            </div>
          </div>
          <div class="form-group">
            <label for="password_confirmation">{{ $t('confirmPassword') }}</label>
            <input
              type="password"
              class="form-control"
              id="password_confirmation"
              v-model="details.password_confirmation"
              :placeholder="$t('confirmPassword')"
            />
          </div>
          <button type="button" @click="register" class="btn btn-primary">
            {{ $t('register') }}
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "Home",

  data: function() {
    return {
      details: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null
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
    ...mapActions("auth", ["sendRegisterRequest"]),

    register: function() {
      this.sendRegisterRequest(this.details).then(() => {
        this.$router.push({ name: "Home" });
      });
    }
  }
};
</script>
