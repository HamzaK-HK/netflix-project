import { createRouter, createWebHistory } from 'vue-router';

// Import your Vue components
// import About from '@/pages/About.vue'; // Adjust the path as needed
import Home from '../Pages/Home.vue' // Adjust the path as needed
import Admin from '../Pages/Admin.vue' // Adjust the path as needed
import Movies from '../Pages/Movies.vue' // Adjust the path as needed
import TVShows from '../Pages/TVShows.vue' // Adjust the path as needed
import Welcome from '../Pages/Welcome.vue'
// import Login from '../Pages/Auth/Login.vue'
// import Register from '../Pages/Auth/Register.vue'


const routes = [
    {
        path: '/',
        name: 'Welcome',
        component: Welcome,
    },
  {
    path: '/home',
    name: 'Home',
    component: Home,
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import('../Pages/Auth/Login.vue'),
  },
  {
    path: '/register',
    name: 'Register',
    component: () => import('../Pages/Auth/Register.vue'),
  },
  {
    path: '/admin',
    name: 'Admin',
    component: Admin,
  },
  {
    path: '/movies',
    name: 'Movies',
    component: Movies,
  },
  {
    path: '/tv-shows',
    name: 'TVShows',
    component: TVShows,
  }
//   {
//     path: '/about',
//     name: 'About',
//     component: About,
//   },
  // Add more routes here
];

const router = createRouter({
  history: createWebHistory(), // Make sure BASE_URL is correctly set in your Vite config
  routes,
});

export default router;
