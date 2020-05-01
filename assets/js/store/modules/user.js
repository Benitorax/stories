import { disconnect_user } from '../../api/ajax';

// initial state
const state = {
	user: {}
};

// getters
const getters = {
	user: state => {
		return state.user;
	}
};

// actions
const actions = {
	disconnectUser({ commit, state }, data) {
		disconnect_user(data).then(response => {
			commit('eraseUser');
		});
	}
};

// mutations
const mutations = {
	setUser(state, user) {
		state.user = user;
	},
	eraseUser(state) {
		state.user = {};
	}
};

export default {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
};