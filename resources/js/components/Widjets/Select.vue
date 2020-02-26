<template>
    <div class="container-fluid">
        <div class="row form-group">
            <select class="mySelect col-md-12 custom-select" required>
                <option class="myOption" v-for="item in data" v-bind:key="item.id" :value=item.value>{{ item.name }}</option>
            </select>
            <div class="invalid-feedback">Поле не выбрано.</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data'],
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