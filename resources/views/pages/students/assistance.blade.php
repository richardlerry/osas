@extends('layouts.main')

@section('title','Student Financial Assistance')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Students</a></li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Student Financial Assistance <small>...</small></h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-2 -->

        <!-- end col-2 -->
        <!-- begin col-10 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <div class="panel-heading-btn">

                        <a href="#add-student" data-toggle="modal"  class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> Student Profiles </a>
                        <a href="#add-financial" data-toggle="modal"  class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> Financial Assistance Titles</a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Student Financial Assistance</h4>
                </div>
                <!-- end panel-heading -->

                <div class="panel-body bg-black text-white">
                    <a href="#assign-financial" data-toggle="modal" class="btn  btn-warning"><i class="fa fa-plus-square"></i> Assign Financial Assistance to Student </a>

                </div>
                <!-- begin alert -->

                @if(session('success') || session('error') )
                    <div class="alert alert-{{(session('success')?'success':'danger')}} fade show">
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{(session('success'))?session('success'):session('error')}}
                    </div>
            @endif
            <!-- end alert -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <table id="data-table-button" class="table  table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 30%">Info</th>
                            <th>Course</th>
                            <th>Financial Assistance</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $item)
                            <tr>
                                <td><strong>{{ $item->stud_no }}</strong><br><small>{{ $item->lname.', '.$item->fname.' '.$item->mname }}</small> </td>
                                <td>
                                    {{$item->rCourse->title}}
                                </td>
                                <td>
                                    <center>
                                        @if($item->tFinancialAssistances->count())
                                        @foreach($item->tFinancialAssistances as $fin)
                                            <span class="label label-success">{{\App\r_financial_title::where('finT_id',$fin->rFinancialTitle->finT_id)->first()->title}}</span>
                                        @endforeach
                                        @else
                                            None
                                        @endif
                                    </center>
                                </td>
                                <td>{{ (new DateTime($item->created_at))->format('D M d, Y | h:i A') }}</td>
                                <td>
                                    <center>
                                        @if($item->stat==1)
                                            <a class="btn btn-info" data-toggle="modal" href="#view-financial{{$item->studP_id}}" title="View"><i class="fas fa-folder text-white"></i></a>
                                        @else
                                            <a id=act  vals="{{$item->TAXP_ID}}" class="btn btn-success" data-toggle="modal" data-target="#activate"><i class="fas fa-undo text-white"></i></a>
                                        @endif
                                    </center>
                                </td>
                </tr>

                        @endforeach
                        </tbody>
                        <tfoot>

                        <th style="width: 30%">Info</th>
                        <th>Course</th>
                        <th>Financial Assistance</th>
                        <th>Date Created</th>
                        <th>Action</th>
                        </tfoot>
                    </table>
                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-10 -->
    </div>
    <!-- end row -->


    @foreach($students as $item)

        {{--view financial title--}}
        <div class="modal modal-message fade" id="view-financial{{$item->studP_id}}" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $item->lname.', '.$item->fname.' '.$item->mname }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">

                        <div class="col-md-12" style="margin-top: 20px">
                            <label>Financial Assitance List</label>
                            <table id="data-table-button" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 30%">Title</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\App\t_financial_assistance::with('rStudentProfile','rFinancialTitle')->where('stat',1)->where('studP_id',$item->studP_id)->get() as $fin)
                                    <tr>
                                        <form method="post" action="{{action('assistance@update',$fin->finA_id)}}" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <td><strong>{{ \App\r_financial_title::where('finT_id',$fin->finT_id)->first()->title }}</strong><br><small>{{ \App\r_financial_title::where('finT_id',$fin->finT_id)->first()->desc }}</small></td>
                                            <td><textarea required="" name="fin_status" class="form-control" >{{ $fin->finStatus  }}</textarea></td>
                                            <td><textarea required="" name="fin_remarks" class="form-control" >{{ $fin->remarks  }}</textarea></td>
                                            <td>{{ (new DateTime($fin->created_at))->format('D M d, Y | h:i A') }}</td>
                                            <td>
                                                <center>
                                                    @if($fin->stat==1)
                                                        <button class="btn btn-success" type="submit" ><i class="fas fa-check text-white"></i></button>
                                                        <a id=deact   class="btn btn-danger" ><i class="fa fa-ban text-white"></i></a>
                                                    @else
                                                        <a id=act   class="btn btn-success" data-toggle="modal" data-target="#activate"><i class="fas fa-undo text-white"></i></a>
                                                    @endif
                                                </center>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <th style="width: 30%">Title</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th>Date Created</th>
                                <th>Action</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{--student--}}
    <div class="modal modal-message fade" id="add-student" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Student Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <form method="post"  action="{{action('student@store')}}"  enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{ method_field('POST') }}
                        <div class="row">

                            <div class="col-md-12" style="padding-bottom: 20px;">
                                <strong>Are you sure? you want to add a student profile?</strong>
                                <p>Please provide the following inputs to validate the record.</p>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Student No. </label>
                                    <input class="form-control"  name=stud_no placeholder="Student Number" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Course <a class="label label-danger" href="#add-course" data-dismiss="modal" data-toggle="modal">not listed?</a> </label>
                                    <select name="course" class="form-control" style="width: 100%;" required>
                                        <option value="" disabled selected>Please Select</option>
                                        @foreach(\App\r_course::where('stat',1)->get() as $item)
                                            <option value="{{$item->course_id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Section </label>
                                    <input class="form-control"  name=section placeholder="Section" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>First Name </label>
                                    <input class="form-control"  name=fname placeholder="First Name" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Middle Name </label>
                                    <input class="form-control"  name=mname placeholder="Middle Name" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Last Name </label>
                                    <input class="form-control"  name=lname placeholder="Last Name" required>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email </label>
                                    <input class="form-control" type="email" name=email placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone No. </label>
                                    <input class="form-control"  name=phone placeholder="Phone No" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Telephone No. </label>
                                    <input class="form-control"  name=tel placeholder="Telephone No" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gender </label>
                                    <select name="gender" class="form-control" style="width: 100%;" required>
                                        <option value="" disabled selected>Please Select</option>
                                        <option value="Male" >Male</option>
                                        <option value="Female" >Female</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Civil Status </label>
                                    <input class="form-control"  name=civil placeholder="Civil Status" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Birth Date </label>
                                    <input class="form-control"  name=bdate type="date" placeholder="Birth Date" required>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Home No. </label>
                                    <input class="form-control"  name=home placeholder="Home No." required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Street </label>
                                    <input class="form-control"  name=street placeholder="Street" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Barangay </label>
                                    <input class="form-control"  name=brgy placeholder="Barangay" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Province </label>
                                    <input class="form-control"  name=prov placeholder="Province" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City </label>
                                    <input class="form-control"  name=city placeholder="City" required>
                                </div>
                            </div>



                            <!-- /.row -->
                            <div class="col-md-12" >
                                <div class="pull-right" style="">
                                    <button class="btn btn-success" type="submit" >Insert</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



    {{--course title--}}
    <div class="modal modal-message fade" id="add-course" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Course Title</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <form method="post"  action="{{action('course@store')}}"  enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{ method_field('POST') }}
                        <div class="row">

                            <div class="col-md-12" style="padding-bottom: 20px;">
                                <strong>Are you sure? you want to add a sanction details?</strong>
                                <p>Please provide the following inputs to validate the record.</p>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input class="form-control" name=title_course placeholder="Name" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name=desc_course style="resize:vertical; width:100%;height:107px" placeholder="Description" required></textarea>
                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="col-md-12" >
                                <div class="pull-right" style="">
                                    <button class="btn btn-success" type="submit" >Insert</button>
                                </div>
                            </div>
                    </form>
                    <div class="col-md-12" style="margin-top: 20px">
                        <label>Course Title List</label>
                        <table id="data-table-button" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 30%">Title</th>
                                <th>Description</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\r_course::where('stat',1)->get() as $item)
                                <tr>
                                    <form method="post" action="{{action('course@update',$item->course_id)}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <td><strong><input required name="title_course" class="form-control" value="{{ $item->title }}"></strong></td>
                                        <td><textarea required="" name="desc_course" class="form-control" >{{ $item->desc  }}</textarea></td>
                                        <td>{{ (new DateTime($item->created_at))->format('D M d, Y | h:i A') }}</td>
                                        <td>
                                            <center>
                                                @if($item->stat==1)
                                                    <button class="btn btn-success" type="submit" ><i class="fas fa-check text-white"></i></button>
                                                    <a id=deact   class="btn btn-danger" ><i class="fa fa-ban text-white"></i></a>
                                                @else
                                                    <a id=act   class="btn btn-success" data-toggle="modal" data-target="#activate"><i class="fas fa-undo text-white"></i></a>
                                                @endif
                                            </center>
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <th style="width: 30%">Title</th>
                            <th>Description</th>
                            <th>Date Created</th>
                            <th>Action</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    {{--financial title--}}
    <div class="modal modal-message fade" id="add-financial" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Financial Assistance Title</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <form method="post"  action="{{action('assistance@store')}}"  enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{ method_field('POST') }}
                        <div class="row">

                            <div class="col-md-12" style="padding-bottom: 20px;">
                                <strong>Are you sure? you want to add a financial assistance details?</strong>
                                <p>Please provide the following inputs to validate the record.</p>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input class="form-control" name=title_fin placeholder="Name" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name=desc_fin style="resize:vertical; width:100%;height:107px" placeholder="Description" required></textarea>
                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="col-md-12" >
                                <div class="pull-right" style="">
                                    <button class="btn btn-success" type="submit" >Insert</button>
                                </div>
                            </div>
                    </form>
                    <div class="col-md-12" style="margin-top: 20px">
                        <label>Financial Assistance Title List</label>
                        <table id="data-table-button" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 30%">Title</th>
                                <th>Description</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\r_financial_title::where('stat',1)->get() as $item)
                                <tr>
                                    <form method="post" action="{{action('assistance@update',$item->finT_id)}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <td><strong><input required name="title_fin" class="form-control" value="{{ $item->title }}"></strong></td>
                                        <td><textarea required="" name="desc_fin" class="form-control" >{{ $item->desc  }}</textarea></td>
                                        <td>{{ (new DateTime($item->created_at))->format('D M d, Y | h:i A') }}</td>
                                        <td>
                                            <center>
                                                @if($item->stat==1)
                                                    <button class="btn btn-success" type="submit" ><i class="fas fa-check text-white"></i></button>
                                                    <a id=deact   class="btn btn-danger" ><i class="fa fa-ban text-white"></i></a>
                                                @else
                                                    <a id=act   class="btn btn-success" data-toggle="modal" data-target="#activate"><i class="fas fa-undo text-white"></i></a>
                                                @endif
                                            </center>
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <th style="width: 30%">Title</th>
                            <th>Description</th>
                            <th>Date Created</th>
                            <th>Action</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    {{--assign financial--}}
    <div class="modal modal-message fade" id="assign-financial" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Assign Financial Assistance to Student</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <form method="post"  action="{{action('assistance@store')}}"  enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{ method_field('POST') }}
                        <div class="row">

                            <div class="col-md-12" style="padding-bottom: 20px;">
                                <strong>Are you sure? you want to assign a financial assistance details?</strong>
                                <p>Please provide the following inputs to validate the record.</p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Student Profile <a class="label label-danger" href="#add-student" data-dismiss="modal" data-toggle="modal">not listed?</a></label>
                                    <select name="studP_id" class="form-control" style="width: 100%;" required>
                                        <option value="" disabled selected>Please Select</option>
                                        @foreach(\App\r_student_profile::where('stat',1)->get() as $item)
                                            <option value="{{$item->studP_id}}">{{$item->stud_no}} - {{$item->lname.', '.$item->fname.' '.$item->mname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Financial Assistance <a class="label label-danger" href="#add-financial" data-dismiss="modal" data-toggle="modal">not listed?</a></label>
                                    <select name="finT_id" class="form-control" style="width: 100%;" required>
                                        <option value="" disabled selected>Please Select</option>
                                        @foreach(\App\r_financial_title::where('stat',1)->get() as $item)
                                            <option value="{{$item->finT_id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <textarea class="form-control" name=status style="resize:vertical; width:100%;height:107px" placeholder="Status" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea class="form-control" name=remariks style="resize:vertical; width:100%;height:107px" placeholder="Remarks" required></textarea>
                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="col-md-12" >
                                <div class="pull-right" style="">
                                    <button class="btn btn-success" type="submit" >Insert</button>
                                </div>
                            </div>

                </div>
                    </form>
            </div>
        </div>
    </div>
    </div>


@endsection

@section('extrajs')

    <script>

        $('select[name=course]').select2({
            dropdownParent:$('#add-student')
        });
        $('select[name=studP_id]').select2({
            dropdownParent:$('#assign-financial')
        });
        $('select[name=finT_id]').select2({
            dropdownParent:$('#assign-financial')
        });
        $('table[id=data-table-button]').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "aaSorting": [[3, "desc" ]]
            ,dom: 'lBfrtip'
            ,   buttons: [
                { extend: 'copy', className: 'btn-sm',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                { extend: 'csv', className: 'btn-sm' ,
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                { extend: 'excel', className: 'btn-sm',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                { extend: 'pdf', className: 'btn-sm',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                { extend: 'print', className: 'btn-sm',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },


            ],
        });


        $("a[id='editTax']").on('click',function () {
            $('.modal-title').html('Editing Tax Reference');
            document.querySelector('#taxModal').reset();
            $id = $(this).attr('vals');
            $.ajax({
                url: 'tax/'+$id
                ,type: 'get'
                ,data: {_token:CSRF_TOKEN }
                ,dataType:'json'
                ,success:function($data){

                    $("input[name='taxname']").val($data.data[0].TAXP_NAME);
                    $("textarea[name='taxdesc']").val($data.data[0].TAXP_DESC);
                    $("select[name='taxtype']").val($data.data[0].TAXP_TYPE).trigger('change');
                    $("input[name='taxrate']").val($data.data[0].TAXP_RATE);
                    $('#taxModal').attr('action','{{url('tax')}}/'+$data.data[0].TAXP_ID);
                    $("input[name='_method']").attr('value','PATCH');
                }
                ,error:function(){

                }
            });

        });


        $("a[id='deact']").on('click',function(){
            $id = $(this).attr('vals');
            // $("button[id='deactSave']").on('click',function () {
            swal({
                title: "This record will be deactivated?"
                , text: "After this action, this record is not available, unless it is activated"
                , type: "warning"
                , showLoaderOnConfirm: true
                , showCancelButton: true
                , confirmButtonColor: '#9DD656'
                , confirmButtonText: 'Yes!'
                , cancelButtonText: "No!"
                , closeOnConfirm: false
                , closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        url: '/tax/actDeact'
                        ,type: 'post'
                        ,data: {id:$id,_token:CSRF_TOKEN, type:0  }
                        ,success:function(){
                            window.location.reload();
                        }
                        ,error:function(){

                        }
                    });

                }
            });
            // });
        });

        $("a[id='act']").on('click',function(){
            $id = $(this).attr('vals');
            // $("button[id='actSave']").on('click',function () {

            swal({
                title: "This record will be activated?"
                , text: "After this action, this record is now available, unless it is deactivated"
                , type: "warning"
                , showLoaderOnConfirm: true
                , showCancelButton: true
                , confirmButtonColor: '#9DD656'
                , confirmButtonText: 'Yes!'
                , cancelButtonText: "No!"
                , closeOnConfirm: false
                , closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '/tax/actDeact'
                        ,type: 'post'
                        ,data: {id:$id,_token:CSRF_TOKEN, type:1  }
                        ,success:function(){
                            window.location.reload();
                        }
                        ,error:function(){

                        }
                    });
                }
            });

            // });
        });


    </script>
@endsection
