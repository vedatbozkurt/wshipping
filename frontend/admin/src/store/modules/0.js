
/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 20:29:22
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-06-28 20:51:17
*/
import axios from "axios";
const namespaced= true;
const state = {
  settings: {}
};
const getters = {
   setting: state => state.settings
};

const actions =  {

}

const mutations =  {
}


export default {
  namespaced,
  state,
  getters,
  actions,
  mutations
};
