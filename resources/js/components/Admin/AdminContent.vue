<template>
    <div>
        <!-- <div v-if="item == ''" class="content">
            <div class="top-nav">
                User
                <div>
                    <a class="nav-item nav-link"
                        style="cursor: pointer"
                        @click.prevent="logout"
                        >Add New Product Category
                    </a>

                    <router-link :to="{ path : '/product_categories/add'}">Add</router-link>
                    <a
                        class="nav-item nav-link"
                        style="cursor: pointer"
                        @click.prevent="logout"
                        >Logout
                    </a>
                </div>
            </div>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Nickname</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Admin</td>
                    <td>admin@gmail.com</td>
                    <td>Admin</td>
                    <td>
                        <button class="edit">Edit</button>
                        <button class="delete">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>User</td>
                    <td>user@gmail.com</td>
                    <td>User</td>
                    <td>
                        <button class="edit">Edit</button>
                        <button class="delete">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>User2</td>
                    <td>user2@gmail.com</td>
                    <td>User</td>
                    <td>
                        <button class="edit">Edit</button>
                        <button class="delete">Delete</button>
                    </td>
                </tr>
            </table>
        </div> -->
        <div v-if="item === 'product-categories'" class="content">
            <ProductCategories />
        </div>
        <div v-if="item === 'dashboard'" class="dashboard content">
            Dashboard
        </div>
    </div>
</template>

<script>
import ProductCategories from '../ProductCategory/ProductCategories.vue'
import api from "../../api";
export default {
    name: "AdminContent",

    components: {
        ProductCategories
    },

    data() {
        return {
            item: ''
        };
    },

    mounted() {
        this.item = 'dashboard'
        this.emitter.on("get-item", item => {
            if(item == 'product-categories'){
                this.$router.push({ path: '/admin-panel/product-categories' })
                this.item = item
            }

            if(item == 'dashboard'){
                this.$router.push({ path: '/admin-panel/dashboard' })
                this.item = item
            }
        })
    },

    // updated() {
    //     this.emitter.on("get-item", item => {
    //         if(item == 'product-categories'){
    //             this.$router.replace({ path: '/product-categories'})
    //             this.item = item
    //             console.log(item)
    //             console.log(this.$router.replace({ path: '/product-categories'}))
    //         }

    //         if(item == 'dashboard'){
    //             this.item = item
    //             console.log(item)
    //             this.$router.replace({ path: '/dashboard'})
    //         }
    //     })
    // },

    methods: {
        logout() {
            this.$parent.$parent.$parent.logout();
        },
    },
};
</script>

<style scoped></style>
