<template>
    <div class="container">
        <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <span class="text-secondary">Laravel SPA with Vue 3, Auth (Sanctum), CURD Example</span>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav"  >
                <!-- for logged-in user-->
                    <router-link v-if="token" :to="{ name: 'dashboard' }" class="nav-item nav-link">Dashboard</router-link>
                    <a v-if="token" class="nav-item nav-link" style="cursor: pointer;" @click.prevent="logout">Logout</a>
                <!-- for logged-in admin user-->
                    <router-link v-if="token && userRole.admin" :to="{ name: 'product_categories' }" class="nav-item nav-link">Product Categories</router-link>
                <!-- for non-logged user-->
                    <router-link :to="{ name: 'home' }" class="nav-item nav-link">Home</router-link>
                    <router-link v-if="!token" :to="{ name: 'login' }" class="nav-item nav-link">login</router-link>
                    <router-link v-if="!token" :to="{ name: 'register' }" class="nav-item nav-link">Register</router-link>
                    <router-link :to="{ name: 'about' }" class="nav-item nav-link">About</router-link>
                </div>
            </div>
        </nav>
        <br/>
        <router-view></router-view>
    </div>
</template>

<script>
import api from './api'
export default {
    name: "Index",
    data() {
        return {
            token: null,
            userRole: {
                admin: null,
                user: null,
                guest: null,
            }
        }
    },

    mounted() {
        this.getToken()

        this.emitter.on("get-token-login", token => {
            this.getToken()
        })

        this.emitter.on("get-user-role_id", roleId => {
            console.log(roleId)
            this.checkUserRole()
        })

        this.checkUserRole()
    },

    methods: {
        getToken() {
            this.token = localStorage.getItem('X_XSRF_TOKEN')
        },

        logout() {
            api.post('/api/logout')
                .then(response => {
                    if (response.data.success) {
                        localStorage.removeItem('X_XSRF_TOKEN')
                        localStorage.removeItem('USER_ROLE_ID')
                        this.$router.push({name: 'home'});
                        this.getToken()
                        this.checkUserRole()
                    } else {
                        console.log(response)
                    }
                })
                .catch(function (error) {
                    console.error(error.response);
                });
        },

        checkUserRole() {
            let userRoleId = localStorage.getItem('USER_ROLE_ID')

            if(userRoleId == 1) {
                this.userRole.guest = 1
            } else {
                this.userRole.guest = 0
            }

            if(userRoleId == 2) {
                this.userRole.user = 1
            } else {
                this.userRole.user = 0
            }

            if(userRoleId == 3) {
                this.userRole.admin = 1
            } else {
                this.userRole.admin = 0
            }
        }
    },
}
</script>
