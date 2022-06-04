<template>
    <div>
        <h4 class="text-center">All Product Categories</h4>
        <br />
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Updated At</th>
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
                    <td>{{ product_category.created_at }}</td>
                    <td>{{ product_category.updated_at }}</td>
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
        </table>

        <button
            type="button"
            class="btn btn-info"
            @click.prevent="this.$router.push('/product_categories/add')"
        >
            Add Product Category
        </button>
    </div>
</template>

<script>
import api from '../../api'
export default {
    data() {
        return {
            product_categories: [],
        };
    },

    mounted() {
        this.getProductCategories();
    },

    methods: {
        getProductCategories() {
            api.get("/api/product_categories")
                .then((response) => {
                    console.log(response)
                    this.product_categories = response.data;
                })
                .catch(function (error) {
                    return Promise.reject(error);
                });
        },

        deleteProductCategory(id) {
            api.delete(`/api/product_categories/delete/${id}`)
                .then((response) => {
                    let i = this.product_categories
                        .map((item) => item.id)
                        .indexOf(id); // find index of your object
                    this.product_categories.splice(i, 1);
                })
                .catch(function (error) {
                    return Promise.reject(error);
                });
        },
    },

};
</script>
