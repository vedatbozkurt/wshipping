<template>
  <div class="profile-page">
    <section class="section-profile-cover section-shaped my-0">
      <div class="shape shape-style-1 shape-primary shape-skew alpha-4">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </section>
    <section class="section section-skew mt--200">
      <div class="container">
        <card shadow class="card-profile mt--300" no-body>
          <div class="px-4">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img v-lazy="getProfilePhoto()" class="rounded-circle">
                  </a>
                </div>

              </div>
              <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                <div class="card-profile-actions py-4 mt-lg-0">
                   <router-link to="/task" class="btn btn-sm btn-info mr-2">{{ $t('task.tasks') }}</router-link>
                   <router-link to="/task/create" class="btn btn-warning btn-sm mr-2">{{ $t('task.createTask') }}</router-link>
                </div>
              </div>
              <div class="col-lg-4 order-lg-1">
                <div class="card-profile-stats d-flex justify-content-center">
                  <div>
                    <span class="heading">{{sentTask}}</span>
                    <span class="description">{{ $t('user.sentDetails') }}</span>
                  </div>
                  <div>
                    <span class="heading">{{receivedTask}}</span>
                    <span class="description">{{ $t('user.receivedTasks') }}</span>
                  </div>
                  <div>
                    <span class="heading">{{addresses}}</span>
                    <span class="description">{{ $t('addresses') }}</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center mt-5">
              <h3>{{editedUser.name}}
                <small class="h6 text-muted"> #{{editedUser.id}}</small>
              </h3>
              <div class="h6 font-weight-300"><i class="ni location_pin mr-2"></i>{{editedUser.email}}</div>
              <div class="h6 font-weight-300"><i class="ni location_pin mr-2"></i>{{editedUser.phone}}</div>
              <router-link to="/profile/edit" class="btn btn-neutral mt-4 mb-4">
                {{ $t('editProfile') }}
              </router-link>
              <router-link to="/address" class="btn btn-primary mt-4 mb-4">
                {{ $t('addresses') }}
              </router-link>
            </div>
          </div>
        </card>
      </div>
    </section>
  </div>
</template>
<script>
 import { mapGetters, mapActions } from "vuex";

 export default {
  data() {
    return {
      previous_image:'no-image.png',
      editedUser: {
        image:'no-image.png',
      }
    }
  },

  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("dashboard", ["user","sentTask","receivedTask","addresses"]),
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit("dashboard/setUserData", {});

  },
  created() {
   this.getDashboard().then(() => {
    if (this.user.image == "") { this.user.image = 'no-image.png';}
    this.editedUser = this.user;
    this.previous_image = this.user.image;
  });
 },
 methods: {
  ...mapActions("dashboard", ["getDashboard"]),

  getProfilePhoto(){
    if (this.editedUser.image) {
      return process.env.VUE_APP_URL+"images/user/" + this.previous_image;
    }else{
      return process.env.VUE_APP_URL+"images/user/"+ this.editedUser.image;
    }
  },
}
}
</script>
