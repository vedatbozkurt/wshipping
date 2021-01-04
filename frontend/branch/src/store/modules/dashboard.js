
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-15 03:38:05
*/
import axios from "axios";
const namespaced= true;
const state = {
   citiesNumber: null,
   couriersNumber: null,
   usersNumber: null,
   tasksNumber: null,
};
const getters = {
 cities: state => state.citiesNumber,
 couriers: state => state.couriersNumber,
 users: state => state.usersNumber,
 tasks: state => state.tasksNumber,
};

const actions =  {
async getDashboard({ commit }) {
      commit("setLoader", true, { root: true });
        await axios.get(process.env.VUE_APP_API_URL + "dashboard")
        .then(response => {
          commit("setCities", response.data.city);
          commit("setCouriers", response.data.courier);
          commit("setUsers", response.data.user);
          commit("setTasks", response.data.task);
      commit("setLoader", false, { root: true });
      })
    },
}

const mutations =  {
  setCities(state, data) { state.citiesNumber = data },
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
