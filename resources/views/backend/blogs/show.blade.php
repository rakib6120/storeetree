@extends('backend.layouts.content')
@section('content')

<div class="content-wrapper" style="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Blog Info</h1>
        <ol class="breadcrumb">
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">


        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Blog Info</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-responsive table-striped table-bordered">
                            <tr>
                                <th style="width: 20%;">Title</th>
                                <td style="width: 80%;">{{ $blog->title }}</td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Sub-Title</th>
                                <td style="width: 80%;">{!! $blog->subtitle !!}</td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Description</th>
                                <td style="width: 80%;">{!! $blog->description !!}</td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Order</th>
                                <td style="width: 80%;">{{ $blog->sort }}</td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Active</th>
                                <td style="width: 80%;">{!! Helper::activeStatuslabel($blog->status) !!}</td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Thumbnail</th>
                                <td style="width: 80%;">
                                    @if($blog->thumbnail)
                                    <img style="height: 100px;" src="{{ asset(Helper::storagePath($blog->thumbnail)) }}">
                                    @else
                                    No image added
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Created At</th>
                                <td style="width: 80%;">{{ $blog->created_at->diffForHumans() }}</td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Updated At</th>
                                <td style="width: 80%;">{{ $blog->updated_at->diffForHumans() }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection