import axios from '~plugins/axios'
import _ from 'lodash'

export const state = () => ({
  item: {}
})

export const mutations = {

  set (state, user) {
    state.item = user
  },

  drop (state, commit) {
    state.item = {}
    Cookies.remove('user')
  }

}

export const getters = {

  item (state) {
    return state.item
  },

  isAdmin(state) {

    return _.includes(state.item.roles, 'admin');

  },

}

export const actions = {
  get({ commit }){

    commit('set', Cookies.getJSON('user') )


//      axios.get('/users')
//      .then(function (res) {
//        commit('set', res.data )
//      })
//      .catch(function (error) {
//        console.log(error);
//      });
  },
}
