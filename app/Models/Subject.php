<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'classCategory_id', 'course_id', 'board_name', 'name'
    ];

    public function classCategory()
    {
        return $this->hasOne('\App\Models\ClassCategory', 'id', 'classCategory_id');
    }

    public function CourseType()
    {
        return $this->hasOne('\App\Models\CourseType', 'id', 'course_id');
    }
}
