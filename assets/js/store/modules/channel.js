import { channel_post, channel_list } from '../../api/ajax';

// initial state
const state = {
    channels: [],
    channel: {}
};

// getters
const getters = {
    channels: state => {
        return state.channels;
    },
    channel: state => {
        return state.channel;
    }
};

// actions
const actions = {
    fetchChannels({commit, state}) {
        return channel_list().then(response => {
            let channels = JSON.parse(response.data);
            console.log('inside action', channels);
            commit('setChannels', channels);
        });
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
    setChannels(state, channels) {
        state.channels = channels;
    },
    setChannel(state, channel) {
        state.channel = channel;
    },
    eraseChannel(state) {
        state.channel = {};
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