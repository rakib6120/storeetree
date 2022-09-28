@extends('backend.layouts.content')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Users </h1>

    </section>

    <!-- Main content -->
    <section class="content">


        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">User List</h3>
                    </div>
                    
                    {!! Form::open(['method'=>'GET', 'action'=>'backend\UserController@index']) !!}

                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('first_name', 'First Name') !!}
                                    {!! Form::text('first_name', request()->first_name, ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('last_name', 'Last Name') !!}
                                    {!! Form::text('last_name', request()->last_name, ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('email', 'Email') !!}
                                    {!! Form::text('email', request()->email, ['class'=>'form-control']) !!}
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('country_id', 'Country') !!}
                                    {!! Form::select('country_id', ['0'=>'All'] + $countries, request()->country_id, ['class'=>'form-control', 'style'=>'width:100%;']) !!}
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('status', 'Status') !!}
                                    {!! Form::select('status', ['2'=>'All'] + Config::get('constants.ACTIVE_STATUSES'), request()->status, ['class'=>'form-control', 'style'=>'width:100%;']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('from', 'Date (From)') !!}
                                    {!! Form::text('from', request()->from, ['class'=>'form-control', 'autocomplete' => 'off']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('to', 'Date (To)') !!}
                                    {!! Form::text('to', request()->to, ['class'=>'form-control', 'autocomplete' => 'off']) !!}
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
                                <th class="" style="min-width:50px;">@sortablelink('first_name', 'First Name')</th>
                                <th class="" style="min-width:50px;">@sortablelink('last_name', 'Last Name')</th>
                                <th class="" style="min-width:50px;">@sortablelink('email', 'Email')</th>
                                <th class="" style="min-width:50px;">@sortablelink('country', 'Country')</th>
                                <th class="" style="min-width:50px;">@sortablelink('postal_code', 'Postal Code')</th>
                                <th class="" style="min-width:50px;">@sortablelink('dob', 'DoB')</th>
                                <th class="" style="min-width:50px;">@sortablelink('connected_period', 'Connected Period')</th>
                                <th class="" style="min-width:50px;">@sortablelink('status', 'Status')</th>
                                <th class="" style="min-width:50px;">@sortablelink('created_at', 'Created At')</th>
                                <th class="" style="min-width:50px;">@sortablelink('updated_at', 'Updated At')</th>
                                <th style="width: 50px">Actions</th>
                            </tr>

                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->country ? $user->country->title : '' }}</td>
                                <td>{{ $user->postal_code }}</td>
                                <td>{{ $user->dob }}</td>
                                <td>{!! Helper::activeConnectedPeriodlabel($user->connected_period) !!}</td>
                                <td>{!! Helper::activeStatuslabel($user->status) !!}</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td>{{ $user->updated_at->diffForHumans() }}</td>
                                <td>
                                    @if($user->status)
                                    <a href="#" class="btn btn-default btn-sm" title="Inactive"
                                               onclick="if (confirm(&quot;Are you sure you want to deactivate this user?&quot;)) { document.getElementById('inactiveForm{{ $user->id }}').submit(); } event.returnValue = false; return false;"><i
                                                        class="fa fa-ban"></i></a>

                                    {!! Form::open(['method'=>'PATCH', 'action'=>['backend\UserController@deactivate', $user->id], 'id'=>'inactiveForm'.$user->id]) !!}
                                    {!! Form::close() !!}
                                    @else 
                                    <a href="#" class="btn btn-default btn-sm" title="Active"
                                               onclick="if (confirm(&quot;Are you sure you want to activate this user?&quot;)) { document.getElementById('activeForm{{ $user->id }}').submit(); } event.returnValue = false; return false;"><i
                                                        class="fa fa-check"></i></a>

                                    {!! Form::open(['method'=>'PATCH', 'action'=>['backend\UserController@activate', $user->id], 'id'=>'activeForm'.$user->id]) !!}
                                    {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            Page {{ $users->currentPage() }}  , showing {{ $users->count() }} records out of {{ $users->total() }} total
                        </ul>
                    </div>

                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{$users->appends(Request::all())->links()}}
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

        $("#country_id").select2({
            placeholder: "Choose an option"
        });

        $('#from').datepicker({
            autoclose: true,
            format: 'mm/dd/yyyy'
        });

        $('#to').datepicker({
            autoclose: true,
            format: 'mm/dd/yyyy'
        });
    });

</script>

@endsection