<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topper extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'percentage', 'description'];
}
