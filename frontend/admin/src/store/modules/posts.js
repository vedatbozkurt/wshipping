/*
* @Author: @vedatbozkurt
* @Date:   2020-04-04 16:36:49
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-04-04 18:51:46
*/

import axios from 'axios';


const state = {
  posts: [],
  post: {}
};

const getters = {
  // allPosts: state => state.posts,
  allPosts(state){
    return state.posts
  },
  singlePost(state){
    return state.post
  }
};

const actions =  {
    // put asynchronous functions that can call one or more mutation functions
    // this.$store.dispatch('increment')
    // vue dosyasındaki dispatch actions çağırır, actions mutations çalıştırır
    async fetchPosts({ commit }) {
      const response = await axios.get('http://127.0.0.1:8000/api/posts');
      commit('setPosts', response.data);
    },
    async addPost({ commit }, post) {
      const response = await axios.post('http://127.0.0.1:8000/api/post/create', post);
      commit('newPost', response.data);
    },
    async fetchPost({ commit }, postid) {
      const response = await axios.get(`http://127.0.0.1:8000/api/post/edit/${postid}`);
      commit('setPost', response.data);
    },
    async updatePost({ commit }, post) {
      const response = await axios.put(`http://127.0.0.1:8000/api/post/update/${post.id}`, post);
      // console.log(response.data);
      commit('updateSinglePost', response.data);
    },
    async deletePost({ commit }, id) {
      await axios.delete(`http://127.0.0.1:8000/api/post/delete/${id}`);
      commit('removePost', id);
    },
  };


  const  mutations =  {
    // put sychronous functions for changing state e.g. add, edit, delete
    // state değiştirir
    // setPosts: (state, posts) => (state.posts = posts),
    // newTodo: (state, todo) => state.todos.unshift(todo),
    setPosts(state,posts){ state.posts = posts },
    setPost(state,post){ state.post = post },
    newPost(state,post){ state.posts.unshift(post) },
    updateSinglePost: (state, updPost) => {
      const index = state.posts.findIndex(post => post.id === updPost.id);
      if (index !== -1) {
        state.posts.splice(index, 1, updPost);
      }
    },
    removePost(state,id){
      let i = state.posts.map(item => item.id).indexOf(id);
      state.posts.splice(i, 1)
    },


  };


  export default {
    state,
    getters,
    actions,
    mutations
  };
