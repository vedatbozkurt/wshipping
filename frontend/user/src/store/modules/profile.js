/*
* @Author: @vedatbozkurt
* @Date:   2020-06-26 14:42:53
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-09 00:14:34
*/
import axios from "axios";
const namespaced= true;

const state = {
  branchData: {}
};

/*getters: {
    user: state => state.userData
  },*/

  const getters = {
   branch: state => state.branchData
};

const actions =  {
  async getBranchData({ commit }) {
      commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "profile")
    .then(response => {
      commit("setBranchData", response.data);
      commit("setLoader", false, { root: true });
    })
    .catch(() => {
      localStorage.removeItem("authToken");
      commit("setLoader", false, { root: true });
    });
  },
  async uploadBranchData({ commit }, data) {
    commit("setErrors", {}, { root: true });
    await axios.put(process.env.VUE_APP_API_URL + "profile", data)
    .then(response => {
      commit("setBranchData", response.data);
    });
  },
 /* sendRegisterRequest({ commit }, data) {
    commit("setErrors", {}, { root: true });
    return axios
    .post(process.env.VUE_APP_API_URL + "register", data)
    .then(response => {
      commit("setUserData", response.data.user);
      localStorage.setItem("authToken", response.data.token);
      console.log('basarili update'+response.data)
    });
  },*/
}

const mutations =  {
  setBranchData(state, branch) { state.branchData = branch }
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
