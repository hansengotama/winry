<template>
    <div v-if="isLogin">
        <div style="padding: 20px">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link" 
                            :class="(currentRoute == 'Admin Manage Guess') ? 'active' : ''"
                            @click="redirectToMenu('Admin Manage Guess')">
                            Guess
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" 
                            :class="(currentRoute == 'Admin Manage Guess Group') ? 'active' : ''"
                            @click="redirectToMenu('Admin Manage Guess Group')">
                            Group
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link"  @click="logout()">Logout</button>
                </li>
            </ul>
            <router-view></router-view>
        </div>
    </div>
    <router-view @updateIsLogin="updateIsLogin" v-else></router-view>
</template>

<script>
    import vueCookie from "vue-cookie"
    import requestUrl from "../../helper/request"

    export default {
        data() {
            return {
                isLogin: false,
                currentRoute: ""
            }
        },
        created() {
            const routerRoute = this.$router.currentRoute
            this.currentRoute = routerRoute._value.name
        },
        mounted() {
            this.checkAuth()
        },
        methods: {
            checkAuth() {
                if(vueCookie.get('access_token') == null) {
                    this.redirectToLogin();
                    return;
                }

                requestUrl.get('/admin/auth/user').then((response) => {
                    if (response.response != null && response.response.status != 200) {
                        this.redirectToLogin();
                        return
                    }

                    if (response.error == null && response.data != null) {
                        if (this.currentRoute == 'Admin Login') {
                            this.redirectToMenu('Admin Manage Guess');
                        }
                        
                        this.isLogin = true;
                        return;
                    }
                })
            },
            redirectToLogin() {
                this.$router.push({
                    name: "Admin Login"
                })
            },
            redirectToMenu(routeName) {
                if (routeName == this.currentRoute) {
                    return
                }

                this.currentRoute = routeName
                this.$router.push({
                    name: routeName
                })
            },
            updateIsLogin() {
                this.isLogin = true
            },
            logout() {
                requestUrl.post("/admin/auth/logout").then((response) => {
                    if (response.status == 200) {
                        this.redirectToLogin()
                        vueCookie.delete('access_token')
                        this.isLogin = false
                    }
                })
            },
        }
    }
</script>