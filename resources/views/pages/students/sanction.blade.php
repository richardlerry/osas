@extends('layouts.main')

@section('title','Student Sanction')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Students</a></li>
        <li class="breadcrumb-item active">Sanctions</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Student Sanctions <small>To have the student sanction removed, you must render the the given consumable hours to serve student related services</small></h1>
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

                        <a href="#add-sanction" data-toggle="modal" class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> Sanction Title </a>
                        <a href="#add-office" data-toggle="modal"  class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> Designated Offices </a>
                        <a href="#add-student" data-toggle="modal"  class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> Student Profiles </a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Student Sanctions</h4>
                </div>
                <!-- end panel-heading -->

                <div class="panel-body bg-black text-white">
                    <a href="#assign-sanction" data-toggle="modal" class="btn  btn-danger"><i class="fa fa-plus-square"></i> Assign Sanction to Student </a>

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
                    <table id="data-table-button" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 30%">Info</th>
                            <th>Sanctions</th>
                            <th>Total Hours</th>
                            <th>Recent Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $item)
                            <tr>
                                <td><strong>{{ $item->stud_no }}</strong><br><small>{{ $item->lname.', '.$item->fname.' '.$item->mname }}</small> </td>
                                <td>
                                    <center>
                                        <span class="label label-success" title="finished sanction/s"> {{$item->tSanctions->where('isFinished',1)->count()}}</span>
                                        <span class="label label-danger" title="current sanction/s"> {{$item->tSanctions->where('isFinished',0)->count()}}</span>
                                    </center>
                                </td>
                                <td>
                                    @php
                                        $total = 0;
                                        $sanctions = "";
                                        foreach($item->tSanctions->where('stat',1)->where('isFinished',0) as $item){
                                            $total += $item->totalHours;
                                        }
                                    @endphp
                                    <center>
                                        {{$total}}
                                    </center>
                                </td>
                                <td>{{ (new DateTime($item->created_at))->format('D M d, Y | h:i A') }}</td>
                                <td>
                                    <center>
                                        @if($item->stat==1)
                                            <a class="btn btn-info" href="{{action('sanction@show',$item->studP_id)}}" title="View"><i class="fas fa-folder text-white"></i></a>
                                        @else
                                            <a id=act  vals="{{$item->TAXP_ID}}" class="btn btn-success" data-toggle="modal" data-target="#activate"><i class="fas fa-undo text-white"></i></a>
                                        @endif
                                    </center>
                                </td>


                            </tr>

                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th style="width: 30%">Info</th>
                            <th>Sanctions</th>
                            <th>Total Hours</th>
                            <th>Recent Date</th>
                            <th>Action</th>
                        </tr>
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



    {{--sanction title--}}
    <div class="modal modal-message fade" id="add-sanction" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Sanction Title</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <form method="post"  action="{{action('sanctionTitle@store')}}"  enctype="multipart/form-data">
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
                                    <input class="form-control" name=title_sancT placeholder="Name" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name=desc_sancT style="resize:vertical; width:100%;height:107px" placeholder="Description" required></textarea>
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
                                <label>Santion Title List</label>
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
                                    @foreach($sanctionTitles as $item)
                                        <tr>
                                            <form method="post" action="{{action('sanctionTitle@update',$item->sancT_id)}}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                {{ method_field('PATCH') }}
                                                <td><strong><input required name="title_sancT" class="form-control" value="{{ $item->title }}"></strong></td>
                                                <td><textarea required="" name="desc_sancT" class="form-control" >{{ $item->desc  }}</textarea></td>
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

