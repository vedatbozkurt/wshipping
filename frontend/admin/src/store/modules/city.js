
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-03 14:58:19
*/
import axios from "axios";
const namespaced= true;
const state = {
  citiesData: [], //dropdown için array olmalı - all cities
  citiesPageData: {}, //pagination için object olmalı - all cities
  cityData: [],
  cityDistrictsData: {},
  cityCouriersData: {},
  cityBranchesData: {},
  cityUsersData: {},
  cityTasksData: {},
};

const getters = {
 cities: state => state.citiesData,
 citiesPage: state => state.citiesPageData,
 city: state => state.cityData,
 cityDistricts: state => state.cityDistrictsData,
 cityCouriers: state => state.cityCouriersData,
 cityBranches: state => state.cityBranchesData,
 cityUsers: state => state.cityUsersData,
 cityTasks: state => state.cityTasksData,
};

const actions =  {
async getCities({ commit }) { // all cities
  await axios.get(process.env.VUE_APP_API_URL + "city/allcities")
  .then(response => {
    commit("setCities", response.data);
  })
},
async getCitiesPage({ commit }, page = 1) { // all cities with pagination
  await axios.get(process.env.VUE_APP_API_URL + "city?page=" + page)
  .then(response => {
    commit("setCitiesPage", response.data);
  })
},
async createCity({ commit }, data) {
  await axios.post(process.env.VUE_APP_API_URL + "city/store", data)
  .then(response => {
    if (response.data === 'success') {
      commit("setErrors", {}, { root: true });
    }
  });
},
async getCity({ commit }, id) {
  commit("setLoader", true, { root: true });
  await axios.get(process.env.VUE_APP_API_URL + "city/" + id)
  .then(response => {
    commit("setCity", response.data);
    commit("setLoader", false, { root: true });

  })
},
async updateCity({ commit }, data) {
  await axios.put(process.env.VUE_APP_API_URL + `city/${data.id}`, data)
  .then(response => {
    if (response.data === 'success') {
      commit("setErrors", {}, { root: true });
    }
  });
},
async deleteCity({ commit }, id) {
  commit("removeCity", id);
  await axios.delete(process.env.VUE_APP_API_URL + "city/" + id)
  .then(response => {
    if (response.data === 'success') {
      commit("setErrors", {}, { root: true });
    }
  });
},
async deleteCityFromEdit({ commit }, id) {
  await axios.delete(process.env.VUE_APP_API_URL + "city/" + id)
  .then(response => {
    if (response.data === 'success') {
      commit("setErrors", {}, { root: true });
    }
  });
},

async getCityDistricts({ commit }, id) {
  commit("setLoader", true, { root: true });
  await axios.get(process.env.VUE_APP_API_URL + "city/" + id + "/districts")
  .then(response => {
    commit("setCityDistricts", response.data);
    commit("setLoader", false, { root: true });

  })
},
async getCityCouriers({ commit }, id) {
  commit("setLoader", true, { root: true });
  await axios.get(process.env.VUE_APP_API_URL + "city/" + id + "/couriers")
  .then(response => {
    commit("setCityCouriers", response.data);
    commit("setLoader", false, { root: true });

  })
},
async getCityBranches({ commit }, id) {
  commit("setLoader", true, { root: true });
  await axios.get(process.env.VUE_APP_API_URL + "city/" + id + "/branches")
  .then(response => {
    commit("setCityBranches", response.data);
    commit("setLoader", false, { root: true });

  })
},
async getCityUsers({ commit }, id) {
  commit("setLoader", true, { root: true });
  await axios.get(process.env.VUE_APP_API_URL + "city/" + id + "/users")
  .then(response => {
    commit("setCityUsers", response.data);
    commit("setLoader", false, { root: true });

  })
},
async getCityTasks({ commit }, id) {
  commit("setLoader", true, { root: true });
  // await axios.get(process.env.VUE_APP_API_URL + "city/" + id + "/tasks?page="+page)
  await axios.get(process.env.VUE_APP_API_URL + "city/" + id + "/tasks")
  .then(response => {
    commit("setCityTasks", response.data);
    commit("setLoader", false, { root: true });
  })
},
}

const mutations =  {
  setCities(state, data) { state.citiesData = data },
  setCitiesPage(state, data) { state.citiesPageData = data }, //pagination cities
  setCity(state, data) { state.cityData = data },
  removeCity: (state, id) => (state.citiesPageData.data = state.citiesPageData.data.filter(todo => todo.id !== id)),
  setCityDistricts(state, data) { state.cityDistrictsData = data },
  setCityCouriers(state, data) { state.cityCouriersData = data },
  setCityBranches(state, data) { state.cityBranchesData = data },
  setCityUsers(state, data) { state.cityUsersData = data },
  setCityTasks(state, data) { state.cityTasksData = data },
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
