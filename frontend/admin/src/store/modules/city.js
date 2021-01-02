
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-06-29 01:57:04
*/
import axios from "axios";
const namespaced= true;
const state = {
  citiesAdminData: [],
};
const getters = {
 citiesAdmin: state => state.citiesAdminData,
/* citiesAdmin(){
  array.push(objectName)
 } */
};

const actions =  {
async getCities({ commit }) {
    await axios.get(process.env.VUE_APP_API_URL + "branch/cities")
    .then(response => {
      commit("setAdminCities", response.data);
    })
  },
}

const mutations =  {
  setAdminCities(state, data) { state.citiesAdminData = data },
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
