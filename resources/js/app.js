import { createApp } from 'vue';
import ElementPlus from 'element-plus';
//import 'element-plus/lib/theme-chalk/index.css';
import App from './components/App.vue';

const app = createApp(App);
app.use(ElementPlus);
app.mount('#app');
