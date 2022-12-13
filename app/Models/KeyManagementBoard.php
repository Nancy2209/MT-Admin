<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyManagementBoard extends Model
{
    protected $table = 'key_management_board';

    protected $fillable = ['name', 'designation', 'image'];
}
