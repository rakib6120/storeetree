@extends('frontend.layouts.app')

@section('title')
<title>Storee Tree: Home Page</title>
@endsection

@section('content')
<div class="content_area">
    <div class="common_section story_section">
        <div class="container-fluid">
            <div class="row padding_18_top video_show">
                <div class="col-xs-12 col-sm-12 col-md-6 pull-right">
                    <div class="video_single sd_height">
                        <div class="video_wrapper">
                            <div class="embed-responsive embed-responsive-16by9">
                                <video width="100%" height="100%" controls>
                                    <source src="{{ asset(Helper::storagePath($settings->home_video)) }}" type="video/mp4">
                                </video>
                            </div>
                        </div>
                    </div><!-- end video_single-->
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="story_wrapper sd_height">
                        <div class="story_block">
                            <h2>CREATE YOUR STORY FOR FAMILY, FRIENDS & GENERATIONS TO COME</h2>
                            <ul>
                                <li>Your life in your words - first hand</li>
                                <li>Comes to life with easy video questions</li>
                                <li>Tell us your memories, we make a lasting video for all to enjoy.</li>
                            </ul>
                            <div class="common_btn">
                                <a href="{{ route('create-your-story.step-1') }}">Start Now</a>
                            </div>
                        </div><!--story_block-->
                    </div>
                </div>
            </div>
            <div class="row padding_18">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="single_photo_wrapper sd_height2">
                        <div class="single_photo_block bg_common_1" style="background-image:url({{ URL::to('/') }}/images/frontend/cm_bg_1.jpg)"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="story_wrapper sd_height2">
                        <div class="story_block">
                            <h2>View a Story</h2>
                            <ul>
                                <li>See a family & friends tree - watch their stories</li>
                                <li>Watch their stories</li>
                                <li>Create your own story</li>
                            </ul>
                            <div class="common_btn"><a href="{{ route('view-story') }}">View Story</a></div>
                        </div><!--story_block-->
                    </div><!-- end story_wrapper-->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                    <div class="single_photo_wrapper sd_height2">
                        <div class="single_photo_block bg_common_1" style="background-image:url({{ URL::to('/') }}/images/frontend/aboutbg.jpg)"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="story_wrapper sd_height2">
                        <div class="story_block">
                            <h2>About Us</h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap.</p>

                            <div class="common_btn"><a href="{{ route('about-us') }}">Read More</a></div>
                        </div><!--story_block-->
                    </div>
                </div>
            </div>
        </div>

    </div><!--common_section-->


    @include('frontend.include.blogs')

    <div class="faq_section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="photo_faq">
                        <img src="{{ URL::to('/') }}/images/frontend/faq_bg.jpg" alt=""/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="story_block">
                        <h2>Frequently Asked Questions</h2>
                        <p>Here are answers to most common questions. Can't find an answer?</p>
                        <ul>
                            @foreach($faqs as $faq)
                            <li>{{ $faq->title }}</li>
                            @endforeach
                        </ul>
                        <div class="common_btn"><a href="{{ route('faqs') }}">View All</a></div>
                    </div><!--story_block-->
                </div>
            </div>
        </div>
    </div><!--faq_section-->

    <div class="testimonial_section" style="background-image:url({{ URL::to('/') }}/images/frontend/slider_photo.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="testimonial_tittle">Our Clients Say</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="testimonial_slider">
                        <div id="banner-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="item active" > 
                                    <div class="testimonial_wrapper">
                                        <div class="testimonial_single">
                                            <div class="photo_block_top"><span><img src="{{ URL::to('/') }}/images/frontend/rv_photo.jpg" alt=""/></span></div>
                                            <div class="testimonial_content">
                                                <p>The Group today has eight operating companies (SBUs), a few other business ventures, and a not for profit social enterprise. As of 2019, the Group currently employs more than three thousand five hundred people directly. Rahimafrooz operates in four broad segments – Storage Power, Automotive & Auto Service, Energy and Retail.</p>
                                                <h4>Gisle Birkeland , Codefish</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item" > 
                                    <div class="testimonial_wrapper">
                                        <div class="testimonial_single">
                                            <div class="photo_block_top"><span><img src="{{ URL::to('/') }}/images/frontend/rv_photo.jpg" alt=""/></span></div>
                                            <div class="testimonial_content">
                                                <p>2The Group today has eight operating companies (SBUs), a few other business ventures, and a not for profit social enterprise. As of 2019, the Group currently employs more than three thousand five hundred people directly. Rahimafrooz operates in four broad segments – Storage Power, Automotive & Auto Service, Energy and Retail.</p>
                                                <h4>Gisle Birkeland , Codefish</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="left control" href="#banner-carousel" role="button" data-slide="prev">Prev</a>
                            <a class="right control" href="#banner-carousel" role="button" data-slide="next">Next</a>
                        </div>
                    </div><!--testimonial_slider-->
                </div>
            </div>
        </div>
    </div><!--testimonial_section-->

</div><!--content-->

@endsection