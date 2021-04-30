<template>
    <div class="conversation">
        <img src="" class="rounded-circle" style="width:150px">
        <h1>{{contact ? contact.name : 'Select Contact'}}</h1>
        <Messagesfeed :contact="contact" :messages="messages"/>
        <MessageComposer @send="sendMessage" />
    </div>
</template>


<script>
    import Messagesfeed from './Messagesfeed';
    import MessageComposer from './MessageComposer';
import Axios from 'axios';

    export default{
        props:{
            contact:{ 
                type:Object,
                default: null
            },
            messages:{
                type:Array,
                default:[]
            }
        },
        methods: {
            sendMessage(text){
                if(!this.contact) {
                    return;
                }

                Axios.post('/conversation/send',{
                    contact_id: this.contact.id,
                    text: text
                }).then(response=>{
                    this.$emit('new', response.data);
                })
            }
        },
        components:{Messagesfeed,MessageComposer}
    }
</script>

<style lang="scss" scoped>
.conversation {
    flex: 5;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    h1 {
        font-size: 20px;
        padding: 10px;
        margin: 0;
        border-bottom: 1px dashed lightgray;
    }
}
</style>