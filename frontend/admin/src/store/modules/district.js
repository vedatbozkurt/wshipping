
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-03 16:16:57
*/
import axios from "axios";
const namespaced= true;
const state = {
  citiesDistrictsData: [],
  cityDistrictsData: [],
  districtsData: {}, //pagination için object olmalı
  districtData: {},
  districtCouriersData: {},
  districtBranchesData: {},
  districtUsersData: {},
  districtTasksData: {},
};

const getters = {
 citiesDistricts: state => state.citiesDistrictsData,
 cityDistricts: state => state.cityDistrictsData,
 districts: state => state.districtsData,  //pagination için
 district: state => state.districtData,
 districtCouriers: state => state.districtCouriersData,
 districtBranches: state => state.districtBranchesData,
 districtUsers: state => state.districtUsersData,
 districtTasks: state => state.districtTasksData,
};

const actions =  {
  async getCitiesDistricts({ commit }, data) {
    await axios.post(process.env.VUE_APP_API_URL + "district/citiesalldistricts/", data )
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
    await axios.get(process.env.VUE_APP_API_URL + "district?page=" + page)
    .then(response => {
      commit("setDistricts", response.data);
    })
  },
  async createDistrict({ commit }, data) {
    await axios.post(process.env.VUE_APP_API_URL + "district/store", data)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async getDistrict({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "district/" + id)
    .then(response => {
      commit("setDistrict", response.data);
      commit("setLoader", false, { root: true });

    })
  },
  async updateDistrict({ commit }, data) {
    await axios.put(process.env.VUE_APP_API_URL + `district/${data.id}`, data)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async deleteDistrict({ commit }, id) {
    commit("removeDistrict", id);
    await axios.delete(process.env.VUE_APP_API_URL + "district/" + id)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async deleteDistrictFromEdit({ commit }, id) {
    await axios.delete(process.env.VUE_APP_API_URL + "district/" + id)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async getDistrictCouriers({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "district/" + id + "/couriers")
    .then(response => {
      commit("setDistrictCouriers", response.data);
      commit("setLoader", false, { root: true });
    })
  },
  async getDistrictBranches({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "district/" + id + "/branches")
    .then(response => {
      commit("setDistrictBranches", response.data);
      commit("setLoader", false, { root: true });
    })
  },
  async getDistrictUsers({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "district/" + id + "/users")
    .then(response => {
      commit("setDistrictUsers", response.data);
      commit("setLoader", false, { root: true });
    })
  },
  async getDistrictTasks({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "district/" + id + "/tasks")
    .then(response => {
      commit("setDistrictTasks", response.data);
      commit("setLoader", false, { root: true });
    })
  },
}

const mutations =  {
  setCitiesDistricts(state, data) { state.citiesDistrictsData = data },
  setCityDistricts(state, data) { state.cityDistrictsData = data },
  setDistricts(state, data) { state.districtsData = data }, //pagination cities
  setDistrict(state, data) { state.districtData = data },
  removeDistrict: (state, id) => (state.districtsData.data = state.districtsData.data.filter(todo => todo.id !== id)),
  setDistrictCouriers(state, data) { state.districtCouriersData = data },
  setDistrictBranches(state, data) { state.districtBranchesData = data },
  setDistrictUsers(state, data) { state.districtUsersData = data },
  setDistrictTasks(state, data) { state.districtTasksData = data },
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
