
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-07 00:02:29
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
  cidtIDData:null, //city:info dosyalarında kullanıldı
};

const getters = {
//adress:create(dropdown),edit(dropdown),Branch:info:Details(dropdown)
//Branch:create(dropdown),edit(dropdown)
//courier:info:Details(dropdown),courier:create(dropdown),courier:edit(dropdown)
//district:Info:Details(droppdown),district:create(dropdown),district:edit(dropdown)
cities: state => state.citiesData,
 citiesPage: state => state.citiesPageData, //city:index(paginate)
 city: state => state.cityData, //city:Info:Details-city:create,edit
 cityDistricts: state => state.cityDistrictsData, //city:Info:District
 cityCouriers: state => state.cityCouriersData, //city:Info:Courier
 cityBranches: state => state.cityBranchesData, //city:Info:Branch
 cityUsers: state => state.cityUsersData, //city:Info:User
 cityTasks: state => state.cityTasksData, //city:Info:Task
};

const actions =  {
async getCities({ commit }) { // all cities
  await axios.get(process.env.VUE_APP_API_URL + "city/allcities")
  .then(response => {
    commit("setCities", response.data);
  })
},
async getCitiesPage({ commit }, page = 1) { // all cities with pagination
  commit("setLoader", true, { root: true });
  if (this.state.searchData == null ) {
    await axios.get(process.env.VUE_APP_API_URL + "city?page=" + page)
    .then(response => {
      commit("setCitiesPage", response.data);
      commit("setLoader", false, { root: true });
    })
  }else {
    await axios.post(process.env.VUE_APP_API_URL + "city/"+ this.state.searchData +"/?page=" + page)
    .then(response => {
      commit("setCitiesPage", response.data);
      commit("setLoader", false, { root: true });
    })
  }
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

async getCityDistricts({ commit }, page = 1) {
  commit("setLoader", true, { root: true });
  await axios.get(process.env.VUE_APP_API_URL + "city/" + state.CityIDData + "/districts?page=" + page)
  .then(response => {
    commit("setCityDistricts", response.data);
    commit("setLoader", false, { root: true });

  })
},
async getCityCouriers({ commit }, page = 1) {
  commit("setLoader", true, { root: true });
  await axios.get(process.env.VUE_APP_API_URL + "city/" + state.CityIDData + "/couriers?page=" + page)
  .then(response => {
    commit("setCityCouriers", response.data);
    commit("setLoader", false, { root: true });

  })
},
async getCityBranches({ commit }, page = 1) {
  commit("setLoader", true, { root: true });
  await axios.get(process.env.VUE_APP_API_URL + "city/" + state.CityIDData + "/branches?page=" + page)
  .then(response => {
    commit("setCityBranches", response.data);
    commit("setLoader", false, { root: true });

  })
},
async getCityUsers({ commit }, page = 1) {
  commit("setLoader", true, { root: true });
  await axios.get(process.env.VUE_APP_API_URL + "city/" + state.CityIDData + "/users?page=" + page)
  .then(response => {
    commit("setCityUsers", response.data);
    commit("setLoader", false, { root: true });

  })
},
async getCityTasks({ commit }, page = 1) {
  commit("setLoader", true, { root: true });
  // await axios.get(process.env.VUE_APP_API_URL + "city/" + id + "/tasks?page="+page)
  await axios.get(process.env.VUE_APP_API_URL + "city/" + state.CityIDData + "/tasks?page=" + page)
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
  setCityID(state, data) { state.CityIDData = data },
  setSearch(state, data) { state.search = data; }
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
