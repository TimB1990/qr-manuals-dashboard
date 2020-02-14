<template>
    <div class="container">

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
            return moment(date).fromNow();

        }

    },
}
</script>  