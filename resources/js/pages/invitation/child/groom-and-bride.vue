<template>
    <div class="groom-and-bride-container">
        <div class="groom-and-bride-section">
            <div style="padding: 30px; max-width: 470px; margin: 0 auto;">
                <div class="groom-and-bride-title">THE GROOM & BRIDE</div>
                <div class="groom-container">
                    <img src="@/../images/winry/groom.png" class="profile-image">
                    <div class="groom-detail">
                        <div class="groom-name">Ryan Chan</div>
                        <div class="groom-son-of">Son Of</div>
                        <div class="groom-son-of-value">Ivan & Avy</div>
                    </div>
                </div>
                <div class="bride-container">
                    <img src="@/../images/winry/bride.png" class="profile-image">
                    <div class="bride-detail">
                        <div class="bride-name">Winnie Gotama</div>
                        <div class="daughter-of">Daughter Of</div>
                        <div class="daughter-of-value">Hendrik Gotama & Suarti</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .groom-and-bride-container {
        background-color: #E3E5DA;
        padding: 60px 0;
    }

    .groom-and-bride-section {
        margin: 0 auto;
        width: 80%;
        border-top-left-radius: 50px;
        border-bottom-right-radius: 50px;
        background-color: #FFFFFF;
    }

    .groom-and-bride-title {
        font-size: 16px;
        color: #5E5E5E;
        font-weight: 800;
        text-align: center;
    }

    .groom-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 20px 0;
    }

    .groom-detail {
        display: flex;
        flex-direction: column;
    }

    .groom-name {
        font-family: Brigitha Signature;
        font-size: 24px;
        color: #5E5E5E;
        font-weight: 400;
    }

    .groom-son-of {
        margin-top: -6px;
        color: #5E5E5E;
        font-size: 13px;
    }

    .groom-son-of-value {
        color: #5E5E5E;
        font-size: 13px;
        font-weight: 700;
    }

    .bride-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 20px 0;
    }

    .profile-image {
        max-width: 200px;
        width: 100%;
    }

    .bride-detail {
        display: flex;
        flex-direction: column;
    }

    .bride-name {
        font-family: Brigitha Signature;
        font-size: 24px;
        color: #5E5E5E;
        font-weight: 400;
    }

    .daughter-of {
        margin-top: -6px;
        color: #5E5E5E;
        font-size: 13px;
    }

    .daughter-of-value {
        color: #5E5E5E;
        font-size: 13px;
        font-weight: 700;
    }

    @media (min-width: 600px) {
        .groom-and-bride-title {
            padding-bottom: 40px;
            font-size: 30px;
        }
        .groom-container {
            flex-direction: row;
            gap: 30px;
            padding: 0;
        }

        .groom-detail {
            align-items: flex-start;
        }

        .groom-son-of {
            margin-top: 0;
            font-size: 20px;
            text-align: left;
        }

        .groom-son-of-value {
            font-size: 20px;
            text-align: left;
        }

        .bride-container {
            flex-direction: row-reverse;
            gap: 30px;
            padding: 0;
        }

        .bride-detail {
            align-items: flex-end;
        }
        .daughter-of {
            margin-top: 0;
            font-size: 20px;
            text-align: right;
        }

        .daughter-of-value {
            font-size: 20px;
            text-align: right;
        }

        .groom-name, .bride-name {
            font-size: 32px;
            margin-bottom: 8px;
        }
    }
</style>