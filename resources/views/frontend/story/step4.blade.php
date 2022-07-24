@extends('frontend.layouts.app')

@section('title')
<title>Storee Tree: Create Your Story - Step 4</title>
@endsection

@section('content')

<div class="video_banner">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="video_banner_single">
                    <div class="embed-responsive embed-responsive-16by9">
                        <video width="100%" height="100%" controls>
                            <source src="{{ asset(Helper::storagePath($settings->story_fourth_step)) }}" type="video/mp4">
                        </video>
                    </div>
                </div><!--video_banner_single-->
            </div>
        </div>
    </div>
</div><!--video_banner-->

<div class="step_section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="deliver_process_section">

                    <div class="deliver_order_process_dop">
                        <ul>
                            <li class="active">
                                <div class="process_tick"><span></span></div>
                                <div class="process_info_bl">
                                    <h3>Step 1</h3>
                                </div>
                            </li>
                            <li class="active">
                                <div class="process_tick"><span></span></div>
                                <div class="process_info_bl">
                                    <h3>Step 2</h3>
                                </div>
                            </li>
                            <li class="active">
                                <div class="process_tick"><span></span></div>
                                <div class="process_info_bl">
                                    <h3>Step 3</h3>
                                </div>
                            </li>
                            <li class="current">
                                <div class="process_tick"><span></span></div>
                                <div class="process_info_bl">
                                    <h3>Step 4</h3>
                                </div>
                            </li>
                        </ul>
                    </div><!--end deliver_order_process_dop-->
                </div><!--end deliver_process_section-->
            </div>
        </div>
    </div>
</div><!--step_section-->

