/*
* @Author: @vedatbozkurt
* @Date:   2020-06-28 13:34:40
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-12 01:27:16
*/
import axios from "axios";
const namespaced= true;
const state = {
  couriersData: {},
  courierData: {},
  courierTasksData: {},
  courierIDData: null, //courier:info dosyalarında kullanıldı
};

const getters = {
 couriers: state => state.couriersData,
 courier: state => state.courierData,
 courierTasks: state => state.courierTasksData,
}

const actions =  {
  async getCouriers({ commit }, page = 1) {
    commit("setLoader", true, { root: true });
    if (this.state.searchData == null ) {
      await axios.get(process.env.VUE_APP_API_URL + "courier?page=" + page)
      .then(response => {
        commit("setCouriers", response.data);
        commit("setLoader", false, { root: true });
      })
    }else {
      await axios.post(process.env.VUE_APP_API_URL + "courier/"+ this.state.searchData +"/?page=" + page)
      .then(response => {
        commit("setCouriers", response.data);
        commit("setLoader", false, { root: true });
      })
    }
  },
  async createCourier({ commit }, data) {
    await axios.post(process.env.VUE_APP_API_URL + "courier/store", data)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async getCourier({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "courier/" + id)
    .then(response => {
      commit("setCourier", response.data);
      commit("setLoader", false, { root: true });

    })
  },
  async updateCourier({ commit }, data) {
    let id = data.get('id');
    await axios.post(process.env.VUE_APP_API_URL + `courier/${id}`, data)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async deleteCourier({ commit }, id) {
    commit("removeCourier", id);
    await axios.delete(process.env.VUE_APP_API_URL + "courier/" + id)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async deleteCourierFromEdit({ commit }, id) {
    await axios.delete(process.env.VUE_APP_API_URL + "courier/" + id)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async getCourierTask({ commit }, page = 1) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "courier/" + state.courierIDData + "/tasks?page="+page)
    .then(response => {
      commit("setCourierTask", response.data);
      commit("setLoader", false, { root: true });
    })
  },
}

const mutations =  {
  setCouriers(state, data) { state.couriersData = data },
  setCourier(state, data) { state.courierData = data },
  removeCourier: (state, id) => (state.couriersData.data = state.couriersData.data.filter(todo => todo.id !== id)),
  setCourierTask(state, data) { state.courierTasksData = data },
  setCourierID(state, data) { state.courierIDData = data },
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
