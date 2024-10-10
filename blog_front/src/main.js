import './assets/main.css';

import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const app = createApp(App)
app.use(toast)
app.use(router)

app.mount('#app')
