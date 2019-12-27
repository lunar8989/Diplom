<template>
    <div class="container-fluid">
        <div class="row">
            <select class="mySelect col-md-12">
                <option class="myOption" v-for="item in options" v-bind:key="item.id" :value=item.value>{{ item.name }}</option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['options'],
        data() {
            return{

            }
        }
    }
</script>

<style scoped>
    .mySelect{
        height: 50px;
    }

    .myOption:hover{
        background-color: #FF6200;
        color: white;
    }

</style>