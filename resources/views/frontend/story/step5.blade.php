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
                            <li class="active">
                                <div class="process_tick"><span></span></div>
                                <div class="process_info_bl">
                                    <h3>Step 4</h3>
                                </div>
                            </li>
                            <li class="current">
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

<div class="video_content">
        
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="rc_tittle_section">
                    <div class="rc_tittle">All Video</div>
                </div><!--end rc_tittle_section-->
            </div>
        </div>
        <div class="row">
            @foreach ($questions as $question)
                @php
                    $story = $storyItems->where('question_id', $question->id)->first();
                @endphp
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="single_video_thm">
                        <div class="video_thm_top">
                            <div class="embed-responsive embed-responsive-16by9">
                                <video width="100%" height="100%" controls>
                                    <source src="/{{ $story['video'] }}" type="video/mp4">
                                </video>
                            </div>
                        </div><!--video_thm_top-->
                        <div class="video_thm_button_group">
                            <div class="recorder_review_button">
                                <a href="{{ route('create-your-story.step-4.show', $question->id) }}" class="btn_re-record">Re-Record</a>
                            </div><!--recorder_review_button-->
                        </div><!--video_thm_button_group-->
                        <div class="video_qs_thm">
                            <h3>{{ $question->title }}</h3>
                        </div><!--video_qs_thm-->
                    </div><!--single_video_thm-->
                </div>
            @endforeach

        </div>
        <div class="row">
            <div class="col-xs-12 padding_cs_1">
                <div class="step_bottom_section">
                    <div class="step_next">
                        <button type="button" name="" class="step_next_btn" data-toggle="modal" data-target="#cart_popup">Accept All Videos</button>
                    </div><!--step_next-->
                </div><!--step_bottom_section-->
            </div>
        </div>
    </div>
    
</div><!--video_content-->


<div class="modal fade modal-vcenter modal_cart" id="cart_popup" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="cart_top">
                            <h3>Cart</h3>
                            <p>Great Job! as our proprietary software is building your special personalized video, this is a great time to go through Checkout. Please confirm the selected package below and click on to Payment Info</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="cart_table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h3>{{ $packagePlan['title'] }}</h3>
                                        </td>
                                        <td class="price_col">
                                            <strong>${{ $packagePlan['price'] }}</strong>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div><!--cart_table-->
                    </div>
                </div>
                
                
                <div class="row padding_gap_3">
                    <div class="col-xs-12">
                        <div class="modal_confirm_btn checkout_link"><a href="{{ route('story.pay') }}">Payment Info</a></div>
                    </div>
                    
                </div>

            </div>
            
        </div>
    </div>
</div>


@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
