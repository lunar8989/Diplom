<template>
    <div class="container-fuild">
        <div class="row">
            <div v-for="article in articles" v-bind:key="article.id" class="col-sm-3">
                <a :href=article.url><img :src=article.img alt=""></a>
                <img :src=article.category.img >
                <h2>{{ article.name }}</h2>
                <p>{{ article.description }}</p>
                <h4>{{ article.autor.сity }}</h4>
                <h3>{{ article.price }}</h3>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['articles'],
    data() {
        return{

        }
    }
}
</script>

<style scoped>

</style>