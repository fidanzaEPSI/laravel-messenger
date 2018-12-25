<template>
    <div class="card">
        <div class="card-header">
            All conversations
        </div>
        <div class="card-body">
            <div class="loader" v-if="loading">
                Loading...
            </div>
            <div class="media" v-else-if="conversations.length" v-for="conversation in conversations" :key="conversation.id">
                <div class="media-body">
                    <a href="#" @click.prevent="getConversation(conversation.id)">{{ truncate(conversation.body, { length: 25 }) }}</a>
                    <p class="text-muted">
                        You and {{ conversation.participants_count }} {{ pluralize('other', conversation.participants_count )}}
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
            <div v-else>No conversations</div>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'
    import { truncate } from 'lodash'
    import pluralize from 'pluralize'

    export default {
        mounted () {
            this.getConversations(1)
        },
        methods: {
            ...mapActions({
                getConversations: 'conversations/getConversations',
                getConversation: 'conversations/getConversation'
            }),
            truncate,
            pluralize
        },
        computed: mapGetters({
            conversations: 'conversations/getAllConversations',
            loading: 'conversations/loadingConversations'
        })
    }
</script>

