<style>
    .slide-up-enter-active,
    .slide-up-leave-active {
        transition: transform 0.5s;
    }
    .slide-up-enter, .slide-up-leave-to /* .slide-up-leave-active in <2.1.8 */ {
        transform: translateY(0);
    }
    .slide-up-leave-active {
        transform: translateY(-100%);
    }
</style>

<template>
    <router-view v-slot="{ Component, route }">
        <transition :name="route.meta.transition || 'none'">
            <component :is="Component" />
        </transition>
    </router-view>
</template>