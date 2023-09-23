<template>
    <div class="invitation-thank-you">
        <div class="invitation-thank-you-container">
            <div class="invitation-thank-you-text-container">
                <div class="invitation-thank-you-title">Thank you</div>
                <div class="invitation-thank-you-text-detail">Family & Friends</div>
            </div>
            <div class="invitation-thank-you-img-container">
                <img class="invitation-thank-you-img" src="@/../images/winry/thank_you.jpg">
            </div>
            <div class="invitation-thank-you-text-container">
                <div class="invitation-thank-you-title">with love,</div>
                <div class="invitation-thank-you-text-detail">Ryan & Winnie</div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .invitation-thank-you {
        background-color: #3A3A3A;
    }

    .invitation-thank-you-container {
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .invitation-thank-you-text-container {
        color: white;
        display: flex;
        align-items: center;
        flex-direction: column;
    }

    .invitation-thank-you-title {
        font-size: 14px;
    }

    .invitation-thank-you-text-detail {
        font-family: Brigitha Signature;
        font-size: 32px;
    }

    .invitation-thank-you-img-container {
        padding-top: 30px;
        padding-bottom: 30px;
        width: 50%;
        margin: 0 auto;
    }

    .invitation-thank-you-img {
        width: 100%;
    }

    @media (min-width: 720px) {
        .invitation-thank-you-container {
            padding-top: 80px;
            padding-bottom: 80px;
        }

        .invitation-thank-you-title {
            font-size: 24px;
        }

        .invitation-thank-you-text-detail {
            font-family: Brigitha Signature;
            font-size: 40px;
        }
    }
</style>