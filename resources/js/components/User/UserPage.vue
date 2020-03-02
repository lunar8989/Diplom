<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <router-link :to="{ name : route.path }" :key="key" class="nav-link">{{route.name}}</router-link>
            </div>
            <div class="col-sm-12">
                <router-link :to="{ name : route.path }" :key="key" class="nav-link">{{route.name}}</router-link>
            </div>
            <div class="col-sm-12">
                <router-link :to="{ name : route.path }" :key="key" class="nav-link">{{route.name}}</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserPage",
        date(){
            return{
                routes: {
                    unlogged: [
                        { name: 'Register', path: 'register' },
                        { name: 'Login', path: 'login'}
                    ],
                    // LOGGED USER
                    user: [
                        { name: 'Dashboard', path: 'dashboard' }
                    ],
                    // LOGGED ADMIN
                    admin: [
                        { name: 'Dashboard', path: 'admin.dashboard' }
                    ]
                }
            }
        }
    }
</script>

<style scoped>

</style>