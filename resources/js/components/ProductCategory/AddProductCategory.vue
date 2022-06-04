<template>
    <div>
        <h4 class="text-center">Add Product Category</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addProductCategory">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" v-model="product_category.title">
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" class="form-control" v-model="product_category.slug">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" v-model="product_category.description">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product Category</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import api from '../../api'
export default {
    data() {
        return {
            product_category: {}
        }
    },

    methods: {
        addProductCategory() {
            api.post('/api/product_categories/add', this.product_category)
                .then(response => {
                    this.$router.push({name: 'product_categories'})
                })
                .catch(function (error) {
                    return Promise.reject(error);
                });
        }
    },
}
</script>
