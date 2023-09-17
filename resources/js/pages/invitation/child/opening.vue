<template>
    <div class="opening-container">
        <div class="opening-title">
            <div class="opening-title-text">THE WEDDING OF</div>
            <div class="opening-title-name">Ryan &amp; Winnie</div>
            <div class="opening-title-date">10 . 12 . 2023</div>
        </div>
        <div class="view-invitation">
            <div class="view-invitation-greeting-1">Dear {{this.user.name}},</div>
            <div class="view-invitation-greeting-2">We humbly invite you to be a part of our joyous celebration of love.</div>
            <button class="view-invitation-btn" @click="viewInvitation()">View e-invitation</button>
        </div>
    </div>
</template>

<style scoped>
    .opening-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-end;
        height: 100%;
    }

    .opening-title { 
        color: #FFF;
        font-weight: 700;
        display: flex;
        flex-direction: column;
        text-align: center;
        align-items: center;
    }

    .opening-title-text {
        font-size: 24px;
    }

    .opening-title-name {
        font-size: 40px;
        font-weight: normal;
        font-family: Brigitha Signature;
        margin-top: -6px;
    }

    .opening-title-date {
        font-size: 20px;
        margin-top: -10px;
    }

    .view-invitation {
        font-size: 18px;
        font-weight: 700;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 50px;
        margin-bottom: 45px;
    }

    .view-invitation-greeting-1 {
        color: #FFF;
        margin-bottom: 20px;
    }

    .view-invitation-greeting-2 {
        color: #FFF;
        margin-bottom: 18px;
        max-width: 350px;
    }

    .view-invitation-btn {
        color: #5E5E5E;
        opacity: 0.6;
        border: none;
        background-color: rgba(255, 255, 255, 1);
        cursor: pointer;
        padding: 5px 40px;
        border-radius: 36px;
        font-weight: 700;
        font-family: Abhaya Libre;
        font-size: 18px;
    }

    @media (max-width: 720px) {
        .opening-container {
            justify-content: space-between;
        }

        .opening-title {
            margin-top: 45px;
        }

        .opening-title-text {
            font-size: 16px;
        }

        .opening-title-name { 
            font-size: 36px;
        }

        .opening-title-date {
            font-size: 16px;
        }

        .view-invitation-greeting-1 {
            font-size: 16px;
        }

        .view-invitation-greeting-2 {
            font-size: 14px;
        }

        .view-invitation-greeting-2 {
            max-width: 250px;
        }

        .view-invitation-btn {
            font-size: 14px;
            padding: 4px 30px;

        }
    }
</style>

<script>
    export default {
        props: ['user'],
        methods: {
            viewInvitation() {
                this.$emit('viewInvitation')
            }
        }
    }
</script>