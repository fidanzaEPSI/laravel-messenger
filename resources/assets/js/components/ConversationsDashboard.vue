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

    export default {
        props: {
            'id': {
                default: null,
                type: Number
            }
        }
    }
    
</script>


