<template>
    <div style="border: 1px solid #dee2e6; padding: 20px; border-radius: 20px;">
        <h3>Manage Guess</h3>
        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddGuess" style="margin-top: 10px;">+ Add Guess</button>

        <div style="padding-top: 20px;">
            12
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Group</th>
                        <th scope="col">Email</th>
                        <th scope="col">Attend</th>
                        <th scope="col">Num of Attendee</th>
                        <th scope="col">Max Attendee</th>
                        <th scope="col">Wishes</th>
                        <th scope="col">Show Wishes</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr v-for="guess in guesses" :key="guess.id" v-if="guesses.length > 0">
                        <th>{{ guess.name }}</th>
                        <th v-html="constructBadgeHTML(guess.guess_group.name)"></th>
                        <th>{{ guess.email == null ? '-' : guess.email }}</th>
                        <th v-html="constructAttendHTML(guess.is_attend)"></th>
                        <th v-html="constructBadgeHTML(guess.number_of_attendance)"></th>
                        <th v-html="constructBadgeHTML(guess.max_attendance)"></th>
                        <th>{{ guess.wishes == null ? '-' : guess.wishes }}</th>
                        <th v-html="constructShowWishesHTML(guess.is_show_wishes)"></th>
                        <th><button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditGuess" @click="onClickUpdateGuess(guess)">Edit</button></th>
                        <th><button class="btn btn-outline-primary" @click="copyURL(guess.invitation_url)">URL</button></th>
                    </tr>
                </tbody>
            </table>
            <div v-if="guesses.length == 0" style="padding-top: 4px; text-align: center;">No data available</div>
        </div>
        
        <!-- Modal Add -->
        <div class="modal fade" id="modalAddGuess" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Guess</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="resetCreateGuess()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="name" class="form-control" placeholder="input name" v-model="createGuess.name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Max Attendee</label>
                            <input type="number" class="form-control" placeholder="input max attendee" v-model="createGuess.maxAttendance">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Group</label>
                            <select class="form-select" v-model="createGuess.groupGuessId">
                                <option value=null>choose group</option>
                                <option :value=group.id v-for="group in groups" :key="group.id">{{ group.name }}</option>
                            </select>
                        </div>
                        <div style="color:red" class="form-text">{{  createGuessError }}</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="resetCreateGuess()">Close</button>
                        <button type="button" class="btn btn-primary" @click="submitCreateGuess()">Add</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Edit -->
        <div class="modal fade" id="modalEditGuess" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Guess</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="resetUpdateGuess()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="name" class="form-control" placeholder="input name" v-model="updateGuess.name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Max Attendee</label>
                            <input type="number" class="form-control" placeholder="input max attendee" v-model="updateGuess.maxAttendance">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Group</label>
                            <select class="form-select" v-model="updateGuess.groupGuessId">
                                <option value=null>choose group</option>
                                <option :value=group.id v-for="group in groups" :key="group.id">{{ group.name }}</option>
                            </select>
                        </div>
                        <div style="color:red" class="form-text">{{  updateGuessError }}</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="resetUpdateGuess()">Close</button>
                        <button type="button" class="btn btn-primary" @click="submitUpdateGuess()">Edit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Copied Toast -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="successCopiedToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="fa-regular fa-copy" style="margin-right: 6px;"></i>
                    <strong class="me-auto">Copied to clipboard!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ copiedURL }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import requestUrl from "../../helper/request"
    import swal from 'sweetalert2';

    export default {
        data() {
            return {
                guesses: [],
                groups: [],
                createGuess: {
                    name: null,
                    maxAttendance: null,
                    groupGuessId: null,
                },
                updateGuess: {
                    id: null,
                    name: null,
                    maxAttendance: null,
                    groupGuessId: null,
                },
                createGuessError: "",
                updateGuessError: "",
                copiedURL: ""
            }
        },
        mounted() {
            this.getGuesses()
            this.getGuessGroup() 
        },
        methods: {
            onClickUpdateGuess(guess) {
                this.updateGuess.id = guess.id
                this.updateGuess.name = guess.name
                this.updateGuess.maxAttendance = guess.max_attendance
                this.updateGuess.groupGuessId = guess.guess_group_id
            },
            resetCreateGuess() {
                this.createGuess.name = null
                this.createGuess.maxAttendance = null
                this.createGuess.groupGuessId = null
            },
            resetUpdateGuess() {
                this.updateGuess.id = null
                this.updateGuess.name = null
                this.updateGuess.maxAttendance = null
                this.updateGuess.groupGuessId = null
            },
            validateCreateGuess() {
                if (this.validateName(this.createGuess.name) != null) {
                    this.createGuessError = this.validateName(this.createGuess.name)
                    return false
                }
                
                if (this.validateMaxAttendance(this.createGuess.maxAttendance) != null) {
                    this.createGuessError = this.validateMaxAttendance(this.createGuess.maxAttendance)
                    return false
                }

                if (this.validateGroupGuessId(this.createGuess.groupGuessId) != null) {
                    this.createGuessError = this.validateGroupGuessId(this.createGuess.groupGuessId)
                    return false
                }

                return true
            },
            validateUpdateGuess() {
                if (this.validateName(this.updateGuess.name) != null) {
                    this.updateGuessError = this.validateName(this.updateGuess.name)
                    return false
                }
                
                if (this.validateMaxAttendance(this.updateGuess.maxAttendance) != null) {
                    this.updateGuessError = this.validateMaxAttendance(this.updateGuess.maxAttendance)
                    return false
                }

                if (this.validateGroupGuessId(this.updateGuess.groupGuessId) != null) {
                    this.updateGuessError = this.validateGroupGuessId(this.updateGuess.groupGuessId)
                    return false
                }

                return true
            },
            submitCreateGuess() {
                const isSuccess = this.validateCreateGuess()
                if (!isSuccess) {
                    return;
                }

                this.createGuessError = ""
                this.createGuessFunc()
            },
            submitUpdateGuess() {
                const isSuccess = this.validateUpdateGuess()
                if (!isSuccess) {
                    return;
                }

                this.updateGuessError = ""
                this.updateGuessFunc()
            },
            createGuessFunc() {
                requestUrl.post("/admin/guesses", {
                    name: this.createGuess.name,
                    max_attendance: this.createGuess.maxAttendance,
                    guess_group_id: this.createGuess.groupGuessId,
                }).then((response) => {
                    if (response.error == null && response.data != null) {
                        this.resetCreateGuess()
                        $("#modalAddGuess").modal("hide")
                        swal.fire(
                            'Success Add Guess!',
                            'URL:' + response.data.data.invitation_url,
                            'success'
                        )
                        this.getGuesses()
                        return;
                    }

                    swal.fire({
                        title: 'Error!',
                        text: 'Please try again!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })    
                })
            },
            updateGuessFunc() {
                requestUrl.put("/admin/guesses/" + this.updateGuess.id, {
                    name: this.updateGuess.name,
                    max_attendance: this.updateGuess.maxAttendance,
                    guess_group_id: this.updateGuess.groupGuessId,
                }).then((response) => {
                    if (response.error == null && response.data != null) {
                        this.resetUpdateGuess()
                        $("#modalEditGuess").modal("hide")
                        swal.fire(
                            'Success Update Guess!',
                            'Yey',
                            'success'
                        )
                        this.getGuesses()
                        return;
                    }

                    swal.fire({
                        title: 'Error!',
                        text: 'Please try again!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })    
                })
            },
            validateName(value) {
                if (value == null || value == "") {
                    return 'Name is required'
                }

                return null
            },
            validateMaxAttendance(value) {
                if (value == null) {
                    return 'Max Attendee is required'
                }

                if (value <= 0) {
                    return 'Max Attendee cannot be 0 or less'
                }

                return null
            },
            validateGroupGuessId(value) {
                if (value == null) {
                    return 'Group is required'
                }

                return null
            },
            getGuesses() {
                requestUrl.get("/admin/guesses").then((response) => {
                    if (response.status == 200) {
                        this.guesses = response.data.data
                    }
                })
            },
            getGuessGroup() {
                requestUrl.get("/admin/guess-groups").then((response) => {
                    if (response.status == 200) {
                        this.groups = response.data.data
                    }
                })
            },
            constructAttendHTML(value) {
                if (value == true) {
                    return '<span class="badge rounded-pill text-bg-success">Yes</span>'
                }

                if (value == false) {
                    return '<span class="badge rounded-pill text-bg-danger">No</span>'
                }

                if (value == null) {
                    return '<span class="badge rounded-pill text-bg-warning">Pending</span>'
                }
            },
            constructShowWishesHTML(value) {
                if (value == 1) {
                    return '<i class="fa-solid fa-check text-success"></i>'
                }

                return '<i class="fa-solid fa-xmark text-danger"></i>'
            },
            constructBadgeHTML(value) {
                if (value == null) {
                    return '<span class="badge rounded-pill text-bg-light" style="font-weight: bold">-</span>'
                }

                return '<span class="badge rounded-pill text-bg-light"  style="font-weight: bold">'+value+'</span>'
            },
            copyURL(url) {
                const textarea = document.createElement("textarea");
                textarea.value = url;

                // Make the textarea invisible
                textarea.style.position = "absolute";
                textarea.style.left = "-9999px";

                // Append the textarea to the DOM
                document.body.appendChild(textarea);

                // Select and copy the text in the textarea
                textarea.select();
                document.execCommand("copy");

                // Remove the textarea from the DOM
                document.body.removeChild(textarea);
                this.copiedURL = url
                $('#successCopiedToast').toast('show');
            }
        }
    }
</script>