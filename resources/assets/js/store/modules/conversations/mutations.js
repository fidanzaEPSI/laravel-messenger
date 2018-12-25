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
    state.currentConversation.replies.unshift(reply.data)
}