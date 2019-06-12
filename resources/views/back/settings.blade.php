@extends('back.layout')
@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            <div class="form-three widget-shadow">
                <div class=" panel-body-inputin">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Email Address</label>
                            <div class="col-md-8">
                                <div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-envelope-o"></i>
												</span>
                                    <input type="text" class="form-control1" placeholder="Email Address" value="{{$user->email}}" disabled="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">First Name</label>
                            <div class="col-md-8">
                                <div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-key"></i>
												</span>
                                    <input type="text" value="{{$user->first_name}}" class="form-control1" id="exampleInputPassword1" placeholder="Full Name" disabled="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Last Name</label>
                            <div class="col-md-8">
                                <div class="input-group input-icon right">
												<span class="input-group-addon">
													<i class="fa fa-envelope-o"></i>
												</span>
                                    <input id="text" value="{{$user->last_name}}" class="form-control1" type="text" placeholder="Phone Number" disabled="">
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Staff ID</label>
                            <div class="col-md-8">
                                <div class="input-group input-icon right">
												<span class="input-group-addon">
													<i class="fa fa-key"></i>
												</span>
                                    <input type="text" value="{{$user->staff_id}}" class="form-control1" placeholder="Referer Code" disabled="">
                                </div>
                            </div>

                        </div>


                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
