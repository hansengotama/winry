<template>
    <div class="introduction">
        <div class="introduction-container">
            <div class="introduction-title">
                <div class="introduction-title-text">THE WEDDING OF</div>
                <div class="introduction-title-name">Ryan &amp; Winnie</div>
            </div>
            <div class="introduction-description">
                “And I knew exactly how old Walt Disney’s Cinderella felt when she found her prince.” —Elizabeth Young
            </div>
        </div>
    </div>
</template>

<style scoped>
    .introduction {
        height: 100vh;
        width: 100%;
        background: linear-gradient(
            rgba(0, 0, 0, 0.1),
            rgba(0, 0, 0, 0.5)
        ), url('/images/winry/image_1.JPG');
        background-position: center 25%;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .introduction-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        height: 100%;
    }

    .introduction-title { 
        margin-top: 20px;
        color: #FFF;
        font-weight: 700;
        display: flex;
        flex-direction: column;
        text-align: center;
        align-items: center;
    }

    .introduction-title-text {
        font-size: 24px;
    }

    .introduction-title-name {
        font-size: 40px;
        font-weight: normal;
        font-family: Brigitha Signature;
        margin-top: -6px;
    }

    .introduction-description {
        font-size: 18px;
        color: #FFF;
        font-weight: 700;
        margin-bottom: 30px;
        max-width: 600px;
        text-align: center;
    }

    @media (max-width: 720px) {
        .introduction-title {
            margin-top: 45px;
        }

        .introduction-title-text {
            font-size: 16px;
        }

        .introduction-title-name { 
            font-size: 36px;
        }
    }
</style>