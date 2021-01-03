<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">{{ $t('district.editDistrict') }}</h3>
    </div>
    <!-- /.card-header -->
    <form>
      <div class="card-body">
        <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.city') }}</label>
                <div class="col-sm-10">
                  <multiselect v-model="district.city" :deselect-label="$t('select.cantRemove')" track-by="name" label="name" :placeholder="$t('select.selectCity')" :options="cities" :searchable="true" :allow-empty="false">
                    <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> {{ $t('select.selected') }}<strong>  {{ option.language }}</strong></template>
                  </multiselect>
                  <span class="text-danger" v-if="errors.city"> {{ errors.city[0] }}</span>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">{{ $t('form.name') }}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" v-model="district.name" v-bind:class="{ 'is-invalid':errors.name }">
                  <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
                </div>
              </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="button" @click="updateThisDistrict" class="btn btn-info">{{ $t('save') }}</button>
        <button type="button" @click="deleteDistrictConfirm(district.id)" class="btn btn-danger float-right">{{ $t('delete') }}</button>

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
    ...mapGetters("city", ["cities"]),
    ...mapGetters("district", ["district"]),

  },
  mounted() {
    this.$store.commit("setErrors", {});
  },
  created() {
    this.getCities();
    this.getDistrict(this.$route.params.id);
  },
  methods: {
    ...mapActions("city", ["getCities"]),
    ...mapActions("district", ["getDistrict","updateDistrict","deleteDistrictFromEdit"]),

    updateThisDistrict: function() {
      this.updateDistrict(this.district).then(() => {
        this.myToast('success',this.$t('district.updatedDistrict'));
      });
    },
    deleteDistrictConfirm(id){
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
          this.deleteDistrictConfirmed(id)
        }
      });
    },
    deleteDistrictConfirmed: function(id) {
      this.deleteDistrictFromEdit(id).then(() => {
        this.myToast('success',this.$t('district.deletedDistrict'));
        this.$router.push({ name: "Districts" });
      });
    },
  }
}
</script>
