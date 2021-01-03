/*
* @Author: @vedatbozkurt
* @Date:   2020-06-28 13:34:40
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-05 20:59:47
*/
import axios from "axios";
const namespaced= true;
const state = {
  branchesData: {},
  branchData: {},
  branchAllCourierData: [], //task create-edit
  branchCourierData: {},
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
  branchIDData: null, //branch:info(courier,task,user) sayfalarında kullanıldı
  branchCityIDData: null, //branch:info(citycourier,citytask,cityuser)sayfalarında kullanıldı
  branchDistrictIDData: null, //branch:info(districtcourier,districttask,districtuser)sayfalarında kullanıldı
};

const getters = {
 allBranches: state => state.allBranchesData, //task:create,edit
 branches: state => state.branchesData, //Branch:index
  //Branch:info:CityCourier-Branch:info:CityTask-Branch:info:CityUser-Branch:info:Details
  //Branch:info:DistrictCourier-Branch:info:DistrictTask-Branch:info:DistrictUser
  //Branch:create,edit
  //task:create,edit
  branch: state => state.branchData,
 branchAllCourier: state => state.branchAllCourierData, //task:create,edit
 branchCourier: state => state.branchCourierData, //Branch:info:Courier
 branchUser: state => state.branchUserData, //Branch:info:User
 branchTask: state => state.branchTaskData, //Branch:info:Task
 branchCity: state => state.branchCityData, //Branch:info:CityCourier,CityTask,CityUser
 branchDistrict: state => state.branchDistrictData, //Branch:info:DistrictCourier-Branch:info:DistrictTask-Branch:info:DistrictUser
 branchCityCouriers: state => state.branchCityCouriersData, //Branch:info:CityCourier
 branchDistrictCouriers: state => state.branchDistrictCouriersData, //Branch:info:DistrictCourier
 branchCityUsers: state => state.branchCityUsersData, //Branch:info:CityUserstate.branchIDData
 branchDistrictUsers: state => state.branchDistrictUsersData, //Branch:info:DistrictUser
 branchCityTasks: state => state.branchCityTasksData,//-Branch:info:CityTask
 branchDistrictTasks: state => state.branchDistrictTasksData, //Branch:info:DistrictTask
 branchCityID: state => state.branchCityIDData,//branch:info(citycourier,citytask,cityuser)
 branchDistrictID: state => state.branchDistrictIDData,//branch:info(districtcourier,districttask,districtuser)
}

const actions =  {
  async getBranches({ commit }, page = 1) {
    if (this.state.searchData == null ) {
      await axios.get(process.env.VUE_APP_API_URL + "branch?page=" + page)
      .then(response => {
        commit("setBranches", response.data);
      })
    }else {
      await axios.post(process.env.VUE_APP_API_URL + "branch/"+ this.state.searchData +"/?page=" + page)
      .then(response => {
        commit("setBranches", response.data);
      })
    }
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
  async getBranchAllCourier({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "branch/" + id + "/allcouriers")
    .then(response => {
      commit("setBranchAllCourier", response.data);
      commit("setLoader", false, { root: true });
    })
  },
  async getBranchCourier({ commit },  page = 1) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "branch/" + state.branchIDData + "/couriers?page="+page)
    .then(response => {
      commit("setBranchCourier", response.data);
      commit("setLoader", false, { root: true });
    })
  },
  async getBranchUser({ commit },  page = 1) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "branch/" + state.branchIDData + "/users?page="+page)
    .then(response => {
      commit("setBranchUser", response.data);
      commit("setLoader", false, { root: true });
    })
  },
  async getBranchTask({ commit },  page = 1) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "branch/" + state.branchIDData + "/tasks?page="+page)
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
  async getBranchCityCouriers({ commit }, page = 1) {
    await axios.get(process.env.VUE_APP_API_URL + "branch/citycouriers/" + state.branchCityIDData + "?page="+page)
    .then(response => {
      commit("setBranchCityCouriers", response.data);
    })
  },
  async getBranchDistrictCouriers({ commit }, page = 1) {
    await axios.get(process.env.VUE_APP_API_URL + "branch/districtcouriers/" + state.branchDistrictIDData + "?page="+page)
    .then(response => {
      commit("setBranchDistrictCouriers", response.data);
    })
  },
  async getBranchCityUsers({ commit }, page = 1) {
    await axios.get(process.env.VUE_APP_API_URL + "branch/cityusers/" + state.branchCityIDData + "?page="+page)
    .then(response => {
      commit("setBranchCityUsers", response.data);
    })
  },
  async getBranchDistrictUsers({ commit }, page = 1) {
    await axios.get(process.env.VUE_APP_API_URL + "branch/districtusers/" + state.branchDistrictIDData + "?page="+page)
    .then(response => {
      commit("setBranchDistrictUsers", response.data);
    })
  },
  async getBranchCityTasks({ commit }, page = 1) {
    await axios.get(process.env.VUE_APP_API_URL + "branch/citytasks/" + state.branchCityIDData + "?page="+page)
    .then(response => {
      commit("setBranchCityTasks", response.data);
    })
  },
  async getBranchDistrictTasks({ commit }, page = 1) {
    await axios.get(process.env.VUE_APP_API_URL + "branch/districttasks/" + state.branchDistrictIDData + "?page="+page)
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
          setBranchAllCourier(state, data) { state.branchAllCourierData = data },
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
          setBranchID(state, data) { state.branchIDData = data },
          setBranchCityID(state, data) { state.branchCityIDData = data },
          setBranchDistrictID(state, data) { state.branchDistrictIDData = data },
        }


        export default {
          namespaced,
          state,
          getters,
          actions,
          mutations
        };
