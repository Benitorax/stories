import ajax from '../../api/ajax'

// initial state
const state = {
  user: {
    id: null,
    username: null,
    points: null
  }
};

// getters
const getters = {
  user: state => {
    return state.user;
  }
};

// actions
const actions = {
};

// mutations
const mutations = {
  setUser(state, user) {
    state.user = user;
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}