import './assets/css/main.css'
import './assets/css/tailwind.css'


import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import axios from 'axios'
import { useStore } from './stores/useStore'

axios.defaults.baseURL = "http://localhost:8000"
axios.defaults.withCredentials = true

const app = createApp(App)

app.use(createPinia())
// app.use(router)

const store = useStore()

store.authenticate().then(() => {
    app
    .use(router)
    .mount('#app')
})


