@extends('frontend.layouts.app')

@section('title')
<title>Storee Tree: Frequently Asked Questions</title>
@endsection

@section('content')
<div class="banner_subpage" style="background-image:url({{ URL::to('/') }}/images/frontend/subpage_bg_1.jpg)">
    <h1>FAQ</h1>
</div><!--subpage_banner-->

<div class="content_area cn_gap_top">
    <div class="common_section story_section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="faq_top_section">
                        <h2>FREQUENTLY ASKED QUESTIONS</h2>
                        <p>Thank you for your interest in the StoryTree Memory Maker. Below are some common We have run across. If you do not see the Question/answer you are looking for, definitely reach out to us directly with the link at the bottom of this page - we are happy to help.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="faq_content">
                        <div class="faq_single_block">
                            <div role="tablist" class="ui-accordion ui-widget ui-helper-reset" id="accordion">
                                @foreach($faqs as $faq)
                                <h3 role="tab"><span class="ui-accordion-header-icon ui-icon"></span>{{ $faq->title }}</h3>
                                <div aria-hidden="false" aria-expanded="true" role="tabpanel" style="display: block;">
                                    {!! $faq->description !!}
                                </div>
                                @endforeach
                            </div>
                        </div><!--faq_single_block-->
                    </div><!--faq_content-->
                </div>
            </div>
        </div>
    </div><!--common_section-->
</div><!--content-->

@endsection