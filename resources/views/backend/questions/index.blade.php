@extends('backend.layouts.content')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Questions </h1>

    </section>

    <!-- Main content -->
    <section class="content">


        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Question List</h3>
                    </div>
                    
                    @include('backend.include.flashMessage')
                    
                    <!-- /.box-header -->
                    <div class="box-body table-responsive ">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th class="" style="min-width:50px;">@sortablelink('id', 'ID')</th>
                                <th class="" style="min-width:50px;">@sortablelink('category_id', 'Category')</th>
                                <th class="" style="min-width:50px;">@sortablelink('title', 'Title')</th>
                                <th class="" style="min-width:50px;">@sortablelink('sort', 'Order')</th>
                                <th class="" style="min-width:50px;">@sortablelink('status', 'Status')</th>
                                <th class="" style="min-width:50px;">@sortablelink('created_at', 'Created At')</th>
                                <th class="" style="min-width:50px;">@sortablelink('updated_at', 'Updated At')</th>

                                <th style="width: 200px">Actions</th>
                            </tr>

                            @foreach($questions as $question)
                            <tr>
                                <td>{{ $question->id }}</td>
                                <td>{{ $question->category->title }}</td>
                                <td>{{ $question->title }}</td>
                                <td>{{ $question->sort }}</td>
                                <td>{!! Helper::activeStatuslabel($question->status) !!}</td>
                                <td>{{ $question->created_at->diffForHumans() }}</td>
                                <td>{{ $question->updated_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-default btn-sm" title="Edit"><i class="fa fa-edit"></i></a>

                                    <a href="#" class="btn btn-default btn-sm" title="Delete"
                                               onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $question->id }}').submit(); } event.returnValue = false; return false;"><i
                                                        class="fa fa-trash"></i></a>

                                    {!! Form::open(['method'=>'DELETE', 'action'=>['backend\QuestionController@destroy', $question->id], 'id'=>'deleteForm'.$question->id]) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            Page {{ $questions->currentPage() }}  , showing {{ $questions->count() }} records out of {{ $questions->total() }} total
                        </ul>
                    </div>

                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{$questions->appends(Request::all())->links()}}
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