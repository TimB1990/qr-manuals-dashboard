<template>
    <div class="container">
        <div class="flex-container">
            Select a product to view details...
        </div>
        
    </div>
</template>

<script>

import moment from 'moment';

export default {

    components: { },

    data() {
        return{

            // TODO     
        }
    },

    filters: {

        ago(date){

            // date is being piped trough by status.created_at | ago
            // created_at is a date
            // return moment(date).fromNow();

        }
    },
}
</script>

<style scoped>
.flex-container{
    display: flex;
    color: lightgrey;
    border-radius:6px;
    font-size: 28px;
    border: 1px solid lightgrey;
    height: 100%;
    justify-content: center;
    align-items: center;
}

</style>