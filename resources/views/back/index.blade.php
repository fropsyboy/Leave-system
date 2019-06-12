@extends('back.layout')
@section('content')
    <!-- //header-ends -->
    <!-- main content start-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div id="page-wrapper">
        <div class="main-page">
            <div class="col_3">
                <div class="col-md-3 widget widget1">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-dollar icon-rounded"></i>
                        <div class="stats">
                            <h5><strong>{{totalRequest()}}</strong></h5>
                            <span>Total Requests</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 widget widget1">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-laptop user1 icon-rounded"></i>
                        <div class="stats">
                            <h5><strong>{{approvedRequest()}}</strong></h5>
                            <span>Approved Requests</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 widget widget1">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-money user2 icon-rounded"></i>
                        <div class="stats">
                            <h5><strong>{{rejectedRequest()}}</strong></h5>
                            <span>Rejected Requests</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 widget widget1">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-pie-chart dollar1 icon-rounded"></i>
                        <div class="stats">
                            <h5><strong>{{deletedRequest()}}</strong></h5>
                            <span>Deleted Request</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 widget">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-users dollar2 icon-rounded"></i>
                        <div class="stats">
                            <h5>
                                <strong style="color: #0F9E5E">{{remainingRequest()}}</strong>
                            </h5>
                            <span>Leave Remaining</span>
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>


            <div class="row-one widgettable">
                <div class="col-12 content-top-2 card">
                    <div class="agileinfo-cdr">
                        <div class="card-header">
                        </div>
                        <div id="dual_x_div" style="width: 900px; height: 500px;">

                        </div>
                        </div>

                    </div>
                </div>
                <div class="clearfix"> </div>
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
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawStuff);

    function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
            ['Months', 'Request', 'Balance'],
            ['February', 0, 20],
            ['March', 2, 18],
            ['April', 2, 16],
            ['May', 5, 11],
            ['June', 3, 8],
            ['July', 1, 7]

        ]);

        var options = {
            width: 800,
            chart: {
                title: 'Leave Request',
            },
            bars: 'horizontal', // Required for Material Bar Charts.
            series: {
                0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
                1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.
            },
            axes: {
                x: {
                    distance: {label: 'Days'}, // Bottom x-axis.
                    brightness: {side: 'top', label: 'Days'} // Top x-axis.
                }
            }
        };

        var chart = new google.charts.Bar(document.getElementById('dual_x_div'));
        chart.draw(data, options);
    };
</script>


        </div>
    </div>


{{--    <div class="modal fade" id="createProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <form method="post" action="{{route('addProduct')}}" enctype="multipart/form-data">--}}
{{--                {{csrf_field()}}--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
{{--                    <h4 class="modal-title" id="exampleModalLabel">Make An Investment</h4>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}


{{--                        --}}
{{--                        <div class="form-group">--}}
{{--                            <label for="recipient-name" class="control-label">Product Name:</label>--}}
{{--                            <input type="text" class="form-control" name="name" value="" >--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label for="recipient-name" class="control-label">Product Quantity:</label>--}}
{{--                            <input type="number" class="form-control" name="quantity"  value="0">--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label for="recipient-name" class="control-label">Product Amount:</label>--}}
{{--                            <input type="number" class="form-control" name="amount" value="0">--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label for="recipient-name" class="control-label">Product Description:</label>--}}
{{--                            <textarea class="form-control"  name="description"></textarea>--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label for="recipient-name" class="control-label">Product Image A:</label>--}}
{{--                            <input type="file" class="form-control" name="image1" >--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label for="recipient-name" class="control-label">Product Image B:</label>--}}
{{--                            <input type="file" class="form-control" name="image2" >--}}
{{--                        </div>--}}

{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
{{--                    <button type="submit" class="btn btn-primary">Add Product</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
