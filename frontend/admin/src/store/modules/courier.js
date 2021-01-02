/*
* @Author: @vedatbozkurt
* @Date:   2020-06-28 13:34:40
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-01 02:42:30
*/
import axios from "axios";
const namespaced= true;
const state = {
  couriersData: {},
  courierData: {},
  courierCityData: [],
  courierDistrictData: [],
  courierCityBranchesData: {},
  courierDistrictBranchesData: {},
  courierTasksData: {},
};

const getters = {
 couriers: state => state.couriersData,
 courier: state => state.courierData,
 courierCity: state => state.courierCityData,
 courierDistrict: state => state.courierDistrictData,
 courierCityBranches: state => state.courierCityBranchesData,
 courierDistrictBranches: state => state.courierDistrictBranchesData,
 courierTasks: state => state.courierTasksData,
}

const actions =  {
  async getCouriers({ commit }, page = 1) {
    await axios.get(process.env.VUE_APP_API_URL + "courier?page=" + page)
    .then(response => {
      commit("setCouriers", response.data);
    })
  },
  async createCourier({ commit }, data) {
    await axios.post(process.env.VUE_APP_API_URL + "courier/store", data)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async getCourier({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "courier/" + id)
    .then(response => {
      commit("setCourier", response.data);
      commit("setLoader", false, { root: true });

    })
  },
  async updateCourier({ commit }, data) {
    await axios.put(process.env.VUE_APP_API_URL + `courier/${data.id}`, data)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async deleteCourier({ commit }, id) {
    commit("removeCourier", id);
    await axios.delete(process.env.VUE_APP_API_URL + "courier/" + id)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async deleteCourierFromEdit({ commit }, id) {
    await axios.delete(process.env.VUE_APP_API_URL + "courier/" + id)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async getCourierTask({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "courier/" + id + "/tasks")
    .then(response => {
      commit("setCourierTask", response.data);
      commit("setLoader", false, { root: true });
    })
  },
  async getCourierCity({ commit }, id) {
    await axios.get(process.env.VUE_APP_API_URL + "courier/cities/" + id)
    .then(response => {
      commit("setCourierCity", response.data);
    })
  },
  async getCourierDistrict({ commit }, id) {
    await axios.get(process.env.VUE_APP_API_URL + "courier/districts/" + id)
    .then(response => {
      commit("setCourierDistrict", response.data);
    })
  },
  async getCourierCityBranches({ commit }, id) {
    await axios.get(process.env.VUE_APP_API_URL + "courier/citybranches/" + id)
    .then(response => {
      commit("setCourierCityBranches", response.data);
    })
  },
  async getCourierDistrictBranches({ commit }, id) {
    await axios.get(process.env.VUE_APP_API_URL + "courier/districtbranches/" + id)
    .then(response => {
      commit("setCourierDistrictBranches", response.data);
    })
  },
}

const mutations =  {
  setCouriers(state, data) { state.couriersData = data },
  setCourier(state, data) { state.courierData = data },
  removeCourier: (state, id) => (state.couriersData.data = state.couriersData.data.filter(todo => todo.id !== id)),
  setCourierTask(state, data) { state.courierTasksData = data },
  setCourierCity(state, data) { state.courierCityData = data },
  setCourierDistrict(state, data) { state.courierDistrictData = data },
  setCourierCityBranches(state, data) { state.courierCityBranchesData = data },
  setCourierDistrictBranches(state, data) { state.courierDistrictBranchesData = data },
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
