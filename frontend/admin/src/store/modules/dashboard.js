
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-06 02:05:48
*/
import axios from "axios";
const namespaced= true;
const state = {
  branchesNumber: null,
  couriersNumber: null,
  usersNumber: null,
  tasksNumber: null,
};
const getters = {
 branches: state => state.branchesNumber,
 couriers: state => state.couriersNumber,
 users: state => state.usersNumber,
 tasks: state => state.tasksNumber,
};

const actions =  {
    async getDashboard({ commit }) {
        await axios.get(process.env.VUE_APP_API_URL + "dashboard")
        .then(response => {
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
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
