<template>
    <div v-if="loading">
        <!-- Loader -->
        <div class="loader" >
            Loading...
        </div>
    </div>
    <div v-else-if="conversation">
        <div class="card conversation">
            <div class="card-header my-0">
                <!-- Participants -->
                <ul class="list-inline" v-if="conversation.users.length">
                    <li class="list-inline-item"><strong> Participants: </strong></li>
                    <li class="list-inline-item" v-for="user in conversation.users" :key="user.id"> {{ user.name }}</li>
                </ul>
            </div>
            <div class="card-body border-bottom overflow-auto h-50 d-inline-block mb-6">
                <!-- Conversation -->
                <ul class="list-unstyled">
                    <!-- Replies -->
                    <li class="media my-4" v-for="conversation in conversation.replies" :key="conversation.id">
                        <img :src="conversation.user.avatar" class="align-self-center mr-3" alt="avatar">
                        <div class="media-body">
                            <p class="mt-0 mb-2"> {{ conversation.user.name }} &bull; {{ conversation.created_at }}</p>
                            {{ conversation.body }}
                        </div>
                    </li>
                    <!-- Initial message -->
                    <li class="media my-4">
                        <img :src="conversation.user.avatar" class="align-self-center mr-3" alt="avatar">
                        <div class="media-body">
                            <p class="mt-0 mb-2"> {{ conversation.user.name }} &bull; {{ conversation.created_at }}</p>
                            {{ conversation.body }}
                        </div>
                    </li>
                </ul>
            </div>
            <!-- Form reply -->
            <conversation-reply-form></conversation-reply-form>
        </div>
    </div>
    <div v-else>Pick up a conversation or create one</div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'
    import { isNull } from 'lodash'

    export default {
        props: {
            'id': {
                default: null,
                type: Number
            }
        },
        computed: mapGetters({
            conversation: 'conversations/getCurrentConversation',
            loading: 'conversations/loadingConversation'
        }),
        methods: {
            ...mapActions({
                'getConversation': 'conversations/getConversation'
            })
        },
        mounted () {
            if (!isNull(this.id)) {
                // this.$store.dispatch('conversations/getConversation', this.id) // Alternative syntax without mapping actions
                this.getConversation(this.id)
            }
        }
    }
</script>

<style lang="scss">
    .conversation {
        max-height: 800px;
    }
</style>
