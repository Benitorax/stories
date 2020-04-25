// initial state
const state = {
  isDisplayed: false,
  message: {
    text: null,
    type: null
  }
};

// getters
const getters = {
  message: state => {
    return state.message;
  },
  isDisplayed: state => {
    return state.isDisplayed;
  }
};

// actions
const actions = {

};

// mutations
const mutations = {
  setMessage(state, message) {
    state.message = message;
    state.isDisplayed = true;
  },
  eraseMessage(state) {
    state.message = {
      text: null,
      type: null
    };
    state.isDisplayed = false;
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}