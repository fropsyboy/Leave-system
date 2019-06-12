<?php

use App\User;
use App\Role;
use Carbon\Carbon;
use App\Leave;

function getUsers(){
    $users = User::where('status', 'active')->get();
    return $users;
}

function getRoles(){
    return Role::all();
}

function getDays($start_date, $end_date){
    $dt = Carbon::parse($start_date);
    $dt2 = Carbon::parse($end_date);

    $daysForExtraCoding = $dt->diffInDaysFiltered(function(Carbon $date) {
        return !$date->isWeekend();
    }, $dt2);

    return $daysForExtraCoding;
}

function getPending(){
    $user = auth()->user() ;
    $pending = Leave::where('user_id', $user->id)->where('status', 'pending')->count();

    return $pending;
}

function waitPending(){
    $user = auth()->user() ;
    $pending = Leave::where('manager_id', $user->id)->where('status', 'pending')->count();

    return $pending;
}

function totalRequest(){
    $user = auth()->user() ;
    $pending = Leave::where('user_id', $user->id)->count();

    return $pending;
}

function approvedRequest(){
    $user = auth()->user() ;
    $pending = Leave::where('user_id', $user->id)->where('status', 'approved')->count();

    return $pending;
}

function rejectedRequest(){
    $user = auth()->user() ;
    $pending = Leave::where('user_id', $user->id)->where('status', 'rejected')->count();

    return $pending;
}

function deletedRequest(){
    $user = auth()->user() ;
    $pending = Leave::where('user_id', $user->id)->where('status', 'deleted')->count();

    return $pending;
}

function remainingRequest(){
    $user = auth()->user() ;

    return $user->leave_bal;
}

