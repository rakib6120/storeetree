@extends('frontend.layouts.app')

@section('header')
    <link href="https://vjs.zencdn.net/7.20.2/video-js.css" rel="stylesheet" />
@endsection

@section('title')
<title>Storee Tree: Create Your Story - Step 4</title>
@endsection

@section('content')
<div class="banner_subpage" style="background-image:url({{ URL::to('/') }}/images/frontend/subpage_bg_1.jpg)">
    <h1>All Storoes</h1>
</div><!--subpage_banner-->

<div class="video_content">
        
    <div class="container">
        <div class="row">
            @forelse ($stories as $story)
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="single_video_thm">
                        <div class="video_thm_top">
                            <div class="embed-responsive embed-responsive-16by9">
                                <video width="100%" height="100%" controls>
                                    <source src="{{ $story->video_url }}" >
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-danger text-center" role="alert">
                    <strong>No story found!</strong>
                </div>
            @endforelse

        </div>
    </div>
    
</div><!--video_content-->
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://vjs.zencdn.net/7.20.2/video.min.js"></script>
@endsection
