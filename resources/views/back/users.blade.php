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

            <div class="col-md-4 modal-grids">
                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add User</button>

            </div>



            <div class="tables">

                <div class="bs-example widget-shadow" data-example-id="hoverable-table">

                    <table class="table table-hover" id="myTable">
                        <h4>User Module</h4>
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Leave Balance</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Manager ID</th>
                            <th>Email</th>
                            <th>Date Created</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <th scope="row">{{$user->leave_bal ? $user->leave_bal : 0 }} </th>
                            <th scope="row">{{$user->first_name}}</th>
                            <th scope="row">{{$user->last_name}}</th>
                            <th scope="row">{{$user->manager_id ? $user->manager_id : "N/A" }}</th>
                            <th scope="row">{{$user->email}}</th>
                            <th scope="row">{{$user->created_at->toFormattedDateString() }}</th>
                            <td>
                                @if($user->status=='in-active')
                                        <span class="label label-danger">
                                        {{strtoupper($user->status)}}
                                        </span>
                                    @endif
                                @if($user->status=='active')
                                        <span class="label label-success">
                                        {{strtoupper($user->status)}}
                                         </span>
                                @endif
                            </td>
                            <td>
                                    {{strtoupper($user->roles->first()->name)}}
                            </td>
                            <td>
                                <a href="{{route('chgStatus',['id' => $user->id,'status' => $user->status])}}" >

                                    @if($user->status=='active')
                                        <button class="btn btn-xs btn-danger">
                                            Disable
                                        </button>
                                    @else
                                        <button class="btn btn-xs btn-info">
                                            Enable
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
