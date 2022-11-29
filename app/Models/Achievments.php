<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievments extends Model
{
    use HasFactory;
    protected $fillable = ['student_ratio', 'faculty_ratio', 'institute_ratio', 'school_ratio', 'college_ratio'];
}
