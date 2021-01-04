<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">{{ $t('city.editCity') }}</h3>
    </div>
    <!-- /.card-header -->
    <form>
      <div class="card-body">
        <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.name') }}</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" v-model="city.name" v-bind:class="{ 'is-invalid':errors.name }" disabled="">
                    <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
                  </div>
                </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <router-link to="/city" class="btn btn-default float-right">
              {{ $t('cancel') }}
            </router-link>
      </div>
    </form>
  </div>
  <!-- /.card -->
</template>
<script>
 import { mapGetters, mapActions } from "vuex";
 import Swal from 'sweetalert2'
 window.Swal = Swal
 export default {
  data() {
    return {
    }
  },

  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("city", ["city"]),

  },
  mounted() {
    this.$store.commit("setErrors", {});
  },
  created() {
    this.getCity(this.$route.params.id);
  },
  methods: {
    ...mapActions("city", ["getCity","updateCity","deleteCityFromEdit"]),


    updateThisCity: function() {
      this.updateCity(this.city).then(() => {
        this.myToast('success',this.$t('city.updatedCity'));
      });
    },
    deleteCityConfirm(id){
      Swal.fire({
        title: this.$t('areYouSure'),
        text: this.$t('noRevert'),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: this.$t('yesDelete')
      }).then((result) => {
        if (result.value) {
          this.deleteCityConfirmed(id)
        }
      });
    },
    deleteCityConfirmed: function(id) {
      this.deleteCityFromEdit(id).then(() => {
        this.myToast('success',this.$t('city.deletedCity'));
        this.$router.push({ name: "Cities" });
      });
    },
  }
}
</script>
