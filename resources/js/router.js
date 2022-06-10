import Cookies from "js-cookie";
import {createWebHistory, createRouter} from "vue-router";
import AdminSidebarVue from "./components/Admin/AdminSidebar.vue";
import AdminControllerVue from "./components/Admin/AdminContent.vue";
import AddProductCategoryVue from "./components/ProductCategory/AddProductCategory.vue";

export const routes = [
    {
        path: '/admin-panel/:any/:type',
        component: () => import('./components/Admin/AdminIndex'),
        name: 'admin_panel',
        alias: ['/admin-panel/:any:type'],
        children: [
            // {
            //   // UserProfile will be rendered inside User's <router-view>
            //   // when /user/:id/profile is matched
            //   path: '/add',
            //   component: AddProductCategoryVue,
            // },
            // {
            //     path: '/admin-panel/:any/add',
            //     component: () => import('./components/ProductCategory/AddProductCategory'),
            //     name: 'product_category.add',
            // },
            // {
            //   // UserPosts will be rendered inside User's <router-view>
            //   // when /user/:id/posts is matched
            //   path: 'posts',
            //   component: AdminSidebarVue,
            // },
          ],
    },

    {
        path: '/',
        component: () => import('./Index'),
        name: 'index'
    },

    {
        path: '/user',
        component: () => import('./components/Pages/User'),
        name: 'user'
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
        path: '/product_categories',
        component: () => import('./components/ProductCategory/ProductCategories'),
        name: 'product_categories'
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
    const userRoleId = localStorage.getItem('USER_ROLE_ID')

    if(userRoleId == 3 && from.name === 'login') {
        if(to.name === 'dashboard') {
            return next()
        }
        next({
            name: 'dashboard'
        })
    }

    if(!xsrfToken) {
        if(to.name === 'login' || to.name === 'register' || to.name === 'main'){
            return next()
        }
        next({
            name: 'login'
        })
    }

    if(userRoleId == 2) {
        if(to.name === 'product_categories') {
            return next({
                name: 'user'
            })
        }
    }

    if(userRoleId == 2 && to.name === 'index'){
        return next({
            name: 'user'
        })
    }


    next()
})

export default router;
