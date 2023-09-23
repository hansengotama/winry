<template>
    <div class="countdown-background">
        <div class="countdown-container">
            <div class="countdown-item">
                <div class="countdown-value">{{remaining.days}}</div>
                <div class="countdown-text">Days</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-value">{{remaining.hours}}</div>
                <div class="countdown-text">Hours</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-value">{{remaining.minutes}}</div>
                <div class="countdown-text">Minutes</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-value">{{remaining.seconds}}</div>
                <div class="countdown-text">Seconds</div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .countdown-background {
        height: 350px;
        background-image: url(http://127.0.0.1:5173/resources/images/countdown.png);
        background-position: center;
        background-size: cover;
        background-attachment: scroll;
        background-repeat: no-repeat;
    }

    .countdown-container {
        display: grid;
        width: 90%;
        max-width: 500px;
        margin: 0 auto;
        grid-template-columns: repeat(4, 1fr);
        place-items: center normal;
        grid-gap: 20px;
        height: 100%;
    }

    .countdown-item {
        background-color: rgba(255, 255, 255, 0.80);
        padding: 20px 0;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .countdown-value {
        font-family: Bebas Neue;
        color: #5E5E5E;
        margin-bottom: 10px;
        font-size: 36px;
    }

    .countdown-text {
        color: #5E5E5E;
        
    }

    @media (max-width: 400px) {
        .countdown-container {
            grid-gap: 10px;
        }
        
    }
</style>

<script>
    export default {
        data() {
            return {
                targetTime: new Date('2023-12-10T19:00:00+08:00'),
                remaining: {
                    days: 0,
                    hours: 0,
                    minutes: 0,
                    seconds: 0,
                },
                interval: null
            }
        },
        methods: {
            updateCountdown() {
                const now = new Date();
                const timeDifference = this.targetTime - now;
                if (timeDifference <= 0) {
                    if (this.interval != null) {
                        clearInterval(this.interval);
                    }
                    
                    return;
                }

                this.remaining.days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                this.remaining.hours = Math.floor(
                    (timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
                );

                this.remaining.minutes = Math.floor(
                    (timeDifference % (1000 * 60 * 60)) / (1000 * 60)
                );

                this.remaining.seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);
            },
        },
        mounted() {
            this.updateCountdown();
            this.interval = setInterval(this.updateCountdown, 1000);
        },
        beforeDestroy() {
            if (this.interval != null) {
                clearInterval(this.interval);
            }
        },
    }
</script>