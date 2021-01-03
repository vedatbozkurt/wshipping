
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-06 21:37:08
*/
import axios from "axios";
const namespaced= true;
const state = {
  branchesNumber: null,
  couriersNumber: null,
  usersNumber: null,
  tasksNumber: null,
  tasksMonthData: [],
  usersMonthData: [],
  couriersMonthData: [],
};
const getters = {
 branches: state => state.branchesNumber,
 couriers: state => state.couriersNumber,
 users: state => state.usersNumber,
 tasks: state => state.tasksNumber,
 tasksMonth: state => state.tasksMonthData,
 usersMonth: state => state.usersMonthData,
 couriersMonth: state => state.couriersMonthData,
};

const actions =  {
    async getDashboard({ commit }) {
        await axios.get(process.env.VUE_APP_API_URL + "dashboard")
        .then(response => {
          commit("setTasksMonth", response.data.tasksmonth);
          commit("setUsersMonth", response.data.usersmonth);
          commit("setCouriersMonth", response.data.couriersmonth);
          commit("setBranches", response.data.branch);
          commit("setCouriers", response.data.courier);
          commit("setUsers", response.data.user);
          commit("setTasks", response.data.task);
      })
    },
}

const mutations =  {
  setBranches(state, data) { state.branchesNumber = data },
  setCouriers(state, data) { state.couriersNumber = data },
  setUsers(state, data) { state.usersNumber = data },
  setTasks(state, data) { state.tasksNumber = data },
  setTasksMonth(state, data) { state.tasksMonthData = data },
  setUsersMonth(state, data) { state.usersMonthData = data },
  setCouriersMonth(state, data) { state.couriersMonthData = data },
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
