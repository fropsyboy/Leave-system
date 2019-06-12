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




            <div class="tables">
                <div class="bs-example widget-shadow" data-example-id="hoverable-table">

                    <table class="table table-hover" id="myTable">
                        <h4>Approval Module</h4>
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Leave Type</th>
                            <th>Staff Requesting</th>
                            <th>Staff ID</th>
                            <th>Leave Days</th>
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
                                <th scope="row">{{$leave->user->first_name}}  {{$leave->user->last_name}}</th>
                                <th>{{$leave->staff_id}}</th>
                                <th scope="row">{{$leave->leave_days}}</th>
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
                                    @if($leave->status=='pending')
                                        <a href="{{route('approve_leave',['id' => $leave->id])}}" >
                                        <button class="btn btn-xs btn-success">
                                            <i class="fa fa-check-circle-o"></i>
                                        </button>
                                        </a>
                                        <a href="{{route('reject_leave',['id' => $leave->id])}}" >
                                            <button class="btn btn-xs btn-danger">
                                                <i class="fa fa-times-circle-o"></i>
                                            </button>
                                        </a>
                                    @endif
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




        </div>
    </div>


@endsection
