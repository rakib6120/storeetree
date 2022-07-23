@extends('backend.layouts.content')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Categories </h1>

    </section>

    <!-- Main content -->
    <section class="content">


        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Category List</h3>
                    </div>
                    
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

                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->sort }}</td>
                                <td>{!! Helper::activeStatuslabel($category->status) !!}</td>
                                <td>{{ $category->created_at->diffForHumans() }}</td>
                                <td>{{ $category->updated_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-default btn-sm" title="Edit"><i class="fa fa-edit"></i></a>

                                    <a href="#" class="btn btn-default btn-sm" title="Delete"
                                               onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $category->id }}').submit(); } event.returnValue = false; return false;"><i
                                                        class="fa fa-trash"></i></a>

                                    {!! Form::open(['method'=>'DELETE', 'action'=>['backend\CategoryController@destroy', $category->id], 'id'=>'deleteForm'.$category->id]) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            Page {{ $categories->currentPage() }}  , showing {{ $categories->count() }} records out of {{ $categories->total() }} total
                        </ul>
                    </div>

                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{$categories->appends(Request::all())->links()}}
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