<template>
        <div class="col-md-2">
          <div class="card card-warning card-outline">
            <div class="card-header">
              <h3 class="card-title">User Details</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <router-link :to="{ name: 'UserDetails', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-file-alt"></i> Details
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'UserAddress', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-address-book"></i> Addresses
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'UserSenderTask', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-tasks"></i> Sent Tasks
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'UserReceiverTask', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-tasks"></i> Received Tasks
                  </router-link>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
</template>
<style scoped>
  .router-link-exact-active { background-color:#FFC107; }
</style>
