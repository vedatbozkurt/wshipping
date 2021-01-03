<template>
        <div class="col-md-2">
          <div class="card card-warning card-outline">
            <div class="card-header">
              <h3 class="card-title">Branch Details</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <router-link :to="{ name: 'BranchDetails', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-file-alt"></i> Details
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'BranchCourier', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-biking"></i> Couriers
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'BranchCityCourier', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-biking"></i> City Couriers
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'BranchDistrictCourier', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-biking"></i> District Couriers
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'BranchUser', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-users"></i> Users
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'BranchCityUser', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-users"></i> City Users
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'BranchDistrictUser', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-users"></i> District Users
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'BranchTask', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-tasks"></i> Tasks
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'BranchCityTask', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-tasks"></i> City Tasks
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'BranchDistrictTask', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-tasks"></i> District Tasks
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
<!-- nav-link router-link-exact-active router-link-active -->
