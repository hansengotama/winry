import { createRouter, createWebHistory } from 'vue-router';
import Home from './../pages/Home.vue';
import AdminLayout from './../pages/admin/Layout.vue';
import AdminLogin from './../pages/admin/Login.vue';
import AdminManageGuess from './../pages/admin/ManageGuess.vue';
import AdminManageGuessGroup from './../pages/admin/ManageGuessGroup.vue';
import NotFound from './../pages/NotFound.vue';

const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/admin',
        component: AdminLayout,
        children: [
            {
                name: "Admin Login",
                path: '/admin/login',
                component: AdminLogin,
            },
            {
                name: "Admin Manage Guess",
                path: '/admin/manage-guess',
                component: AdminManageGuess,
            },
            {
                name: "Admin Manage Guess Group",
                path: '/admin/manage-guess-group',
                component: AdminManageGuessGroup,
            },
        ]
    },
    {
        path: '/:pathMatch(.*)*',
        component: NotFound
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router