<template>
    <div style="width: 100%; display: flex; align-items: center; justify-content: center; height: 100vh; background: #E3E5DA; font-size: 24px; color: #5E5E5E; font-weight: 700;" v-show="isLoading">
        <div style="width: 117px;">Loading {{ dot }}</div> 
    </div>
    <div v-show="!isLoading">
        <Transition name="slide-up">
            <div class="opening" v-if="!isShowInvitation">
                <opening @viewInvitation="viewInvitation" :user="user" :fetch="isFetchInvitation"></opening>
            </div>
        </Transition>

        <div class="invitation-detail" v-show="isShowInvitation">
            <music @playAndPauseMusic="playAndPauseMusic" :isAudioPlay="isAudioPlay"></music>
            <introduction></introduction>
            <groom-and-bride></groom-and-bride>
            <our-story></our-story>
            <place-and-date></place-and-date>
            <countdown></countdown>
            <rsvp-form :user="user" @getInvitationDetail="getInvitationDetail" ref="rsvpForm" v-if="isShowInvitation"></rsvp-form>
            <thank-you></thank-you>
            <invitation-footer></invitation-footer>
        </div>
    </div>
</template>

<style scoped>
    .opening {
        position: absolute;
        height: 100%;
        width: 100%;
        background: linear-gradient(
            rgba(0, 0, 0, 0.1),
            rgba(0, 0, 0, 0.5)
        ), url('@/../images/winry/image_w_1.JPG');
        background-position: unset;
        background-repeat: no-repeat;
        background-size: cover;
        z-index: 9999;
    }

    .slide-up-enter-active,
    .slide-up-leave-active {
        transition: transform 0.8s;
    }

    .slide-up-enter, .slide-up-leave-to /* .slide-up-leave-active in <2.1.8 */ {
        transform: translateY(0);
    }

    .slide-up-leave-active {
        transform: translateY(-100%);
    }

    @media (max-width: 720px) {
        .opening {
            background: linear-gradient(
                rgba(0, 0, 0, 0.1),
                rgba(0, 0, 0, 0.2)
            ), url('@/../images/winry/image_m_1.JPG');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    }
</style>

<script>
    import requestUrl from "../../helper/request"
    import Music from "./child/music.vue"
    import Opening from './child/opening.vue'
    import Introduction from "./child/introduction.vue"
    import GroomAndBride from "./child/groom-and-bride.vue"
    import OurStory from "./child/our-story.vue"
    import PlaceAndDate from "./child/place-and-date.vue"
    import Countdown from "./child/countdown.vue"
    import RsvpForm from "./child/rsvp.vue"
    import ThankYou from "./child/thank-you.vue"
    import Footer from "./child/footer.vue"

    export default {
        data() {
            return {
                user: {},
                isShowInvitation: false,
                audio: new Audio("/musics/la-vie-en-rose.mp3"),
                isAudioPlay: false,
                isFetchInvitation: true,
                isLoading: true,
                dot: "",
                timeoutDot: null,
            }
        },
        mounted() {
            this.getInvitationDetail(true) 
            this.initiateMusic()
            this.updateDot()

            this.isLoading = false
            // window.onload = () => {
            //     this.isLoading = false
            // }

            // window.addEventListener('load', () => {
            //     this.isLoading = false
            // })
        },
        components: {
            Opening: Opening,
            Music: Music,
            Introduction: Introduction,
            GroomAndBride: GroomAndBride,
            OurStory: OurStory,
            PlaceAndDate: PlaceAndDate,
            Countdown: Countdown,
            RsvpForm: RsvpForm,
            ThankYou: ThankYou,
            InvitationFooter: Footer,
        },
        methods: {
            updateDot() {
                if (!this.isLoading) {
                    return
                }

                if (this.dot.length > 7) {
                    this.dot = ""
                    this.timeoutDot = setTimeout(this.updateDot, 500);
                    return;
                }

                this.dot += ". ";
                this.timeoutDot = setTimeout(this.updateDot, 500);
            },
            getInvitationDetail(isFromMounted) {
                requestUrl.get("/invitations/" + this.getTokenFromURL()).then((response) => {
                    if (response.data == null) {
                        this.redirectToNotFound()
                        return
                    }

                    this.user = response.data.data
                    this.isFetchInvitation = false

                    if (!isFromMounted) {
                        this.$refs.rsvpForm.setGuessData(this.user)
                    }
                })
            },
            getTokenFromURL() {
                return this.$route.params.token
            },
            redirectToNotFound() {
                this.$router.push({
                    name: "Not Found"
                })
            },
            viewInvitation() {
                this.isShowInvitation = true
                this.playAndPauseMusic()
            },
            initiateMusic() {
                this.audio.loop = true;
            },
            playAndPauseMusic() {
                if (this.isAudioPlay) {
                    this.audio.pause();
                    this.isAudioPlay = false
                    return
                }

                this.audio.play();
                this.isAudioPlay = true
            },
        }
    }
</script>