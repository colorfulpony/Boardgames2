import {createApp} from 'vue'

require('./bootstrap')
import Index from './Index'
import axios from 'axios'
import router from './router'
import mitt from 'mitt';

const emitter = mitt();

const app = createApp(Index)
app.config.globalProperties.$axios = axios;
app.config.globalProperties.emitter = emitter;
app.use(router)
app.mount('#app')
