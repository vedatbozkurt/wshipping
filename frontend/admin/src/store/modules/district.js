
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-06-29 05:11:43
*/
import axios from "axios";
const namespaced= true;
const state = {
  districtsAdminData: []
};
const getters = {
   districtsAdmin: state => state.districtsAdminData
};

const actions =  {
  async getDistricts({ commit }, data) {
    await axios.post(process.env.VUE_APP_API_URL + "branch/districts/", data )
    .then(response => {
      commit("setAdminDistricts", response.data);
    })
  },
}

const mutations =  {
  setAdminDistricts(state, data) { state.districtsAdminData = data },
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
