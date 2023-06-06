import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import Store from './store/store.js'
import router from './router'
import './index.css'

createApp(App).use(Store).use(router).mount('#app')
