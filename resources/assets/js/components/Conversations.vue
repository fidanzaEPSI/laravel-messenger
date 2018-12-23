<template>
    <p>Conversations</p>
</template>

<script>

    // Scaffolding api results
    // TODO use Vuex store mapping getters and actions

    export default {
        mounted () {
            axios.get('/webapi/conversations').then((response) => {
                this.conversations = response.data
            })
        },
        data () {
            return {
                conversations: []
            }
        }
    }
    
</script>

