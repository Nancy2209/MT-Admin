<?php

namespace App\Models;

use App\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserAttendance extends Authenticatable
{
    use Notifiable;

    protected $table = 'user_attendance';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'face_status', 'location_status', 'intime','outtime','category','reason', 'status'];

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }
}
