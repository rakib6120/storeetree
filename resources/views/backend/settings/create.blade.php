@extends('backend.layouts.content')
@section('content')

<div class="content-wrapper" style="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Add Settings </h1>
        <ol class="breadcrumb">
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">


        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">New Settings Info</h3>
                    </div>

                    @include('backend.include.error')

                    {!! Form::open(['method'=>'POST', 'action'=>'backend\SettingController@store', 'files'=>true]) !!}

                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('home_video', 'Home Page Video') !!}
                                {!! Form::file('home_video', null, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('story_first_step', 'Create Story (Step 1)') !!}
                                {!! Form::file('story_first_step', null, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('story_second_step', 'Create Story (Step 2)') !!}
                                {!! Form::file('story_second_step', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('story_third_step', 'Create Story (Step 3)') !!}
                                {!! Form::file('story_third_step', null, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('story_fourth_step', 'Create Story (Step 4)') !!}
                                {!! Form::file('story_fourth_step', null, ['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('story_fifth_step', 'Create Story (Step 5)') !!}
                                {!! Form::file('story_fifth_step', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    {!! Form::close() !!}
                </div>


            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">
                <!-- Horizontal Form -->

                <!-- /.box -->
                <!-- general form elements disabled -->

                <!-- /.box -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection

@section('scripts')

<script>

    $(function () {
        $('input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        
        $(".textarea").wysihtml5();
    });
</script>

@endsection