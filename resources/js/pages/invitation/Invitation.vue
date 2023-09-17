<template>
    <Transition name="slide-up">
        <div class="opening" v-if="!isShowInvitation">
            <opening @viewInvitation="viewInvitation" :user="user"></opening>
        </div>
    </Transition>

    <div class="invitation-detail" v-show="isShowInvitation">
        <div class="home">Hi, {{ user.name }}</div>
    </div>
</template>

<style>
    .home {
        font-family: Brigitha Signature;
    }

    .opening {
        position: absolute;
        height: 100vh;
        width: 100%;
        background: linear-gradient(
            rgba(0, 0, 0, 0.1),
            rgba(0, 0, 0, 0.5)
        ), url("/images/winry/image_w_1.JPG");
        background-position: unset;
        background-repeat: no-repeat;
        background-size: cover;
    }

    @media (max-width: 720px) {
        .opening {
            background: linear-gradient(
                rgba(0, 0, 0, 0.1),
                rgba(0, 0, 0, 0.5)
            ), url("/images/winry/image_m_1.JPG");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    }

    .invitation-detail {
        width: 100%;
        height: 200vh;
        background-color: brown;
    }

    .slide-up-enter-active,
    .slide-up-leave-active {
        transition: transform 0.8s;
    }

    .slide-up-enter, .slide-up-leave-to /* .slide-up-leave-active in <2.1.8 */ {
        transform: translateY(0);
    }

    .slide-up-leave-active {
        transform: translateY(-100%);
    }
</style>

<script>
    import requestUrl from "../../helper/request"
    import opening from './child/opening.vue'

    export default {
        data() {
            return {
                user: {},
                isShowInvitation: false,
            }
        },
        mounted() {
            this.getInvitationDetail() 
        },
        components: {
            Opening: opening,
        },
        methods: {
            getInvitationDetail() {
                requestUrl.get("/invitations/" + this.getTokenFromURL()).then((response) => {
                    if (response.data == null && response.data.data == null) {
                        this.redirectToNotFound()
                        return
                    }

                    this.user = response.data.data
                })
            },
            getTokenFromURL() {
                return this.$route.params.token
            },
            redirectToNotFound() {
                this.$router.push({
                    name: "Not Found"
                })
            },
            viewInvitation() {
                this.isShowInvitation = true
            },
        }
    }
</script>