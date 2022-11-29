<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UsersQuery extends Authenticatable
{
    protected $table = 'user_query';

    protected $fillable = ['name', 'email', 'mobile', 'category', 'board', 'standards'];
}
