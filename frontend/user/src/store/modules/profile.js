/*
* @Author: @vedatbozkurt
* @Date:   2020-06-26 14:42:53
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-22 17:21:31
*/
import axios from "axios";
const namespaced= true;

const state = {
  userData: {}
};

/*getters: {
    user: state => state.userData
  },*/

  const getters = {
   user: state => state.userData
};

const actions =  {
  async getUserData({ commit }) {
      commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "profile")
    .then(response => {
      commit("setUserData", response.data);
      commit("setLoader", false, { root: true });
    })
    .catch(() => {
      localStorage.removeItem("authToken");
      commit("setLoader", false, { root: true });
    });
  },
  async uploadUserData({ commit }, data) {
    commit("setErrors", {}, { root: true });
    await axios.put(process.env.VUE_APP_API_URL + "profile", data)
    .then(response => {
      commit("setUserData", response.data);
    });
  },
}

const mutations =  {
  setUserData(state, user) { state.userData = user }
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
