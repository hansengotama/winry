<template>
    <div style="border: 1px solid #dee2e6; padding: 20px; border-radius: 20px;">
        <h3>Manage Guess</h3>
        <button class="btn btn-outline-primary" style="margin-top: 10px;">+ Add</button>

        <div class="table-responsive" style="padding-top: 20px;">
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
                    <tr v-for="guess in guesses" :key="guess.id">
                        <th>{{ guess.name }}</th>
                        <th v-html="constructBadgeHTML(guess.guess_group.name)"></th>
                        <th>{{ guess.email == null ? '-' : guess.email }}</th>
                        <th v-html="constructAttendHTML(guess.is_attend)"></th>
                        <th v-html="constructBadgeHTML(guess.number_of_attendance)"></th>
                        <th v-html="constructBadgeHTML(guess.max_attendance)"></th>
                        <th>{{ guess.wishes == null ? '-' : guess.wishes }}</th>
                        <th v-html="constructShowWishesHTML(guess.is_show_wishes)"></th>
                        <th><button class="btn btn-outline-primary">Edit</button></th>
                        <th><button class="btn btn-outline-primary" @click="copyURL(guess.invitation_url)">URL</button></th>
                    </tr>
                </tbody>
            </table>
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
    import requestUrl from "../../helper/request"

    export default {
        data() {
            return {
                guesses: [],
            }
        },
        mounted() {
            this.getGuesses()
        },
        methods: {
            getGuesses() {
                requestUrl.get("/admin/guesses").then((response) => {
                    if (response.status == 200) {
                        this.guesses = response.data.data
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
            }
        }
    }
</script>