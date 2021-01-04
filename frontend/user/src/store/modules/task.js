/*
* @Author: @vedatbozkurt
* @Date:   2020-06-28 13:34:40
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-23 02:29:21
*/
import axios from "axios";
const namespaced= true;
const state = {
  tasksData: {},
  receivedTasksData: {},
  sentTasksData: {},
  taskData: {},
};

const getters = {
 tasks: state => state.tasksData, //task:index
 receivedTasks: state => state.receivedTasksData,
 sentTasks: state => state.sentTasksData,
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
  async getReceivedTasks({ commit }, page = 1) {
    commit("setLoader", true, { root: true });
      await axios.get(process.env.VUE_APP_API_URL + "task/receivertasks?page=" + page)
      .then(response => {
        commit("setReceivedTasks", response.data);
        commit("setLoader", false, { root: true });
      })
  },

  async getSentTasks({ commit }, page = 1) {
    commit("setLoader", true, { root: true });
      await axios.get(process.env.VUE_APP_API_URL + "task/sendertasks?page=" + page)
      .then(response => {
        commit("setSentTasks", response.data);
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
  async getTaskDetails({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "task/details/" + id)
    .then(response => {
      commit("setTask", response.data);
      commit("setLoader", false, { root: true });

    })
  },
  async getTrackingTask({ commit }, id) {
    commit("setLoader", true, { root: true });
    await axios.get(process.env.VUE_APP_API_URL + "tracking/" + id)
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
}

const mutations =  {
  setTasks(state, data) { state.tasksData = data },
  setTask(state, data) { state.taskData = data },
  setReceivedTasks(state, data) { state.receivedTasksData = data },
  setSentTasks(state, data) { state.sentTasksData = data },
  removeTask: (state, id) => (state.sentTasksData.data = state.sentTasksData.data.filter(todo => todo.id !== id)),
}

export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
