<template>
    <div class="container">
        <div class="columns">
            <div class="column">
                <div class="message">
                    <div class="message-header">
                        <p>Home</p>
                    </div>
                    <div class="message-body">
                        <p>Welcome to home page</p>
                    </div>
                </div>
            </div>
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
            return moment(date).fromNow();

        }

    },
}
</script>  