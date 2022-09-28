@extends('frontend.layouts.app')

@section('title')
<title>Storee Tree: Create Your Story - Step 2</title>
@endsection

@section('content')
<div class="video_banner">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="video_banner_single">
                    <div class="embed-responsive embed-responsive-16by9">
                        <video width="100%" height="100%" controls>
                            <source src="{{ asset(Helper::storagePath($settings->story_second_step)) }}" type="video/mp4">
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
                            <li class="current">
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
                        <h2>Choose Questions</h2>
                        <p>Based on your <strong>{{ config('constants.PLAN_TYPES')[$cart['plan']] }} plan ({{ config('constants.PLAN_NO_OF_QUESTIONS')[$cart['plan']] }} Questions)</strong> Click the boxes next to the questions you would like to select (total to equal selected above)</p>
                    </div>
                </div>
            </div>
            {!! Form::open(['method'=>'POST', 'action'=>'frontend\CreateStoryController@step2Store']) !!}
            <div class="row choose_select">
                @foreach($categories as $category)
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="choose_select_common">
                        <h3>{{ $category->title }}</h3>
                        <ul>
                            @foreach($category->questions->where('status', 1) as $question)
                            <li>
                                <div class="av_check">
                                    <input name="questions[]" value="{{ $question->id }}" id="ct1_{{ $question->id }}" type="checkbox" class="question-check" onchange="QuestionPlanCheck('{{ $question->id }}')" @if(isset($cart['questions'])) @if(in_array($question->id, $cart['questions'])) checked @endif @endif>
                                    <label for="ct1_{{ $question->id }}">{{ $question->title }}</label>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div><!--choose_select_common-->
                </div>
                @endforeach

            </div>
            <div class="row">
                <div class="col-xs-12 padding_cs_1">
                    <div class="step_bottom_section">
                        <div class="step_next"><button type="submit" disabled="disabled" name="" class="step_next_btn" >Next</button></div><!--step_next-->
                        <div class="common_btn" style="display: contents"><a href="{{ route('create-your-story.step-1') }}">Back</a></div><!--step_back-->
                    </div><!--step_bottom_section-->
                </div>
            </div>
            {!! Form::close() !!}
        </div>

    </div><!--common_section-->

</div><!--content-->

@endsection

@section('scripts')

<script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>
<link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
<script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>


<script type="text/javascript">
    function QuestionPlanCheck(id) {
        var length = $(".question-check:checked").length;
        if(length >{{ config('constants.PLAN_NO_OF_QUESTIONS')[$cart['plan']] }}){
            if($('#ct1_'+id).is(':checked'))
                $('#ct1_'+id).attr('checked',false);
            Swal.fire('You Have Reached Your Limit To Choose Question According To Your Plan.');
        }
        if (length >= {{ config('constants.PLAN_NO_OF_QUESTIONS')[$cart['plan']] }}) {
            // $('.question-check:not(:checked)').attr('disabled', true);
            
 
            $('.step_next_btn').attr('disabled', false);
        } else {
            // $('.question-check:not(:checked)').attr('disabled', false);
            
            $('.step_next_btn').attr('disabled', true);
        }
    }
    $(window).on("load",function(){
        var length = $(".question-check:checked").length;
        if (length >= {{ config('constants.PLAN_NO_OF_QUESTIONS')[$cart['plan']] }}) {
            // $('.question-check:not(:checked)').attr('disabled', true);
            
            $('.step_next_btn').attr('disabled', false);
        } else {
            $('.question-check:not(:checked)').attr('disabled', false);
            
            $('.step_next_btn').attr('disabled', true);
        }
    });
</script>
@endsection
