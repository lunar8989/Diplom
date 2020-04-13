<template>
    <div class="container-fluid">
        <div class="row form-group" style="height: 50px; margin: 0;">
            <select  class="selectpicker mySelect col-12 " data-title="выберите из списка" data-size="5" data-live-search="true" v-model="selected" style="height: 50px">
                <option class="myOption" v-for="item in data" :key="item.id" :value=item.name>{{ item.name }}</option>
            </select>
        
        </div>
    </div>
</template>

<script>
    export default {
        props: ['value', 'data'],
        data() {
            return{
            
            }
        },
        mounted(){
            $(document).ready(function() {
                $('.mySelect').selectpicker ();
                $('.dropdown-toggle').addClass('my_height');
            });
        },
        updated () {
            $('.mySelect').selectpicker('refresh')
        },
        computed: {
            selected: {
                get(){ return this.value },
                set(v){ this.$emit('input', v) }
            }
        },
    }
</script>

<style scoped>
    .mySelect{
        height: 50px !important;
    }

    .myOption:hover{
        background-color: #FF6200;
        color: white;
    }

    .my_height{
        height: 50px !important;
    }

</style>