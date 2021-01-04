
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-12 00:51:03
*/
import axios from "axios";
const namespaced= true;
const state = {
  citiesDistrictsData: [],
  cityDistrictsData: [],
};

const getters = {
  citiesDistricts: state => state.citiesDistrictsData,
  cityDistricts: state => state.cityDistrictsData,
};

const actions =  {
  async getCitiesDistricts({ commit }, data) {
    await axios.get(process.env.VUE_APP_API_URL + "district/citiesalldistricts/"+data  )
    .then(response => {
      commit("setCitiesDistricts", response.data);
    })
  },
  async getCityDistricts({ commit }, city_id) {
    await axios.get(process.env.VUE_APP_API_URL + "district/cityalldistricts/"+city_id )
    .then(response => {
      commit("setCityDistricts", response.data);
    })
  },
}

const mutations =  {
  setCitiesDistricts(state, data) { state.citiesDistrictsData = data },
  setCityDistricts(state, data) { state.cityDistrictsData = data },
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
