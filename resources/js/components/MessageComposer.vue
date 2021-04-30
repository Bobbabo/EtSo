<template>
    <div class="composer">
        <textarea v-model="message" @keydown="send" placeholder="Message..."></textarea>
    </div>
</template>


<script>
    export default{
        data(){
            return{
                message: ''
            }
        },

        methods: {
            send(e) {
                if (e.keyCode === 13 && !e.shiftKey) {
                    e.preventDefault();
                    this.submitForm();
                }
            },
            submitForm() {
               if (this.message == '') {
                    return;
                }
                this.$emit('send', this.message);
                this.message = '';
            }
        }
        
    }
</script>

<style lang="scss" scoped>
.composer textarea {
    width: 96%;
    margin: 10px;
    resize: none;
    border-radius: 3px;
    border: 1px solid lightgray;
    padding: 6px;
}
</style>