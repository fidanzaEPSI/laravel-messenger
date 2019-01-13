import axios from 'axios';

export default {
    getCurrentUser () {
        return new Promise((resolve, reject) => {
            axios.get('/webapi/me/').then((response) => {
                resolve(response)
            })
        })
    },

    getConversations (page) {
        return new Promise((resolve, reject) => {
            axios.get('/webapi/conversations?page=' + page).then((response) => {
                resolve(response)
            })
        })
    },

    getConversation (id) {
        return new Promise((resolve, reject) => {
            axios.get(`/webapi/conversations/${id}`).then((response) => {
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
    },

    storeConversation (payload) {
        return new Promise((resolve, reject) => {
            axios.post(`/webapi/conversations`, payload).then((response) => {
                resolve(response)
            }).catch((errors) => {
                reject(errors)
            })
        })
    },

    addUsersInConversation (payload) {
        return new Promise((resolve, reject) => {
            axios.post(`/webapi/conversations/${payload.id}/users`, payload).then((response) => {
                resolve(response)
            }).catch((errors) => {
                reject(errors)
            })
        })
    }
}