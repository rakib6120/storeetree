@extends('frontend.layouts.app')

@section('title')
<title>Storee Tree: My Profile</title>
@endsection

@section('content')

<div class="banner_subpage" style="background-image:url({{ URL::to('/') }}/images/frontend/subpage_bg_1.jpg)">
    <h1>Profile</h1>
</div><!--subpage_banner-->

<div class="content_area cn_gap_top">
        <div class="blog_list_section">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="blog_filter_section">
                            <div class="pr_back_btn"><a href="{{ route('family-trees') }}">Back To Family Tree</a></div>
                            
                        </div><!--blog_filter_section-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="pr_tittle">Member Information :</div>
                        <div class="pr_row">
                            <div class="pr_photo"><img src="{{ URL::to('/') }}/images/frontend/pr_photo.png" alt="" /></div><!--pr_photo-->
                        </div><!--pr_photo-->
                        <div class="profile_content_row">
                            <ul>
                                <li>
                                    <div class="profile_col_1">
                                        <div class="profile_left_tittle_pr">Full Nmae :</div>
                                        <div class="profile_rt_con">{{ $authuser->full_name }}</div>
                                    </div><!--profile_col_1-->
                                </li>
                                <li class="pr_sub_content">
                                    <div class="profile_col_1">
                                        <div class="profile_left_tittle_pr sb_tittle">Spouse :</div>
                                        <div class="profile_rt_con"><a href="#">Lorem Ipsum</a></div>
                                    </div><!--profile_col_1-->
                                </li>
                                <li class="pr_sub_content">
                                    <div class="profile_col_1">
                                        <div class="profile_left_tittle_pr sb_tittle">Parents :</div>
                                        <div class="profile_rt_con">
                                            <a href="#">Lorem Ipsum</a> 
                                            <a href="#">Lorem Ipsum</a>
                                        </div>
                                    </div><!--profile_col_1-->
                                </li>
                                <li class="pr_sub_content">
                                    <div class="profile_col_1">
                                        <div class="profile_left_tittle_pr sb_tittle">Siblings :</div>
                                        <div class="profile_rt_con">
                                            <a href="#">Lorem Ipsum</a> 
                                        </div>
                                    </div><!--profile_col_1-->
                                </li>
                                <li class="pr_sub_content">
                                    <div class="profile_col_1">
                                        <div class="profile_left_tittle_pr sb_tittle">Children :</div>
                                        <div class="profile_rt_con">
                                            <a href="#">Lorem Ipsum</a> 
                                            <a href="#">Lorem Ipsum</a> 
                                            <a href="#">Lorem Ipsum</a> 
                                        </div>
                                    </div><!--profile_col_1-->
                                </li>
                                <li>
                                    <div class="profile_col_1">
                                        <div class="profile_left_tittle_pr">Date Of Birth :</div>
                                        <div class="profile_rt_con">{{ Carbon\Carbon::parse($authuser->dob)->format('F j, Y') }}</div>
                                    </div><!--profile_col_1-->
                                </li>
                                <li>
                                    <div class="profile_col_1">
                                        <div class="profile_left_tittle_pr">Date Of Death :</div>
                                        <div class="profile_rt_con">April 06, 2018</div>
                                    </div><!--profile_col_1-->
                                </li>
                            </ul>
                        </div><!--profile_content_row-->
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="pr_tittle">Video :</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8">
                        <div class="profile_video_single">
                            <div class="embed-responsive embed-responsive-16by9">
                                <video width="100%" height="100%" controls>
                                    <source src="{{ URL::to('/') }}/images/frontend/Finger_Tap_Single_Videvo.mov" type="video/mp4">
                                </video>
                            </div>
                        </div><!--profile_video_single-->
                    </div>
                </div>
            </div>
        </div><!--blog_section-->
    </div><!--content-->

@endsection