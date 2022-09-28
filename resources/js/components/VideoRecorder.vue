<template>
    <div class="video_recorder_wrapper">
        <div class="qs_top_block">
            <p>{{ currentQuestion.title }}</p>
        </div><!--qs_top_block-->
        <div class="video_recor_area">
            <video id="myVideo" class="video-js vjs-default-skin">
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, or consider upgrading to a
                    web browser that
                    <a href="https://videojs.com/html5-video-support/" target="_blank">
                        supports HTML5 video.
                    </a>
                </p>
            </video>
        </div><!--video_recor_area-->
        <div class="rc_button_group_bottom">
            <div class="player_button_left">
                <button class="btn_play" v-if="!isStartRecording" @click="startRecording()"></button>
                <button class="btn_pause" v-if="!isPauseDisabled" @click="pauseRecording()"></button>
                <button class="btn_play" v-if="!isResumeDisabled" @click="resumeRecording()"></button>
                <button class="btn_stop" v-if="!isStopRecording" @click="stopRecording()"></button>
            </div><!--player_button_left-->
            <div class="recorder_review_button">
                <button class="btn_re-record" :disabled="isRetakeDisabled" data-toggle="modal" data-target="#retake-video" ref="retakeVideo">Re-record</button>
                <button class="btn_accept" @click="submitVideo()" :disabled="isSaveDisabled">{{ submitText }}</button>
            </div><!--recorder_review_button-->
        </div><!--rc_button_group_bottom-->

        <div class="modal fade modal-vcenter modal_small" id="retake-video" ref="retakeVideo" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="modal_tittle">
                                    <h2>Are You Sure You Want to Re-Record This Question ?</h2>
                                </div>
                            </div>
                        </div>

                        <div class="row padding_gap_3">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="modal_confirm_btn"><a href="#" @click.prevent="retakeVideo()" data-dismiss="modal">Yes</a></div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="modal_cancel_btn"><a href="#" data-dismiss="modal" aria-label="Close">Cancel</a></div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div><!--video_recorder_wrapper-->

        
    <!-- <button type="button" class="btn btn-info" @click.prevent="startRecording()" v-bind:disabled="isStartRecording" id="btnStart">Start Recording</button>
    <button type="button" class="btn btn-info" @click.prevent="resumeRecording()" v-bind:disabled="isResumeDisabled">Resume</button>
    <button type="button" class="btn btn-info" @click.prevent="pauseRecording()" v-bind:disabled="isPauseDisabled">Pause</button>
    <button type="button" class="btn btn-success" @click.prevent="submitVideo()" v-bind:disabled="isSaveDisabled" id="btnSave">{{ submitText }}</button>
    <button type="button" class="btn btn-primary" @click.prevent="retakeVideo()" v-bind:disabled="isRetakeDisabled" id="btnRetake">Retake</button> -->
</template>

<script>
import 'video.js/dist/video-js.css'
import 'videojs-record/dist/css/videojs.record.css'
import videojs from 'video.js'
import 'webrtc-adapter'
import RecordRTC from 'recordrtc'
import Record from 'videojs-record/dist/videojs.record.js'
import FFmpegjsEngine from 'videojs-record/dist/plugins/videojs.record.ffmpegjs.js';
import Swal from 'sweetalert2'

export default {
    props: ['upload_url', 'question'],
    data() {
        return {
            player: '',
            retake: 0,
            isSaveDisabled: true,
            isStartRecording: false,
            isStopRecording: true,
            isResumeDisabled: true,
            isPauseDisabled: true,
            isRetakeDisabled: true,
            submitText: 'Accept',
            options: {
                controls: true,
                autoplay: true,
                bigPlayButton: false,
                controlBar: {
                    deviceButton: false,
                    recordToggle: false,
                    pipToggle: false
                },
                width: 1020,
                height: 1080,
                plugins: {
                    record: {
                        pip: false,
                        audio: true,
                        video: true,
                        maxLength: 60,
                        debug: true
                    }
                }
            },

            currentQuestion: {}
        }
    },
    mounted() {
        this.currentQuestion = JSON.parse(this.question);
        this.player = videojs('myVideo', this.options, () => {
            // print version information at startup
            let msg = 'Using video.js ' + videojs.VERSION +
                ' with videojs-record ' + videojs.getPluginVersion('record') +
                ' and recordrtc ' + RecordRTC.version;
            videojs.log(msg);
        });

        if (this.currentQuestion.video) {
            this.player.src(`/${this.currentQuestion.video}`);
        }

        // error handling
        this.player.on('deviceReady', () => {
            this.player.record().start();
        });
        this.player.on('deviceError', () => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: this.player.deviceErrorCode
            });
        });
        this.player.on('error', (element, error) => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error
            });
        });
        // user clicked the record button and started recording
        this.player.on('startRecord', () => {
            this.isPauseDisabled = false;
            this.isStopRecording = false;
        });
        // user completed recording and stream is available
        this.player.on('finishRecord', () => {
            this.isSaveDisabled = false;
            this.isStartRecording = true;
            this.isStopRecording = true;
            this.isResumeDisabled = true;
            this.isPauseDisabled = true;
            this.player.record().stopDevice();
        });
    },
    methods: {
        startRecording() {
            this.isStartRecording = true;
            this.isRetakeDisabled = false;
            this.player.record().getDevice();
        },
        submitVideo() {
            this.isSaveDisabled = true;
            let data = this.player.recordedData;
            let formData = new FormData();
            formData.append('video', data, data.name);
            formData.append('question_id', this.currentQuestion.id);

            this.submitText = "Uploading "+data.name;
            this.player.record().stopDevice();

            axios({
                method: "post",
                url: this.upload_url,
                data: formData,
                headers: {
                    "Content-Type": "multipart/form-data",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).then(
                res => {
                    if (res.status === 200) {
                        this.submitText = "Upload Complete";
                        window.location.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "Upload Failed"
                        });
                        this.submitText = "Upload Failed";
                    }
                }
            ).catch(
                error =>{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "Upload Failed"
                    });
                    this.submitText = "Upload Failed";
                }
            );
        },
        resumeRecording() {
            this.isResumeDisabled = true;
            this.isPauseDisabled = false;
            this.player.record().resume();
        },
        pauseRecording() {
            this.isPauseDisabled = true;
            this.isResumeDisabled = false;
            this.player.record().pause();
        },
        stopRecording() {
                this.isSaveDisabled = true;
                this.isStartRecording = true;
                this.isResumeDisabled = true;
                this.isPauseDisabled = true;
                this.player.record().stop();
        },
        retakeVideo() {
            this.isSaveDisabled   = true;
            this.isStartRecording = true;
            this.isResumeDisabled = true;
            this.isPauseDisabled  = false;
            this.submitText       = "Accept";

            this.retake += 1;
            this.player.record().start();
        }
    },
    beforeDestroy() {
        if (this.player) {
            this.player.dispose();
        }
    }
}
</script>

<style scoped>
    .video_recor_area {
        padding-top: 5rem;
        padding-bottom: 6rem;
    }
    .video_recor_area #myVideo {
        width: 100%;
        height: 100%;
    }
</style>