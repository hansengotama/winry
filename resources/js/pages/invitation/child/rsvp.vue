<template>
    <div class="rsvp-container">
        <div class="rsvp-section">
            <div class="rsvp-title">RSVP</div>
            <div class="rsvp-description">Attendance Confirmation</div>
            <div class="rsvp-form-container">
                <div class="rsvp-form-control">
                    <div class="rsvp-form-input">Full Name</div>
                    <input class="rsvp-form-input-value rsvp-form-disable" type="text" :value="user.name" disabled>
                </div>
                <div class="rsvp-form-control">
                    <div class="rsvp-form-select">Attendance</div>
                    <select class="rsvp-form-select-value" v-model="form.is_attend">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="rsvp-form-control" v-if="form.is_attend == 'yes'">
                    <div class="rsvp-form-input">Email</div>
                    <input class="rsvp-form-input-value" type="text" placeholder="Input email" v-model="form.email" @keyup="validateEmail()">
                    <div v-show="error.email != ''" class="rsvp-form-error-message">{{ error.email }}</div>
                </div>
                <div class="rsvp-form-control" v-if="form.is_attend == 'yes'">
                    <div class="rsvp-form-select">Number of Pax</div>
                    <select class="rsvp-form-select-value" v-model="form.number_of_pax">
                        <option :value="i" v-for="i in user.max_attendance">{{ i }}</option>
                    </select>
                </div>
                <div class="rsvp-form-control">
                    <div class="rsvp-form-textarea">Wishes for Ryan & Winnie</div>
                    <textarea class="rsvp-form-textarea-value" rows="4" v-model="form.wishes" placeholder="Input wishes" @keyup="validateWishes()"></textarea>
                    <div v-show="error.wishes != ''" class="rsvp-form-error-message">{{ error.wishes }}</div>
                </div>

                <div class="rsvp-confirmation-button" @click="confirmation()">Confirmation</div>
            </div>
        </div>
        
    </div>
</template>

<style scoped>
    .rsvp-container {
        background-color: #E3E5DA;
        padding: 40px 0;
    }

    .rsvp-section {
        width: 80%;
        margin: 0 auto;
    }

    .rsvp-title {
        color: #5E5E5E;
        text-align: center;
        font-weight: bolder;
        font-size: 40px;
    }

    .rsvp-description {
        color: #5E5E5E;
        text-align: center;
        font-weight: bolder;
        font-size: 20px;
    }

    .rsvp-form-input, .rsvp-form-textarea, .rsvp-form-select {
        color: #5E5E5E;
        margin-top: 40px;
        font-size: 20px;
    }

    .rsvp-form-input-value , .rsvp-form-textarea-value, .rsvp-form-select-value {
        margin-top: 10px;
        width: -webkit-fill-available;
        border-radius: 5px;
        background: #FFF;
        border: none;
        padding: 15px 12px;
        font-size: 20px;
        font-family: 'Abhaya Libre';
        color: #5E5E5E;
    }

    .rsvp-form-textarea-value {
        vertical-align: top;
    }

    .rsvp-form-disable {
        background-color: #dbdbdb;
    }

    .rsvp-confirmation-button {
        border-radius: 36px;
        background: #5E5E5E;
        padding: 8px 0;
        width: 50%;
        text-align: center;
        color: white;
        margin: 25px auto;
        cursor: pointer;
    }

    .rsvp-form-error-message {
        margin-top: 6px;
        color: red;
        font-size: 14px;
    }
</style>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                form: {
                    is_attend: "yes",
                    email: "",
                    number_of_pax: 1,
                    wishes: ""
                },
                error: {
                    email: "",
                    wishes: ""
                },
                isSubmitted: false
            }
        },
        methods: {
            confirmation() {
                this.isSubmitted = true
                const isSuccess = this.validate()
                if (isSuccess) {
                    this.submitRSVP()
                }
            },
            validate() {
                const isEmailValid = this.validateEmail()
                const isWishesValid = this.validateWishes()

                return isEmailValid && isWishesValid
            },
            validateEmail() {
                if (!this.isSubmitted) {
                    return false
                }

                if (this.form.email == "") {
                    this.error.email = "Email is required"
                    return false
                }

                if (!this.isValidEmail(this.form.email)) {
                    this.error.email = "Email format is invalid"
                    return false
                }

                this.error.email = ""
                return true
            },
            validateWishes() {
                if (!this.isSubmitted) {
                    return false
                }
                
                if (this.form.wishes == "") {
                    this.error.wishes = "Wishes is required"
                    return false
                }

                this.error.wishes = ""
                return true
            },
            isValidEmail(email) {
                const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                return emailRegex.test(email);
            },
            submitRSVP() {

            }
        }
    }
</script>