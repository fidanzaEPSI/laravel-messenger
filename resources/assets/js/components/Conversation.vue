<template>
    <div v-if="loading">
        <div class="loader" >
            Loading...
        </div>
    </div>
        <div class="card" v-else-if="conversation">
            <div class="card-body">
                <div class="card-title">
                    <ul class="list-inline" v-if="conversation.users.length">
                        <li class="list-inline-item"><strong> Participants: </strong></li>
                        <li class="list-inline-item" v-for="user in conversation.users" :key="user.id"> {{ user.name }}</li>
                    </ul>
                    <hr>
                </div>
                <ul class="list-unstyled">
                    <li class="media my-4" v-for="conversation in conversation.replies" :key="conversation.id">
                        <img :src="conversation.user.avatar" class="align-self-center mr-3" alt="avatar">
                        <div class="media-body">
                            <p class="mt-0 mb-2"> {{ conversation.user.name }} &bull; {{ conversation.created_at }}</p>
                            {{ conversation.body }}
                        </div>
                    </li>
                    <li class="media my-4">
                        <img :src="conversation.user.avatar" class="align-self-center mr-3" alt="avatar">
                        <div class="media-body">
                            <p class="mt-0 mb-2"> {{ conversation.user.name }} &bull; {{ conversation.created_at }}</p>
                            {{ conversation.body }}
                        </div>
                    </li>
                </ul>
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
