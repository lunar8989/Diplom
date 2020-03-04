<template>
    <div class="container-fluid">
        <div id="search" class="row">
            <div id="searchBox" class="col-md-12" v-show="searchShow">
                <input class="col-md-10 searchInput"  type="text" name="search" placeholder="Поиск..">
                <button @click="searching" class="col-md-2" id="btnSearch" type="button">  
                    <i class="fa fa-search fa-2x" aria-hidden="true" style="color: white;"></i>
                </button> 
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props:['searchShow'],
        data() {
            return{
                
            }
        },
        methods: {
            searching: function(){
                var search = this.search.value;
            }
        },
    }

</script>

<style scoped>

    #searchBox{
        padding: 0;
    }
    
    .searchInput{
        height: 50px;
        float: left;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    .searchInput:focus{
        outline: none;
        border-bottom: 2px solid #FF6200;
    }

    #btnSearch{
        padding: 5px;
        height: 50px;
        background-color: #FF6200;
        border: none;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    #btnSearch:hover{
        background-color: gray;
    }
</style>