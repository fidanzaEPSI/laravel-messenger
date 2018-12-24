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
    }
}