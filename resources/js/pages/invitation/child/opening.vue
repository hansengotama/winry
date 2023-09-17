<template>
    <div class="opening-container">
        <div class="invitation-title">
            <div class="invitation-title-text">THE WEDDING OF</div>
            <div class="invitation-title-name">Ryan &amp; Winnie</div>
            <div class="invitation-title-date">10 . 09 . 2023</div>
        </div>
        <div class="view-invitation">
            <div class="view-invitation-greeting-1">Dear {{this.user.name}},</div>
            <div class="view-invitation-greeting-2">We humbly invite you to be a part of our joyous celebration of love.</div>
            <button class="view-invitation-btn" @click="viewInvitation()">View e-invitation</button>
        </div>
    </div>
</template>

<style>
    .opening-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-end;
        height: 100%;
    }

    .invitation-title { 
        color: #FFF;
        font-weight: 700;
        display: flex;
        flex-direction: column;
        text-align: center;
        align-items: center;
    }

    .invitation-title-text {
        font-size: 24px;
    }

    .invitation-title-name {
        font-size: 40px;
        font-weight: normal;
        font-family: Brigitha Signature;
    }

    .invitation-title-date {
        font-size: 20px;
    }

    .view-invitation {
        font-size: 18px;
        font-weight: 700;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 30px;
        margin-bottom: 45px;
    }

    .view-invitation-greeting-1 {
        color: #FFF;
        margin-bottom: 18px;
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

        .invitation-title {
            margin-top: 45px;
        }

        .invitation-title-text {
            font-size: 16px;
        }

        .invitation-title-name { 
            font-size: 36px;
        }

        .invitation-title-date {
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