<template>
    <div style="padding: 20px; max-width: 400px; margin: 0 auto">
        <div style="border: 1px solid #dee2e6; padding: 20px; border-radius: 20px;">
            <h3>Login</h3>
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="inputEmail" v-model="form.email">
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="inputPassword" v-model="form.password">
            </div>
            <button class="btn btn-primary" @click="login()">Login</button>
            <div style="color:red" class="form-text">{{  error.message }}</div>
        </div>
    </div>
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
        data() {
            return {
                form: {
                    email: "",
                    password: ""
                },
                error: {
                    message: ""
                }
            }
        },
        methods: {
            login() {
                requestUrl.post("/admin/auth/login", {
                    email: this.form.email,
                    password: this.form.password
                }).then((response) => {
                    if (response.data != null && response.data.data.error == null) {
                        vueCookie.set('access_token', response.data.data.token)
                        this.redirectToManageGuess()
                        this.$emit("updateIsLogin")
                        return;
                    }

                    if (response.response.status == 422) {
                        var description = response.response.data.error.description

                        if (description.email != null && description.email.length > 0) {
                            this.error.message = description.email[0]
                            return; 
                        }

                        if (description.password != null && description.password.length > 0) {
                            this.error.message = description.password[0]
                            return; 
                        }
                    }

                    this.error.message = response.response.data.error.message
                })
            },
            redirectToManageGuess() {
                this.$router.push({
                    name: "Admin Manage Guess"
                })
            },
        }
    }
</script>