
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-15 04:07:49
*/
import axios from "axios";
const namespaced= true;
const state = {
  citiesDistrictsData: [],
  cityDistrictsData: [],
  districtsData: {},
  districtData: {},
  districtCouriersData: {},
  districtUsersData: {},
  districtTasksData: {},
  districtIDData: null, //district:info dosyalarında kullanıldı
};

const getters = {
  citiesDistricts: state => state.citiesDistrictsData,
  cityDistricts: state => state.cityDistrictsData,
 districts: state => state.districtsData,  //district:index
  district: state => state.districtData, //district:Info:Details,district:create,district:edit
 districtCouriers: state => state.districtCouriersData, //district:Info:Courier
 districtUsers: state => state.districtUsersData, //district:Info:User
 districtTasks: state => state.districtTasksData, //district:Info:Task
};

const actions =  {
  async getCitiesDistricts({ commit }, data) {
    await axios.get(process.env.VUE_APP_API_URL + "district/citiesalldistricts/"+data  )
    .then(response => {
      commit("setCitiesDistricts", response.data);
    })
  },
  async getCityDistricts({ commit }, city_id) {
    await axios.get(process.env.VUE_APP_API_URL + "district/cityalldistricts/"+city_id )
    .then(response => {
      commit("setCityDistricts", response.data);
    })
  },
  async getDistricts({ commit }, page = 1) { // all districts with pagination
    commit("setLoader", true, { root: true });
      await axios.get(process.env.VUE_APP_API_URL + "district?page=" + page)
      .then(response => {
        commit("setDistricts", response.data);
        commit("setLoader", false, { root: true });
      })
  },
  async getDistrict({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "district/" + id)
    .then(response => {
      commit("setDistrict", response.data);
      commit("setLoader", false, { root: true });

    })
  },
  async getDistrictCouriers({ commit }, page = 1) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "district/" + state.districtIDData + "/couriers?page=" + page)
    .then(response => {
      commit("setDistrictCouriers", response.data);
      commit("setLoader", false, { root: true });
    })
  },
  async getDistrictUsers({ commit }, page = 1) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "district/" + state.districtIDData + "/users?page=" + page)
    .then(response => {
      commit("setDistrictUsers", response.data);
      commit("setLoader", false, { root: true });
    })
  },
  async getDistrictTasks({ commit }, page = 1) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "district/" + state.districtIDData + "/tasks?page=" + page)
    .then(response => {
      commit("setDistrictTasks", response.data);
      commit("setLoader", false, { root: true });
    })
  },
}

const mutations =  {
  setCitiesDistricts(state, data) { state.citiesDistrictsData = data },
  setCityDistricts(state, data) { state.cityDistrictsData = data },
  setDistricts(state, data) { state.districtsData = data }, //pagination districts
  setDistrict(state, data) { state.districtData = data },
  setDistrictCouriers(state, data) { state.districtCouriersData = data },
  setDistrictUsers(state, data) { state.districtUsersData = data },
  setDistrictTasks(state, data) { state.districtTasksData = data },
  setDistrictID(state, data) { state.districtIDData = data },
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
