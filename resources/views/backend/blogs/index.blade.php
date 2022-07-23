@extends('backend.layouts.content')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Blogs </h1>

    </section>

    <!-- Main content -->
    <section class="content">


        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Blog List</h3>
                    </div>

                    {!! Form::open(['method'=>'GET', 'action'=>'backend\BlogController@index']) !!}

                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('title', 'Title') !!}
                                    {!! Form::text('title', request()->title, ['class'=>'form-control']) !!}
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('status', 'Status') !!}
                                    {!! Form::select('status', ['2'=>'All'] + Config::get('constants.ACTIVE_STATUSES'), request()->status, ['class'=>'form-control', 'style'=>'width:100%;']) !!}
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>

                    {!! Form::close() !!}
                    
                    @include('backend.include.flashMessage')
                    
                    <!-- /.box-header -->
                    <div class="box-body table-responsive ">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th class="" style="min-width:50px;">@sortablelink('id', 'ID')</th>
                                <th class="" style="min-width:50px;">@sortablelink('title', 'Title')</th>
                                <th class="" style="min-width:50px;">@sortablelink('sort', 'Order')</th>
                                <th class="" style="min-width:50px;">@sortablelink('status', 'Status')</th>
                                <th class="" style="min-width:50px;">@sortablelink('created_at', 'Created At')</th>
                                <th class="" style="min-width:50px;">@sortablelink('updated_at', 'Updated At')</th>

                                <th style="width: 200px">Actions</th>
                            </tr>

                            @foreach($blogs as $blog)
                            <tr>
                                <td>{{ $blog->id }}</td>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->sort }}</td>
                                <td>{!! Helper::activeStatuslabel($blog->status) !!}</td>
                                <td>{{ $blog->created_at->diffForHumans() }}</td>
                                <td>{{ $blog->updated_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.blogs.show', $blog->id) }}" class="btn btn-default btn-sm" title="Details"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-default btn-sm" title="Edit"><i class="fa fa-edit"></i></a>

                                    <a href="#" class="btn btn-default btn-sm" title="Delete"
                                               onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $blog->id }}').submit(); } event.returnValue = false; return false;"><i
                                                        class="fa fa-trash"></i></a>

                                    {!! Form::open(['method'=>'DELETE', 'action'=>['backend\BlogController@destroy', $blog->id], 'id'=>'deleteForm'.$blog->id]) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            Page {{ $blogs->currentPage() }}  , showing {{ $blogs->count() }} records out of {{ $blogs->total() }} total
                        </ul>
                    </div>

                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{$blogs->appends(Request::all())->links()}}
                        </ul>
                    </div>

                </div>
                <!-- /.box -->

                <!-- /.box -->
            </div>
            <!-- /.col -->

            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>

@endsection

@section('scripts')

<script>

    $(function () {
        $("#status").select2({
            placeholder: "Choose an option"
        });
    });

</script>

@endsection