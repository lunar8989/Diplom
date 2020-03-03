<template>
    <div class="container-fluid">
        <div class="row card card-default">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                User Dashboard
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Dashboard",
        data(){
            return{
                user:{},
            }
        },
        created() {
            axios.get('/users', { params: { id: this.$route.params.userId } })
                .then(response => { this.user = response.data; })
        }
    }
</script>

<style scoped>

</style>
