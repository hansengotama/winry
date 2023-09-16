<template>
    <div style="border: 1px solid #dee2e6; padding: 20px; border-radius: 20px;">
        <h3>Manage Group</h3>
        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddGroup" style="margin-top: 10px; margin-bottom: 15px;">+ Add Group</button>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Name</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr v-for="group, index in groups" :key="group.id" v-if="groups.length > 0">
                        <th>{{ index + 1 }}</th>
                        <th>{{ group.name }}</th>
                        <th><button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditGroup" @click="onClickUpdateGroup(group)">Edit</button></th>
                        <th><button class="btn btn-outline-danger" @click="onDeleteGuestGroup(group.id, group.name)">Delete</button></th>
                    </tr>
                </tbody>
            </table>
            <div v-if="groups.length == 0" style="padding-top: 4px; text-align: center;">No data available</div>
        </div>
        
        <!-- Modal Add -->
        <div class="modal fade" id="modalAddGroup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Group</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="resetCreateGroup()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="name" class="form-control" placeholder="input name" v-model="createGroup.name">
                        </div>
                        <div style="color:red" class="form-text">{{  createGroupError }}</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="resetCreateGroup()">Close</button>
                        <button type="button" class="btn btn-primary" @click="submitCreateGroup()">Add</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Edit -->
        <div class="modal fade" id="modalEditGroup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Group</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="resetUpdateGroup()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="name" class="form-control" placeholder="input name" v-model="updateGroup.name">
                        </div>
                        <div style="color:red" class="form-text">{{  updateGroupError }}</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="resetUpdateGroup()">Close</button>
                        <button type="button" class="btn btn-primary" @click="submitUpdateGroup()">Save</button>
                    </div>
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
                groups: [],
                createGroup: {
                    name: null,
                },
                updateGroup: {
                    id: null,
                    name: null,
                },
                createGroupError: "",
                updateGroupError: "",
                copiedURL: ""
            }
        },
        mounted() {
            this.getGuestGroup() 
        },
        methods: {
            onClickUpdateGroup(group) {
                this.updateGroup.id = group.id
                this.updateGroup.name = group.name
            },
            resetCreateGroup() {
                this.createGroup.name = null
            },
            resetUpdateGroup() {
                this.updateGroup.id = null
                this.updateGroup.name = null
            },
            validateCreateGroup() {
                if (this.validateName(this.createGroup.name) != null) {
                    this.createGroupError = this.validateName(this.createGroup.name)
                    return false
                }

                return true
            },
            validateUpdateGroup() {
                if (this.validateName(this.updateGroup.name) != null) {
                    this.updateGroupError = this.validateName(this.updateGroup.name)
                    return false
                }

                return true
            },
            submitCreateGroup() {
                const isSuccess = this.validateCreateGroup()
                if (!isSuccess) {
                    return;
                }

                this.createGroupError = ""
                this.createGroupFunc()
            },
            submitUpdateGroup() {
                const isSuccess = this.validateUpdateGroup()
                if (!isSuccess) {
                    return;
                }

                this.updateGroupError = ""
                this.updateGroupFunc()
            },
            createGroupFunc() {
                requestUrl.post("/admin/guest-groups", {
                    name: this.createGroup.name,
                }).then((response) => {
                    if (response.error == null && response.data != null) {
                        this.resetCreateGroup()
                        $("#modalAddGroup").modal("hide")
                        swal.fire(
                            'Success Add Group!',
                            'Yey',
                            'success'
                        )
                        this.getGuestGroup()
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
            updateGroupFunc() {
                requestUrl.put("/admin/guest-groups/" + this.updateGroup.id, {
                    name: this.updateGroup.name,
                }).then((response) => {
                    if (response.error == null && response.data != null) {
                        this.resetUpdateGroup()
                        $("#modalEditGroup").modal("hide")
                        swal.fire(
                            'Success Update Group!',
                            'Yey',
                            'success'
                        )
                        this.getGuestGroup()
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
            getGuestGroup() {
                requestUrl.get("/admin/guest-groups").then((response) => {
                    if (response.status == 200) {
                        this.groups = response.data.data
                    }
                })
            },
            onDeleteGuestGroup(id, name) {
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
                        this.deleteGuessGroup(id)
                    }
                })
            },
            deleteGuessGroup(id) {
                requestUrl.post("/admin/guest-groups/" + id + "/delete")
                .then((response) => {
                    if (response.error == null && response.data != null) {
                        swal.fire(
                            'Success Delete Group!',
                            'Yey',
                            'success'
                        )
                        this.getGuestGroup()
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