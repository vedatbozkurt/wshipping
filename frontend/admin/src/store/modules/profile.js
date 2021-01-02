/*
* @Author: @vedatbozkurt
* @Date:   2020-06-26 14:42:53
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-06-27 01:30:56
*/
import axios from "axios";
const namespaced= true;

const state = {
  adminData: {}
};

/*getters: {
    user: state => state.userData
  },*/

  const getters = {
  // allPosts: state => state.posts,
  admin(state){
    return state.adminData
  }
};

const actions =  {
  async getAdminData({ commit }) {
    await axios.get(process.env.VUE_APP_API_URL + "profile")
    .then(response => {
      commit("setAdminData", response.data);
    })
    .catch(() => {
      localStorage.removeItem("authToken");
    });
  },
  async uploadAdminData({ commit }, data) {
    commit("setErrors", {}, { root: true });
    await axios.put(process.env.VUE_APP_API_URL + "profile", data)
    .then(response => {
      commit("setAdminData", response.data);
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
  setAdminData(state, admin) { state.adminData = admin }
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
