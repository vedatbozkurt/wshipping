<template>
    <div>
        <div class="position-relative">
         <section class="section-hero section-shaped my-0">
            <div class="shape shape-style-1 shape-primary">
                <span class="span-150"></span>
                <span class="span-50"></span>
                <span class="span-50"></span>
                <span class="span-75"></span>
                <span class="span-100"></span>
                <span class="span-75"></span>
                <span class="span-50"></span>
                <span class="span-100"></span>
                <span class="span-50"></span>
                <span class="span-100"></span>
            </div>
            <div class="container shape-container d-flex align-items-center">
                <div class="col px-0">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-7 text-center pt-lg">
                            <img  v-if="companyLogo" :src="getLogo()" style="width: 50px;" class="img-fluid mb-4" />
                            <span style="font-size: 50px" class="lead text-white mb-0"> {{companyName}}</span>
                            <p class="lead text-white mt-4 mb-5">{{companyDescription}}</p>
                            <div class="btn-wrapper">
                             <base-input alternative
                             placeholder="Tracking No"
                             v-model="trackNo"
                             addon-left-icon="ni ni-zoom-split-in">
                         </base-input>
                         <base-button
                         type="white"
                         icon="ni ni-send"
                         class="mb-3 mb-sm-0"
                         @click="getTrackingNoTask">
                         Search
                     </base-button>
                     <modal :show.sync="modals.modal1">
                        <h6 slot="header" class="modal-title" id="modal-title-default">Task Details</h6>

                        <div class="row py-3 align-items-left">
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">{{ $t('form.senderName') }}:</small>
                            </div>
                            <div class="col-sm-8">
                                <p>{{mytask.sendername}}</p>
                            </div>
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">{{ $t('form.senderAddress') }}:</small>
                            </div>
                            <div class="col-sm-8">
                                <p>{{mytask.senderaddress}}</p>
                            </div>
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">{{ $t('form.receiverName') }}:</small>
                            </div>
                            <div class="col-sm-8">
                                <p>{{mytask.receivername}}</p>
                            </div>
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">{{ $t('form.receiverAddress') }}:</small>
                            </div>
                            <div class="col-sm-8">
                                <p>{{mytask.receiveraddress}}</p>
                            </div>
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">{{ $t('courier.courier') }}:</small>
                            </div>
                            <div class="col-sm-8">
                                <p>{{mytask.courier}}</p>
                            </div>
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">{{ $t('form.price') }}:</small>
                            </div>
                            <div class="col-sm-8">
                                <p>{{task.price}} {{currency}}</p>
                            </div>
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">{{ $t('form.description') }}:</small>
                            </div>
                            <div class="col-sm-8">
                                <p>{{task.description}}</p>
                            </div>
                            <div class="col-sm-4">
                                <small class="text-uppercase text-muted font-weight-bold">{{ $t('form.status') }}:</small>
                            </div>
                            <div class="col-sm-8">
                                <p><span v-if="task.status==0">{{ $t('task.pendingApproval') }}</span>
                                  <span v-if="task.status==1">{{ $t('task.approvedAwaitingCourierAssignment') }}</span>
                                  <span v-if="task.status==2">{{ $t('task.courierAssignedAcceptanceExpected') }}</span>
                                  <span v-if="task.status==3">{{ $t('task.courierAccepted') }}</span>
                                  <span v-if="task.status==4">{{ $t('task.courierReceivedTask') }}</span>
                                  <span v-if="task.status==5">{{ $t('task.courierOnTheRoad') }}</span>
                                  <span v-if="task.status==6">{{ $t('task.courierArrivedAtDestination') }}</span>
                                  <span v-if="task.status==7">{{ $t('task.delivered') }}</span>
                                  <span v-if="task.status==8">{{ $t('task.couriercanceled') }}</span></p>
                              </div>
                          </div>

                          <template slot="footer">
                            <base-button type="link" class="ml-auto" @click="modals.modal1 = false">Close
                        </base-button>
                    </template>
                </modal>
            </div>
        </div>
    </div>
    <div class="row align-items-center justify-content-around stars-and-coded">
        <div class="col-sm-4">
            <span class="text-white alpha-7 ml-3">Star us on</span>
            <a href="https://github.com/creativetimofficial/argon-design-system" target="_blank" title="Support us on Github">
                <img src="img/brand/github-white-slim.png" style="height: 22px; margin-top: -3px">
            </a>
        </div>
        <div class="col-sm-4 mt-4 mt-sm-0 text-right">
            <span class="text-white alpha-7">Coded by</span>
            <a href="https://www.creative-tim.com" target="_blank" title="Creative Tim - Premium Bootstrap Themes and Templates">
                <img src="img/brand/creativetim-white-slim.png" class="ml-3" style="height: 30px;">
            </a>
        </div>
    </div>
