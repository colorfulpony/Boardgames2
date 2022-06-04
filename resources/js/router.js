import Cookies from "js-cookie";
import {createWebHistory, createRouter} from "vue-router";

export const routes = [
    {
        path: '/',
        component: () => import('./components/Pages/Home'),
        name: 'home'
    },

    {
        path: '/about',
        component: () => import('./components/Pages/About'),
        name: 'about'
    },

    {
        path: '/register',
        component: () => import('./components/Pages/Register'),
        name: 'register'
    },

    {
        path: '/login',
        component: () => import('./components/Pages/Login'),
        name: 'login'
    },

    {
        path: '/dashboard',
        component: () => import('./components/Pages/Dashboard'),
        name: 'dashboard'
    },

    {
        path: '/product_categories',
        component: () => import('./components/ProductCategory/ProductCategories'),
        name: 'product_categories'
    },

    {
        path: '/product_categories/add',
        component: () => import('./components/ProductCategory/AddProductCategory'),
        name: 'product_category.add'
    },

    {
        path: '/product_categories/edit/:id',
        component: () => import('./components/ProductCategory/EditProductCategory'),
        name: 'product_category.edit'
    },

]

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

router.beforeEach((to, from, next) => {
    const xsrfToken = localStorage.getItem('X_XSRF_TOKEN')

    if(!xsrfToken) {
        if(to.name === 'login' || to.name === 'register' || to.name === 'home' || to.name === 'about'){
            return next()
        }
        next({
            name: 'login'
        })
    }

    if((to.name === 'login' || to.name === 'register') && xsrfToken) {
        return next({
            name: 'dashboard'
        })
    }

    next()
})

export default router;
