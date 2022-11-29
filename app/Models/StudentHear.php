<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentHear extends Model
{
    use HasFactory;

    protected $table = 'students_hears';

    protected $fillable = ['name', 'image', 'description', 'designation'];
}
