@extends('frontend.layouts.app')

@section('title')
<title>Storee Tree: Blog List</title>
@endsection

@section('content')

<div class="banner_subpage" style="background-image:url({{ URL::to('/') }}/images/frontend/subpage_bg_1.jpg)">
    <h1>Blog</h1>
</div><!--subpage_banner-->

<div class="content_area cn_gap_top">
    <div class="blog_list_section">
        <div class="container">
            {!! Form::open(['method'=>'GET', 'action'=>'frontend\BlogController@index', 'id'=>'blogForm']) !!}
            <div class="row">
                <div class="col-xs-12">
                    <div class="blog_filter_section">
                        <div class="blog_tittle_left">All Blog</div>
                        <div class="filter_select select_common">
                            <select data-placeholder="Search" name="sort" class="option-select" tabindex="1">
                                  <option value="0" @if(request()->sort == 0) selected @endif>Sort By</option>
                                  <option value="1" @if(request()->sort == 1) selected @endif>Most Popular</option>
                                  <option value="2" @if(request()->sort == 2) selected @endif>Newest</option>
                            </select>
                        </div><!--filter_select-->
                    </div><!--blog_filter_section-->
                </div>
            </div>
            {!! Form::close() !!}
            <div class="row blog_list_row">
                <div class="grid">
                    @foreach($blogs as $blog)
                    <div class="grid-item">
                        <div class="blog_single">
                            @if($blog->thumbnail)
                            <div class="blog_photo_sc">
                                <a href="{{ route('blogs.show', $blog->id) }}"><img src="{{ asset(Helper::storagePath($blog->thumbnail)) }}" alt="" /></a>
                            </div><!--blog_photo_sc-->
                            @endif
                            <div class="blog_info_cn">
                                <div class="blog_short_dsp">
                                    <h3><a href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a></h3>
                                    <p>{!! Str::limit($blog->subtitle, 80) !!}</p>
                                </div><!--blog_short_dsp-->
                            </div><!--blog_info_cn-->
                        </div><!--blog_single-->
                    </div><!--grid-item-->
                    @endforeach
                </div>
            </div>
        </div>
    </div><!--blog_section-->
</div><!--content-->
@endsection

@section('scripts')
    <script>
        $('.option-select').on('change', function(evt, params) {
            $('#blogForm').submit();
        });
    </script>
@endsection