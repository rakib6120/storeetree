@extends('backend.layouts.content')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Admins </h1>

        </section>

        <!-- Main content -->
        <section class="content">


            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Admin List</h3>
                        </div>

                        @include('backend.include.flashMessage')
                        @include('backend.include.error')

                        <!-- /.box-header -->
                        <div class="box-body table-responsive ">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th class="" style="min-width:50px;">ID</th>
                                    <th class="" style="min-width:50px;">Name</th>
                                    <th class="" style="min-width:50px;">Email</th>
                                    <th class="" style="min-width:50px;">Active</th>
                                    <th class="" style="min-width:50px;">Created At</th>
                                    <th class="" style="min-width:50px;">Updated At</th>

                                    <th style="width: 170px">Actions</th>
                                </tr>

                                @foreach($adminusers as $admin)
                                    <tr>
                                        <td>{{ $admin->id }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{!! Helper::activeStatuslabel($admin->status) !!}</td>
                                        <td>{{ $admin->created_at->diffForHumans() }}</td>
                                        <td>{{ $admin->updated_at->diffForHumans() }}</td>
                                        <td>        
                                            <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('admin.admins.resetPassword', $admin->id) }}" class="btn btn-default btn-sm"><i class="fa fa-unlock-alt"></i></a>

                                            <a href="#" class="btn btn-default btn-sm" title="Delete"
                                               onclick="if (confirm(&quot;Are you sure you want to delete ?&quot;)) { document.getElementById('deleteForm{{ $admin->id }}').submit(); } event.returnValue = false; return false;"><i
                                                        class="fa fa-trash"></i></a>

                                            {!! Form::open(['method'=>'DELETE', 'action'=>['backend\AdminController@destroy', $admin->id], 'id'=>'deleteForm'.$admin->id]) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach


                            </table>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                Page {{ $adminusers->currentPage() }}  , showing {{ $adminusers->count() }} records out of {{ $adminusers->total() }} total
                            </ul>
                        </div>

                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                {{$adminusers->links()}}
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