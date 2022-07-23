@extends('backend.layouts.content')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Relations </h1>

    </section>

    <!-- Main content -->
    <section class="content">


        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Relation List</h3>
                    </div>
                    
                    @include('backend.include.flashMessage')
                    
                    <!-- /.box-header -->
                    <div class="box-body table-responsive ">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th class="" style="min-width:50px;">@sortablelink('id', 'ID')</th>
                                <th class="" style="min-width:50px;">@sortablelink('parent_id', 'Parent')</th>
                                <th class="" style="min-width:50px;">@sortablelink('title', 'Title')</th>
                                <th class="" style="min-width:50px;">@sortablelink('sort', 'Order')</th>
                                <th class="" style="min-width:50px;">@sortablelink('gender', 'Gender')</th>
                                <th class="" style="min-width:50px;">@sortablelink('status', 'Status')</th>
                                <th class="" style="min-width:50px;">@sortablelink('created_at', 'Created At')</th>
                                <th class="" style="min-width:50px;">@sortablelink('updated_at', 'Updated At')</th>

                                <th style="width: 200px">Actions</th>
                            </tr>

                            @foreach($relations as $relation)
                            <tr>
                                <td>{{ $relation->id }}</td>
                                <td>{{ $relation->parent ? $relation->parent->title : '' }}</td>
                                <td>{{ $relation->title }}</td>
                                <td>{{ $relation->sort }}</td>
                                <td>{!! Helper::activeGenderlabel($relation->gender) !!}</td>
                                <td>{!! Helper::activeStatuslabel($relation->status) !!}</td>
                                <td>{{ $relation->created_at->diffForHumans() }}</td>
                                <td>{{ $relation->updated_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.relations.edit', $relation->id) }}" class="btn btn-default btn-sm" title="Edit"><i class="fa fa-edit"></i></a>

                                    <a href="#" class="btn btn-default btn-sm" title="Delete"
                                               onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $relation->id }}').submit(); } event.returnValue = false; return false;"><i
                                                        class="fa fa-trash"></i></a>

                                    {!! Form::open(['method'=>'DELETE', 'action'=>['backend\RelationController@destroy', $relation->id], 'id'=>'deleteForm'.$relation->id]) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            Page {{ $relations->currentPage() }}  , showing {{ $relations->count() }} records out of {{ $relations->total() }} total
                        </ul>
                    </div>

                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{$relations->appends(Request::all())->links()}}
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