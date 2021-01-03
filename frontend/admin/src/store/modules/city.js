
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-02 17:33:09
*/
import axios from "axios";
const namespaced= true;
const state = {
  citiesData: [], //dropdown için array olmalı - all cities
  citiesPageData: {}, //pagination için object olmalı - all cities
  cityData: [],
};
const getters = {
 cities: state => state.citiesData,
 citiesPage: state => state.citiesPageData,
 city: state => state.cityData,
/* citiesAdmin(){
  array.push(objectName)
 } */
};

const actions =  {
async getCities({ commit }) { // all cities
    await axios.get(process.env.VUE_APP_API_URL + "city/allcities")
    .then(response => {
      commit("setCities", response.data);
    })
  },
async getCitiesPage({ commit }, page = 1) { // all cities with pagination
    await axios.get(process.env.VUE_APP_API_URL + "city?page=" + page)
    .then(response => {
      commit("setCitiesPage", response.data);
    })
  },
  async createCity({ commit }, data) {
    await axios.post(process.env.VUE_APP_API_URL + "city/store", data)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async getCity({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "city/" + id)
    .then(response => {
      commit("setCity", response.data);
      commit("setLoader", false, { root: true });

    })
  },
  async updateCity({ commit }, data) {
    await axios.put(process.env.VUE_APP_API_URL + `city/${data.id}`, data)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async deleteCity({ commit }, id) {
    commit("removeCity", id);
    await axios.delete(process.env.VUE_APP_API_URL + "city/" + id)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
}

const mutations =  {
  setCities(state, data) { state.citiesData = data },
  setCitiesPage(state, data) { state.citiesPageData = data }, //pagination cities
  setCity(state, data) { state.cityData = data },
  removeCity: (state, id) => (state.citiesPageData.data = state.citiesPageData.data.filter(todo => todo.id !== id)),
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
