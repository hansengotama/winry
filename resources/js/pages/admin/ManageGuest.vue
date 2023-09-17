<template>
    <div style="border: 1px solid #dee2e6; padding: 20px; border-radius: 20px;">
        <h3>Manage Guest</h3>
        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddGuest" style="margin-top: 10px;">+ Add Guest</button>

        <div style="padding: 20px 0;">
            <h4>Filter</h4>
            <div style="display: flex; align-items: center; justify-content: space-around; flex-direction: row">
                <div style="flex: 1">
                    <input style="width: 90%;" type="name" class="form-control" placeholder="input name" v-model="filter.name">
                </div>
                <div style="flex: 1">
                    <select style="width: 90%;" class="form-select" v-model="filter.groupGuestId">
                        <option value=null>choose group</option>
                        <option :value=group.id v-for="group in groups" :key="group.id">{{ group.name }}</option>
                    </select>
                </div>
                <div style="flex: 1">
                    <button class="btn btn-outline-primary" @click="applyFilter()">Filter</button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Group</th>
                        <th scope="col">Email</th>
                        <th scope="col">Attend</th>
                        <th scope="col">Num of Attendee</th>
                        <th scope="col">Max Attendee</th>
                        <th scope="col">Wishes</th>
                        <th scope="col">Show Wishes</th>
                        <th scope="col" colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr v-for="guest, index in guests" :key="guest.id" v-if="guests.length > 0">
                        <th>{{ index + 1 }}</th>
                        <th>{{ guest.name }}</th>
                        <th v-html="constructBadgeHTML(guest.guest_group.name)"></th>
                        <th>{{ guest.email == null ? '-' : guest.email }}</th>
                        <th v-html="constructAttendHTML(guest.is_attend)"></th>
                        <th v-html="constructBadgeHTML(guest.number_of_attendance)"></th>
                        <th v-html="constructBadgeHTML(guest.max_attendance)"></th>
                        <th>{{ guest.wishes == null ? '-' : guest.wishes }}</th>
                        <th v-html="constructShowWishesHTML(guest.is_show_wishes)"></th>
                        <th><button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditGuest" @click="onClickUpdateGuest(guest)">Edit</button></th>
                        <th><button class="btn btn-outline-primary" @click="copyURL(guest.invitation_url)">URL</button></th>
                        <th><button class="btn btn-outline-danger" @click="onDeleteGuest(guest.id, guest.name)">Delete</button></th>
                    </tr>
                </tbody>
            </table>
            <paginate :paginateData="paginateData" @changePage="changePage" style="margin-top: 20px"></paginate>

            <div v-if="guests.length == 0" style="padding-top: 4px; text-align: center;">No data available</div>
        </div>
        
        <!-- Modal Add -->
        <div class="modal fade" id="modalAddGuest" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Guest</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="resetCreateGuest()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="name" class="form-control" placeholder="input name" v-model="createGuest.name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Max Attendee</label>
                            <input type="number" class="form-control" placeholder="input max attendee" v-model="createGuest.maxAttendance">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Group</label>
                            <select class="form-select" v-model="createGuest.groupGuestId">
                                <option value=null>choose group</option>
                                <option :value=group.id v-for="group in groups" :key="group.id">{{ group.name }}</option>
                            </select>
                        </div>
                        <div style="color:red" class="form-text">{{  createGuestError }}</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="resetCreateGuest()">Close</button>
                        <button type="button" class="btn btn-primary" @click="submitCreateGuest()">Add</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Edit -->
        <div class="modal fade" id="modalEditGuest" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Guest</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="resetUpdateGuest()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="name" class="form-control" placeholder="input name" v-model="updateGuest.name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Max Attendee</label>
                            <input type="number" class="form-control" placeholder="input max attendee" v-model="updateGuest.maxAttendance">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Group</label>
                            <select class="form-select" v-model="updateGuest.groupGuestId">
                                <option value=null>choose group</option>
                                <option :value=group.id v-for="group in groups" :key="group.id">{{ group.name }}</option>
                            </select>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" v-model="updateGuest.isShowWishes">
                            <label class="form-check-label">
                                Show Wishes
                            </label>
                        </div>
                        <div style="color:red" class="form-text">{{  updateGuestError }}</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="resetUpdateGuest()">Close</button>
                        <button type="button" class="btn btn-primary" @click="submitUpdateGuest()">Save</button>
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
    import paginate from './../../shared/paginate.vue'

    export default {
        data() {
            return {
                guests: [],
                groups: [],
                createGuest: {
                    name: null,
                    maxAttendance: null,
                    groupGuestId: null,
                },
                updateGuest: {
                    id: null,
                    name: null,
                    maxAttendance: null,
                    groupGuestId: null,
                    isShowWishes: null,
                },
                createGuestError: "",
                updateGuestError: "",
                copiedURL: "",
                filter: {
                    name: null,
                    groupGuestId: null,
                    page: 1,
                },
                paginateData: {
                    currentPage: 0,
                    lastPage: 0
                }
            }
        },
        components: {
            Paginate: paginate,
        },
        mounted() {
            this.getGuests()
            this.getGuestGroup() 
        },
        methods: {
            changePage(page) {
                this.filter.page = page

                this.getGuests()
            },
            onClickUpdateGuest(guest) {
                this.updateGuest.id = guest.id
                this.updateGuest.name = guest.name
                this.updateGuest.maxAttendance = guest.max_attendance
                this.updateGuest.groupGuestId = guest.guest_group_id
                this.updateGuest.isShowWishes = guest.is_show_wishes == 1 ? true : false
            },
            resetCreateGuest() {
                this.createGuest.name = null
                this.createGuest.maxAttendance = null
                this.createGuest.groupGuestId = null
            },
            resetUpdateGuest() {
                this.updateGuest.id = null
                this.updateGuest.name = null
                this.updateGuest.maxAttendance = null
                this.updateGuest.groupGuestId = null
                this.updateGuest.isShowWishes = null
            },
            validateCreateGuest() {
                if (this.validateName(this.createGuest.name) != null) {
                    this.createGuestError = this.validateName(this.createGuest.name)
                    return false
                }
                
                if (this.validateMaxAttendance(this.createGuest.maxAttendance) != null) {
                    this.createGuestError = this.validateMaxAttendance(this.createGuest.maxAttendance)
                    return false
                }

                if (this.validateGroupGuestId(this.createGuest.groupGuestId) != null) {
                    this.createGuestError = this.validateGroupGuestId(this.createGuest.groupGuestId)
                    return false
                }

                return true
            },
            validateUpdateGuest() {
                if (this.validateName(this.updateGuest.name) != null) {
                    this.updateGuestError = this.validateName(this.updateGuest.name)
                    return false
                }
                
                if (this.validateMaxAttendance(this.updateGuest.maxAttendance) != null) {
                    this.updateGuestError = this.validateMaxAttendance(this.updateGuest.maxAttendance)
                    return false
                }

                if (this.validateGroupGuestId(this.updateGuest.groupGuestId) != null) {
                    this.updateGuestError = this.validateGroupGuestId(this.updateGuest.groupGuestId)
                    return false
                }

                return true
            },
            submitCreateGuest() {
                const isSuccess = this.validateCreateGuest()
                if (!isSuccess) {
                    return;
                }

                this.createGuestError = ""
                this.createGuestFunc()
            },
            submitUpdateGuest() {
                const isSuccess = this.validateUpdateGuest()
                if (!isSuccess) {
                    return;
                }

                this.updateGuestError = ""
                this.updateGuestFunc()
            },
            createGuestFunc() {
                requestUrl.post("/admin/guests", {
                    name: this.createGuest.name,
                    max_attendance: this.createGuest.maxAttendance,
                    guest_group_id: this.createGuest.groupGuestId,
                }).then((response) => {
                    if (response.error == null && response.data != null) {
                        this.resetCreateGuest()
                        $("#modalAddGuest").modal("hide")
                        swal.fire(
                            'Success Add Guest!',
                            'URL:' + window.location.origin + '/invitations/' + response.data.data.invitation_url,
                            'success'
                        )
                        this.getGuests()
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
            updateGuestFunc() {
                requestUrl.put("/admin/guests/" + this.updateGuest.id, {
                    name: this.updateGuest.name,
                    max_attendance: this.updateGuest.maxAttendance,
                    guest_group_id: this.updateGuest.groupGuestId,
                    is_show_wishes: this.updateGuest.isShowWishes,
                }).then((response) => {
                    if (response.error == null && response.data != null) {
                        this.resetUpdateGuest()
                        $("#modalEditGuest").modal("hide")
                        swal.fire(
                            'Success Update Guest!',
                            'Yey',
                            'success'
                        )
                        this.getGuests()
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
            validateGroupGuestId(value) {
                if (value == null) {
                    return 'Group is required'
                }

                return null
            },
            applyFilter() {
                this.filter.page = 1
                this.getGuests()
            },
            getGuests() {
                const filterName = this.filter.name ?? ""
                const filterGuestGroupId = this.filter.groupGuestId ?? ""
                
                requestUrl.get("/admin/guests?name="+filterName+"&guest_group_id="+filterGuestGroupId+"&page="+this.filter.page).then((response) => {
                    if (response.status == 200) {
                        this.guests = response.data.data.data
                        this.paginateData.currentPage = response.data.data.current_page
                        this.paginateData.lastPage = response.data.data.last_page
                    }
                })
            },
            getGuestGroup() {
                requestUrl.get("/admin/guest-groups").then((response) => {
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
                url = window.location.origin + '/invitations/' + url
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
            },
            onDeleteGuest(id, name) {
                swal.fire({
                    title: 'Are you sure want to delete "' + name + '"?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.deleteGuess(id)
                    }
                })
            },
            deleteGuess(id) {
                requestUrl.post("/admin/guests/" + id + "/delete")
                .then((response) => {
                    if (response.error == null && response.data != null) {
                        swal.fire(
                            'Success Delete Guest!',
                            'Yey',
                            'success'
                        )
                        this.getGuests()
                        return;
                    }

                    swal.fire({
                        title: 'Error!',
                        text: 'Please try again!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })    
                })
            }
        }
    }
</script>