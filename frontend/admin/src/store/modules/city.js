
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-06-30 22:22:48
*/
import axios from "axios";
const namespaced= true;
const state = {
  citiesData: [],
};
const getters = {
 cities: state => state.citiesData,
/* citiesAdmin(){
  array.push(objectName)
 } */
};

const actions =  {
async getCities({ commit }) {
    await axios.get(process.env.VUE_APP_API_URL + "branch/cities")
    .then(response => {
      commit("setCities", response.data);
    })
  },
}

const mutations =  {
  setCities(state, data) { state.citiesData = data },
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
