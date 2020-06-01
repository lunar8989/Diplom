<template>
    <div class="chat_main container">
        <div class="messages_window">
            <div class="message" v-for="(message, index) in messages" :key="index" @click="getChatMessages(message.id)">
                <div class="message_author">
                    <span>{{ message.authorName }}</span>
                </div>
                <div class="message_value">
                    <span :class="{ 'new': message.status === 1, 'check': message.status === 0 }">{{ message.lastMessage }}</span>
                </div>
            </div>
        </div>
        
        <div class="chat_window">
            <div class="chat" v-if="message_status === true">
                <div class="chat_message"
                     v-for="(message, index) in chat_messages"
                     :key="index"
                     :class="{
                    'message__author': message.author === this.$auth.user.id,
                    'message__user': message.author !== this.$auth.user.id,
                 }"
                ><span class="chat_date">{{ message.date }}</span>
                    <b-avatar variant="info" :src="message.author.img" class="mr-3"></b-avatar>
                    <span class="chat_message">{{ message.message }}</span>
                </div>
                
                <div class="chat_input">
                    <input class="chat_input" type="text" :value="message.message" placeholder="Введите сообщение...">
                    <button class="chat_btn" @click="newMessage()">Отправить</button>
                </div>
            </div>
            
        </div>
        
    </div>
</template>

<script>
    export default {
        data(){
            return{
                messages:{},
                message: {
                    message: '',
                    date: '',
                    author: '',
                },
                chat_messages: {},
                message_status: false,
            }
        },
        mounted(){
            this.getMessages(this.$route.params.userId);
            this.getChatMessages(this.$route.params.messageId);
        },
        methods:{
            getMessages(id){
                axios.get('/getMessages', { params: { userId: id } })
                    .then(response => { this.messages = response.data;});
            },
            
            getChatMessages(id){
                axios.get('/getMessagesForChat', { params: { id: id } })
                    .then(response => { this.chat_messages = response.data;});
            },
            
            newMessage(){
                let data = new FormData();
    
                let now = new Date();
    
                this.message.date = now.getFullYear() + '-' + now.getMonth() + '-' + now.getDate();
                this.message.author = this.$auth.user.id;
                
                data.append('message', this.message);
                data.append('user', this.userId);
                
                let config = {
                    header : {
                        'Content-Type' : 'multipart/form-data'
                    }
                };
                
                axios.post('/updateMessages', data, config)
                    .then(response => {
                        this.messages.push({
                            message: this.message.message,
                            date: this.message.date,
                            author: this.$auth.user.id,
                        });
                    });
            },
        },
    };
</script>

<style lang="scss">
    
    .message__user, .message__author{
        width: 100%;
        display: flex;
    }
    
    .message__user{
        justify-content: flex-start;
    }

    .message__author{
        justify-content: flex-end;
    }
    
    .chat_main{
        width: 100%;
        height: 90vh;
        display: flex;
        justify-content: space-between;
    }
    
    .messages_window{
        flex: 0 0 20%;
        background-color: #fff;
        border: 1px solid #FF6200;
        padding: 5px;
        .message{
            padding: 15px;
            width: 100%;
            height: 80px;
            border-radius: 5px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            cursor: pointer;
            .message_author{
                width: 100%;
                height: 20px;
                display: flex;
                justify-content: flex-start;
                align-items: center;
                color: #FF6200;
                &::first-letter{
                    text-transform: uppercase !important;
                }
            }
            .message_value{
                span{
                    width: 100%;
                    font-size: 18px;
                    -webkit-line-clamp: 0.7;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    height: 1em;
                    text-overflow: ellipsis;
                    background-color: #fff;
                    color: #000;
                    &::first-letter{
                        text-transform: uppercase !important;
                    }
                    &::before{
                        content: '';
                        width: 10px;
                        height: 10px;
                        border-radius: 50%;
                        background-color: gray;
                        display: inline-block;
                        margin-right: 5px;
                    }
                    &.new{
                        &::before{
                            content: '';
                            width: 10px;
                            height: 10px;
                            border-radius: 50%;
                            background-color: #FF6200 !important;
                            display: inline-block;
                            margin-right: 5px;
                        }
                    }
                }
            }
        }
    }
    
    .chat_window{
        flex: 0 0 70%;
        background-color: #fff;
        border: 1px solid #FF6200;
        padding: 5px;
        .chat{
            height: 80vh;
            padding: 15px;
            .chat_message{
                width: 100%;
                display: flex;
            }
        }
    }

</style>
