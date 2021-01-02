/*
* @Author: @vedatbozkurt
* @Date:   2020-06-27 01:19:15
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-06-28 16:04:43
*/
import Vue from 'vue'
import Swal from 'sweetalert2'

window.Swal = Swal
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
window.Toast = Toast
Vue.mixin({
  methods: {
    capitalizeFirstLetter(str) {
      return str.charAt(0).toUpperCase() + str.slice(1);
    },
    myToast(icon,title) {
      return Toast.fire({
        icon: icon,
        title: title
      })
    },
    afterDeleteAlert(icon,text) {
      return Swal.fire({
        icon: icon,
        timer: 3000,
        timerProgressBar: true,
        text: text,
      })
    },

  }
})
