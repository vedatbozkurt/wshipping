
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-02 17:43:51
*/
import axios from "axios";
const namespaced= true;
const state = {
  citiesDistrictsData: [],
  cityDistrictsData: [],
  districtsData: {}, //pagination için object olmalı
  districtData: {},
};

const getters = {
 citiesDistricts: state => state.citiesDistrictsData,
 cityDistricts: state => state.cityDistrictsData,
 districts: state => state.districtsData,  //pagination için
 district: state => state.districtData,
};

const actions =  {
  async getCitiesDistricts({ commit }, data) {
    await axios.post(process.env.VUE_APP_API_URL + "district/citiesalldistricts/", data )
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
  async getDistricts({ commit }, page = 1) { // all districts with pagination
    await axios.get(process.env.VUE_APP_API_URL + "district?page=" + page)
    .then(response => {
      commit("setDistricts", response.data);
    })
  },
  async createDistrict({ commit }, data) {
    await axios.post(process.env.VUE_APP_API_URL + "district/store", data)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async getDistrict({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "district/" + id)
    .then(response => {
      commit("setDistrict", response.data);
      commit("setLoader", false, { root: true });

    })
  },
  async updateDistrict({ commit }, data) {
    await axios.put(process.env.VUE_APP_API_URL + `district/${data.id}`, data)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async deleteDistrict({ commit }, id) {
    commit("removeDistrict", id);
    await axios.delete(process.env.VUE_APP_API_URL + "district/" + id)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
}

const mutations =  {
  setCitiesDistricts(state, data) { state.citiesDistrictsData = data },
  setCityDistricts(state, data) { state.cityDistrictsData = data },
  setDistricts(state, data) { state.districtsData = data }, //pagination cities
  setDistrict(state, data) { state.districtData = data },
  removeDistrict: (state, id) => (state.districtsData.data = state.districtsData.data.filter(todo => todo.id !== id)),
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
