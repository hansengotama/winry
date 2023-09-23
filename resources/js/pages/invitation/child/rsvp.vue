<template>
    <div class="rsvp-container">
        <div class="rsvp-section">
            <div class="rsvp-title">RSVP</div>
            <div class="rsvp-description">Attendance Confirmation</div>
            <div class="rsvp-form-container">
                <div class="rsvp-form-control">
                    <div class="rsvp-form-input">Full Name</div>
                    <input class="rsvp-form-input-value" type="text">
                </div>
                <div class="rsvp-form-control">
                    <div class="rsvp-form-select">Attendance</div>
                    <select class="rsvp-form-select-value">
                        <option value="">Yes</option>
                        <option value="">No</option>
                    </select>
                </div>
                <div class="rsvp-form-control">
                    <div class="rsvp-form-input">Phone Number</div>
                    <input class="rsvp-form-input-value" type="text">
                </div>
                <div class="rsvp-form-control">
                    <div class="rsvp-form-select">Number of Pax</div>
                    <select class="rsvp-form-select-value">
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                </div>
                <div class="rsvp-form-control">
                    <div class="rsvp-form-textarea">Wishes for Ryan & Winnie</div>
                    <textarea class="rsvp-form-textarea-value" rows="4"></textarea>
                </div>

                <div class="rsvp-confirmation-button">Confirmation</div>
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
</style>