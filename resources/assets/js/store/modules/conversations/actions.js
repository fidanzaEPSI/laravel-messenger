import api from '../../api/all'

export const getConversations = ({ dispatch, commit }, page) => {
    commit('setConversationsLoading', true)
    api.getConversations(page).then((response) => {
        commit('setConversations', response.data)
        commit('setConversationsLoading', false)

    })
}

export const getConversation = ({ dispatch, commit }, id) => {
    commit('setConversationLoading', true)
    api.getConversation(id).then((response) => {
        commit('setCurrentConversation', response.data)
        commit('setConversationLoading', false)

        window.history.pushState(null, null, `/conversations/${id}`)
    })
}