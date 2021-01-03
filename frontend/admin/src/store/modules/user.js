/*
* @Author: @vedatbozkurt
* @Date:   2020-06-28 13:34:40
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-05 21:25:58
*/
import axios from "axios";
const namespaced= true;
const state = {
  usersData: {},
  userData: {},
  userAddressData: {},
  userSenderTaskData: {},
  userReceiverTaskData: {},
  allUsersData: [], //paginate olmadan dropdown için
  userSenderAddressData: [], //paginate olmadan dropdown için
  userReceiverAddressData: [], //paginate olmadan dropdown için
  userIDData: null, //user:info dosyalarında kullanıldı
};

const getters = {
 users: state => state.usersData, //user:index
  //adress:create(dropdown),edit(dropdown)
  //task:create(dropdown),edit(dropdown)
  allUsers: state => state.allUsersData,
 user: state => state.userData, ////user:info:Details,create,edit
 userAddress: state => state.userAddressData, //user:info:Address
 userSenderTask: state => state.userSenderTaskData, //user:info:SenderTask
 userReceiverTask: state => state.userReceiverTaskData, //user:info:ReceiverTask
 userSenderAddress: state => state.userSenderAddressData, //task:create,edit
 userReceiverAddress: state => state.userReceiverAddressData, //task:create,edit
}

const actions =  {
  async getUsers({ commit }, page = 1) {
    if (this.state.searchData === null ) {
      await axios.get(process.env.VUE_APP_API_URL + "user?page=" + page)
      .then(response => {
        commit("setUsers", response.data);
      })
    }else {
      await axios.post(process.env.VUE_APP_API_URL + "user/"+ this.state.searchData +"/?page=" + page)
      .then(response => {
        commit("setUsers", response.data);
      })
    }
  },
  async getAllUsers({ commit }) {
    await axios.get(process.env.VUE_APP_API_URL + "user/all")
    .then(response => {
      commit("setAllUsers", response.data);
    })
  },
  async createUser({ commit }, data) {
    await axios.post(process.env.VUE_APP_API_URL + "user/store", data)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async getUser({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "user/" + id)
    .then(response => {
      commit("setUser", response.data);
      commit("setLoader", false, { root: true });

    })
  },
  async updateUser({ commit }, data) {
    await axios.put(process.env.VUE_APP_API_URL + `user/${data.id}`, data)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async deleteUser({ commit }, id) {
    commit("removeUser", id);
    await axios.delete(process.env.VUE_APP_API_URL + "user/" + id)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async deleteUserFromEdit({ commit }, id) {
    await axios.delete(process.env.VUE_APP_API_URL + "user/" + id)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async restoreUser({ commit }, id) {
    await axios.post(process.env.VUE_APP_API_URL + "user/" + id + "/restore")
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async getUserAddress({ commit }, page = 1) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "user/" + state.UserIDData + "/addresses?page=" + page)
    .then(response => {
      commit("setUserAddress", response.data);
      commit("setLoader", false, { root: true });
    })
  },
  async getUserSenderTasks({ commit }, page = 1) {
    await axios.get(process.env.VUE_APP_API_URL + "user/" + state.UserIDData + "/sendertasks?page=" + page)
    .then(response => {
      commit("setUserSenderTasks", response.data);
    })
  },
  async getUserReceiverTasks({ commit }, page = 1) {
    await axios.get(process.env.VUE_APP_API_URL + "user/" + state.UserIDData + "/receivertasks?page=" + page)
    .then(response => {
      commit("setUserReceiverTasks", response.data);
    })
  },

  async getUserSenderAddress({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "user/" + id + "/alladdresses")
    .then(response => {
      commit("setUserSenderAddress", response.data);
      commit("setLoader", false, { root: true });
    })
  },

  async getUserReceiverAddress({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "user/" + id + "/alladdresses")
    .then(response => {
      commit("setUserReceiverAddress", response.data);
      commit("setLoader", false, { root: true });
    })
  },
}

const mutations =  {
  setUsers(state, data) { state.usersData = data },
  setAllUsers(state, data) { state.allUsersData = data },
  setUser(state, data) { state.userData = data },
  removeUser: (state, id) => (state.usersData.data = state.usersData.data.filter(todo => todo.id !== id)),
  setUserAddress(state, data) { state.userAddressData = data },
  setUserSenderTasks(state, data) { state.userSenderTaskData = data },
  setUserReceiverTasks(state, data) { state.userReceiverTaskData = data },
  setUserSenderAddress(state, data) { state.userSenderAddressData = data },
  setUserReceiverAddress(state, data) { state.userReceiverAddressData = data },
  setUserID(state, data) { state.UserIDData = data },
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
