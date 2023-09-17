<template>
    <Transition name="slide-up">
        <div class="invitation" v-if="isShow">
            <div class="home">Hi, {{ user.name }}</div>
            
            <button @click="redirectToDetail()">test</button>
        </div>
    </Transition>

    <div class="invitation-detail">
        <div class="home">Hi, {{ user.name }}</div>
    </div>
</template>

<style>
    .home {
        font-family: Brigitha Signature;
    }

    .invitation {
        position: absolute;
        height: 100vh;
        width: 100%;
        background-color: aliceblue;
    }

    .invitation-detail {
        width: 100%;
        background-color: blue;
    }

    .slide-up-enter-active,
    .slide-up-leave-active {
        transition: transform 2s;
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

    export default {
        data() {
            return {
                user: {},
                isShow: true,
            }
        },
        mounted() {
            this.getInvitationDetail() 
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
            redirectToDetail() {
                this.isShow = false
                // this.$router.push({
                //     name: "Invitation Detail",
                //     params: {
                //         token: this.getTokenFromURL()
                //     }
                // })
            },
            redirectToNotFound() {
                this.$router.push({
                    name: "Not Found"
                })
            },
        }
    }
</script>