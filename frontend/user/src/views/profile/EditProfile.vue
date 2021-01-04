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
  <section class="section section-lg pt-lg-0 section-contact-us">
    <div class="container">
      <div class="row justify-content-center mt--300">
        <div class="col-lg-8 mt--150">
          <card gradient="secondary" shadow body-classes="p-lg-5">
           <h3 class="h4 text-success font-weight-bold mb-4">{{ $t('editProfile') }}</h3>
           <span class="text-danger" v-if="errors.image"> {{ errors.image[0] }}</span>
           <img width="150" :src="getProfilePhoto()" alt="User Image">
           <base-input alternative
           type="file"
           class="mb-3"
           :placeholder="$t('form.photo')"
           v-on:change="onImageChange"
           addon-left-icon="ni ni-image">
         </base-input>

         <span class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</span>
         <base-input alternative
         class="mb-3"
         :placeholder="$t('form.name')"
         v-model="editedUser.name"
         addon-left-icon="ni ni-circle-08">
       </base-input>

       <span class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }}</span>
       <base-input alternative
       class="mb-3"
       :placeholder="$t('form.phone')"
       v-model="editedUser.phone"
       addon-left-icon="ni ni-mobile-button">
     </base-input>

     <span class="text-danger" v-if="errors.email"> {{ errors.email[0] }}</span>
     <base-input alternative
     :placeholder="$t('form.email')"
     v-model="editedUser.email"
     addon-left-icon="ni ni-email-83">
   </base-input>

   <span class="text-danger" v-if="errors.password"> {{ errors.password[0] }}</span>
   <base-input alternative
   type="password"
   :placeholder="$t('form.password')"
   v-model="editedUser.password"
   addon-left-icon="ni ni-lock-circle-open">
 </base-input>
 <div class="text-center">
  <base-button type="primary" @click="updateProfile" class="my-4">{{ $t('save') }}</base-button>
  <router-link to="/profile" class="btn btn-neutral">
    {{ $t('cancel') }}
  </router-link>
</div>
</card>
</div>
</div>
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
    ...mapGetters("profile", ["user"]),
  },
  mounted() {
    this.$store.commit("setErrors", {});

  },
  created() {
   this.getUserData().then(() => {
    if (this.user.image == "") { this.user.image = 'no-image.png';}
    this.previous_image = this.user.image;
    this.editedUser = this.user;
    this.editedUser.password = '';
  });
 },
 methods: {
  ...mapActions("profile", ["uploadUserData","getUserData"]),

  getProfilePhoto(){
    if (this.editedUser.image) {
      return process.env.VUE_APP_URL+"images/user/" + this.previous_image;
    }else{
      return process.env.VUE_APP_URL+"images/user/"+ this.editedUser.image;
    }
  },
  onImageChange(e) {
    this.editedUser.image = e.target.files[0];
  },
  updateProfile: function() {
    let formData2 = new FormData();
    formData2.append('id', this.editedUser.id);
    formData2.append('previous_image', this.previous_image);
    formData2.append('image', this.editedUser.image);
    formData2.append('name', this.editedUser.name);
    formData2.append('phone', this.editedUser.phone);
    formData2.append('email', this.editedUser.email);
    if(this.editedUser.password !== ''){ formData2.append('password', this.editedUser.password); }
    formData2.append("_method", "put");
    this.uploadUserData(formData2).then(() => {
      this.myToast('success',this.$t('user.updatedUser'));
      this.$router.push({ name: "profile" });
    });
  }
}
}
</script>
