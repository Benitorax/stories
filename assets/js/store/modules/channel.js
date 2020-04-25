import { channel_post } from '../../api/ajax'

// initial state
const state = {
  allChannels: [],
  channel: {}
};

// getters
const getters = {
  allChannels: state => {
    return state.allChannels;
  },
  channel: state => {
    return state.channel;
  }
};

// actions
const actions = {
  fetchAllChannels({commit, state}) {

  },
  fetchChannel({commit, state}) {
    return state.channel;
  },
  create({ commit, state }, channel) {
    return channel_post(channel)
    .then(response=>{
      let channel = JSON.parse(response.data);
      commit('setChannel', channel);
    });
  }
};

// mutations
const mutations = {
  setAllChannels(state, channels) {
    state.allChannels = channels;
  },
  setChannel(state, channel) {
    state.channel = channel;
  },
  setUser(user) {
    state.user = user;
  },
  decrementProductInventory (state, { id }) {
    const product = state.all.find(product => product.id === id);
    product.inventory--;
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}