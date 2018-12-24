import api from '../../api/all'

export const getConversations = ({ dispatch, commit }, page) => {
    api.getConversations(page).then((response) => {
        commit('setConversations', response.data)
    })
}