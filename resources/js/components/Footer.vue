<template>
    <div id="footer">
        <div id="copyright">
            <span>©2020. Все права защищены. ООО"Дай-Лапу"</span>
        </div>
        <div class="contact">
            <span>Контакты: <a href="tel: +79507907366" style="white-space: nowrap">+7(950)790-73-66</a></span>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
            
            }
        },
    }
</script>

<style scoped lang="scss">
    span{
        font-size: 20px;
    }
    
    #footer{
        width: 100%;
        display: flex;
        background-color: #333333;
        color: white;
    }
    
    #copyright{
        padding: 15px;
        flex: 0 0 60%;
    }

    .contact{
        flex: 0 0 40%;
        padding: 15px;
        text-align: right;
    }

    @media(max-width: 800px) {
        span{
            font-size: 16px;
        }
    }

    @media(max-width: 650px) {
        span{
            font-size: 14px;
        }
    }

    @media(max-width: 560px) {
        span{
            font-size: 12px;
        }
    }

    @media(max-width: 500px) {
        span{
            font-size: 10px;
        }
    }
</style>
