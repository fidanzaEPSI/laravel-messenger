<template>
    <div class="card my-2">
        <div class="card-header">
            Create a new conversation
        </div>
        <div class="card-body">
            <form action="#">
                <div class="form-group">
                    <label for="search">Search users :</label>
                    <div class="input-group">
                        <input type="text" id="users" class="form-control" placeholder="Start typing to find a user...">
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import { usersAutocomplete } from '@/helpers'

    export default {
        
        mounted () {
            usersAutocomplete('#users')
        }
    }
</script>
