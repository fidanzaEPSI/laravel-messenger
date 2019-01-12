<template>
    <div class="col-6 my-4">
        <form action="#" id="formReply" @submit.prevent="reply">
            <div class="form-group" :class="{ 'is-invalid': errors.body }">
                <div class="input-group">
                    <textarea @keydown="inputHandler" v-model.trim="body" cols="20" rows="4" class="form-control" :class="{ 'is-invalid': errors.body }" placeholder="Reply"></textarea>
                    <div class="invalid-feedback" v-if="errors.body">
                        {{ errors.body[0] }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit" class="btn btn-info">
            </div>
        </form>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'

    export default {
        data () {
            return {
                body: null,
                errors: []
            }
        },
        computed: mapGetters({
            conversation: 'conversations/getCurrentConversation',
        }),
        methods: {
            ...mapActions({
                'storeConversationReply': 'conversations/storeConversationReply'
            }),
            reply () {
                let payload = { id: this.conversation.id, body: this.body }
                this.storeConversationReply({ payload, context: this }).then(() => {
                    this.body = null
                }).catch((error) => {
                    // console.log(error.response.data);
                })
            },
            inputHandler(e) {
                if (e.keyCode === 13 && !e.shiftKey) {
                    e.preventDefault();
                    this.reply();
                }
            },
        }   
    }
</script>

