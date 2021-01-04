
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-17 01:25:53
*/
import axios from "axios";
const namespaced= true;
const state = {
  tasksData: {},
  myTasksData: {},
  taskData: {},
};
const getters = {
    tasks: state => state.tasksData,
    myTasks: state => state.myTasksData,
    task: state => state.taskData,
};

const actions =  {
    async getTasks({ commit }, page = 1) {
        commit("setLoader", true, { root: true });
        await axios.get(process.env.VUE_APP_API_URL + "task?page=" + page)
        .then(response => {
            commit("setTasks", response.data);
            commit("setLoader", false, { root: true });
        })
    },
    async acceptTask({ commit }, id) {
        await axios.put(process.env.VUE_APP_API_URL  + "task/" + id + "/approved")
        .then(response => {
            commit("acceptTask", id);
            if (response.data === 'success') {
                commit("setErrors", {}, { root: true });
            }
        });
    },
    async getMyTasks({ commit }, page = 1) {
        commit("setLoader", true, { root: true });
        await axios.get(process.env.VUE_APP_API_URL + "task/mytasks?page=" + page)
        .then(response => {
            commit("setMyTasks", response.data);
            commit("setLoader", false, { root: true });
        })
    },
    async getTask({ commit }, id) {
        commit("setLoader", true, { root: true });
        await axios.get(process.env.VUE_APP_API_URL + "task/" + id)
        .then(response => {
          commit("setTask", response.data);
          commit("setLoader", false, { root: true });

      })
    },
    async updateTask({ commit }, id) {
        await axios.put(process.env.VUE_APP_API_URL + `task/${id}`)
        .then(response => {
          if (response.data === 'success') {
            commit("setErrors", {}, { root: true });
        }
    });
    },
    async cancelTask({ commit }, id) {
        await axios.put(process.env.VUE_APP_API_URL  + "task/" + id + "/cancel")
        .then(response => {
            commit("cancelTask", id);
            if (response.data === 'success') {
                commit("setErrors", {}, { root: true });
            }
        });
    },
}

const mutations =  {
  setTasks(state, data) { state.tasksData = data },
  setMyTasks(state, data) { state.myTasksData = data },
  setTask(state, data) { state.taskData = data },
  acceptTask: (state, id) => (state.tasksData.data = state.tasksData.data.filter(todo => todo.id !== id)),
  cancelTask: (state, id) => (state.myTasksData.data = state.myTasksData.data.filter(todo => todo.id !== id)),
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
