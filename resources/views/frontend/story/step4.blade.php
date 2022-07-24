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
                    {{-- <div class="rec_time">00 : 00 : 00</div> --}}
                </div><!--end rc_tittle_section-->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="video_cnp_wrapper">
                    <div class="video_rc_container">
                        <video-recorder></video-recorder>

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


@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
