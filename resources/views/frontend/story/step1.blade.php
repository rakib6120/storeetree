@extends('frontend.layouts.app')

@section('title')
<title>Storee Tree: Create Your Story - Step 1</title>
@endsection

@section('content')
<div class="video_banner">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="video_banner_single">
                    <div class="embed-responsive embed-responsive-16by9">
                        <video width="100%" height="100%" controls>
                            <source src="{{ asset(Helper::storagePath($settings->story_first_step)) }}" type="video/mp4">
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
                            <li class="current">
                                <div class="process_tick"><span></span></div>
                                <div class="process_info_bl">
                                    <h3>Step 1</h3>
                                </div>
                            </li>
                            <li>
                                <div class="process_tick"><span></span></div>
                                <div class="process_info_bl">
                                    <h3>Step 2</h3>
                                </div>
                            </li>
                            <li>
                                <div class="process_tick"><span></span></div>
                                <div class="process_info_bl">
                                    <h3>Step 3</h3>
                                </div>
                            </li>
                            <li>
                                <div class="process_tick"><span></span></div>
                                <div class="process_info_bl">
                                    <h3>Step 4</h3>
                                </div>
                            </li>
                            <li>
                                <div class="process_tick"><span></span></div>
                                <div class="process_info_bl">
                                    <h3>Step 5</h3>
                                </div>
                            </li>
                        </ul>
                    </div><!--end deliver_order_process_dop-->
                </div><!--end deliver_process_section-->
            </div>
        </div>
    </div>
</div><!--step_section-->

<div class="content_area plan_section">
    <div class="common_section story_section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="pp_top_section">
                        <h2>START YOUR STORY NOW </h2>
                        <p>Welcome - STEP ONE is to choose whiche Storee Package you would like</p>
                    </div>
                </div>
            </div>

            @include('backend.include.error')

            {!! Form::open(['method'=>'POST', 'action'=>'frontend\CreateStoryController@step1Store']) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="plan_single_block">
                        <div class="priceblock_top">
                            <h4>Lite</h4>
                            <h2>$19.95</h2>
                            <h3>One Time</h3>
                        </div><!--priceblock_top-->
                        <div class="plan_dsp">
                            <ul>
                                <li class="active">5 Questions</li>
                                <li>Free "your decade" memories</li>
                                <li>Unlimited Re-recording until you are happy with your videos</li>
                                <li class="active">Free Family Tree Building</li>
                                <li class="active">Unlimited Friend Connections</li>
                            </ul>
                        </div><!--plan_dsp-->
                        <div class="plan_select_option">
                            <div class="radio_check">
                                <input name="plan" id="plan_1" type="radio" value="1">
                                <label for="plan_1">Select this Plan</label>
                            </div>
                        </div><!--plan_select_option-->
                    </div><!--plan_single_block-->
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="plan_single_block">
                        <div class="priceblock_top">
                            <h4>Standard</h4>
                            <h2>$27.95</h2>
                            <h3>One Time</h3>
                        </div><!--priceblock_top-->
                        <div class="plan_dsp">
                            <ul>
                                <li class="active">7 Questions</li>
                                <li class="active">Free "your decade" memories</li>
                                <li class="active">Unlimited Re-recording until you are happy with your videos</li>
                                <li class="active">Free Family Tree Building</li>
                                <li class="active">Unlimited Friend Connections</li>
                            </ul>
                        </div><!--plan_dsp-->
                        <div class="plan_select_option">
                            <div class="radio_check">
                                <input name="plan" id="plan_2" value="2" type="radio">
                                <label for="plan_2">Select this Plan</label>
                            </div>
                        </div><!--plan_select_option-->
                    </div><!--plan_single_block-->
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="plan_single_block">
                        <div class="priceblock_top">
                            <h4>Premimum</h4>
                            <h2>$29.95</h2>
                            <h3>One Time</h3>
                        </div><!--priceblock_top-->
                        <div class="plan_dsp">
                            <ul>
                                <li class="active">10 Questions</li>
                                <li class="active">Free "your decade" memories</li>
                                <li class="active">Unlimited Re-recording until you are happy with your videos</li>
                                <li class="active">Free Family Tree Building</li>
                                <li class="active">Unlimited Friend Connections</li>
                            </ul>
                        </div><!--plan_dsp-->
                        <div class="plan_select_option">
                            <div class="radio_check">
                                <input name="plan" id="plan_3" value="3" type="radio">
                                <label for="plan_3">Select this Plan</label>
                            </div>
                        </div><!--plan_select_option-->
                    </div><!--plan_single_block-->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 padding_cs_1">
                    <div class="step_bottom_section">
                        <div class="step_next"><button type="submit" style="display: none" >Next</button></div><!--step_next-->
                    </div><!--step_bottom_section-->
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div><!--common_section-->
</div><!--content-->

@endsection

@section('scripts')
    <script>
		$(window).on("load", function(){
        	$('input[name="plan"]').change(function(input){
            	$('button[type="submit"]')[0].click();
            });
    	});
    </script>
@endsection