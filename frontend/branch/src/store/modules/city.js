
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-15 02:19:01
*/
import axios from "axios";
const namespaced= true;
const state = {
  citiesData: [], //dropdown için array olmalı - all cities
  citiesPageData: {}, //pagi
  cityData: [],
  cityIDData:null, //city:info dosyalarında kullanıldı
  cityCouriersData: {},
  cityUsersData: {},
  cityTasksData: {},
};

const getters = {
  cities: state => state.citiesData,
  citiesPage: state => state.citiesPageData,
 city: state => state.cityData, //city:Info:Details-city:create,edit
 cityCouriers: state => state.cityCouriersData, //city:Info:Courier
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
async getCitiesPage({ commit },page=1) {
  await axios.get(process.env.VUE_APP_API_URL + "city/cities?page="+page)
  .then(response => {
    commit("setCitiesPage", response.data);
  })
},
async getCity({ commit }, id) {
  commit("setLoader", true, { root: true });
  await axios.get(process.env.VUE_APP_API_URL + "city/" + id)
  .then(response => {
    commit("setCity", response.data);
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
  setCitiesPage(state, data) { state.citiesPageData = data },
  setCity(state, data) { state.cityData = data },
  setCityCouriers(state, data) { state.cityCouriersData = data },
  setCityUsers(state, data) { state.cityUsersData = data },
  setCityTasks(state, data) { state.cityTasksData = data },
  setCityID(state, data) { state.CityIDData = data },
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
