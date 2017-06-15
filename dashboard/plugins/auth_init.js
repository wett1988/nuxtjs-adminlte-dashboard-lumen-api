import Vue from 'vue'
import VueKindergarten from 'vue-kindergarten'

import axios from '~plugins/axios'

export default function(store, router){

  console.log('auth_init')

//  if( _.isUndefined( Cookies.getJSON('user') ) ){
//    router.push('/auth/signin')
//  }


//    console.log("this.$store.getters['user/item']['token']")
//    console.log(this.$store.getters['user/item']['token'])

    if ( _.isEmpty( store.getters['user/item'] ) ){



      if( _.isUndefined( Cookies.getJSON('user') ) ){
         router.push('/auth/signin')
      } else {
         store.commit('user/set', Cookies.getJSON('user') )
      }

    }

    //////// Костыль авторизации
    console.log("store.getters['user/item']['token']")
    console.log(store.getters['user/item']['token'])

    axios.defaults.headers.common['Authorization'] ='Bearer ' + store.getters['user/item']['token']
    /////////

}
