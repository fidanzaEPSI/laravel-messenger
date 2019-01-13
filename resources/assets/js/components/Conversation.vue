<template>
    <div v-if="loading">
        <!-- Loader -->
        <div class="loader" >
            Loading...
        </div>
    </div>
    <transition name="slide-fade" v-else-if="conversation">
        <div class="card conversation">
            <div class="card-header">
                <!-- Participants -->
                <ul class="list-inline my-0" v-if="conversation.users.length">
                    <li class="list-inline-item"><strong> Participants: </strong></li>
                    <li class="list-inline-item" v-for="user in conversation.users" :key="user.id"> {{ user.name }}</li>
                </ul>
            </div>
            <div class="card-body border-bottom overflow-auto">
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
            
            <div class="row justify-content-between mx-2">
                <!-- Form reply -->
                <conversation-reply-form></conversation-reply-form>
                <!-- Add user -->
                <conversation-add-user-form></conversation-add-user-form>
            </div>
        </div>
        </transition>
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
            loading: 'conversations/loadingConversation',
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

<style lang="scss" scoped>
    .conversation {
        max-height: 800px;
    }

    .slide-fade-enter-active {
        transition: all .5s ease;
    }

    .slide-fade-enter, .slide-fade-leave-to {
        transform: translateX(20px);
        opacity: 0;
    }
</style>
