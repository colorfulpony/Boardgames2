import {createApp, defineCustomElement} from 'vue'

require('./bootstrap')
import Index from './Index'
import axios from 'axios'
import router from './router'
import mitt from 'mitt';
import AdminIndex from './components/Admin/AdminIndex.vue'
import AdminContent from './components/Admin/AdminContent.vue'
import AdminSidebar from './components/Admin/AdminSidebar.vue'

const adminIndex = defineCustomElement(AdminIndex);
const adminContent = defineCustomElement(AdminContent);
const adminSidebar = defineCustomElement(AdminSidebar);
const emitter = mitt();

customElements.define('admin-index', adminIndex)
customElements.define('admin-content', adminContent)
customElements.define('admin-sidebar', adminSidebar)
const app = createApp(Index)
// app.component('AdminIndex', AdminIndex);
app.config.globalProperties.$axios = axios;
app.config.globalProperties.emitter = emitter;
app.use(router)
app.mount('#app')
