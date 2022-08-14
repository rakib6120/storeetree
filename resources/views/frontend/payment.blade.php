@extends('frontend.layouts.app')

@section('title')
<title>Storee Tree: Payment</title>
@endsection

@section('content')
<div class="banner_subpage" style="background-image:url({{ URL::to('/') }}/images/frontend/subpage_bg_1.jpg)">
    <h1>Payment</h1>
</div><!--subpage_banner-->

<div class="content_area cn_gap_top">
    <div class="contact_section">
        <div class="container">
            <div class="col-xs-12">
                <div class="contact_info_block_sc payment_wrapper">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="contact_block_tittle">
                                <h3>Billing</h3>
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
                    
                    <form method="post" action="{{ route('store.payment-process') }}">
                        @if(session('error_msg'))
                            <div class="alert alert-danger fade in alert-dismissible show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="font-size:20px">×</span>
                                </button>    
                                {{ session('error_msg') }}
                            </div>
                        @endif
                        @csrf
                        <div class="row">
                            
                            <div class="col-xs-12">
                                <div class="contact_block_tittle">
                                    <h4>Credit Or Debit Card</h4>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <label>Card Holder Name</label>
                                <input type="text" class="form-control" name="owner" value="{{ old('owner') }}" placeholder="Enter Card Holder Name">
                                @error('owner')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-xs-12">
                                <label>Card Number</label>
                                <input type="text" class="form-control" name="cardNumber" value="{{ old('cardNumber') }}" placeholder="Enter Card Number">
                                @error('cardNumber')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <label>Card Validity</label>
                                <input type="text" class="form-control" name="expiration" value="{{ old('expiration') }}" placeholder="MM/YYYY">
                                @error('expiration')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-xs-12 col-md-6 col-sm-6">
                                <label>CVC Number</label>
                                <input type="text" class="form-control" name="cvv" value="{{ old('cvv') }}" placeholder="Enter CVC number">
                                @error('cvv')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <div class="col-xs-12">
                                <input type="submit" class="submit_btn" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            
        </div>
    </div><!--contact_section-->

    
    
</div><!--content-->


@endsection