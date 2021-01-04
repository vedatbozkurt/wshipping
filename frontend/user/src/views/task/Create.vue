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
          <div class="col-lg-12 mt--150">
            <card gradient="secondary" shadow body-classes="p-lg-5">
              <h3 class="h4 text-success font-weight-bold mb-4">{{ $t('task.createTask') }}</h3>
              <div class="row py-1 align-items-center">
                <div class="col-sm-2">
                  <small class="text-uppercase text-muted font-weight-bold">{{$t('form.senderAddress')}}</small>
                </div>
                <div class="col-sm-10">
                 <span class="text-danger" v-if="errors.senderaddress"> {{ errors.senderaddress[0] }}</span>
                 <select class="form-control" v-model="task.senderaddress">
                  <option v-for="userSenderAddress in userSenderAddresses" v-bind:value="userSenderAddress.id">{{ userSenderAddress.name }}</option>
                </select>
              </div>
            </div>
            <div class="row py-1 align-items-center">
              <div class="col-sm-2">
                <small class="text-uppercase text-muted font-weight-bold">{{$t('form.receiverName')}}</small>
              </div>
              <div class="col-sm-10">
                <span class="text-danger" v-if="errors.receivername"> {{ errors.receivername[0] }}</span>
                <base-input alternative
                class="mb-3"
                :placeholder="$t('form.receiverName')"
                v-model="task.receivername">
              </base-input>
            </div>
          </div>

          <div class="row align-items-center">
            <div class="col-sm-2">
              <small class="text-uppercase text-muted font-weight-bold">{{$t('form.receiverPhone')}}</small>
            </div>
            <div class="col-sm-10">
              <span class="text-danger" v-if="errors.receiverphone"> {{ errors.receiverphone[0] }}</span>
              <base-input alternative
              class="mb-3"
              :placeholder="$t('form.receiverPhone')"
              v-model="task.receiverphone">
            </base-input>
          </div>
        </div>


        <div class="row align-items-center">
          <div class="col-sm-2">
            <small class="text-uppercase text-muted font-weight-bold">{{$t('form.receiverEmail')}}</small>
          </div>
          <div class="col-sm-10">
           <span class="text-danger" v-if="errors.receiverEmail"> {{ errors.receiverEmail[0] }}</span>
           <base-input alternative
           class="mb-3"
           :placeholder="$t('form.receiverEmail')"
           v-model="task.receiveremail">
         </base-input>
       </div>
     </div>


     <div class="row align-items-center">
      <div class="col-sm-2">
        <small class="text-uppercase text-muted font-weight-bold">{{$t('form.receiverAddress')}}</small>
      </div>
      <div class="col-sm-10">
        <span class="text-danger" v-if="errors.receiveraddress"> {{ errors.receiveraddress[0] }}</span>
        <select class="form-control" style="margin: 15px 0px 15px 0px;" v-model="task.receiveraddress">
          <option v-for="userReceiverAddress in userSenderAddresses" v-bind:value="userReceiverAddress.id">{{ userReceiverAddress.name }}</option>
        </select>
      </div>
    </div>

    <div class="row align-items-center">
      <div class="col-sm-2">
        <small class="text-uppercase text-muted font-weight-bold">{{$t('form.description')}}</small>
      </div>
      <div class="col-sm-10">
       <span class="text-danger" v-if="errors.description"> {{ errors.description[0] }}</span>
       <base-input alternative
       class="mb-3"
       :placeholder="$t('form.description')"
       v-model="task.description">
     </base-input>
   </div>
 </div>



 <div class="text-center">
  <base-button type="primary" @click="addTask()" class="my-4">{{ $t('save') }}</base-button>
  <router-link to="/task" class="btn btn-neutral">
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
      allAddresses: []
    }
  },

  computed: {
    ...mapGetters(["errors"]),
    ...mapGetters("task", ["task"]),
    ...mapGetters("address", ["userSenderAddresses"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
    this.$store.commit('address/setUserSenderAddress', []);
    this.$store.commit('task/setTask', {});
  },
  created() {
    this.getUserSenderAddress();
  },
  methods: {
    ...mapActions("task", ["createTask"]),
    ...mapActions("address", ["getUserSenderAddress"]),

    addTask: function() {
      this.task.sender = 0;
      this.task.receiver = 0;
      this.task.price = 0;
      this.createTask(this.task).then(() => {
        this.myToast('success',this.$t('task.createdTask'));
        this.$router.push({ name: "SentTask" });
      });
    },
  }
}
</script>
