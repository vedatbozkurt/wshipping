/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-06-27 20:44:00
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
    await axios.get(process.env.VUE_APP_API_URL + "setting")
    .then(response => {
      commit("setSetting", response.data);
  })
    .catch(() => {
      localStorage.removeItem("authToken");
  });
},
async updateSetting({ commit }, data) {
    commit("setErrors", {}, { root: true });
    await axios.put(process.env.VUE_APP_API_URL + "setting", data)
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
