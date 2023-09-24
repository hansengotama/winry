<template>
    <div class="wishes-container">
        <div class="wishes-section">
            <div class="wishes-title">Prayers & Wishes</div>
            <div class="wishes-description">Your prayers & wishes means a lot for us</div>
            <div class="wishes-description">Thank you!</div>
            <div class="wishes-part">
                <div v-for="wish in wishes" class="wishes-items">
                    <div class="wishes-icon-section">
                        <img src="@/../images/Icons/1.png" v-if="wish.wishes_icon_type == '1'" class="wishes-icon">
                        <img src="@/../images/Icons/2.png" v-if="wish.wishes_icon_type == '2'" class="wishes-icon">
                        <img src="@/../images/Icons/3.png" v-if="wish.wishes_icon_type == '3'" class="wishes-icon">
                        <img src="@/../images/Icons/4.png" v-if="wish.wishes_icon_type == '4'" class="wishes-icon">
                        <img src="@/../images/Icons/5.png" v-if="wish.wishes_icon_type == '5'" class="wishes-icon">
                        <img src="@/../images/Icons/6.png" v-if="wish.wishes_icon_type == '6'" class="wishes-icon">
                        <img src="@/../images/Icons/7.png" v-if="wish.wishes_icon_type == '7'" class="wishes-icon">
                        <img src="@/../images/Icons/8.png" v-if="wish.wishes_icon_type == '8'" class="wishes-icon">
                    </div>
                    <div class="wishes-comment-section">
                        <div class="wishes-name">{{ wish.name }}</div>
                        <div class="wishes-wish">{{ wish.wishes }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .wishes-container {
        width: 80%;
        margin: 0 auto;
    }

    .wishes-section {
        padding: 65px 0px;
        background-color: white;
        border-top-right-radius: 167px;
        border-top-left-radius: 167px;
    }

    .wishes-title {
        color: #5E5E5E;
        text-align: center;
        font-family: Brigitha Signature;
        font-size: 40px;
        font-style: normal;
    }

    .wishes-description {
        color: #5E5E5E;
        text-align: center;
        font-family: Abhaya Libre;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }

    .wishes-part {
        padding: 10px;
        max-height: 600px;
        overflow-y: auto;
    }

    .wishes-items {
        display: flex;
        padding: 10px 20px;
    }

    .wishes-icon {
        width: 40px;
    }

    .wishes-comment-section {
        margin-left: 10px;
        padding: 12px;
        border: 1px solid #5E5E5E;
        border-radius: 5px;
        font-size: 20px;
        width: 100%;
    }

    .wishes-name {
        color: #5E5E5E;
        font-weight: bold;
        margin-bottom: 8px;
    }


    @media (max-width: 720px) {
        .wishes-title {
            font-size: 32px;
        }
        .wishes-comment-section {
            font-size: 14px;
        }
    }

    @media (max-width: 400px) {
        .wishes-title {
            font-size: 28px;
        }
    }
</style>

<script>
    import requestUrl from "../../../../helper/request"

    export default {
        data() {
            return {
                wishes: []
            }
        },
        mounted() {
            this.getWishes()
        },
        methods: {
            getWishes() {
                requestUrl.get('/wishes').then(response => {
                    if (response!= null && response.data != null && response.data.data != null) {
                        this.wishes = response.data.data
                    }
                })
            },
            getIcon(icon_type) {
                
            }
        }
    }
</script>