/*
* @Author: @vedatbozkurt
* @Date:   2020-06-26 14:42:53
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-06-26 15:28:22
*/
import axios from "axios";
const state = {
  userData: null
};

/*getters: {
    user: state => state.userData
},*/

const getters = {
  // allPosts: state => state.posts,
  user(state){
    return state.userData
}
};

const actions =  {
    getUserData({ commit }) {
      axios
      .get(process.env.VUE_APP_API_URL + "user")
      .then(response => {
          commit("setUserData", response.data);
      })
      .catch(() => {
          localStorage.removeItem("authToken");
      });
  },
  sendLoginRequest({ commit }, data) {
      commit("setErrors", {}, { root: true });
      return axios
      .post(process.env.VUE_APP_API_URL + "login", data)
      .then(response => {
          commit("setUserData", response.data.user);
          localStorage.setItem("authToken", response.data.token);
      });
  },
  sendRegisterRequest({ commit }, data) {
      commit("setErrors", {}, { root: true });
      return axios
      .post(process.env.VUE_APP_API_URL + "register", data)
      .then(response => {
          commit("setUserData", response.data.user);
          localStorage.setItem("authToken", response.data.token);
      });
  },
  sendLogoutRequest({ commit }) {
      axios.post(process.env.VUE_APP_API_URL + "logout").then(() => {
        commit("setUserData", null);
        localStorage.removeItem("authToken");
    });
  }
}

const  mutations =  {
    setUserData(state, user) {
      state.userData = user;
  }
}


export default {
    state,
    getters,
    actions,
    mutations
  };
