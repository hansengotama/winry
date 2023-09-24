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
                    <select class="rsvp-form-select-value" v-model="form.is_attend">
                        <option value="yes">Definitely, Yes!</option>
                        <option value="no">Sorry, I can’t attend your wedding</option>
                    </select>
                </div>
                <div class="rsvp-form-control" v-if="form.is_attend == 'yes'">
                    <div class="rsvp-form-input">Email</div>
                    <input class="rsvp-form-input-value" type="text" placeholder="Enter your email" v-model="form.email" @keyup="validateEmail()">
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
                    <textarea class="rsvp-form-textarea-value" rows="4" v-model="form.wishes" placeholder="Enter you wishes" @keyup="validateWishes()"></textarea>
                    <div v-show="error.wishes != ''" class="rsvp-form-error-message">{{ error.wishes }}</div>
                </div>
                <div class="rsvp-form-control">
                    <div class="rsvp-form-custom">Wishes Icon</div>
                    <div class="rsvp-form-icon-container">
                        <img src="@/../images/Icons/1.png" class="rsvp-icon" :class="form.icon_type == '1' ? 'rsvp-icon-active' : ''" @click="changeIcon('1')">
                        <img src="@/../images/Icons/2.png" class="rsvp-icon" :class="form.icon_type == '2' ? 'rsvp-icon-active' : ''" @click="changeIcon('2')">
                        <img src="@/../images/Icons/3.png" class="rsvp-icon" :class="form.icon_type == '3' ? 'rsvp-icon-active' : ''" @click="changeIcon('3')">
                        <img src="@/../images/Icons/4.png" class="rsvp-icon" :class="form.icon_type == '4' ? 'rsvp-icon-active' : ''" @click="changeIcon('4')">
                        <img src="@/../images/Icons/5.png" class="rsvp-icon" :class="form.icon_type == '5' ? 'rsvp-icon-active' : ''" @click="changeIcon('5')">
                        <img src="@/../images/Icons/6.png" class="rsvp-icon" :class="form.icon_type == '6' ? 'rsvp-icon-active' : ''" @click="changeIcon('6')">
                        <img src="@/../images/Icons/7.png" class="rsvp-icon" :class="form.icon_type == '7' ? 'rsvp-icon-active' : ''" @click="changeIcon('7')">
                        <img src="@/../images/Icons/8.png" class="rsvp-icon" :class="form.icon_type == '8' ? 'rsvp-icon-active' : ''" @click="changeIcon('8')">
                    </div>
                </div>

                <div class="rsvp-confirmation-button" @click="confirmation()">Confirmation</div>
            </div>
        </div>
        
        <success-rsvp-modal
            v-show="isShowSuccessModal"
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
        vertical-align: top;
    }

    .rsvp-form-disable {
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

    .rsvp-icon-active {
        border: 3px solid #3A3A3A;
        border-radius: 50%;
        padding: 0px;
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
    import SuccessRsvpModal from "./rsvp-child/success-rsvp-modal.vue"

    export default {
        props: ['user'],
        data() {
            return {
                form: {
                    is_attend: "yes",
                    email: "hansenwu98@gmail.com",
                    number_of_pax: 1,
                    wishes: "123",
                    icon_type: "1",
                },
                error: {
                    email: "",
                    wishes: ""
                },
                isSubmitted: false,
                isShowSuccessModal: false,
            }
        },
        components: {
            SuccessRsvpModal: SuccessRsvpModal,
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
                this.form.icon_type = icon
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
                this.showModal()
            },
            showModal() {
                this.isShowSuccessModal = true
                document.body.style.top = `-${window.scrollY}px`; 
                document.body.classList.add("no-scroll"); 
            },
            closeModal() {
                this.isShowSuccessModal = false
                document.body.classList.remove("no-scroll");
                const scrollY = document.body.style.top;
                window.scrollTo(0, parseInt(scrollY || '0') * -1);
            }
        },
    }
</script>