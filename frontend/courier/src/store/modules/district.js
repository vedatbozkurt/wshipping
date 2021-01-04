
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-16 17:32:23
*/
import axios from "axios";
const namespaced= true;
const state = {
  citiesDistrictsData: [],
};

const getters = {
citiesDistricts: state => state.citiesDistrictsData,
}
const actions =  {
  async getCitiesDistricts({ commit }, data) {
    await axios.get(process.env.VUE_APP_API_URL + "district/citiesalldistricts/"+data  )
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
