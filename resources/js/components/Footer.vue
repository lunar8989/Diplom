<template>
    <div class="container-fluid">
        <div class="row" id="footer">
            <div class="col-sm-12 row">
                <a href="#" class="col-sm-4"><img src="" alt=""></a>
                <div id="footerMenu" class="col-sm-8 row">
                    <a class="col" v-for="link in links" v-bind:key="link.id" :href=link.url>{{ link.value }}</a>
                </div>
            </div>
            <div id="widgets" class="col-sm-12 row">
                <div class="col" v-for="widget in widgets" v-bind:key="widget.id">
                    <h1>{{ widget.name }}</h1>
                    <p>{{ widget.description }}</p>
                </div>
            </div>
            <div class="col-sm-12 row">
                <div id="copyright" class="col-sm-4">
                    <h6>©2019. Все права защищены. ООО"Дай-Лапу"</h6>
                </div>
                <div id="socialLink" class="col-sm-6">
                    <i v-for="social in socials" v-bind:key="social.id" class="col"></i>
                </div>
                <div class="contact col-sm-2">
                    <h6>Контакты: <a href="tel: +79507907366">+7(950)790-73-66</a></h6>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                links: [
                    {url: '', value: ''},
                    {url: '', value: ''},
                    {url: '', value: ''},
                    {url: '', value: ''}
                ],
                widgets: [
                    {name: '', description: ''},
                    {name: '', description: ''},
                    {name: '', description: ''},
                    {name: '', description: ''}
                ],
                socials: [
                    {class: ''}
                ]
            }
        },
    }
</script>

<style scoped>
    #footer{
        background-color: #333333;
        color: white;
    }

    .contact{
        padding: 0;
    }
</style>
