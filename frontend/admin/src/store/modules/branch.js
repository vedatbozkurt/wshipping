/*
* @Author: @vedatbozkurt
* @Date:   2020-06-28 13:34:40
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-06-29 04:32:12
*/
import axios from "axios";
const namespaced= true;
const state = {
  branchesData: {},
  branchData: {},
};

const getters = {
 branches: state => state.branchesData,
 branch: state => state.branchData,
}

const actions =  {
  async getBranches({ commit }, page = 1) {
    await axios.get(process.env.VUE_APP_API_URL + "branch?page=" + page)
    .then(response => {
      commit("setBranches", response.data);
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
    await axios.get(process.env.VUE_APP_API_URL + "branch/" + id)
    .then(response => {
      commit("setBranch", response.data);
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

}

const mutations =  {
  setBranches(state, data) { state.branchesData = data },
  setBranch(state, data) { state.branchData = data },
  removeBranch: (state, id) =>
  (state.branchesData.data = state.branchesData.data.filter(todo => todo.id !== id)),
        /*{ let i = state.branchesData.data.map(item => item.id).indexOf(id);
          state.branchesData.data.splice(i, 1) }*/

        }


        export default {
          namespaced,
          state,
          getters,
          actions,
          mutations
        };
