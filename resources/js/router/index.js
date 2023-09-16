import { createRouter, createWebHistory } from 'vue-router';
import Home from './../pages/Home.vue';
import AdminLayout from './../pages/admin/Layout.vue';
import AdminLogin from './../pages/admin/Login.vue';
import AdminManageGuest from './../pages/admin/ManageGuest.vue';
import AdminManageGuestGroup from './../pages/admin/ManageGuestGroup.vue';
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
                name: "Admin Manage Guest",
                path: '/admin/manage-guest',
                component: AdminManageGuest,
            },
            {
                name: "Admin Manage Guest Group",
                path: '/admin/manage-guest-group',
                component: AdminManageGuestGroup,
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