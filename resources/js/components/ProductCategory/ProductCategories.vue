<template>
    <div>
        <!-- <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="product_category in product_categories"
                    :key="product_category.id"
                >
                    <td>{{ product_category.id }}</td>
                    <td>{{ product_category.title }}</td>
                    <td>{{ product_category.slug }}</td>
                    <td>{{ product_category.description }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link
                                :to="{
                                    name: 'product_category.edit',
                                    params: {
                                        id: product_category.id
                                    },
                                }"
                                class="btn btn-primary"
                                >Edit</router-link
                            >
                            <button
                                class="btn btn-danger"
                                @click="
                                    deleteProductCategory(product_category.id)
                                "
                            >
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table> -->
        <div v-if="type_of_content === 'table-content'" class="table-content">
            <div class="top-nav">
                All Product Categories
                <div>
                    <a href="#" @click.prevent="typeOfContent('add-content')" class="add-new">Add New Product Category</a>
                    <a
                        class="nav-item nav-link"
                        style="cursor: pointer"
                        @click.prevent="logout"
                        >Logout</a
                    >
                </div>
            </div>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                <tr v-for="product_category in product_categories" :key="product_category.id">
                    <td>{{ product_category.id }}</td>
                    <td>{{ product_category.title }}</td>
                    <td>{{ product_category.slug }}</td>
                    <td>{{ product_category.description }}</td>
                    <td>
                        <a href="#" @click.prevent="typeOfContent('edit-content', product_category.id)" class="add-new">Edit</a>
                        <button @click="deleteProductCategory(product_category.id)" class="delete">Delete</button>
                    </td>
                </tr>
            </table>
        </div>

        <div v-if="type_of_content === 'add-content'" class="add-content">
            <h4 class="text-center">Add Product Category</h4>
            <div class="row">
                <div class="col-md-6">
                    <form @submit.prevent="addProductCategory">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" v-model="product_category.title">
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control" v-model="product_category.slug">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control" v-model="product_category.description">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Product Category</button>
                    </form>
                </div>
            </div>
        </div>

        <div v-if="type_of_content === 'edit-content'" class="edit-content">
            <h4 class="text-center">Edit Product Category</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group btn-danger p-2" v-if="error">
                        {{ this.error }}
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" v-model="product_category.title">
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control" v-model="product_category.slug">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="description" class="form-control" v-model="product_category.description">
                    </div>
                    <button :disabled='getError()' type="submit" @click.prevent="updateProductCategory" class="btn btn-primary">Update Product Category</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import api from '../../api'
export default {
    data() {
        return {
            product_categories: [],
            type_of_content: 'table-content',
            product_category: {
                title: '',
                slug: '',
                description: ''
            }
        };
    },

    mounted() {
        this.getProductCategories();
    },

    methods: {
        getProductCategories() {
            api.get("/api/product_categories")
                .then((response) => {
                    this.product_categories = response.data;
                })
                .catch(function (error) {
                    return Promise.reject(error);
                });
        },

        addProductCategory() {
            api.post('/api/product_categories/add', this.product_category)
                .then(response => {
                    this.emitter.emit("get-item", 'product-categories');
                    this.typeOfContent('table-content')
                    this.getProductCategories()
                    this.product_category.title = null
                    this.product_category.slug = null
                    this.product_category.description = null
                })
                .catch(function (error) {
                    console.log(error.response)
                    return Promise.reject(error);
                });
        },

        deleteProductCategory(id) {
            api.delete(`/api/product_categories/delete/${id}`)
                .then((response) => {
                    this.getProductCategories();
                })
                .catch(function (error) {
                    return Promise.reject(error);
                });
        },

        logout() {
            this.$parent.$parent.$parent.$parent.logout();
        },

        typeOfContent(type, id) {
            this.type_of_content = type

            if(type === 'add-content') {
                this.$router.push({ path: '/admin-panel/product-categories/add' })
            }

            if(type === 'table-content') {
                this.$router.push({ path: '/admin-panel/product-categories' })
            }

            if(type === 'edit-content') {
                this.$router.push({ path: `/admin-panel/product-categories/${id}/edit` })
            }
        }
    },

};
</script>
