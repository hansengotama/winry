<template>
    <div class="our-story">
        <div class="our-story-title">OUR STORY</div>
        <div class="our-story-description">
            <div class="our-story-description-text">
                We met 4 years ago under unlikely circumstances at a friend’s gathering, and have never looked back since. We fell in love with each other’s authenticity, kindness, humour, and drive to build a better life together.
            </div>
            <div class="our-story-description-text">
                We made a promise to always have each other’s backs, and to support each other in everything that we do. With this promise, Ryan proposed to Winnie in December 2021 to commit as a lifelong partner, to which Winnie said YES!
            </div>
            <div class="our-story-description-text">
                Now 2 years later… We are officially celebrating this commitment through our wedding!
            </div>
            <div class="our-story-description-text">
                And so, with honour, we humbly request your wonderful presence at our wedding, and to share in an evening of joy in celebrating our marriage.
            </div>
            <div class="our-story-description-text">
                We hope to see you there, and look forward to having you.
            </div>
        </div>
        <div class="our-story-image-container">
            <div class="our-story-image-1">
                <img :src="baseURL + '/images/Assets/1.JPG'" width="100%">
            </div>
            <div class="our-story-image-2">
                <img :src="baseURL + '/images/Assets/3.JPG'" width="100%">
            </div>
            <div class="our-story-image-3">
                <img :src="baseURL + '/images/Assets/2.JPG'" width="100%">
            </div>
            <div class="our-story-image-4">
                <img :src="baseURL + '/images/Assets/4.JPG'" width="100%">
            </div>
        </div>
        <div class="our-story-description-text">
            “We may not have it all together, but together we have it all.”
        </div>
    </div>
</template>

<style scoped>
    .our-story {
        padding: 30px 0;
        width: 80%;
        margin: 0 auto;
    }
    .our-story-title {
        font-size: 16px;
        color: #5E5E5E;
        font-weight: 800;
        padding-bottom: 10px;
    }

    .our-story-description-text {
        font-size: 14px;
        padding: 14px 0;
    }

    .our-story-image-container {
        margin-top: 30px;
        display: grid;
        grid-template-columns: auto auto;
        grid-template-rows: auto auto;
        grid-gap: 5px 10px;
    }

    .our-story-image-1 {
        width: 100%;
        height: 100%;

        grid-row-start: 1;
        grid-row-end: 3;
    }

    .our-story-image-2 {
        width: 100%;

        grid-row-start: 3;
    }

    .our-story-image-3 {
        width: 100%;
        height: 100%;

        grid-row-start: 1;
    }

    .our-story-image-4 {
        width: 100%;

        grid-row-start: 2;
        grid-row-end: 5;
    }

    @media (min-width: 600px) {

        .our-story {
            padding: 30px 0;
        }
        .our-story-title {
            font-size: 40px;
        }
        .our-story-description-text {
            font-size: 20px;
        }
    }
</style>


<script>
    export default {
        data() {
            return {
                baseURL: "",
            }
        },
        mounted() {
            this.initBaseURL();
        },
        methods: {
            initBaseURL() {
                this.baseURL = window.location.origin
            },
        }
    }
</script>