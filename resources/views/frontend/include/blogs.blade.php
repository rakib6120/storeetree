<div class="blog_section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="blog_tittle">
                    <h2>Our Blog <a href="{{ route('blogs.index') }}">View All</a></h2>
                </div><!--blog_tittle-->
            </div>
        </div>
        <div class="row">
            @php
            $blog = $blogs->first();
            @endphp
            @if($blog)
            <div class="col-xs-12 col-sm-12 col-md-8">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="cm_info_block">
                            <h4>{{ $blog->title }}</h4>
                            <h2><a href="{{ route('blogs.show', $blog->id) }}">{!! Str::limit($blog->subtitle, 80) !!}</a></h2>
                            <p>{!! Str::limit($blog->description, 160) !!}</p>
                            <div class="common_btn"><a href="{{ route('blogs.show', $blog->id) }}">Read More</a></div>
                        </div><!--cm_info_block-->
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="photo_block_single">
                            <a href="{{ route('blogs.show', $blog->id) }}">
                                <img src="{{ asset(Helper::storagePath($blog->thumbnail)) }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="recent_blog_list">
                    @foreach($blogs->where('id', '<>', $blog->id) as $blog)
                    <div class="recent_blog_single">
                        <div class="media">
                            <div class="media-left">
                                <a href="{{ route('blogs.show', $blog->id) }}"><img src="{{ asset(Helper::storagePath($blog->thumbnail)) }}" alt=""/></a>
                            </div>
                            <div class="media-body">
                                <h3><a href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a></h3>
                                <p><a href="{{ route('blogs.show', $blog->id) }}">{!! Str::limit($blog->subtitle, 80) !!}</a></p>
                            </div>
                        </div>
                    </div><!--recent_work_single-->
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div><!--blog_section-->