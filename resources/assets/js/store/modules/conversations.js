import api from '../api/all'
import conversation from './conversation'

const state = {
    conversations: [],
    loadingConversations: false
}

const getters = {
   // 
}

const actions = {
    getConversation ({ dispatch, commit }, page) {
        api.getConversations(1).then((response) => {
            commit('setConversations', response.data)
        }).catch((errors) => {
            //
        })
        // api request
        // set conversations via a mutation
    }
}

const mutations = {
    setConversations (data) {
        state.conversations = data
    }
}

const modules = {
    conversation: conversation
}

export default {
    state,
    getters,
    actions,
    mutations
}