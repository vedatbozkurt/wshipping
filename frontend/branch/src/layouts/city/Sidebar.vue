<template>
        <div class="col-md-2">
          <div class="card card-warning card-outline">
            <div class="card-header">
              <h3 class="card-title">{{ $t('city.cityDetails') }}</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <router-link :to="{ name: 'CityDetails', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-file-alt"></i> {{ $t('details') }}
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'CityCourier', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-biking"></i> {{ $t('courier.couriers') }}
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'CityUser', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-users"></i> {{ $t('users') }}
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{ name: 'CityTask', params: { id: $route.params.id }}"  class="nav-link">
                    <i class="fas fa-tasks"></i> {{ $t('task.tasks') }}
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
