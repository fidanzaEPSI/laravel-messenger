<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <conversations></conversations>
            <conversation-form></conversation-form>
        </div>
        <div class="col">
            <conversation :id="id"></conversation>
        </div>
    </div>
</div>
</template>

<script>
    import api from '@/store/api/all'

    export default {
        props: {
            'id': {
                default: null,
                type: Number
            }
        },
        mounted () {
            api.getCurrentUser().then((response) => {
                this.$store.commit('conversations/setCurrentUser', response.data.data)
            })
        }
    }
</script>


