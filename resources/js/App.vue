<style>
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 1s ease;
    }

    .fade-enter-from,
    .fade-leave-to {
        opacity: 0;
    }
</style>

<template>
    <router-view v-slot="{ Component, route }">
        <transition :name="route.meta.transition || 'fade'">
            <component :is="Component" />
        </transition>
    </router-view>
</template>