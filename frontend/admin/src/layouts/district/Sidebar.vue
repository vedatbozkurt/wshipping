<template>
        <div class="col-md-2">
          <div class="card card-warning card-outline">
            <div class="card-header">
              <h3 class="card-title">District Details</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <router-link :to="{ name: 'DistrictDetails', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-file-alt"></i> Details
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'DistrictCourier', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-biking"></i> Couriers
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'DistrictBranch', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-code-branch"></i> Branch
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'DistrictUser', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-users"></i> Users
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'DistrictTask', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-tasks"></i> Tasks
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
