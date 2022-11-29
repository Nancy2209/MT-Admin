<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyManagement extends Model
{
    protected $fillable = ['title', 'address', 'address1', 'mobile', 'email', 'fax'];
}
