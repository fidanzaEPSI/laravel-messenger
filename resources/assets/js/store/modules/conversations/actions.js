import api from '@/store/api/all'

export const getConversations = ({ dispatch, commit, state }, page) => {
    commit('setConversationsLoading', true)
    api.getConversations(page).then((response) => {
        commit('setConversations', response.data)
        commit('setConversationsLoading', false)

        console.log('User ' + state.user.id + ' logged in.');
        
        Echo.private('user.' + state.user.id)
            .listen('ConversationReplyCreated', (e) => {
                commit('prependToConversations', e.parent)
            })
    })
}

export const getConversation = ({ dispatch, commit, state }, id) => {
    commit('setConversationLoading', true)

    // if already subscribed, leave current conversation channel 
    if (state.conversation) {
        Echo.leave('conversation.' + state.conversation.id);
    }

    api.getConversation(id).then((response) => {
        commit('setCurrentConversation', response.data)
        commit('setConversationLoading', false)
        
        Echo.private('conversation.' + id)
            .listen('ConversationReplyCreated', (e) => {
                commit('appendReplyToConversation', e)
            })

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

export const addUsersInConversation = ({ dispatch, commit }, { payload, context }) => {
    return api.addUsersInConversation(payload).then((response) => {
        commit('updateUsersInConversation', response.data.data)
        commit('updateConversationInList', response.data.data)
    }).catch((errors) => {
        context.errors = errors.response.data.errors
        return Promise.reject('VALIDATION_ERROR')
    })
}