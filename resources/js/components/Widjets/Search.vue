<template>
    <div id="searchBox">
        <input  type="text" v-on:keyup.13="checkInput" v-model="value" placeholder="Поиск.."/>
        <button @click="searching" >
            <i class="fa fa-search"></i>
        </button>
    </div>
</template>

<script>

    export default {
        props:['searchShow'],
        data() {
            return{
                value: '',
            }
        },
        methods: {
            searching(){
                this.$router.push({ name: 'Searching', params: { filters: { value: this.value } } });
            },
            checkInput(e){
                this.$router.push({ name: 'Searching', params: { filters: { value: this.value } } });
            },
        },
    }

</script>

<style scoped lang="scss">
    
    $size: 50px;

    #searchBox{
        display: flex;
        background: linear-gradient(to bottom, #fff, rgba(255, 106, 0, 0.65));
        border-radius: $size;
        width: 60px;
        padding: 5px;
        transition: .4s;
        &:hover{
            width: 300px;
            input{
                width: 250px;
                padding: 0 10px;
            }
            button{
                background-color: #fff;
            }
        }
        
        input{
            border: none;
            background: none;
            outline: none;
            padding: 0;
            font-size: 18px;
            color: #fff;
            width: 0;
            transition: .4s;
        }
        button{
            color: #FF6200;
            width: $size;
            height: $size;
            border-radius: 50%;
            border: none;
            background-color: #333;
            font-size: 20px;
            cursor: pointer;
            transition: .4s;
        }
    }
    
    @media(max-width: 1024px) {
        #searchBox{
            width: 40px;
            height: 40px;
            button{
                width: 30px;
                height: 30px;
            }
        }
    }
</style>