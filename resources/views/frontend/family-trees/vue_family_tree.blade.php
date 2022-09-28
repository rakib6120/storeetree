@extends('frontend.layouts.app')

@section('title')
<title>Storee Tree: Family Tree</title>
@endsection

@section('content')

<!-- <style>
    #app {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
        margin-top: 60px;
    }

    html, body {
       /* width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;*/
       /* overflow: hidden;*/
        font-family: Helvetica;
    }

    #tree {
        width: 100%;
        height: 100%;
    }
</style> -->

<div class="banner_subpage" style="background-image:url( {{URL::to('/')}} /images/frontend/subpage_bg_1.jpg)">
    <h1>Family Tree</h1>
</div>

<div class="content_area cn_gap_top">
    <div class="familyTree_list_section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="blog_filter_section">
                        <div class="blog_tittle_left">Family Tree Of  {{$authuser->full_name}}  Family</div>
                        <div class="filter_select fm_ad">
                            <a href="#" data-toggle="modal" data-target="#new_member_pp">Add Member</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="family_tree_wrapper">
                        <div class="fm_tree_wrapper_inner">

                        
                            <!-- <family-tree></family-tree> -->
                            
                            <family-tree1 datas='@json($datas)'></family-tree1>
                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade modal-vcenter member_plus" id="new_member_pp" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="modal_tittle">
                            <h2>Add people to your family tree and friens connections</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="modal-block">
                            <div class="modal-form">
                                {!! Form::open(['method'=>'POST', 'action'=>'frontend\FamilyTreeController@store', 'onsubmit'=>'return checkRelationValid()', 'id' => 'relationForm']) !!}
                                <div class="form-group">
                                    <div class="form_select_common select_common">
                                        <select class="option-select" name="aa" onchange="setMemberInfo(this.value)">
                                            <option  value="">Choose Member From Existing User</option>
                                        @php($userList=App\Models\User::orderBy('id','asc')->get())
                                            @foreach($userList as $key=>$userInfo)
                                                <option  value="{{$userInfo}}" >{{$userInfo->first_name.' '.$userInfo->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!--form-group-->

                                <div class="form-group">
                                    <input type="text" name="first_name" placeholder="First Name" id="first_name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="last_name" placeholder="Last Name" id="last_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="relation_email" placeholder="Email Address" id="email_address" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="form_select_common select_common">
                                        <select class="option-select" id="relation_id" name="relation_id">
                                            <option value="">Choose a Relation</option>
                                           <!--  <option value="1">Self</option> -->
                                            <option value="2">Father</option>
                                            <option value="3">Mother</option>
                                            <option value="4">Partner</option>
                                            <option value="5">Son</option>
                                            <option value="6">Daughter</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="label_tittle">Gender :</div>
                                    <div class="gn_block">
                                        <div class="rd_check radio_check2">
                                            <input name="gender" id="gd_1" value="male" type="radio" checked="" required>
                                            <label for="gd_1">Male</label>
                                        </div>
                                        <div class="rd_check radio_check2">
                                            <input name="gender" id="gd_2" value="female" type="radio" required>
                                            <label for="gd_2">Female</label>
                                        </div>
                                    </div>
                                </div>
                                
                                

                                <div class="form-group">
                                    <input type="text" name="relation_dob" class="form-control dob_input" id="relation_dob" placeholder="Date Of Birth (MM/DD/YYYY)" autocomplete="off">
                                    
                                </div>
                                

                                

                                <div class="form-group">
                                    <div class="row padding_gap_3">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="modal_confirm_btn"><button type="submit" class="btn_member">Add Member</button></div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="modal_cancel_btn"><a href="#" data-dismiss="modal" aria-label="Close">Cancel</a></div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div><!--end modal-left-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--sign up modal end -->

@endsection

@section('scripts')

  <script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    $('#relation_dob').datepicker({
        autoclose: true,
        format: 'mm/dd/yyyy'
    });
    function setMemberInfo (dataInfo) {
        dataInfo=JSON.parse(dataInfo);
       var dob=new Date(dataInfo.dob);
        dob= (dob.getMonth()+1)+"/"+dob.getDate()+"/"+dob.getFullYear();
        
        $("#first_name").val(dataInfo.first_name);
        $("#last_name").val(dataInfo.last_name);
        $("#relation_dob").val(dob);
        
        if(dataInfo.gender=="Male"){
            // console.dir(dataInfo.gender);
            $("#gd_1").attr("checked","true");
            $("#gd_2").removeAttr("checked");
        }
        else{
             // console.dir(dataInfo.gender);
            $("#gd_1").removeAttr("checked");
            $("#gd_2").attr("checked","true");
         }

    }
    function checkRelationValid() {
        var form_data = new FormData($("#relationForm")[0]);
        $('.form-group span').remove();
        $.ajax({
            type: "POST",
            data: form_data,
            processData: false,
            contentType: false,
            url: "{{ route('family-trees.store') }}",
            success: function (response) {
                // console.dir(response);
                location.reload();
            },
            error: function (data) {
                if (data.status == 422) {
                    var errors = data.responseJSON;
                    $.each(errors.errors, function (i, error) {
                        var el = $(document).find('[name="' + i + '"]');
                        el.after($('<span style="color: red;">' + error[0] + '</span>'));
                    });
                }
            }
        });
        return false;
    }

    // $('#relation_id').chosen().change(function() {
    //     var relation_id = $('#relation_id').val();
    //     if(relation_id == 20) {
    //         $('.son_id').removeClass('hidden');
    //         $('.daughter_id').addClass('hidden');
    //         $('.parent_id').addClass('hidden');
    //     } else if(relation_id == 22) {
    //         $('.son_id').addClass('hidden');
    //         $('.daughter_id').removeClass('hidden');
    //         $('.parent_id').addClass('hidden');
    //     } else if(relation_id == 24) {
    //         $('.son_id').addClass('hidden');
    //         $('.daughter_id').addClass('hidden');
    //         $('.parent_id').removeClass('hidden');
    //     } else if(relation_id == 25) {
    //         $('.son_id').addClass('hidden');
    //         $('.daughter_id').addClass('hidden');
    //         $('.parent_id').removeClass('hidden');
    //     } else {
    //         $('.son_id').addClass('hidden');
    //         $('.daughter_id').addClass('hidden');
    //         $('.parent_id').addClass('hidden');
    //     }
    // });
</script>
@endsection