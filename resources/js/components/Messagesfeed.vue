<template>
  <div class="feed" ref="feed"> 
      <ul v-if="contact">
          <li v-for="message in messages" :class="`message${message.to == contact.id ? ' sent':' received'}`" :key="message.id">
              <div class="text">
                  {{message.message}}
              </div>
          </li>

      </ul>
  </div>
</template>
 

<script>
    export default{
        props: {
            contact: {
                type: Object
            },
            messages: {
                type: Array,
                required: true,
            },
            methods: {
                scrollToBottom(){
                    console.log("here")
                    setTimeout(()=> {
                        this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                    }, 50);
                    
                },
                watch: {
                    contact(contact){
                        this.scrollToBottom();
                    },
                    messages(messages){
                        this.scrollToBottom();
                    }
                }
            }
        }
        
    }
</script>

<style lang="scss" scoped>
.feed {
    background: #f0f0f0;
    height: 100%;
    max-height: 470px;
    overflow: scroll;
    overflow-x: hidden;
    ul {
        list-style-type: none;
        padding: 5px;
        li {
            &.message {
                margin: 10px 0;
                width: 100%;
                .text {
                    max-width: 200px;
                    border-radius: 5px;
                    padding: 12px;
                    display: inline-block;
                }
                &.received {
                    text-align: left;
                    .text {
                        background: #94fa8e;
                        word-break:break-all;
                    }
                }
                &.sent {
                    text-align: right;
                    .text {
                        background: #81c4f9;
                        word-break:break-all;
                    }
                }
            }
        }
    }
}
</style>