<template>
    <div class="col-6 my-4">
        <form action="#" @submit.prevent="reply">
            <div class="form-group">
                <textarea v-model="body" cols="30" rows="4" class="form-control" placeholder="Reply"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit" class="btn btn-info">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                body: null
            }
        },
        methods: {
            reply () {

            }
        }   
    }
</script>

