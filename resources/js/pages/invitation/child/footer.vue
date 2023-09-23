<template>
    <div class="invitation-footer">
        <div class="invitation-footer-container">
            <div class="invitation-footer-img-container">
                <img class="invitation-footer-img" src="@/../images/bocahproject.png">
            </div>
            <div class="invitation-footer-name">bocahproject</div>

            <div class="invitation-footer-icon-container">
                <div class="invitation-footer-icon-img-container" @click="redirectToIG()">
                    <img class="invitation-footer-icon-img" src="@/../images/ig_icon.png">
                </div>
                
                <div class="invitation-footer-icon-img-container" style="margin-left: 8px;" @click="redirectToWA()">
                    <img class="invitation-footer-icon-img" src="@/../images/wa_icon.png">
                </div>
            </div>

            <div class="invitation-footer-music-container">
                Backsound: La Vie En Rose - Emily Watts
            </div>
        </div>
    </div>
</template>

<style scoped>
    .invitation-footer {
        width: 100%;
        background-color: #525F51;
    }

    .invitation-footer-container {
        padding-top: 60px;
        padding-bottom: 30px;
        text-align: center;
    }

    .invitation-footer-img {
        padding: 2px;
        border-radius: 50%;
        background-color: #FFFFFF;
    }

    .invitation-footer-icon-container {
        margin-top: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .invitation-footer-icon-img-container {
        padding: 5px;
        border-radius: 40%;
        background-color: #D9D9D9;
        cursor: pointer;
        display: flex;
    }

    .invitation-footer-icon-img {
        width: 12px;
        height: 12px;
    }

    .invitation-footer-name {
        color: white;
        font-size: 14px;
    }

    .invitation-footer-music-container {
        margin-top: 30px;
        font-size: 12px;
        color: white;
    }

    @media (min-width: 600px) {
        .invitation-footer-container {
            padding-top: 30px;
            padding-bottom: 15px;
        }

        .invitation-footer-icon-img {
            width: 16px;
            height: 16px;
        }

        .invitation-footer-name {
            font-size: 18px;
        }

        .invitation-footer-music-container {
            margin-top: 15px;
            font-size: 14px;
        }
    }
</style>

<script>
    export default {
        methods: {
            redirectToIG() {
                window.open("https://www.instagram.com/bocah_project/", "_blank")
            },
            redirectToWA() {
                window.open("https://wa.me/08111814032", "_blank")
            },
        }
    }
</script>