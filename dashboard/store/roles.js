import axios from '~plugins/axios'

export const state = () => ({
  list: [],
  form: ''
})

export const mutations = {
  set (state, data) {
    state.list = data
  }
}

export const getters = {
  list (state) {
    return state.list
  },
  form (state) {
    return state.form
  },
}

export const actions = {
  create(state){

    axios.get( '/roles/create' )
    .then((res) => {
      state.form = res.data
    })

  },
  get({ commit }){

      axios.get('/roles')
      .then(function (res) {
        commit('set', res.data )
      })
      .catch(function (error) {
        console.log(error);
      });
  },
}
