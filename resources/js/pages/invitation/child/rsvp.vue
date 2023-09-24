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
                    <div class="rsvp-form-select">RSVP</div>
                    <select class="rsvp-form-select-value" :class="isFormStored ? 'rsvp-form-disable' : ''" v-model="form.is_attend" :disabled="isFormStored">
                        <option value="yes">Definitely, Yes!</option>
                        <option value="no">Sorry, I can’t attend your wedding</option>
                    </select>
                </div>
                <div class="rsvp-form-control" v-if="form.is_attend == 'yes'">
                    <div class="rsvp-form-input">Email</div>
                    <input class="rsvp-form-input-value" type="text" placeholder="Enter your email" :class="isFormStored ? 'rsvp-form-disable' : ''" v-model="form.email" @keyup="validateEmail()" :disabled="isFormStored">
                    <div v-show="error.email != ''" class="rsvp-form-error-message">{{ error.email }}</div>
                </div>
                <div class="rsvp-form-control" v-if="form.is_attend == 'yes'">
                    <div class="rsvp-form-select">Number of Pax</div>
                    <select class="rsvp-form-select-value" v-model="form.number_of_pax" :class="isFormStored ? 'rsvp-form-disable' : ''" :disabled="isFormStored">
                        <option :value="i" v-for="i in user.max_attendance">{{ i }}</option>
                    </select>
                </div>
                <div class="rsvp-form-control">
                    <div class="rsvp-form-textarea">Wishes for Ryan & Winnie</div>
                    <textarea class="rsvp-form-textarea-value" rows="4" v-model="form.wishes" placeholder="Enter you wishes" @keyup="validateWishes()" :class="isFormStored ? 'rsvp-form-disable' : ''" :disabled="isFormStored"></textarea>
                    <div v-show="error.wishes != ''" class="rsvp-form-error-message">{{ error.wishes }}</div>
                </div>
                <div class="rsvp-form-control">
                    <div class="rsvp-form-custom">Wishes Icon</div>
                    <div class="rsvp-form-icon-container">
                        <img src="@/../images/Icons/1.png" class="rsvp-icon" :class="form.icon_type == '1' ? 'rsvp-icon-active' : '', isFormStored ? 'cursor-not-allowed' : ''" @click="changeIcon('1')">
                        <img src="@/../images/Icons/2.png" class="rsvp-icon" :class="form.icon_type == '2' ? 'rsvp-icon-active' : '', isFormStored ? 'cursor-not-allowed' : ''" @click="changeIcon('2')">
                        <img src="@/../images/Icons/3.png" class="rsvp-icon" :class="form.icon_type == '3' ? 'rsvp-icon-active' : '', isFormStored ? 'cursor-not-allowed' : ''" @click="changeIcon('3')">
                        <img src="@/../images/Icons/4.png" class="rsvp-icon" :class="form.icon_type == '4' ? 'rsvp-icon-active' : '', isFormStored ? 'cursor-not-allowed' : ''" @click="changeIcon('4')">
                        <img src="@/../images/Icons/5.png" class="rsvp-icon" :class="form.icon_type == '5' ? 'rsvp-icon-active' : '', isFormStored ? 'cursor-not-allowed' : ''" @click="changeIcon('5')">
                        <img src="@/../images/Icons/6.png" class="rsvp-icon" :class="form.icon_type == '6' ? 'rsvp-icon-active' : '', isFormStored ? 'cursor-not-allowed' : ''" @click="changeIcon('6')">
                        <img src="@/../images/Icons/7.png" class="rsvp-icon" :class="form.icon_type == '7' ? 'rsvp-icon-active' : '', isFormStored ? 'cursor-not-allowed' : ''" @click="changeIcon('7')">
                        <img src="@/../images/Icons/8.png" class="rsvp-icon" :class="form.icon_type == '8' ? 'rsvp-icon-active' : '', isFormStored ? 'cursor-not-allowed' : ''" @click="changeIcon('8')">
                    </div>
                </div>

                <div class="rsvp-confirmation-button" @click="confirmation()" v-if="!this.isFormStored">Confirmation</div>
                <div class="rsvp-confirmation-done-button" v-else>Your RSVP has been noted</div>
            </div>
        </div>
        <wishes></wishes>
        
        <success-rsvp-modal
            v-show="isShowSuccessModal"
            @close="closeModal"
        />
        
        <failed-rsvp-modal
            v-show="isShowFailedModal"
            @close="closeModal"
        />
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

    .rsvp-form-input, .rsvp-form-textarea, .rsvp-form-select, .rsvp-form-custom {
        color: #5E5E5E;
        margin-top: 40px;
        font-size: 20px;
    }

    .rsvp-form-input-value , .rsvp-form-textarea-value, .rsvp-form-select-value {
        margin-top: 10px;
        width: -webkit-fill-available;
        -webkit-appearance: none;
        border-radius: 5px;
        background: #FFF;
        border: none;
        padding: 15px 12px;
        font-size: 20px;
        font-family: 'Abhaya Libre';
        color: #5E5E5E;
    }

    .rsvp-form-textarea-value {
        resize: none;
        vertical-align: top;
    }

    .rsvp-form-disable {
        cursor: not-allowed;
        background: white;
        opacity: 0.6;
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

    .rsvp-form-icon-container {
        width: 100%;
        display: flex;
        overflow-x: auto;
        padding: 15px 0;
    }

    .rsvp-icon {
        width: 50px;
        cursor: pointer;
        padding: 3px;
    }

    .cursor-not-allowed {
        cursor: not-allowed !important;
    }

    .rsvp-icon-active {
        border: 3px solid #3A3A3A;
        border-radius: 50%;
        padding: 0px;
    }

    .rsvp-confirmation-done-button {
        margin: 25px 0;
        color: green;
        text-align: center;
    }

    @media (max-width: 600px) {
        .rsvp-form-input, .rsvp-form-textarea, .rsvp-form-select, .rsvp-form-custom {
            font-size: 16px;
        }

        .rsvp-form-input-value , .rsvp-form-textarea-value, .rsvp-form-select-value {
            font-size: 16px;
        }
    }
</style>

<script>
    import requestUrl from "../../../helper/request"
    import SuccessRsvpModal from "./rsvp-child/success-rsvp-modal.vue"
    import FailedRsvpModal from "./rsvp-child/fail-rsvp-modal.vue"
    import Wishes from "./rsvp-child/wishes.vue"

    export default {
        props: ['user'],
        data() {
            return {
                form: {
                    is_attend: "yes",
                    email: "",
                    number_of_pax: 1,
                    wishes: "",
                    icon_type: "1",
                },
                error: {
                    email: "",
                    wishes: ""
                },
                isSubmitted: false,
                isShowSuccessModal: false,
                isShowFailedModal: false,
                isFormStored: false,
            }
        },
        components: {
            SuccessRsvpModal: SuccessRsvpModal,
            FailedRsvpModal: FailedRsvpModal,
            Wishes: Wishes,
        },
        methods: {
            confirmation() {
                this.isSubmitted = true
                const isSuccess = this.validate()
                if (isSuccess) {
                    this.submitRSVP()
                }
            },
            changeIcon(icon) {
                if (this.isFormStored) {
                    return 
                }

                this.form.icon_type = icon
            },
            validate() {
                let isEmailValid = true
                if (this.form.is_attend == "yes") {
                    isEmailValid = this.validateEmail()
                }

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
                let isAttend = this.form.is_attend == "yes" 
                if (!isAttend) {
                    this.form.email = ""
                    this.form.number_of_pax = 0
                }

                requestUrl.put("/invitations/" + this.user.token, {
                    is_attend: isAttend,
                    email: this.form.email,
                    number_of_attendance: this.form.number_of_pax,
                    wishes: this.form.wishes,
                    wishes_icon_type: this.form.icon_type,
                }).then((response) => {
                    if (response.status == 200) {
                        this.$emit('getInvitationDetail')
                        this.showSuccessModal()
                        return
                    }

                    this.showFailedModal()
                })
                
            },
            showSuccessModal() {
                this.isShowSuccessModal = true
                document.body.style.top = `-${window.scrollY}px`; 
                document.body.classList.add("no-scroll"); 
            },
            showFailedModal() {
                this.isShowFailedModal = true
                document.body.style.top = `-${window.scrollY}px`; 
                document.body.classList.add("no-scroll"); 
            },
            closeModal() {
                this.isShowSuccessModal = false
                this.isShowFailedModal = false
                document.body.classList.remove("no-scroll");
                const scrollY = document.body.style.top;
                window.scrollTo(0, parseInt(scrollY || '0') * -1);
            },
            setGuessData(data) {
                this.isFormStored = true

                this.form.is_attend = data.is_attend ? "yes" : "no"
                this.form.email = data.email
                this.form.number_of_pax = data.number_of_attendance
                this.form.wishes = data.wishes
                this.form.icon_type = data.wishes_icon_type
            },
        },
    }
</script>