</div>
</div>
</section>
</div>
<section class="section section-lg pt-lg-10">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row row-grid">
                    <div class="col-lg-4">
                        <card class="border-0" hover shadow body-classes="py-5">
                            <icon name="ni ni-check-bold" type="primary" rounded class="mb-4">
                            </icon>
                            <h6 class="text-primary text-uppercase">Download Argon</h6>
                            <p class="description mt-3">Argon is a great free UI package based on Bootstrap 4
                            that includes the most important components and features.</p>
                            <div>
                                <badge type="primary" rounded>design</badge>
                                <badge type="primary" rounded>system</badge>
                                <badge type="primary" rounded>creative</badge>
                            </div>
                            <base-button tag="a" href="#" type="primary" class="mt-4">
                            Learn more
                        </base-button>
                    </card>
                </div>
                <div class="col-lg-4">
                    <card class="border-0" hover shadow body-classes="py-5">
                        <icon name="ni ni-istanbul" type="success" rounded class="mb-4">
                        </icon>
                        <h6 class="text-success text-uppercase">Build Something</h6>
                        <p class="description mt-3">Argon is a great free UI package based on Bootstrap
                        4 that includes the most important components and features.</p>
                        <div>
                            <badge type="success" rounded>business</badge>
                            <badge type="success" rounded>vision</badge>
                            <badge type="success" rounded>success</badge>
                        </div>
                        <base-button tag="a" href="#" type="success" class="mt-4">
                        Learn more
                    </base-button>
                </card>
            </div>
            <div class="col-lg-4">
                <card class="border-0" hover shadow body-classes="py-5">
                    <icon name="ni ni-planet" type="warning" rounded class="mb-4">
                    </icon>
                    <h6 class="text-warning text-uppercase">Prepare Launch</h6>
                    <p class="description mt-3">Argon is a great free UI package based on Bootstrap
                    4 that includes the most important components and features.</p>
                    <div>
                        <badge type="warning" rounded>marketing</badge>
                        <badge type="warning" rounded>product</badge>
                        <badge type="warning" rounded>launch</badge>
                    </div>
                    <base-button tag="a" href="#" type="warning" class="mt-4">
                    Learn more
                </base-button>
            </card>
        </div>
    </div>
</div>
</div>
</div>
</section>
<section class="section section-lg mt--200">
    <div class="container">
        <div class="row row-grid align-items-center">
            <div class="col-md-6 order-md-2">
                <img src="img/theme/promo-1.png" class="img-fluid floating">
            </div>
            <div class="col-md-6 order-md-1">
                <div class="pr-md-5">
                    <icon name="ni ni-settings-gear-65" class="mb-5" size="lg" type="success" shadow
                    rounded></icon>
                    <h3>Awesome features</h3>
                    <p>The kit comes with three pre-built pages to help you get started faster. You can change
                    the text and images and you're good to go.</p>
                    <ul class="list-unstyled mt-5">
                        <li class="py-2">
                            <div class="d-flex align-items-center">
                                <badge type="success" circle class="mr-3" icon="ni ni-settings-gear-65"></badge>
                                <h6 class="mb-0">Carefully crafted components</h6>
                            </div>
                        </li>
                        <li class="py-2">
                            <div class="d-flex align-items-center">
                                <badge type="success" circle class="mr-3" icon="ni ni-html5"></badge>
                                <h6 class="mb-0">Amazing page examples</h6>
                            </div>
                        </li>
                        <li class="py-2">
                            <div class="d-flex align-items-center">
                                <badge type="success" circle class="mr-3" icon="ni ni-satisfied"></badge>
                                <h6 class="mb-0">Super friendly support team</h6>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section bg-secondary">
    <div class="container">
        <div class="row row-grid align-items-center">
            <div class="col-md-6">
                <div class="card bg-default shadow border-0">
                    <img v-lazy="'img/theme/img-1-1200x1000.jpg'" class="card-img-top">
                    <blockquote class="card-blockquote">
                        <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95"
                        class="svg-bg">
                        <polygon points="0,52 583,95 0,95" class="fill-default"></polygon>
                        <polygon points="0,42 583,95 683,0 0,95" opacity=".2" class="fill-default"></polygon>
                    </svg>
                    <h4 class="display-3 font-weight-bold text-white">Design System</h4>
                    <p class="lead text-italic text-white">The Arctic Ocean freezes every winter and much of
                        the sea-ice then thaws every summer, and that process will continue whatever
                    happens.</p>
                </blockquote>
            </div>
        </div>
        <div class="col-md-6">
            <div class="pl-md-5">
                <icon name="ni ni-settings" class="mb-5" size="lg" type="warning" shadow rounded></icon>

                <h3>Our customers</h3>
                <p class="lead">Don't let your uses guess by attaching tooltips and popoves to any element.
                Just make sure you enable them first via JavaScript.</p>
                <p>The kit comes with three pre-built pages to help you get started faster. You can change
                the text and images and you're good to go.</p>
                <p>The kit comes with three pre-built pages to help you get started faster. You can change
                the text and images and you're good to go.</p>
                <a href="#" class="font-weight-bold text-warning mt-5">A beautiful UI Kit for impactful
                websites</a>
            </div>
        </div>
    </div>
