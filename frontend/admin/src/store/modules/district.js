
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-06-30 22:22:06
*/
import axios from "axios";
const namespaced= true;
const state = {
  citiesDistrictsData: []
};
const getters = {
   citiesDistricts: state => state.citiesDistrictsData
};

const actions =  {
  async getCitiesDistricts({ commit }, data) {
    await axios.post(process.env.VUE_APP_API_URL + "branch/districts/", data )
    .then(response => {
      commit("setCitiesDistricts", response.data);
    })
  },
}

const mutations =  {
  setCitiesDistricts(state, data) { state.citiesDistrictsData = data },
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
