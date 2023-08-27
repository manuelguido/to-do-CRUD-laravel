const state = {
    user: null, // User is not authenticated initially
    token: null, // User PASSPORT authentication token
};

const mutations = {
    setUser(state, user) {
        state.user = user;
    },
    setToken(state, token) {
        state.token = token;
    },
    clearUser(state) {
        state.user = null;
        state.token = null;
    },
};

const actions = {
    login({ commit }, userData) {
        commit('setUser', userData.user);
        commit('setToken', userData.access_token);
    },
    logout({ commit }) {
        commit('clearUser');
    },
};

const getters = {
    isAuthenticated: (state) => !!state.user && !!state.token,
    getToken: (state) => state.token,
    user: (state) => state.user,
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
};
