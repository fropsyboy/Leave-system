@extends('back.layout')
@section('content')
    <!-- //header-ends -->
    <!-- main content start-->
    <div id="page-wrapper">
        <div class="main-page">
            @if(session()->has('msg'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Alert...! </strong> {{ Session::get('msg', '') }}
                </div>
            @endif

                @if(session()->has('LeaveError'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Alert...! </strong> {{ Session::get('LeaveError', '') }}
                    </div>
                @endif

            <div class="col-md-4 modal-grids">
                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#leaveForm" data-whatever="@mdo">
                    Leave Form - ({{$balance}} day(s))
                </button>

            </div>



            <div class="tables">
                <div class="bs-example widget-shadow" data-example-id="hoverable-table">

                    <table class="table table-hover" id="myTable">
                        <h4>Leave Module</h4>
                        <h5>Leave Balance : {{$balance}} day(s)</h5>
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Leave Type</th>
                            <th>Approving Manager</th>
                            <th>Leave Days</th>
                            <th>Reason</th>
                            <th>Date Created</th>
                            <th>Start Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($leaves as $leave)
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <th>{{$leave->type}}</th>
                                <th scope="row">{{$leave->manager->first_name}}  {{$leave->manager->last_name}}</th>
                                <th scope="row">{{$leave->leave_days}}</th>
                                <th>{{$leave->reason}}</th>
                                <th scope="row">{{$leave->created_at->toFormattedDateString() }}</th>
                                <td scope="row">{{$leave->start_date }}</td>

                                <td>
                                    @if($leave->status=='pending')
                                        <span class="label label-primary1">
                                        {{strtoupper($leave->status)}}
                                        </span>
                                    @elseif($leave->status=='approved')
                                        <span class="label label-success">
                                        {{strtoupper($leave->status)}}
                                         </span>
                                        @else
                                        <span class="label label-danger">
                                        {{strtoupper($leave->status)}}
                                         </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('delete_leave',['id' => $leave->id])}}" >

                                        @if($leave->status=='pending')
                                            <button class="btn btn-xs btn-danger">
                                                Delete
                                            </button>
                                        @else
                                            <button class="btn btn-xs btn-info">
                                                View
                                            </button>
                                        @endif
                                    </a>
                                </td>


                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



            <!-- for amcharts js -->
            <script src=" {{ URL::asset('assets/back/js/amcharts.js') }}"></script>
            <script src=" {{ URL::asset('assets/back/js/serial.js') }}"></script>
            <script src=" {{ URL::asset('assets/back/js/export.min.js') }}"></script>
            <link rel="stylesheet" href=" {{ URL::asset('assets/back/css/export.css') }}" type="text/css" media="all" />
            <script src=" {{ URL::asset('assets/back/js/light.js') }}"></script>
            <!-- for amcharts js -->

            <script  src=" {{ URL::asset('assets/back/js/index1.js') }}"></script>


            <script type="text/javascript">
                $(function() {
                    var id = $("#id").val();
                    var amount = $("#amount").val();
                    var idd = $("#idd").val();
                    var amountd = $("#amountd").val();

                    $("#send").on('click', function () {

                        $("#demo").html(amount);
                        $("#demox").html(id);


                    });



                    $("#liquid").on('click', function () {

                        document.getElementById("idt").value = id;


                    });
                    $("#delete").on('click', function () {

                        $("#demod").html(amountd);
                        $("#demoxd").html(idd);


                    });

                    $("#del").on('click', function () {

                        document.getElementById("idd").value = idd;


                    });

                });
            </script>


        </div>
    </div>


@endsection
