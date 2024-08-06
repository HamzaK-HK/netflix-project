import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router/route'; // Import your router configuration
import axios from 'axios';
import '../../resources/css/app.css';

// import '@stripe/stripe-js/dist/stripe.min.css';



const app = createApp(App);

app.use(router); // Use the router
app.mount('#app');

export { axios };
