@extends('frontend.layouts.app')

@section('title')
<title>Storee Tree: Contact Us</title>
@endsection

@section('content')
<div class="banner_subpage" style="background-image:url({{ URL::to('/') }}/images/frontend/subpage_bg_1.jpg)">
    <h1>Contact</h1>
</div><!--subpage_banner-->

<div class="content_area cn_gap_top">
    <div class="contact_section">
        <div class="container">
            <div class="col-xs-12 col-sm-8 col-md-8">
                <div class="contact_info_block_sc">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="contact_block_tittle">
                                <h3>Add a Comment</h3>
                            </div>
                        </div>
                    </div>

                    @include('backend.include.error')
                    @include('backend.include.flashMessage')

                    {!! Form::open(['method'=>'POST', 'action'=>'frontend\ContactUsController@store']) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            {!! Form::text('name', null, ['class'=>'form-control', 'placeholder' => 'Full Name']) !!}
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            {!! Form::text('phone', null, ['class'=>'form-control', 'placeholder' => 'Phone Number']) !!}
                        </div>
                        <div class="col-xs-12">
                            {!! Form::text('email', null, ['class'=>'form-control', 'placeholder' => 'Email']) !!}
                        </div>
                        <div class="col-xs-12">
                            {!! Form::textarea('comments', null, ['class'=>'form-control form_text_1', 'placeholder' => 'Comments']) !!}
                        </div>
                        <div class="col-xs-12">
                            <input type="submit" class="submit_btn" value="Submit">
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="contact_info_block_sc">
                    <div class="contact_block_tittle">
                        <h3>contact Us</h3>
                    </div>
                    <div class="contact_dt_section">
                        <div class="cn_info_single">
                            <div class="media">
                                <div class="media-left">
                                    <img src="{{ URL::to('/') }}/images/frontend/contact_phonebg.png" alt=""/>
                                </div>
                                <div class="media-body">
                                    <h3>Phone</h3>
                                    <p>+XXXXXX XXX XXX</p>
                                </div>
                            </div>
                        </div><!--cn_info_single-->
                        <div class="cn_info_single">
                            <div class="media">
                                <div class="media-left">
                                    <img src="{{ URL::to('/') }}/images/frontend/contact_mailbg.png" alt=""/>
                                </div>
                                <div class="media-body">
                                    <h3>Email</h3>
                                    <p><a href="#">info@storeetree.com</a></p>
                                </div>
                            </div>
                        </div><!--cn_info_single-->
                        <div class="cn_info_single">
                            <div class="media">
                                <div class="media-left">
                                    <img src="{{ URL::to('/') }}/images/frontend/address_bg.png" alt=""/>
                                </div>
                                <div class="media-body">
                                    <h3>Address</h3>
                                    <p>lorem ipsum, Road-27,</p>
                                    <p>lorem ipsum, Lorem,</p>
                                    <p>UK</p>
                                </div>
                            </div>
                        </div><!--cn_info_single-->
                    </div>
                </div>
            </div>
        </div>
    </div><!--contact_section-->

    <div class="contact-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2482.3300308685775!2d-0.08606728409913633!3d51.5255063172!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761cafbf0635c1%3A0x2f182388ad7fd780!2sPaul%20St%2C%20London%2C%20UK!5e0!3m2!1sen!2sbd!4v1652552559557!5m2!1sen!2sbd" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div><!--content-->

</div><!--content-->



@endsection