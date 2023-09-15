<template>
    <div class="test">Manage Guess Group</div>
</template>

<style>
    .test {
        font-weight: normal;
    }

    .test-1 {
        font-weight: bold;
    }
</style>

<script>
    import vueCookie from "vue-cookie"
    import requestUrl from "../../helper/request"


    export default {
        methods: {
            logout() {
                requestUrl.post("/admin/auth/logout").then((response) => {
                    if (response.status == 200) {
                        this.redirectToLogin()
                        vueCookie.delete('access_token')
                    }
                })
            },
            redirectToLogin() {
                this.$router.push({
                    name: "Admin Login"
                })
            },
        }
    }
</script>