/*
* @Author: @vedatbozkurt
* @Date:   2020-06-28 13:34:40
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-08 03:35:12
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
  courierIDData: null, //courier:info dosyalarında kullanıldı

};

const getters = {
 couriers: state => state.couriersData, //courier:index
 //courier:info:CityBranch-courier:info:Details-courier:info:DistrictBranch
 //courier:create,courier:edit
 courier: state => state.courierData,
 courierCity: state => state.courierCityData, //courier:info:CityBranch
 courierDistrict: state => state.courierDistrictData, //courier:info:DistrictBranch
 courierCityBranches: state => state.courierCityBranchesData, //courier:info:CityBranch
 courierDistrictBranches: state => state.courierDistrictBranchesData, //courier:info:DistrictBranch
 courierTasks: state => state.courierTasksData, //courier:info:Task
}

const actions =  {
  async getCouriers({ commit }, page = 1) {
    commit("setLoader", true, { root: true });
    if (this.state.searchData == null ) {
      await axios.get(process.env.VUE_APP_API_URL + "courier?page=" + page)
      .then(response => {
        commit("setCouriers", response.data);
        commit("setLoader", false, { root: true });
      })
    }else {
      await axios.post(process.env.VUE_APP_API_URL + "courier/"+ this.state.searchData +"/?page=" + page)
      .then(response => {
        commit("setCouriers", response.data);
        commit("setLoader", false, { root: true });
      })
    }
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
    let id = data.get('id');
    await axios.post(process.env.VUE_APP_API_URL + `courier/${id}`, data)
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
  async restoreCourier({ commit }, id) {
    await axios.post(process.env.VUE_APP_API_URL + "courier/" + id + "/restore")
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
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
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "courier/citybranches/" + id)
    .then(response => {
      commit("setCourierCityBranches", response.data);
      commit("setLoader", false, { root: true });
    })
  },
  async getCourierDistrictBranches({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "courier/districtbranches/" + id)
    .then(response => {
      commit("setCourierDistrictBranches", response.data);
      commit("setLoader", false, { root: true });
    })
  },
  async getCourierTask({ commit }, page = 1) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "courier/" + state.courierIDData + "/tasks?page="+page)
    .then(response => {
      commit("setCourierTask", response.data);
      commit("setLoader", false, { root: true });
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
  setCourierID(state, data) { state.courierIDData = data },
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
