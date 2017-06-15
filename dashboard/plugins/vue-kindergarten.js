import Vue from 'vue'
import VueKindergarten from 'vue-kindergarten'
//import store from '~store'

//import RouteGoverness from '~plugins/governesses/RouteGoverness'

export default ( ) => {

//console.log('router')
//console.log(router)

//console.log("store.getters['user/get']")
//console.log(store.getters['user/get'])

Vue.use(VueKindergarten, {
  // Getter of your current user.
  // If you use vuex, then store will be passed
  child: ( ) => {

    return Cookies.getJSON('user')

//    console.log(store)

//    return store.getters['user/get'];
    // or
    // return decode(localStorage.getItem('jwt'));
    // or your very own logic..
  }
})

}
