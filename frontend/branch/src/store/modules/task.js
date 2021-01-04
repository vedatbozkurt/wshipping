/*
* @Author: @vedatbozkurt
* @Date:   2020-06-28 13:34:40
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-15 04:06:01
*/
import axios from "axios";
const namespaced= true;
const state = {
  tasksData: {},
  taskData: {},
};

const getters = {
 tasks: state => state.tasksData, //task:index
 task: state => state.taskData, //task:create,edit
}

const actions =  {
  async getTasks({ commit }, page = 1) {
    commit("setLoader", true, { root: true });
      await axios.get(process.env.VUE_APP_API_URL + "task?page=" + page)
      .then(response => {
        commit("setTasks", response.data);
        commit("setLoader", false, { root: true });
      })
  },
  async createTask({ commit }, data) {
    await axios.post(process.env.VUE_APP_API_URL + "task/store", data)
    .then(response => {
      console.log(response.data);
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async getTask({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "task/" + id)
    .then(response => {
      commit("setTask", response.data);
      commit("setLoader", false, { root: true });

    })
  },
  async updateTask({ commit }, data) {
    await axios.put(process.env.VUE_APP_API_URL + `task/${data.id}`, data)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async deleteTask({ commit }, id) {
    commit("removeTask", id);
    await axios.delete(process.env.VUE_APP_API_URL + "task/" + id)
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
  async restoreTask({ commit }, id) {
    await axios.post(process.env.VUE_APP_API_URL + "task/" + id + "/restore")
    .then(response => {
      if (response.data === 'success') {
        commit("setErrors", {}, { root: true });
      }
    });
  },
}

const mutations =  {
  setTasks(state, data) { state.tasksData = data },
  setTask(state, data) { state.taskData = data },
  removeTask: (state, id) => (state.tasksData.data = state.tasksData.data.filter(todo => todo.id !== id)),
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
