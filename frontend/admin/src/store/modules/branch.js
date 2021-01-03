/*
* @Author: @vedatbozkurt
* @Date:   2020-06-28 13:34:40
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-02 02:07:25
*/
import axios from "axios";
const namespaced= true;
const state = {
  branchesData: {},
  branchData: {},
  branchCourierData: [],
  branchUserData: {},
  branchTaskData: {},
  branchCityData: [],
  branchDistrictData: [],
  branchCityCouriersData: {},
  branchDistrictCouriersData: {},
  branchCityUsersData: {},
  branchDistrictUsersData: {},
  branchCityTasksData: {},
  branchDistrictTasksData: {},
  allBranchesData: [],
};

const getters = {
 branches: state => state.branchesData,
 branch: state => state.branchData,
 branchCourier: state => state.branchCourierData,
 branchUser: state => state.branchUserData,
 branchTask: state => state.branchTaskData,
 branchCity: state => state.branchCityData,
 branchDistrict: state => state.branchDistrictData,
 branchCityCouriers: state => state.branchCityCouriersData,
 branchDistrictCouriers: state => state.branchDistrictCouriersData,
 branchCityUsers: state => state.branchCityUsersData,
 branchDistrictUsers: state => state.branchDistrictUsersData,
 branchCityTasks: state => state.branchCityTasksData,
 branchDistrictTasks: state => state.branchDistrictTasksData,
 allBranches: state => state.allBranchesData,
}

const actions =  {
  async getBranches({ commit }, page = 1) {
    await axios.get(process.env.VUE_APP_API_URL + "branch?page=" + page)
    .then(response => {
      commit("setBranches", response.data);
    })
  },
  async getAllBranches({ commit }) {
    await axios.get(process.env.VUE_APP_API_URL + "branch/all")
    .then(response => {
      commit("setAllBranches", response.data);
    })
  },
  async createBranch({ commit }, data) {
    await axios.post(process.env.VUE_APP_API_URL + "branch/store", data)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async getBranch({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "branch/" + id)
    .then(response => {
      commit("setBranch", response.data);
      commit("setLoader", false, { root: true });

    })
  },
  async updateBranch({ commit }, data) {
    await axios.put(process.env.VUE_APP_API_URL + `branch/${data.id}`, data)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async deleteBranch({ commit }, id) {
    commit("removeBranch", id);
    await axios.delete(process.env.VUE_APP_API_URL + "branch/" + id)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async deleteBranchFromEdit({ commit }, id) {
    await axios.delete(process.env.VUE_APP_API_URL + "branch/" + id)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async getBranchCourier({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "branch/" + id + "/couriers")
    .then(response => {
      commit("setBranchCourier", response.data);
      commit("setLoader", false, { root: true });
    })
  },
  async getBranchUser({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "branch/" + id + "/users")
    .then(response => {
      commit("setBranchUser", response.data);
      commit("setLoader", false, { root: true });
    })
  },
  async getBranchTask({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "branch/" + id + "/tasks")
    .then(response => {
      commit("setBranchTask", response.data);
      commit("setLoader", false, { root: true });
    })
  },
  async getBranchCity({ commit }, id) {
    await axios.get(process.env.VUE_APP_API_URL + "branch/cities/" + id)
    .then(response => {
      commit("setBranchCity", response.data);
    })
  },
  async getBranchDistrict({ commit }, id) {
    await axios.get(process.env.VUE_APP_API_URL + "branch/districts/" + id)
    .then(response => {
      commit("setBranchDistrict", response.data);
    })
  },
  async getBranchCityCouriers({ commit }, id) {
    await axios.get(process.env.VUE_APP_API_URL + "branch/citycouriers/" + id)
    .then(response => {
      commit("setBranchCityCouriers", response.data);
    })
  },
  async getBranchDistrictCouriers({ commit }, id) {
    await axios.get(process.env.VUE_APP_API_URL + "branch/districtcouriers/" + id)
    .then(response => {
      commit("setBranchDistrictCouriers", response.data);
    })
  },
  async getBranchCityUsers({ commit }, id) {
    await axios.get(process.env.VUE_APP_API_URL + "branch/cityusers/" + id)
    .then(response => {
      commit("setBranchCityUsers", response.data);
    })
  },
  async getBranchDistrictUsers({ commit }, id) {
    await axios.get(process.env.VUE_APP_API_URL + "branch/districtusers/" + id)
    .then(response => {
      commit("setBranchDistrictUsers", response.data);
    })
  },
  async getBranchCityTasks({ commit }, id) {
    await axios.get(process.env.VUE_APP_API_URL + "branch/citytasks/" + id)
    .then(response => {
      commit("setBranchCityTasks", response.data);
    })
  },
  async getBranchDistrictTasks({ commit }, id) {
    await axios.get(process.env.VUE_APP_API_URL + "branch/districttasks/" + id)
    .then(response => {
      commit("setBranchDistrictTasks", response.data);
    })
  },
}

const mutations =  {
  setBranches(state, data) { state.branchesData = data },
  setBranch(state, data) { state.branchData = data },
  removeBranch: (state, id) => (state.branchesData.data = state.branchesData.data.filter(todo => todo.id !== id)),
        /*{ let i = state.branchesData.data.map(item => item.id).indexOf(id);
          state.branchesData.data.splice(i, 1) }*/
          setBranchCourier(state, data) { state.branchCourierData = data },
          setBranchUser(state, data) { state.branchUserData = data },
          setBranchTask(state, data) { state.branchTaskData = data },
          setBranchCity(state, data) { state.branchCityData = data },
          setBranchDistrict(state, data) { state.branchDistrictData = data },
          setBranchCityCouriers(state, data) { state.branchCityCouriersData = data },
          setBranchDistrictCouriers(state, data) { state.branchDistrictCouriersData = data },
          setBranchCityUsers(state, data) { state.branchCityUsersData = data },
          setBranchDistrictUsers(state, data) { state.branchDistrictUsersData = data },
          setBranchCityTasks(state, data) { state.branchCityTasksData = data },
          setBranchDistrictTasks(state, data) { state.branchDistrictTasksData = data },
          setAllBranches(state, data) { state.allBranchesData = data },
        }


        export default {
          namespaced,
          state,
          getters,
          actions,
          mutations
        };
