const state = {
    user: null, // User is not authenticated initially
};

const mutations = {
    setUser(state, user) {
        state.user = user;
    },
    clearUser(state) {
        state.user = null;
        state.token = null;
    },
};

const actions = {
    login({ commit }, userData) {
        commit('setUser', userData.user);
    },
    logout({ commit }) {
        commit('clearUser');
    },
};

const getters = {
    isAuthenticated: (state) => !!state.user,
    user: (state) => state.user,
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
};
