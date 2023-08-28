import { User } from "../../models/user.model";

const state = {
    user: null as User, // User is not authenticated initially
};

const mutations = {
    setUser(state: { user: User }, user: User) {
        state.user = user;
    },
    clearUser(state: { user: User }) {
        state.user = null;
    },
};

const actions = {
    login({ commit }, userData) {
        commit('setUser', userData.user);
    },
    logout({ commit }) {
        commit('clearUser');
        localStorage.clear();

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