{{--office--}}
    <div class="modal modal-message fade" id="add-office" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Office Title</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <form method="post"  action="{{action('officeDesignation@store')}}"  enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{ method_field('POST') }}
                        <div class="row">

                            <div class="col-md-12" style="padding-bottom: 20px;">
                                <strong>Are you sure? you want to add a office details?</strong>
                                <p>Please provide the following inputs to validate the record.</p>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input class="form-control" name=title_offc placeholder="Name" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name=desc_offc style="resize:vertical; width:100%;height:107px" placeholder="Description" required></textarea>
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
                        <label>Office List</label>
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
                            @foreach($designatedOffices as $item)
                                <tr>
                                    <form method="post" action="{{action('officeDesignation@update',$item->off_id)}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <td><strong><input required name="title_offc" class="form-control" value="{{ $item->title }}"></strong></td>
                                        <td><textarea required="" name="desc_offc" class="form-control" >{{ $item->desc  }}</textarea></td>
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

    {{--sanction--}}
    <div class="modal modal-message fade" id="assign-sanction" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Assign Sanction to Student</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <form method="post"  action="{{action('sanction@store')}}"  enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{ method_field('POST') }}
                        <div class="row">

                            <div class="col-md-12" style="padding-bottom: 20px;">
                                <strong>Are you sure? you want to assign a saction to a specific student?</strong>
                                <p>Please provide the following inputs to validate the record.</p>
                            </div>
                            <div class="col-md-12">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sanction Title <a class="label label-danger" href="#add-sanction" data-dismiss="modal" data-toggle="modal">not listed?</a></label>
                                    <select name='sancT_id' class="form-control" style="width: 100%;" required>
                                        <option value="" disabled selected>Please Select</option>
                                        @foreach(\App\r_sanction_title::where('stat',1)->get() as $item)
                                            <option value="{{$item->sancT_id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Designated Office <a class="label label-danger" href="#add-office" data-dismiss="modal" data-toggle="modal">not listed?</a> </label>
                                    <select name="off_id" class="form-control" style="width: 100%;" required>
                                        <option value="" disabled selected>Please Select</option>
                                        @foreach(\App\r_office::where('stat',1)->get() as $item)
                                            <option value="{{$item->off_id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Total Hours to be consumed </label>
                                    <input class="form-control" type="number" name=hours placeholder="Hours" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Case Description </label>
                                    <input class="form-control"  name=case placeholder="Case Description" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date Sanctioned </label>
                                    <input class="form-control" type="date" name=Ddate placeholder="Date Sanctioned" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Completion Date </label>
                                    <input class="form-control" type="date" name=Cdate placeholder="Completion Date" required>
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea class="form-control" name=remarks style="resize:vertical; width:100%;height:107px" placeholder="Remarks" required></textarea>
                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="col-md-12" >
                                <div class="pull-right" style="">
                                    <label><input class="btn btn-success" type="checkbox" name="finish" value="0" > is Finished? </label>
                                    <button class="btn btn-success" type="submit" >Assign</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{--student--}}
    <div class="modal modal-message fade" id="add-student" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Student Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <form method="post"  action="{{action('sanction@store')}}"  enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{ method_field('POST') }}
                        <div class="row">

                            <div class="col-md-12" style="padding-bottom: 20px;">
                                <strong>Are you sure? you want to add a student profile?</strong>
                                <p>Please provide the following inputs to validate the record.</p>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Designated Office <a class="label label-danger" href="#add-office" data-dismiss="modal" data-toggle="modal">not listed?</a> </label>
                                    <select name="off_id" class="form-control" style="width: 100%;" required>
                                        <option value="" disabled selected>Please Select</option>
                                        @foreach(\App\r_office::where('stat',1)->get() as $item)
                                            <option value="{{$item->off_id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Total Hours to be consumed </label>
                                    <input class="form-control" type="number" name=hours placeholder="Hours" required>
                                </div>
                            </div><div class="col-md-4">
                                <div class="form-group">
                                    <label>Case Description </label>
                                    <input class="form-control"  name=case placeholder="Case Description" required>
                                </div>
                            </div><div class="col-md-4">
                                <div class="form-group">
                                    <label>Date Sanctioned </label>
                                    <input class="form-control" type="date" name=date placeholder="Date Sanctioned" required>
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea class="form-control" name=remarks style="resize:vertical; width:100%;height:107px" placeholder="Remarks" required></textarea>
                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="col-md-12" >
                                <div class="pull-right" style="">
                                    <label><input class="btn btn-success" type="checkbox" > is Finished? </label>
                                    <button class="btn btn-success" type="submit" >Assign</button>
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

        $('select[name=studP_id]').select2({
            dropdownParent:$('#assign-sanction')
        });
        $('select[name=off_id]').select2({
            dropdownParent:$('#assign-sanction')
        });
        $('select[name=sancT_id]').select2({
            dropdownParent:$('#assign-sanction')
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
