<template>
        <div class="col-md-3">
  <a href="compose.html" class="btn btn-primary btn-block mb-3">Compose</a>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">City Details</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <router-link :to="{ name: 'CityDetails', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-file-alt"></i> Details
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'CityDistrict', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-tasks"></i> Districts
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'CityCourier', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-biking"></i> Couriers
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'CityBranch', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-code-branch"></i> Branch
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'CityUser', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-users"></i> Users
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'CityTask', params: { id: $route.params.id }}"  class="nav-link">
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