<div class="video_content">
        
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="rc_tittle_section">
                    <div class="rc_tittle"> Record Answers </div>
                    <div class="rec_time">00 : 00 : 00</div>
                </div><!--end rc_tittle_section-->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="video_cnp_wrapper">
                    <div class="video_rc_container">
                        <div class="video_recorder_wrapper">
                            <div class="qs_top_block">
                                <p>What is the happiest moment of your life and why? What is the happiest moment of your life and why? What is the happiest moment of your life and why?</p>
                            </div><!--qs_top_block-->
                            <div class="video_recor_area">
                                <img src="images/videobg.jpg" alt="" />
                            </div><!--video_recor_area-->
                            <div class="record_icon"><span>REC</span></div>
                            <div class="rc_button_group_bottom">
                                <div class="player_button_left">
                                    <button class="btn_pause"></button>
                                    <button class="btn_play"></button>
                                    <button class="btn_stop"></button>
                                </div><!--player_button_left-->
                                <div class="recorder_review_button">
                                    <button class="btn_review">Review</button>
                                    <button class="btn_re-record" data-toggle="modal" data-target="#confirm_popup_1">Re-record</button>
                                    <button class="btn_accept">Accept</button>
                                </div><!--recorder_review_button-->
                            </div><!--rc_button_group_bottom-->
                        </div><!--video_recorder_wrapper-->

                        <div class="vd_sidebar">
                            <div class="vd_sidebar_inner">
                                <div class="vd_tittle">Questions </div>
                                <div class="vb_qs_wrapper">
                                    <div class="vb_qs_scroll">
                                        <ul class="scroll_block">
                                            @foreach($questions as $question)
                                            <li class="{{ $question->class }}">
                                                <a href="javascript:void(0)" id="{{ $question->id }}" class="bookmark-fill">{{ $question->title }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div><!--vb_qs_scroll-->
                                </div><!--vb_qs_wrapper-->
                            </div><!--vd_sidebar_inner-->
                        </div><!--vd_sidebar-->
                        
                    </div><!--video_rc_container-->
                </div><!--video_wrapper-->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 padding_cs_1">
                <div class="step_bottom_section">
                    <div class="step_next"><button type="button" name="" class="step_next_btn" >Next</button></div><!--step_next-->
                </div><!--step_bottom_section-->
            </div>
        </div>
    </div>
    
</div><!--video_content-->

<div class="modal fade modal-vcenter modal_small" id="confirm_popup_1" role="dialog">
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
                        <div class="modal_confirm_btn"><a href="#">Yes</a></div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="modal_cancel_btn"><a href="#" data-dismiss="modal" aria-label="Close">Cancel</a></div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!--forgot password modal end -->

@endsection

@section('scripts')
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">

    $(document).on('click', '.bookmark-fill', function (event) {
        var question_id = $(this).attr('id');
        $('#question_id').val(question_id);
        $('#startButton').click();
    });
    
    let preview = document.getElementById("preview");
    let recording = document.getElementById("recording");
    let startButton = document.getElementById("startButton");
    let stopButton = document.getElementById("stopButton");
    let downloadButton = document.getElementById("downloadButton");
    let logElement = document.getElementById("log");
    let recorded = document.getElementById("recorded");
    // let downloadLocalButton = document.getElementById("downloadLocalButton");

    let recordingTimeMS = 10000; //video limit 10 sec
    var localstream;

    window.log = function (msg) {
    //logElement.innerHTML += msg + "\n";
    console.log(msg);
    }

    window.wait = function (delayInMS) {
    return new Promise(resolve => setTimeout(resolve, delayInMS));
    }

    window.startRecording = function (stream, lengthInMS) {
        let recorder = new MediaRecorder(stream);
        let data = [];

        recorder.ondataavailable = event => data.push(event.data);
        recorder.start();
        log(recorder.state + " for " + (lengthInMS / 1000) + " seconds...");

        let stopped = new Promise((resolve, reject) => {
            recorder.onstop = resolve;
            recorder.onerror = event => reject(event.name);
        });

        let recorded = wait(lengthInMS).then(
            () => recorder.state == "recording" && recorder.stop()
        );

        return Promise.all([
            stopped,
            recorded
            ])
        .then(() => data);
    }

    window.stop = function (stream) {
        stream.getTracks().forEach(track => track.stop());
    }
    var formData = new FormData();
    if (startButton) {
        startButton.addEventListener("click", function () {
            var formData = new FormData();
            startButton.innerHTML = "recording...";
            recorded.style.display = "none";
            stopButton.style.display = "inline-block";
            downloadButton.innerHTML = "rendering..";
            navigator.mediaDevices.getUserMedia({
                video: true,
                audio: false
            }).then(stream => {
                preview.srcObject = stream;
                localstream = stream;
                //downloadButton.href = stream;
                preview.captureStream = preview.captureStream || preview.mozCaptureStream;
                return new Promise(resolve => preview.onplaying = resolve);
            }).then(() => startRecording(preview.captureStream(), recordingTimeMS))
            .then(recordedChunks => {
                let recordedBlob = new Blob(recordedChunks, {
                type: "video/webm"
                });
                recording.src = URL.createObjectURL(recordedBlob);

                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                formData.append('question_id', $('#question_id').val());
                formData.append('video', recordedBlob);

                // downloadLocalButton.href = recording.src;
                // downloadLocalButton.download = "RecordedVideo.webm";
                log("Successfully recorded " + recordedBlob.size + " bytes of " +
                recordedBlob.type + " media.");
                startButton.innerHTML = "Start";
                stopButton.style.display = "none";
                recorded.style.display = "block";
                downloadButton.innerHTML = "Save";
                localstream.getTracks()[0].stop();
            })
            .catch(log);
        }, false);
    }
    if (downloadButton) {
        downloadButton.addEventListener("click", function () {
            console.log(this.getAttribute('data-url'));
            console.log(formData);
            $.ajax({
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            url: this.getAttribute('data-url'),
            success: function (res) {
                if(res.success){
                    location.reload();
                }
            },
            error: function (data) {
                console.log(data);
            }
            });
        }, false);
    }
    if (stopButton) {
        stopButton.addEventListener("click", function () {
            var formData = new FormData();
            stop(preview.srcObject);
            startButton.innerHTML = "Start";
            stopButton.style.display = "none";
            recorded.style.display = "block";
            downloadButton.innerHTML = "Save";
            //localstream.getTracks()[0].stop();

            navigator.mediaDevices.getUserMedia({
                video: true,
                audio: false
            }).then(stream => {
                preview.srcObject = stream;
                localstream = stream;
                //downloadButton.href = stream;
                preview.captureStream = preview.captureStream || preview.mozCaptureStream;
                return new Promise(resolve => preview.onplaying = resolve);
            }).then(() => startRecording(preview.captureStream(), recordingTimeMS))
            .then(recordedChunks => {
                let recordedBlob = new Blob(recordedChunks, {
                type: "video/webm"
                });
                recording.src = URL.createObjectURL(recordedBlob);

                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                formData.append('question_id', $('#question_id').val());
                formData.append('video', recordedBlob);

                // downloadLocalButton.href = recording.src;
                // downloadLocalButton.download = "RecordedVideo.webm";
                log("Successfully recorded " + recordedBlob.size + " bytes of " +
                recordedBlob.type + " media.");
                startButton.innerHTML = "Start";
                stopButton.style.display = "none";
                recorded.style.display = "block";
                downloadButton.innerHTML = "Save";
                localstream.getTracks()[0].stop();
            })
            .catch(log);

        }, false);
    }
</script>
@endsection
