<template>
    <transition name="modal-fade">
        <div class="modal-backdrop">
            <div class="modal">
                <div class="modal-header">Failed</div>
                <div class="modal-body">Sorry for the inconvenience, please contact Ryan/Winnie</div>
                <div class="modal-footer">
                    <button type="button" class="btn-close" @click="close">OK</button>
                </div>
            </div>
        </div>
    </transition>
</template>
  

<style scoped>
    .modal-backdrop {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        backdrop-filter: blur(1px) contrast(.8);
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 990;
    }

    .modal {
        background: #FFFFFF;
        overflow-x: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 20px;
        padding: 20px 60px;
    }

    .modal-header {
        color: #000;
        font-size: 24px;
        font-weight: 800;
    }

    .modal-body {
        position: relative;
        padding-top: 10px;
        padding-bottom: 20px;
        color: #5E5E5E;
        font-size: 14px;
    }

    .btn-close {
        border-radius: 36px;
        background: #5E5E5E;
        color: white;
        padding: 8px 30px;
        cursor: pointer;
        border: 0px;
    }

    .modal-fade-enter,
    .modal-fade-leave-to {
        opacity: 0;
    }

    .modal-fade-enter-active,
    .modal-fade-leave-active {
        transition: opacity .5s ease;
    }
</style>

<script>
    export default {
        name: 'Modal',
        methods: {
            close() {
                this.$emit('close');
            },
        },
    };
</script>