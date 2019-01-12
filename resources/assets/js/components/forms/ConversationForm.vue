<template>
    <div class="card my-2">
        <div class="card-header">
            Create a new conversation
        </div>
        <div class="card-body">
            <form action="#" @submit.prevent="submit">
                <div class="form-group" :class="{ 'is-invalid': errors.recipients }">
                    <label for="users">Search users :</label>
                    <div class="input-group">
                        <input type="text" id="users" class="form-control" :class="{ 'is-invalid': errors.recipients }" placeholder="Start typing to find a user...">
                        <div class="invalid-feedback d-block" v-if="errors.recipients">
                            {{ errors.recipients[0] }}
                        </div>
                    </div>
                </div>

                <ul class="list-inline" v-if="recipients.length">
                    <li class="list-inline-item"><strong>To:</strong></li>
                    <li class="list-inline-item" v-for="recipient in recipients" :key="recipient.id">
                        {{ recipient.name }} [<a href="#" @click.prevent="removeRecipient(recipient)">x</a>]
                    </li>
                </ul>

                <div class="form-group" :class="{ 'is-invalid': errors.body }">
                    <label for="message">Message</label>
                    <div class="input-group">
                        <textarea id="message" cols="20" rows="2" class="form-control" :class="{ 'is-invalid': errors.body }" v-model="body"></textarea>
                        <div class="invalid-feedback" v-if="errors.body">
                            {{ errors.body[0] }}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Send message</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import { usersAutocomplete } from '@/helpers'
    import { mapActions, mapGetters } from 'vuex'
    import { isEmpty } from 'lodash'

    export default {
        
        mounted () {
            var users = usersAutocomplete('#users').on('autocomplete:selected', (e, selection) => {
                this.addRecipient(selection)
                users.autocomplete.setVal('')
            })
        },
        methods: {
            addRecipient (recipient) {
                let existingRecipient = this.recipients.find((item) => {
                    return item.id === recipient.id
                })

                if (!isEmpty(existingRecipient)) {
                    return 
                }

                this.recipients.push(recipient)
            },
            removeRecipient (recipient) {
                let recipients = this.recipients.filter((item) => {
                    return item.id !== recipient.id
                })

                this.recipients = recipients
            },
            ...mapActions({
                'storeConversation': 'conversations/storeConversation'
            }),
            submit () {
                let recipients = this.recipients.map(item => item.id)
                let payload = { body: this.body, recipients }
                this.storeConversation({ payload, context: this}).then(() => {
                    this.recipients = []
                    this.body = null
                }).catch((errors) => {
                    //
                })
            }
        },
        data () {
            return {
                body: null,
                recipients: [],
                errors: []
            }
        },
    }
</script>
