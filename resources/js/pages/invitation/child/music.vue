<template>
    <div class="music-container">
        <img src="@/../images/music.png" 
            :style="{ transform: `rotate(${currentRotation}deg)` }"
             :class="isAudioPlay ? 'rotation' : ''" 
             class="music-icon" 
             @click="playAndPauseMusic()"
             ref="imageElement">
    </div>
</template>

<style>
    @keyframes rotation {
        to {
            transform: rotate(359deg);
        }
    }

    .music-container {
        position: fixed;
        z-index: 2;
        left: 15px;
        bottom: 15px;
    }

    .rotation {
        animation: rotation 6s infinite linear;
    }

    .music-icon {
        width: 80px;
        cursor: pointer;
    }
</style>

<script>
    export default {
        props: ['isAudioPlay'],
        data() {
            return {
                currentRotation: 0,
            }
        },
        methods: {
            playAndPauseMusic() {
                const isWantToPause = this.isAudioPlay
                if (isWantToPause) {
                    const image = this.$refs.imageElement;
                    const style = window.getComputedStyle(image);
                    const transformMatrix = style.getPropertyValue('transform');
                    if (transformMatrix && transformMatrix !== 'none') {
                        const matrix = new DOMMatrix(transformMatrix);
                        this.currentRotation = Math.atan2(matrix.b, matrix.a) * (180 / Math.PI);
                    }
                }

                this.$emit('playAndPauseMusic')
            },
        }
    }
</script>