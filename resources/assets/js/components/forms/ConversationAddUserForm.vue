<template>
    <div class="col-2 my-4 text-right">
        <!-- Actions -->
        <ul class="list-unstyled">
            <li class="list-item my-2">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addUsersModal">Add participants</button>
            </li>
            <li class="list-item my-2">
                <button class="btn btn-danger" @click.prevent="addUser">Delete conversation</button>
            </li>
        </ul>

        <!-- Modal -->
        <div class="modal fade" id="addUsersModal" tabindex="-1" role="dialog" aria-labelledby="addUsersModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUsersModalCenterTitle">Adding participants</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" @submit.prevent="submit">
                    <div class="form-group">
                        <input type="text" id="add-users" class="form-control" :class="{ 'is-invalid': errors.recipients }" placeholder="Start typing to find a user...">
                    </div>

                    <ul class="list-inline" v-if="recipients.length">
                        <li class="list-inline-item" v-for="recipient in recipients" :key="recipient.id">
                            {{ recipient.name }} [<a href="#" @click.prevent="removeRecipient(recipient)">x</a>]
                        </li>
                    </ul>

                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Add</button>
                        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    import { usersAutocomplete } from '@/helpers'
    import { mapActions, mapGetters } from 'vuex'
    import { isEmpty } from 'lodash'

    export default {
        mounted () {
            var users = usersAutocomplete('#add-users').on('autocomplete:selected', (e, selection) => {
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
                'addConversationUsers': 'conversations/addConversationUsers'
            }),
            submit () {
                let recipients = this.recipients.map(item => item.id)
                let payload = { recipients }
                this.addConversationUsers({ payload, context: this}).then(() => {
                    $('#addUsersModal').modal('hide')
                }).catch((errors) => {
                    //
                })
            }
        },
        data () {
            return {
                recipients: [],
                errors: []
            }
        }
    }
</script>

