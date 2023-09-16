<template>
    <div class="home">Hi, {{ user.name }}</div>
</template>

<style>
    .home {
        font-family: Brigitha Signature;
    }
</style>

<script>
    import requestUrl from "../../helper/request"

    export default {
        data() {
            return {
                user: {}
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
            redirectToNotFound() {
                this.$router.push({
                    name: "Not Found"
                })
            },
        }
    }
</script>