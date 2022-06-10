<template>
    <div>
        <admin-sidebar />
        <admin-content />
    </div>
</template>

<script>
import AdminContent from './AdminContent.vue'
import AdminSidebar from './AdminSidebar.vue'
export default {
    name: "AdminIndex",

    components: {
        AdminContent,
        AdminSidebar
    },

    data() {
        return {

        }
    },
}
</script>

<style scoped>

</style>
