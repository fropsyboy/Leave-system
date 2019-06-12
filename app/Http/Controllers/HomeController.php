<?php

namespace App\Http\Controllers;

use App\Leave;
use App\User;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $data = [
            'title' => 'SAHARA CRM : Dashboard'
        ];
        return view('back.index', $data);
    }

    /**
     * Show the application users.
     *
     * @return {$title, $users}
     */
    public function user(){
        $users = User::with('roles')->orderBy('id', 'desc')->get();
        $data = [
            'title' => 'SAHARA CRM : Dashboard',
            'users' => $users
        ];
        return view('back.users', $data);
    }

    /**
     * Adds a new user.
     * $reqBody
     *  'name', 'email', 'password',  'first_name', 'last_name', 'staff_id', 'manager_id'
     * @return {$title, resStatus}
     */
    public function user_add(Request $request){
        try {

            $user = new User;

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request['password']);
            $user->staff_id = $request->staff_id;
            $user->manager_id = $request->manager_id;
            $user->leave_bal = $request->leave_bal;
            $user->save();

            $user->attachRole($request->role);

            Session::flash('msg', 'Successful, Your Users Has been Successfully Updated');


        } catch (\Throwable $e) {

            Session::flash('msg', 'Error, There was an error while saving your credentials, ');

        }


        $data = [
            'title' => 'SAHARA CRM : Users',
        ];

        return redirect()->route('user');
    }

    /**
     * Changes the user status.
     * $id => the user ID
     * $status => current user status
     * @return {$title, $users}
     */
    public function chgStatus($id, $status){
        if($status == 'active'){
            $chfStatus = 'in-active';
        }else{
            $chfStatus = 'active';
        }

        User::where('id', $id)->update([
            'status' => $chfStatus,
        ]);

        Session::flash('msg', 'Successful, Your Status Has been Successfully Updated');
        return back();
    }

    /**
     * Show the users leave requests.
     *
     * @return {$title, $users}
     */
    public function leave(){
        $user = auth()->user() ;
        $leaves = Leave::with('manager')->where('user_id', $user->id)->orderBy('id', 'desc')->get();
        $data = [
            'title' => 'SAHARA CRM : Dashboard',
            'leaves' => $leaves,
            'balance' => $user->leave_bal
        ];
        return view('back.leaves', $data);
    }

    /**
     * Changes the leave status.
     * $id => the user ID
     * $status => current user status
     * @return {$title, $users}
     */
    public function delete_leave($id){

        $leaveReq = Leave::find($id);
        $user = User::find($leaveReq->user_id);

        $balance = $leaveReq->leave_days + $user->leave_bal;

        Leave::where('id', $id)->update([
            'status' => 'deleted',
        ]);

        User::where('id', $user->id)->update([
            'leave_bal' => $balance,
        ]);

        Session::flash('msg', 'Successful, Your Status Has been Successfully Updated');
        return back();
    }

    /**
     * Adds a new user.
     * $reqBody
     *  'type', 'start date', 'end date',  'resumption date',
     * @return {$title, resStatus}
     */
    public function leave_add(Request $request){
        try {
            $mytime = Carbon::now();
            $now = $mytime->toDateTimeString();

            $user = auth()->user() ;
            $startDate = $request->start_date;
            $endDate = $request->end_date;
            if($user->manager_id) {
                $manager = User::where('staff_id', $user->manager_id)->first();
            }else{
                $manager = $user;
            }
            $resumption_date = $request->resuption_date;

            $verifyDays = getDays($startDate, $endDate);
            if ($verifyDays > $user->leave_bal){
                Session::flash('LeaveError', 'Error, The requested days is greater than your remaining LEAVE DAYS, ');

                $data = [
                    'title' => 'SAHARA CRM : Users',
                ];

                return redirect()->route('leave');
            }


            $leaveReq = new Leave;
            $leaveReq->type = $request->type;
            $leaveReq->user_id = $user->id;
            $leaveReq->manager_id = $manager->id;
            $leaveReq->leave_days = $verifyDays;
            $leaveReq->reason = $request->reason;
            $leaveReq->start_date = $startDate;
            $leaveReq->end_date = $endDate;
            $leaveReq->resumption_date = $request->resuption_date;

            $leaveReq->save();

            $balance = $user->leave_bal - $verifyDays ;

            User::where('id', $user->id)
                ->update(['leave_bal' => $balance]);

            Session::flash('msg', 'Successful, Your Leave Form Has been Successfully Submitted');


        } catch (\Throwable $e) {

            Session::flash('msg', 'Error, There was an error while saving your credentials, ');

        }

        $data = [
            'title' => 'SAHARA CRM : Users',
        ];

        return redirect()->route('leave');
    }

    /**
     * User Settings
     * $id => the user ID
     * $status => current user status
     * @return {$title, $users}
     */
    public function settings(){
        $user = auth()->user() ;

        $data = [
            'title' => 'SAHARA CRM : Users',
            'user' => $user
        ];

        Session::flash('msg', 'Successful, Your Status Has been Successfully Updated');
        return view('back.settings', $data);
    }

    /**
     * Leave Approval by Line managers
     *
     * @return
     */
    public function approval(){
        $user = auth()->user() ;

        $lease = Leave::with('user')->where('manager_id', $user->id)->orderBy('id', 'desc')->get();

        $data = [
            'title' => 'SAHARA CRM : Dashboard',
            'leaves' => $lease,
        ];
        return view('back.approval', $data);
    }

    /**
     * Changes the leave status.
     * $id => the user ID
     * $status => current user status
     * @return {$title, $users}
     */
    public function reject_leave($id){

        $leaveReq = Leave::find($id);
        $user = User::find($leaveReq->user_id);

        $balance = $leaveReq->leave_days + $user->leave_bal;

        Leave::where('id', $id)->update([
            'status' => 'rejected',
        ]);

        User::where('id', $user->id)->update([
            'leave_bal' => $balance,
        ]);

        Session::flash('msg', 'Successful, Your Status Has been Successfully Updated');
        return back();
    }

    /**
     * Changes the leave status.
     * $id => the user ID
     * $status => current user status
     * @return {$title, $users}
     */
    public function approve_leave($id){

        Leave::where('id', $id)->update([
            'status' => 'approved',
        ]);

        Session::flash('msg', 'Successful, Your Status Has been Successfully Updated');
        return back();
    }
}
