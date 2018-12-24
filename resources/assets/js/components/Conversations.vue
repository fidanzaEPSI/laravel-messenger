<template>
    <div class="card">
        <div class="card-header">
            All conversations
        </div>
        <div class="card-body">
            <div class="media" v-for="conversation in conversations" :key="conversation.id">
                <div class="media-body">
                    <a href="#">{{ conversation.body }}</a>
                    <p class="text-muted">
                        You and {{ conversation.participants_count }} others
                    </p>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <img class="img-fluid mx-2"
                                 :src="user.avatar" 
                                 :alt="`${user.name}\'s avatar`"
                                 :title="user.name"
                                 v-for="user in conversation.users" :key="user.id">
                        </li>
                        <li>
                            Last reply {{ conversation.last_reply }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'

    export default {
        mounted () {
            this.getConversations(1)
        },
        data () {
            return {
                //
            }
        },
        methods: {
            ...mapActions({
                getConversations: 'conversations/getConversations'
            }),
        },
        computed: mapGetters({
            conversations: 'conversations/getAllConversations'
        })
    }
    
</script>

