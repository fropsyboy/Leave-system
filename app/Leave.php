<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    //
    protected $table = 'leave_request';

    public function manager(){
        return $this->belongsTo(User::class,'manager_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
