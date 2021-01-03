/*
* @Author: @vedatbozkurt
* @Date:   2020-06-28 13:34:40
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-06 23:53:12
*/
import axios from "axios";
const namespaced= true;
const state = {
  addressesData: {},
  addressData: {},
};

const getters = {
   addresses: state => state.addressesData,//adress:index-
   address: state => state.addressData, //adress:create,edit-
}

const actions =  {
  async getAddresses({ commit }, page = 1) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "address?page=" + page)
    .then(response => {
      commit("setAddresses", response.data);
      commit("setLoader", false, { root: true });
  })
},
async createAddress({ commit }, data) {
    await axios.post(process.env.VUE_APP_API_URL + "address/store", data)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
    }
});
},
async getAddress({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "address/" + id)
    .then(response => {
      commit("setAddress", response.data);
      commit("setLoader", false, { root: true });

  })
},
async updateAddress({ commit }, data) {
    await axios.put(process.env.VUE_APP_API_URL + `address/${data.id}`, data)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
    }
});
},
async deleteAddress({ commit }, id) {
    commit("removeAddress", id);
    await axios.delete(process.env.VUE_APP_API_URL + "address/" + id)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
    }
});
},
}

const mutations =  {
  setAddresses(state, data) { state.addressesData = data },
  setAddress(state, data) { state.addressData = data },
  removeAddress: (state, id) => (state.addressesData.data = state.addressesData.data.filter(todo => todo.id !== id)),
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
