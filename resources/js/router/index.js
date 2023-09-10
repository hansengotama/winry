import { createRouter, createWebHistory } from 'vue-router';
import Home from './../pages/Home.vue';
import Test from './../pages/Test.vue';
import NotFound from './../pages/NotFound.vue';

const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/test',
        component: Test
    },
    {
        path: '/:pathMatch(.*)*',
        component: NotFound
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router