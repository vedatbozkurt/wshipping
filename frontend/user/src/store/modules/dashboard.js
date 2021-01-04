
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-22 18:06:35
*/
import axios from "axios";
const namespaced= true;
const state = {
  userData: null,
  senderTaskNumber: null,
  receiverTaskNumber: null,
  addressNumber: null,
};
const getters = {
 user: state => state.userData,
 sentTask: state => state.senderTaskNumber,
 receivedTask: state => state.receiverTaskNumber,
 addresses: state => state.addressNumber,
};

const actions =  {
    async getDashboard({ commit }) {
      commit("setLoader", true, { root: true });
      await axios.get(process.env.VUE_APP_API_URL + "dashboard")
      .then(response => {
          commit("setSentTasks", response.data.senderTask);
          commit("setReceivedTasks", response.data.receiverTask);
          commit("setAddresses", response.data.address);
          commit("setUserData", response.data.user);
          commit("setLoader", false, { root: true });
      })
  },
}

const mutations =  {
    setSentTasks(state, data) { state.senderTaskNumber = data },
    setReceivedTasks(state, data) { state.receiverTaskNumber = data },
    setAddresses(state, data) { state.addressNumber = data },
    setUserData(state, data) { state.userData = data },
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
