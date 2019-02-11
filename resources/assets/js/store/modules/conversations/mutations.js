export const setCurrentUser = (state, user) => {
    state.user = user
}

export const setConversations = (state, conversations) => {
    state.conversations = conversations.data
}

export const setConversationsLoading = (state, status) => {
    state.loadingConversations = status
}

export const setConversationLoading = (state, status) => {
    state.loadingConversation = status
}

export const setCurrentConversation = (state, conversation) => {
    state.currentConversation = conversation.data
}

export const appendReplyToConversation = (state, reply) => {
    state.currentConversation.replies.push(reply.data)
}

export const prependToConversations = (state, conversation) => {
    state.conversations = state.conversations.filter((c) => {
        return c.id !== conversation.id
    })

    state.conversations.unshift(conversation)
}

export const updateUsersInConversation = (state, conversation) => {
    state.currentConversation.users = conversation.users
}

export const updateConversationInList = (state, conversation) => {
    state.conversations = state.conversations.map((item) => {
        if (item.id === conversation.id) {
            return conversation
        }

        return item
    })
}
