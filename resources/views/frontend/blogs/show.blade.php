@extends('frontend.layouts.app')

@section('title')
<title>Storee Tree: Blog List</title>
@endsection

@section('content')

<div class="banner_subpage" style="background-image:url({{ URL::to('/') }}/images/frontend/subpage_bg_1.jpg)">
    <h1>Blog</h1>
</div><!--subpage_banner-->

<div class="content_area cn_gap_top">
    <div class="blog_detail_section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8">
                    <div class="blog_generic">
                        <h2>{{ $blog->title }}</h2>
                        <hr/>
                        <img src="{{ asset(Helper::storagePath($blog->thumbnail)) }}" alt="" />
                        <h3>{!! $blog->subtitle !!}</h3>
                        {!! $blog->description !!}
                    </div><!--blog_generic-->
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="blog_sidebar">
                        <div class="blog_sidebar_tittle">
                            <h3>Recent Post</h3>
                        </div><!--blog_sidebar_tittle-->
                        <div class="blog_post_list_sd">
                            @foreach($recents as $recent)
                            <div class="recent_blog_single">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="{{ route('blogs.show', $recent->id) }}"><img src="{{ asset(Helper::storagePath($recent->thumbnail)) }}" alt=""/></a>
                                    </div>
                                    <div class="media-body">
                                        <p><a href="{{ route('blogs.show', $recent->id) }}">{{ $recent->title }}</a></p>
                                    </div>
                                </div>
                            </div><!--recent_work_single-->
                            @endforeach
                        </div><!--blog_post_list_sd-->
                        <div class="blog_sidebar_tittle">
                            <h3>Most Popular</h3>
                        </div><!--blog_sidebar_tittle-->
                        <div class="blog_post_list_sd">
                            @foreach($populars as $popular)
                            <div class="recent_blog_single">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="{{ route('blogs.show', $popular->id) }}"><img src="{{ asset(Helper::storagePath($popular->thumbnail)) }}" alt=""/></a>
                                    </div>
                                    <div class="media-body">
                                        <p><a href="{{ route('blogs.show', $popular->id) }}">{{ $popular->title }}</a></p>
                                    </div>
                                </div>
                            </div><!--recent_work_single-->
                            @endforeach
                        </div><!--blog_post_list_sd-->
                    </div><!--blog_sidebar-->
                    <div class="view_all_btn_sd"><a href="{{ route('blogs.index') }}">View All</a></div>
                </div>
            </div>
            <div class="row blog_list_row">
                
            </div>
        </div>
    </div><!--blog_section-->
</div><!--content-->

@endsection

@section('scripts')
    <script>
        $('.option-select').on('change', function(evt, params) {
            $('#blogForm').sudmit();
        });
    </script>
@endsection