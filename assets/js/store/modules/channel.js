import { channel_post, channel_list, channel_add_user, channel_check_password } from '../../api/ajax';

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
    },
    channelById: (state) => (id) => {
        return state.channels.find(channel => channel.id === id);
    }
};

// actions
const actions = {
    fetchChannels({commit, state}) {
        return channel_list().then(response => {
            let channels = JSON.parse(response.data.channels);
            commit('setChannels', channels);
        });
    },
    // fetchChannel({commit, state}) {
    //     return state.channel;
    // },
    create({ commit, state }, channel) {
        return channel_post(channel)
        .then(response=> {
            let channel = JSON.parse(response.data.channel);
            let user = JSON.parse(response.data.user);

            commit('user/setUser', user, { root: true });
            commit('setChannel', channel);
            
            return {user, channel};
        });
    },
    addUser({ commit, state }, data) {
        return channel_add_user(data)
        .then(response => {
            let user = JSON.parse(response.data.user);
            let channel = JSON.parse(response.data.channel);
            console.log('inside addUser', user, channel);
            commit('user/setUser', user, { root: true });
            commit('setChannel', channel);

            return { user, channel};
        });
    },
    checkPassword({ commit, state }, data) {
        return channel_check_password(data)
        .then(response => {
            let user = JSON.parse(response.data.user);
            let channel = JSON.parse(response.data.channel);

            commit('user/setUser', user, { root: true });
            commit('setChannel', channel);
            
            return { user, channel};
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