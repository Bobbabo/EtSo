<template>
    <div>
        <h5>Did you find this information to be reliable?</h5>
        <button class="btn btn-primary ml-4" @click="yes">Yes</button>
        <button class="btn btn-primary ml-4" @click="no">No</button>
    </div>
</template>

<script>
    export default {
        props: ['postId', 'answer'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function () {
            return {
                status: this.likes,
            }
        },

        methods: {
            yes() {
                axios.post('/like/' + this.postId)
                    .then(response => {
                        this.status = ! this.status;
                    })
                    .catch(errors => {
                        if (errors.response.status == 401) {
                            window.location = '/login';
                        }
                    });
            },
            no(){
                axios.post('/like/' + this.postId)
                    .then(response => {
                        this.status = ! this.status;
    
                    })
                    .catch(errors => {
                        if (errors.response.status == 401) {
                            window.location = '/login';
                        }
                    });
            }
        }
    }
</script>
