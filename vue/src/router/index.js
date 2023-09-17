import {createRouter, createWebHistory} from 'vue-router';
import Home from '../views/Home.vue'
import Stats from '../views/Stats.vue'
import RedirectComponent from '../views/RedirectComponent.vue'
const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },

    {
        path: '/stats',
        name: 'Statistics',
        component: Stats
    },
    {
    path: '/:shortUrl',
    component: RedirectComponent,
    }
];
const router = createRouter({
    history: createWebHistory(),
    routes
})
export default router;
