import api from '../../api/all'

export const getConversations = ({ dispatch, commit }, page) => {
    commit('setConversationsLoading', true)
    api.getConversations(page).then((response) => {
        commit('setConversations', response.data)
        commit('setConversationsLoading', false)
    })
}