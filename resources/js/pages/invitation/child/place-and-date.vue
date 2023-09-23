<template>
    <div class="place-and-date-section">
        <div class="place-and-date-title">PLACE & DATE</div>
        <div class="place-and-date-detail-container">
            <div class="place-and-date-detail-bg-container">
                <img class="place-and-date-detail-bg" src="@/../images/winry/place-and-date-w.jpg" v-show="windowWidth >= 720">
                <img class="place-and-date-detail-bg" src="@/../images/winry/place-and-date-m.jpg" v-show="windowWidth < 720">
            </div>

            <div class="place-and-date-detail-description">
                <div class="place-and-date-detail-title">Wedding Reception</div>
                <div class="place-and-date-detail-desc">An evening of good food, drinks & music</div>
                <div class="place-and-date-detail-date">Sunday, December 10th, 2023</div>
                <div class="place-and-date-detail-time">7.00 p.m. - 9.00 p.m.</div>
                <div class="place-and-date-detail-place">Pullman Kuala Lumpur City Centre</div>
                <div class="place-and-date-detail-room">Grand Ballroom</div>
                <div class="place-and-date-detail-view-map-btn" @click="redirectToMaps()">view maps</div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .place-and-date-section {
        width: 80%;
        margin: 0 auto;
        padding-bottom: 60px;
    }

    .place-and-date-title {
        padding: 30px 0;
        font-size: 16px;
        color: #5E5E5E;
        font-weight: 800;
        text-align: center;
    }

    .place-and-date-detail-bg {
        width: 100%;
        height: 100%;
    }

    .place-and-date-detail-container {
        position: relative;
    }

    .place-and-date-detail-bg-container {
        position: relative;
        margin-bottom: -6px;
    }

    .place-and-date-detail-bg-container::after  {
        content: '';
        position: absolute;
        left: 0; 
        top: 0;
        z-index: 0;
        width: 100%; 
        height: calc(100% - 6px);;
        background: linear-gradient(rgba(94, 94, 94, 0.7),rgba(94, 94, 94, 0.7));
    }

    .place-and-date-detail-description {
        position: absolute;
        color: white;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        z-index: 1;
        top: 50%;
        left: 50%;
        transform: translateY(-50%) translateX(-50%);
    }

    .place-and-date-detail-title {
        font-family: Brigitha Signature;
        font-size: 24px;
    }

    .place-and-date-detail-desc {
        font-size: 13px;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .place-and-date-detail-date {
        font-size: 13px;
        margin-bottom: 2px;
        font-weight: bold;
    }

    .place-and-date-detail-time {
        font-size: 13px;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .place-and-date-detail-place {
        font-size: 13px;
        margin-bottom: 2px;
        font-weight: bold;
    }

    .place-and-date-detail-room {
        font-size: 13px;
        font-weight: bold;
    }

    .place-and-date-detail-view-map-btn {
        margin-top: 20px;
        cursor: pointer;
        padding: 8px 50px;
        border: 1px solid white;
        border-radius: 20px;
        font-size: 13px;
    }

    @media (min-width: 720px) {
        .place-and-date-title {
            font-size: 40px;
        }

        .place-and-date-detail-title {
            font-size: 40px;
            margin-bottom: 30px;
        }

        .place-and-date-detail-desc {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .place-and-date-detail-date {
            font-size: 20px;
            margin-bottom: 2px;
        }

        .place-and-date-detail-time {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .place-and-date-detail-place {
            font-size: 20px;
            margin-bottom: 2px;
        }

        .place-and-date-detail-room {
            font-size: 20px;
        }

        .place-and-date-detail-view-map-btn {
            font-size: 20px;
        }
    }
</style>

<script>
    export default {
        data() {
            return {
                windowWidth: window.innerWidth
            }
        },
        mounted() {
            this.$nextTick(() => {
                window.addEventListener('resize', this.onResize);
            })
        },

        beforeDestroy() { 
            window.removeEventListener('resize', this.onResize); 
        },

        methods: {  
            onResize() {
                this.windowWidth = window.innerWidth
            },
            redirectToMaps() {
                window.open("https://www.google.com/maps/place/Pullman+Kuala+Lumpur+City+Centre+-+Hotel+%26+Residences/@3.150524,101.7098456,17z/data=!3m1!4b1!4m9!3m8!1s0x31cc362d40080999:0x1fb2c5dd17d95b91!5m2!4m1!1i2!8m2!3d3.150524!4d101.714459!16s%2Fg%2F1tsr0q1v?entry=ttu", "_blank")
            }
        }
    }
</script>