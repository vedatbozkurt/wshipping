
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-22 01:21:10
*/
import axios from "axios";
const namespaced= true;
const state = {
  cityDistrictsData: [],
};

const getters = {
  cityDistricts: state => state.cityDistrictsData,
};

const actions =  {
  async getCityDistricts({ commit }, city_id) {
    await axios.get(process.env.VUE_APP_API_URL + "district/cityalldistricts/"+city_id )
    .then(response => {
      commit("setCityDistricts", response.data);
    })
  },

}

const mutations =  {
  setCityDistricts(state, data) { state.cityDistrictsData = data },
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
