<template>
    <div class="container-fluid">
        <div class="row map">
            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Af6ae083b50a304ab79a73785a08937109905d8097651f9139a4a5962fa723a25&amp;source=constructor" width="100%" height="700" frameborder="1"></iframe>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Map",
    }
</script>

<style scoped>
    .map{
        margin-top: 3vh;
        background-color: white;
        color: black;
        padding-right: 5%;
        padding-left: 5%;
        padding-bottom: 2%;
    }
    .maptitle{
        margin: 3vh;
        margin-left: 5%;
        border-left: 4px solid #FF6200;
        font-size: 40px;
    }
</style>
