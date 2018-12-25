import axios from 'axios';

export default {
    getConversations (page) {
        return new Promise((resolve, reject) => {
            axios.get('/webapi/conversations?page=' + page).then((response) => {
                resolve(response)
            })
        })
    },

    getConversation (id) {
        return new Promise((resolve, reject) => {
            axios.get('/webapi/conversations/' + id).then((response) => {
                resolve(response)
            })
        })
    },

    storeConversationReply (payload) {
        return new Promise((resolve, reject) => {
            axios.post(`/webapi/conversations/${payload.id}/reply`, payload).then((response) => {
                resolve(response)
            }).catch((errors) => {
                reject(errors)
            })
        })
    }
}