</div>
</section>
<section class="section section section-shaped my-0 overflow-hidden">
    <div class="shape shape-style-1 bg-gradient-warning shape-skew">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="container py-0">
        <div class="row row-grid align-items-center">
            <div class="col-md-6 order-lg-2 ml-lg-auto">
                <div class="position-relative pl-md-5">
                    <img src="img/ill/ill-2.svg" class="img-center img-fluid">
                </div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <div class="d-flex px-3">
                    <div>
                        <icon name="ni ni-building" size="lg" class="bg-gradient-white" color="primary" shadow
                        rounded></icon>
                    </div>
                    <div class="pl-4">
                        <h4 class="display-3 text-white">Modern Interface</h4>
                        <p class="text-white">The Arctic Ocean freezes every winter and much of the sea-ice then
                        thaws every summer, and that process will continue whatever happens.</p>
                    </div>
                </div>
                <card shadow class="shadow-lg--hover mt-5">
                    <div class="d-flex px-3">
                        <div>
                            <icon name="ni ni-satisfied" gradient="success" color="white" shadow
                            rounded></icon>
                        </div>
                        <div class="pl-4">
                            <h5 class="title text-success">Awesome Support</h5>
                            <p>The Arctic Ocean freezes every winter and much of the sea-ice then thaws
                            every summer, and that process will continue whatever happens.</p>
                            <a href="#" class="text-success">Learn more</a>
                        </div>
                    </div>
                </card>
                <card shadow class="shadow-lg--hover mt-5">
                    <div class="d-flex px-3">
                        <div>
                            <icon name="ni ni-active-40" gradient="warning" color="white" shadow
                            rounded></icon>
                        </div>
                        <div class="pl-4">
                            <h5 class="title text-warning">Modular Components</h5>
                            <p>The Arctic Ocean freezes every winter and much of the sea-ice then thaws
                            every summer, and that process will continue whatever happens.</p>
                            <a href="#" class="text-warning">Learn more</a>
                        </div>
                    </div>
                </card>
            </div>
        </div>
    </div>
</section>

<section class="section section-lg pt-0">
    <div class="container">
        <card gradient="warning"
        no-body
        shadow-size="lg"
        class="border-0">
        <div class="p-5">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3 class="text-white">We made website building easier for you.</h3>
                    <p class="lead text-white mt-3">I will be the leader of a company that ends up being
                    worth billions of dollars, because I got the answers. I understand culture.</p>
                </div>
                <div class="col-lg-3 ml-lg-auto">
                    <base-button tag="a" href="https://www.creative-tim.com/product/vue-argon-design-system"
                    type="white" block size="lg">
                    Download Vue
                </base-button>
            </div>
        </div>
    </div>
</card>
</div>
</section>
</div>
</template>

<script>
    import Modal from "@/components/Modal.vue";
    import { mapGetters, mapActions } from "vuex";
    export default {
      components: {
        Modal
    },
    data() {
        return {
            trackNo:null,
            modals: {
                modal1: false,
            },
            mytask:{
              sendername:'',
              senderaddress:'',
              receivername:'',
              receiveraddress:'',
              courier:'',
          }
      };
  },
  computed: {
      ...mapGetters(["errors","currency","info","companyName","companyLogo","companyDescription"]),
      ...mapGetters("task", ["task"]),
  },
  mounted() {
      this.$store.commit("setErrors", {});
      this.$store.commit('task/setTask', {});
  },
  created() {
  },
  methods: {
    ...mapActions("task", ["getTrackingTask"]),
      getLogo(){
          return process.env.VUE_APP_URL+"images/" + this.companyLogo;
      },
      getTrackingNoTask() {
        this.mytask = {};
        this.getTrackingTask(this.trackNo).then(() => {
            this.modals.modal1 = true
            this.mytask.sendername = this.task.sender.name;
            this.mytask.receivername =this.task.receiver.name;
            this.mytask.senderaddress =this.task.senderaddress.city.name+' / '+this.task.senderaddress.district.name;
            this.mytask.receiveraddress =this.task.receiveraddress.city.name+' / '+this.task.receiveraddress.district.name;
            this.task.courier ? this.mytask.courier = this.task.courier.name : this.mytask.courier = 'No Courier';
        });
    },
}
};
</script>
