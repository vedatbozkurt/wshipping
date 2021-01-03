/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-08 15:48:56
*/
import axios from "axios";
const namespaced= true;
const state = {
  settings: {}
};
const getters = {
   setting: state => state.settings
};

const actions =  {
  async getSetting({ commit }) {
      commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "setting")
    .then(response => {
      commit("setLoader", false, { root: true });
      commit("setSetting", response.data);
  })
    .catch(() => {
      localStorage.removeItem("authToken");
      commit("setLoader", false, { root: true });
  });
},
async updateSetting({ commit }, data) {
    commit("setErrors", {}, { root: true });
    await axios.post(process.env.VUE_APP_API_URL + "setting", data)
    .then(response => {
      commit("setSetting", response.data);
  });
},
}

const mutations =  {
  setSetting(state, settingData) { state.settings = settingData }
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
