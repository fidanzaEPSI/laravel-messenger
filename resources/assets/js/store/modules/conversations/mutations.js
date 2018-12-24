export const setConversations = (state, conversations) => {
    state.conversations = conversations.data
}

export const setConversationsLoading = (state, status) => {
    state.loadingConversations = status
}