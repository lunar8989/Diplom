<template>
    <div class="container-fluid">
        <div class="row">
        
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        name: "ArticlePage",
        data(){
            return{
                article:{ }
            }
        },
        mounted() {
            axios.get('/article/{' + this.id + '}')
                .then(response => {
                    this.article = response.data;
                });
        }
    }
</script>

<style scoped>

</style>