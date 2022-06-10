<template>
    <div>
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
</template>

<script>
import api from '../../api'
export default {
    data() {
        return {
            product_category: {},
            error: null
        }
    },

    created() {

    },

    mounted() {
        api.get(`/api/product_categories/edit/${this.$route.params.id}`)
            .then(response => {
                console.log(response)
                this.product_category = response.data;
            })
            .catch(error => {
                console.log(error.response.data)
                this.error = error.response.data
                return Promise.reject(error)
            });
    },

    methods: {
        updateProductCategory() {
            api.post(`/api/product_categories/update/${this.$route.params.id}`, this.product_category)
                .then(response => {
                    this.$router.push({name: 'product_categories'});
                })
                .catch(function (error) {
                    return Promise.reject(error);
                });
        },

        getError() {
            return this.error
        }
    },
}
</script>
