import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router/route'; // Import your router configuration
import axios from 'axios';
import '../../resources/css/app.css';


// const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// // Set CSRF token in Axios headers
// axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

// Set Axios base URL if needed (usually Laravel's base URL)
// axios.defaults.baseURL = process.env.MIX_APP_URL || 'http://127.0.0.1:8000';

// // Optionally, add other default configurations
// axios.defaults.headers.common['Accept'] = 'application/json';


const app = createApp(App);

app.use(router); // Use the router
app.mount('#app');

export { axios };
