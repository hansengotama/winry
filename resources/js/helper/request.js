import axios from 'axios'
import vueCookie from 'vue-cookie'

class RequestUrl {
    constructor() {
        this.setBaseUrl()
        this.setHeaderData()
    }

    setBaseUrl() {
        this.baseUrl = window.location.origin + "/api"
    }

    setHeaderData() {
        this.headersData = {}
        this.headersData.headers = {}
        this.headersData.headers["Content-Type"] = 'application/json'
    }

    getAccessToken() {
        const accessToken = vueCookie.get('access_token')

        if(accessToken) this.headersData.headers["Authorization"] = "Bearer " + accessToken
        else this.headersData.headers["Authorization"] = null
    }

    get(url) {
        return new Promise((resolve) => {
            this.getAccessToken()

            axios.get(this.baseUrl + url, this.headersData)
            .then((response) => {
                resolve(response)
            })
            .catch((error) => {
                resolve(error)
            })
        })
    }

    post(url, data) {
        return new Promise((resolve) => {
            this.getAccessToken()

            axios.post(this.baseUrl + url, data, this.headersData)
            .then((response) => {
                resolve(response)
            })
            .catch((error) => {
                resolve(error)
            })
        })
    }

    put(url, data) {
        return new Promise((resolve) => {
            this.getAccessToken()

            axios.put(this.baseUrl + url, data, this.headersData)
            .then((response) => {
                resolve(response)
            })
            .catch((error) => {
                resolve(error)
            })
        })
    }
}

export default new RequestUrl