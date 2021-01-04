
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-16 17:31:43
*/
import axios from "axios";
const namespaced= true;
const state = {
  citiesData: [], //dropdown
};

const getters = {
  cities: state => state.citiesData,
};

const actions =  {
async getCities({ commit }) { // all cities
  await axios.get(process.env.VUE_APP_API_URL + "city/allcities")
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
