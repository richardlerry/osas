@extends('layouts.main')

@section('title',$sanctions->first()->rStudentProfile->lname.', '.$sanctions->first()->rStudentProfile->fname.' '.$sanctions->first()->rStudentProfile->mname)

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

                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">{{$sanctions->first()->rStudentProfile->lname.', '.$sanctions->first()->rStudentProfile->fname.' '.$sanctions->first()->rStudentProfile->mname}}</h4>
                </div>
                <!-- end panel-heading -->

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
                            <th>Info</th>
                            <th>Total Hours</th>
                            <th>To be Finished</th>
                            <th>Remarks</th>
                            <th>Date Created</th>
                            <th>Is Finished</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sanctions as $item)
                            <tr style="background: {{($item->isFinished==1)?'#ccffde':'#ffddda'}} ;">
                                <form method="post" action="{{action('sanction@update',$item->sancT_id)}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <td>
                                        <strong>
                                            Sanction Title: {{$item->rSanctionTitle->title}}
                                        </strong>
                                        <br>
                                        <small>
                                           Designated Office: {{$item->rOffice->title}}
                                        </small>
                                    </td>
                                    <td>
                                        <input required="" name="hours"  value="{{ $item->totalHours  }}" class="form-control" >
                                    </td>
                                    <td>
                                        <input required="" name="Cdate" type="date" value="{{ $item->completionDate  }}" class="form-control" >
                                    </td>
                                    <td>
                                        <textarea name=remarks class="form-control">{{$item->remarks}}</textarea>
                                    </td>
                                    <td>{{ (new DateTime($item->created_at))->format('D M d, Y | h:i A') }}</td>
                                    <td>
                                        <center>
                                            <input class="form-control" type="checkbox" {{($item->isFinished)?'checked':''}} name="finish">
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <button class="btn btn-success" type="submit" ><i class="fas fa-check text-white"></i></button>
                                        </center>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <th style="width: 30%">Info</th>
                        <th>Total Hours</th>
                        <th>To be Finished</th>
                        <th>Remarks</th>
                        <th>Date Created</th>
                        <th>Is Finished</th>
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
