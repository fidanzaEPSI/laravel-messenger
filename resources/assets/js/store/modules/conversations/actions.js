import api from '@/store/api/all'

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

export const storeConversationReply = ({ dispatch, commit }, { payload, context }) => {
    return api.storeConversationReply(payload).then((response) => {
        commit('appendReplyToConversation', response.data)
        commit('prependToConversations', response.data.data.parent)
    }).catch((errors) => {
        context.errors = errors.response.data.errors
        return Promise.reject('VALIDATION_ERROR')
    })
}

export const storeConversation = ({ dispatch, commit }, { payload, context }) => {
    return api.storeConversation(payload).then((response) => {
        commit('setCurrentConversation', response.data)
        commit('prependToConversations', response.data.data)
    }).catch((errors) => {
        context.errors = errors.response.data.errors
        return Promise.reject('VALIDATION_ERROR')
    })
}

export const addConversationUsers = ({ dispatch, commit }, { payload, context }) => {
    return api.addConversationUser(payload).then((response) => {
        commit('setCurrentConversation', response.data)
    }).catch((errors) => {
        context.errors = errors.response.data.errors
        return Promise.reject('VALIDATION_ERROR')
    })
}