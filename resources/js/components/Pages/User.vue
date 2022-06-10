<template>
    <div>
        User
        <a class="nav-item nav-link" style="cursor: pointer" @click.prevent="logout">Logout</a>
    </div>
</template>

<script>
import api from '../../api'
export default {
    name: "Home",
    data() {
        return {
            users: []
        }
    },

    methods: {
        logout() {
            this.$parent.$parent.logout();
        },
    },
}
</script>
